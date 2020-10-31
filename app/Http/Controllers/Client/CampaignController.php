<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Campaign;
use App\Exports\CampaignExport;
use App\Publisher;
use App\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CampaignController extends Controller
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $req = $request->all();
        if(auth()->user()->campaigns()->count() === 0) {
            $campaigns = $this->campaign
                ->search($req['search'] ?? '')
                ->statusIs('demo')
                ->platformIs($req['platform'] ?? '')
                ->orderBy($req['order_col'] ?? 'id', $req['order_dir'] ?? 'desc')
                ->paginate($req['perpage'] ?? 10);

            return view('client.campaigns.index')
                ->withCampaigns($campaigns)
                ->withData($req)
                ->withIsDemo(true)
                ->withPageTitle(__('client.campaigns.title'));
        }

        $campaigns = auth()->user()->campaigns()
            ->search($req['search'] ?? '')
            ->statusIs('active')
            ->platformIs($req['platform'] ?? '')
            ->orderBy($req['order_col'] ?? 'id', $req['order_dir'] ?? 'desc')
            ->paginate($req['perpage'] ?? 10);

        return view('client.campaigns.index')
            ->withCampaigns($campaigns)
            ->withData($req)
            ->withPageTitle(__('client.campaigns.title'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $campaign = $this->campaign->where('id', $id)->first();

        if ($campaign->platform !== 'telegram') {
            $customer_cost = 0;
            foreach($campaign->contents AS $content) {
                $customer_cost += $content->type === 'impression' ? ($content->impersion_cnt * $content->customer_cost) :($content->customer_cost ?? 0);
            }
            // dd($customer_cost);
            $budgetData = [
                'cost' => $customer_cost,
                'costPerImp' => $campaign->impersion_cnt == 0 ? 0 :    $customer_cost / ($campaign->impersion_cnt ? $campaign->impersion_cnt : 1),
                'costPerClick' => $campaign->clicks_cnt == 0 ? 0 : $customer_cost  / ($campaign->clicks_cnt ? $campaign->clicks_cnt : 1),
                'costPerReach' => $campaign->reach_cnt == 0 ? 0 : $customer_cost / ($campaign->reach_cnt ? $campaign->reach_cnt : 1),
            ];
            $ratioData = [
                'impPerClick' => round($campaign->clicks_cnt / ($campaign->impersion_cnt ? $campaign->impersion_cnt : 1), 3),
                'impPerReach' => round($campaign->reach_cnt / ($campaign->impersion_cnt ? $campaign->impersion_cnt : 1), 3),
                'impPerStickerTap' => round($campaign->sticker_tap_cnt / ($campaign->impersion_cnt ? $campaign->impersion_cnt : 1), 3),
                'impPerShare' => round($campaign->sticker_tap_cnt / ($campaign->impersion_cnt ? $campaign->impersion_cnt : 1), 3),
                'impPerLike' => round($campaign->sticker_tap_cnt / ($campaign->impersion_cnt ? $campaign->impersion_cnt : 1), 3),
            ];
            $bestContents = [
                'reach' => $campaign->contents()->orderBy('reach_cnt', 'desc')->limit(5)->get(),
                'click' => $campaign->contents()->orderBy('clicks_cnt', 'desc')->limit(5)->get(),
                'sticker_tap' => $campaign->contents()->orderBy('sticker_tap_cnt', 'desc')->limit(5)->get(),
                'share' => $campaign->contents()->orderBy('share_cnt', 'desc')->limit(5)->get(),
            ];
            return view('client.campaigns.showInstagram')
                ->withCampaign($campaign)
                ->withBudgetData($budgetData)
                ->withRatioData($ratioData)
                ->withBestContents($bestContents)
                ->withPageTitle($campaign->name)
                ->withIsDemo($this->user->campaigns()->count() === 0)
                ->withPageTitle(__('client.campaigns.campaign') . $campaign->name);
        } else {
            $customer_cost = 0;
            foreach($campaign->contents AS $content) {
                $customer_cost += $content->type === 'impression' ? ($content->impersion_cnt * $content->customer_cost) :($content->customer_cost ?? 0);
            }
            $budgetData = [
                'cost' => $customer_cost,
                'costPerImp' => $customer_cost / ($campaign->impersion_cnt ? $campaign->impersion_cnt : 1),
            ];
            $ratioData = [
                'impPerClick' => round($campaign->clicks_cnt / ($campaign->impersion_cnt ? $campaign->impersion_cnt : 1), 3),
                'impPerReach' => round($campaign->reach_cnt / ($campaign->impersion_cnt ? $campaign->impersion_cnt : 1), 3),
                'impPerStickerTap' => round($campaign->sticker_tap_cnt / ($campaign->impersion_cnt ? $campaign->impersion_cnt : 1), 3),
                'impPerShare' => round($campaign->sticker_tap_cnt / ($campaign->impersion_cnt ? $campaign->impersion_cnt : 1), 3),
                'impPerLike' => round($campaign->sticker_tap_cnt / ($campaign->impersion_cnt ? $campaign->impersion_cnt : 1), 3),
            ];
            $bestPublishers = [
                'reach' => $campaign->contents()->orderBy('reach_cnt', 'desc')->with('contentPublishers')->limit(5)->get(),
                'click' => $campaign->contents()->orderBy('clicks_cnt', 'desc')->with('contentPublishers')->limit(5)->get(),
                'sticker_tap' => $campaign->contents()->orderBy('sticker_tap_cnt', 'desc')->with('contentPublishers')->limit(5)->get(),
                'share' => $campaign->contents()->orderBy('share_cnt', 'desc')->with('contentPublishers')->limit(5)->get(),
            ];
            return view('client.campaigns.showTelegram')
                ->withCampaign($campaign)
                ->withBudgetData($budgetData)
                ->withRatioData($ratioData)
                ->withBestPublishers($bestPublishers)
                ->withIsDemo($this->user->campaigns()->count() === 0)
                ->withPageTitle(__('client.campaigns.campaign') . $campaign->name);
        }
    }

    public function downloadExcel(Campaign $campaign)
    {
        return Excel::download(new CampaignExport($campaign), 'invoices.xlsx');
    }
}
