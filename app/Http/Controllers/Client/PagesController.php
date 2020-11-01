<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Campaign;
use App\Publisher;
use App\User;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    protected $campaign;
    protected $user;
    protected $publisher;
    public function __construct(Campaign $campaign, User $user, Publisher $publisher)
    {
        $this->campaign = $campaign;
        $this->user = $user;
        $this->publisher = $publisher;
    }

    function dashboard()
    {
        $isDemo = false;
        if(auth()->user()->campaigns()->count()) {
            $instagramCampaignsData = auth()
                ->user()
                ->campaigns()
                ->where(function($query) {
                    $query->where('platform', 'instagram_post')
                    ->orWhere('platform', 'instagram_story');
                })
                ->withCount('contents')
                ->withCount('contentPublishers')
                ->where('status', 'active')
                ->orderBy('id','desc')
                ->get();

            $telegramCampaignsData = auth()
                ->user()
                ->campaigns()
                ->where('status', 'active')
                ->where('platform', 'telegram')
                ->withCount('contents')
                ->withCount('contentPublishers')
                ->orderBy('id','desc')
                ->get();
            $campaigns = auth()->user()->campaigns()->statusIs('active')->limit(7)->orderBy('id', 'DESC')->get();
        } else {
            $instagramCampaignsData = $this->campaign
            ->where(function($query) {
                $query->where('platform', 'instagram_post')
                ->orWhere('platform', 'instagram_story');
            })
            ->withCount('contents')
            ->withCount('contentPublishers')
            ->where('status', 'demo')
            ->orderBy('id','desc')
            ->get();

            $telegramCampaignsData = $this->campaign
                ->where('status', 'demo')
                ->where('platform', 'telegram')
                ->withCount('contents')
                ->withCount('contentPublishers')
                ->orderBy('id','desc')
                ->get();
            $campaigns = $this->campaign->statusIs('demo')->limit(7)->orderBy('id', 'DESC')->get();
            $isDemo = true;
        }
        $instagramCampaigns = [
            'campaign_cnt' => 0,
            'imp_cnt' => 0,
            'reach_cnt' => 0,
            'clicks_cnt' => 0,
            'like_cnt' => 0,
            'tap_cnt' => 0,
            'publisher_cnt' => 0,
            'cost' => 0,
        ];

        $instagramStat = [
            'imp' => [],
            'publisher' => [],
            'names' => []
        ];

        if (count($instagramCampaignsData)) {
            foreach ($instagramCampaignsData as $index => $instagramCampaign) {
                $instagramCampaigns['campaign_cnt']++;
                $instagramCampaigns['imp_cnt'] += $instagramCampaign->impersion_cnt;
                $instagramCampaigns['reach_cnt'] += $instagramCampaign->reach_cnt;
                $instagramCampaigns['clicks_cnt'] += $instagramCampaign->clicks_cnt;
                $instagramCampaigns['like_cnt'] += $instagramCampaign->like_cnt;
                $instagramCampaigns['tap_cnt'] += $instagramCampaign->sticker_tap_cnt;
                $instagramCampaigns['publisher_cnt'] += $instagramCampaign->content_publishers_count;
                if ($index < 7) {
                    $instagramStat['imp'][] = $instagramCampaign->impersion_cnt / 10;
                    $instagramStat['publisher'][] = $instagramCampaign->content_publishers_count;
                    $instagramStat['names'][] = $instagramCampaign->name;
                }
                if (count($instagramCampaign->contents)) {
                    $instagramCampaigns['cost'] = $instagramCampaigns['cost'] ?? 0;
                    foreach ($instagramCampaign->contents as $content) {
                        $instagramCampaigns['cost'] += $content->type === 'impression' ? ($content->impersion_cnt * $content->customer_cost) :($content->customer_cost ?? 0);
                    }
                }
            }
        }



        $telegramCampaigns = [
            'campaign_cnt' => 0,
            'imp_cnt' => 0,
            'publisher_cnt' => 0,
            'cost' => 0,
        ];

        $telegramStat = [
            'imp' => [],
            'publisher' => [],
            'names' => []
        ];

        if (count($telegramCampaignsData)) {
            foreach ($telegramCampaignsData as $telegramCampaign) {
                $telegramCampaigns['campaign_cnt']++;
                $telegramCampaigns['imp_cnt'] += $telegramCampaign->impersion_cnt;
                $telegramCampaigns['publisher_cnt'] += $telegramCampaign->content_publishers_count;
                $telegramStat['imp'][] = $telegramCampaign->impersion_cnt;
                $telegramStat['publisher'][] = $telegramCampaign->content_publishers_count;
                $telegramStat['names'][] = $telegramCampaign->name;
                if (count($telegramCampaign->contents)) {
                    foreach ($telegramCampaign->contents as $content) {
                        $instagramCampaigns['cost'] += $content->type === 'impression' ? ($content->impersion_cnt * $content->customer_cost) :($content->customer_cost ?? 0);
                    }
                }
            }
        }

        return view('client.pages.dashboard')
            ->withInstagramCampaigns($instagramCampaigns)
            ->withTelegramCampaigns($telegramCampaigns)
            ->withTelegramStat($telegramStat)
            ->withInstagramStat($instagramStat)
            ->withCampaigns($campaigns)
            ->withIsDemo($isDemo)
            ->withPageTitle(__('client.dashboard.title'));
    }
}
