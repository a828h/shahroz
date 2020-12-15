<?php

namespace App\Http\Controllers\Admin;

use App\Campaign;
use App\ContentPublisher;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatController extends Controller
{
    public function index(Request $request)
    {
        $days = $request->input("days") ?? 7;
        $campaigns = Campaign::with(["contents"])->where("start_at",">",Carbon::now()->subDays($days)->format("Y-m-d"))
            ->get();
        $campaignCnt = $campaigns->count();
        $publisherArr = $campaignTelegram = $campaignInstagram = $publishersDataArr = $publisherStat = $huntersData = [];
        $ourCost = $customerCost = 0;
        $campaignTelegramCnt = $campaignInstagramCnt = 0;
        foreach ($campaigns as $campaign) {
            $contentPublishers = ContentPublisher::whereIn("content_id",$campaign->contents()->pluck("id")->toArray())->get();
            foreach ($contentPublishers as $publisher) {
                $publisherArr[$publisher->publisher_id][] = $campaign;
                $publishersDataArr[$publisher->publisher_id] = $publisher->publisher;
            }

            $huntersData[$campaign->hunter_id]['hunter_data'] = $campaign->hunter;
            $huntersData[$campaign->hunter_id]['campaign_cnt'] = ($huntersData[$campaign->hunter_id]['campaign_cnt']??0)+1;

            $ourCostThisCampaign = $customerCostThisCampaign = 0;
            foreach ($campaign->contents as $content) {
                switch ($content->type) {
                    case "impression":
                        $ourCost += $content->our_cost * $content->impresion_cnt;
                        $ourCostThisCampaign += $content->our_cost * $content->impresion_cnt;
                        $customerCost += $content->customer_cost * $content->impresion_cnt;
                        $customerCostThisCampaign += $content->customer_cost * $content->impresion_cnt;
                        break;
                    case "fix":
                        $ourCost += $content->our_cost;
                        $ourCostThisCampaign += $content->our_cost;
                        $customerCost += $content->customer_cost;
                        $customerCostThisCampaign += $content->customer_cost;
                        break;
                }
                foreach ($contentPublishers as $contentPublisher) {
                    $publisherStat[$contentPublisher->publisher_id]["campaign_cnt"] = ($publisherStat[$contentPublisher->publisher_id]["campaign_cnt"]??0) + 1;
                    $publisherStat[$contentPublisher->publisher_id]["click_cnt"] = ($publisherStat[$contentPublisher->publisher_id]["click_cnt"] ?? 0) + $content->clicks_cnt/count($contentPublishers);
                    $publisherStat[$contentPublisher->publisher_id]["impression_cnt"] = ($publisherStat[$contentPublisher->publisher_id]["impression_cnt"]??0) + $content->impersion_cnt/count($contentPublishers);
                    $publisherStat[$contentPublisher->publisher_id]["sticker_tap_cnt"] = ($publisherStat[$contentPublisher->publisher_id]["sticker_tap_cnt"]??0) + $content->sticker_tap_cnt/count($contentPublishers);
                    $publisherStat[$contentPublisher->publisher_id]["like_cnt"] = ($publisherStat[$contentPublisher->publisher_id]["like_cnt"]??0) + $content->like_cnt/count($contentPublishers);
                    $publisherStat[$contentPublisher->publisher_id]["share_cnt"] = ($publisherStat[$contentPublisher->publisher_id]["share_cnt"]??0) + $content->share_cnt/count($contentPublishers);
                    $publisherStat[$contentPublisher->publisher_id]["reach_cnt"] = ($publisherStat[$contentPublisher->publisher_id]["reach_cnt"]??0) + $content->reach_cnt/count($contentPublishers);
                    $publisherStat[$contentPublisher->publisher_id]["save_cnt"] = ($publisherStat[$contentPublisher->publisher_id]["save_cnt"]??0) + $content->save_cnt/count($contentPublishers);
                    $publisherStat[$contentPublisher->publisher_id]["comment_cnt"] = ($publisherStat[$contentPublisher->publisher_id]["comment_cnt"]??0) + $content->comment_cnt/count($contentPublishers);
                }

                $huntersData[$campaign->hunter_id]['customer_cost'] = ($huntersData[$campaign->hunter_id]['customer_cost']??0) + $content->customer_cost;
                $huntersData[$campaign->hunter_id]['our_cost'] = ($huntersData[$campaign->hunter_id]['our_cost']??0) + $content->our_cost;
                $huntersData[$campaign->hunter_id]['income'] = ($huntersData[$campaign->hunter_id]['income'] ?? 0) +  ($content->customer_cost - $content->our_cost);

            }
            $campaign->our_cost = $ourCostThisCampaign;
            $campaign->customer_cost = $customerCostThisCampaign;
            switch ($campaign->platform){
                case "telegram":
                    $campaignTelegramCnt++;
                    $campaignTelegram[] = $campaign;
                    break;
                case "instagram_post":
                case "instagram_story":
                    $campaignInstagramCnt++;
                    $campaignInstagram[] = $campaign;
                break;
            }


        }
//        dd($huntersData);
        $allPublisherInCampaign = 0 ;
        foreach ($publisherArr as $publisher_id => $camps) {
            $allPublisherInCampaign += count($camps);
        }
        return view("admin.stat.index")
            ->withCampaignCnt($campaignCnt)
            ->withCampaignsTelegram($campaignTelegram)
            ->withCampaignsInstagram($campaignInstagram)
            ->withCampaignCntTelegram($campaignTelegramCnt)
            ->withCampaignCntInstagram($campaignInstagramCnt)
            ->withCampaignAllPublisherCnt($allPublisherInCampaign)
            ->withCampaignAllPublisherUniqueCnt(count($publisherArr))
            ->withPublisherData($publishersDataArr)
            ->withPublisherStat($publisherStat)
            ->withHunterData($huntersData)
            ->withDays($days)
            ->withOurCost($ourCost)
            ->withCustomerCost($customerCost)
            ;
    }
}
