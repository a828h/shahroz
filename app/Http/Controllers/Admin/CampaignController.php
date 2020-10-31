<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Http\Controllers\Controller;
use App\Campaign;
use App\Category;
use App\ContentRow;
use App\Document;
use App\Http\Requests\admin\campaigns\storeCampaignRequest;
use App\Http\Requests\admin\campaigns\storeDraftRequest;
use App\Http\Requests\admin\campaigns\updateCampaignRequest;
use App\Imports\CampaignPublisherInstagramImport;
use App\Imports\CampaignPublisherTelegramImport;
use App\Publisher;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class CampaignController extends Controller
{
    protected $campaign;
    protected $user;
    protected $publisher;
    protected $category;
    protected $brand;
    public function __construct(Campaign $campaign, User $user, Publisher $publisher, Category $category, Brand $brand, Document $document)
    {
        $this->campaign = $campaign;
        $this->user = $user;
        $this->publisher = $publisher;
        $this->category = $category;
        $this->brand = $brand;
        $this->document = $document;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $req = $request->all();
        $campaigns = $this->campaign
            ->search($req['search'] ?? '')
            ->statusIs($req['status'] ?? '')
            ->platformIs($req['platform'] ?? '')
            ->categoryIn($req['categories'] ?? '')
            ->brandIn($req['brands'] ?? '')
            ->orderBy($req['order_col'] ?? 'id', $req['order_dir'] ?? 'desc')
            ->with(['categories', 'brands'])
            ->paginate($req['perpage'] ?? 10);

        return view('admin.campaigns.index')
            ->withCampaigns($campaigns)
            ->withData($req)
            ->withCategories($this->category->all()->pluck('name', 'id')->toArray())
            ->withBrands($this->brand->all()->pluck('name', 'id')->toArray());
    }

    public function drafts(Request $request)
    {
        $req = $request->all();
        $campaigns = $this->campaign
            ->search($req['search'] ?? '')
            ->statusIs('draft')
            ->platformIs($req['platform'] ?? '')
            ->categoryIn($req['categories'] ?? '')
            ->brandIn($req['brands'] ?? '')
            ->orderBy($req['order_col'] ?? 'id', $req['order_dir'] ?? 'desc')
            ->with(['categories', 'brands'])
            ->paginate($req['perpage'] ?? 10);

        return view('admin.campaigns.drafts')
            ->withCampaigns($campaigns)
            ->withData($req)
            ->withCategories($this->category->all()->pluck('name', 'id')->toArray())
            ->withBrands($this->brand->all()->pluck('name', 'id')->toArray());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = $this->user->all()->pluck('fullName', 'id')->toArray();
        $publishers = $this->publisher->all()->pluck('name', 'id')->toArray();
        $last = DB::table('campaigns')->orderBy('id', 'DESC')->first();
        return view('admin.campaigns.create')
            ->withUsers($users)
            ->withPublishers($publishers)
            ->withCampaignId($last ? $last->id : 1)
            ->withCategories($this->category->all()->pluck('name', 'id')->toArray())
            ->withBrands($this->brand->all()->pluck('name', 'id')->toArray());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createDrafts()
    {
        $users = $this->user->all()->pluck('fullName', 'id')->toArray();
        $publishers = $this->publisher->all()->pluck('name', 'id')->toArray();
        return view('admin.campaigns.createDrafts')
            ->withUsers($users)
            ->withPublishers($publishers)
            ->withCategories($this->category->all()->pluck('name', 'id')->toArray())
            ->withBrands($this->brand->all()->pluck('name', 'id')->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeCampaignRequest $request)
    {
        $data = $request->all();
        $campaign = Campaign::create([
            'name' => $data['name'],
            'desc' => $data['desc'] ?? '',
            'platform' => $data['platform'],
            'status' => $data['status'],
            'start_at' => $data['start_at'],
            'end_at' => $data['end_at'],
            'resource_type' => $data['resource_type'],
        ]);
        if (!empty($data['document_campaign_unique_id'])) {
            $this->document->where('temp_id', $data['document_campaign_unique_id'])->update([
                'documentable_type' => Campaign::class,
                'documentable_id' => $campaign->id,
                'status' => 'attached',
            ]);
        }
        $campaign->users()->attach($data['users'] ?? []);
        $campaign->categories()->attach($data['categories'] ?? []);
        $campaign->brands()->attach($data['brands'] ?? []);

        $campaignMetaData = [
            'impersion_cnt' => 0,
            'like_cnt' => 0,
            'reach_cnt' => 0,
            'clicks_cnt' => 0,
            'share_cnt' => 0,
            'save_cnt' => 0,
            'sticker_tap_cnt' => 0,
            'comment_cnt' => 0,
        ];

        if (isset($data['contents']) && count($data['contents'])) {
            foreach ($data['contents'] as $cont) {

                $contentData = [
                    "impersion_cnt" => 0,
                    "reach_cnt" => 0,
                    "clicks_cnt" => 0,
                    "like_cnt" => 0,
                    "share_cnt" => 0,
                    "save_cnt" => 0,
                    "sticker_tap_cnt" => 0,
                    "comment_cnt" => 0,
                    "our_cost" => 0,
                    "customer_cost" => 0,
                    "type" => $cont['type'],
                    "our_cost" => $cont['our_cost'],
                    "customer_cost" => $cont['customer_cost'],
                    "dealer_cost" => $cont['customer_cost'],
                    'media_type' => 'rows',
                    'resource_type' => 'rows',
                ];

                $content = $campaign->contents()->create($contentData);

                foreach ($cont['publishers'] as $publisherId) {
                    $content->contentPublishers()->create(['publisher_id' => $publisherId]);
                }

                if(isset($cont['media_checked'])) {
                    $contentData['media_type'] = 'content';
                }

                if(isset($cont['resource_checked'])) {
                    $contentData['resource_type'] = 'content';
                }

                if (isset($cont['content_media_id']) && $cont['content_media_id'] !== 'noid') {
                    $this->document->where('temp_id', $cont['content_media_id'])->update([
                        'documentable_type' => Content::class,
                        'documentable_id' => $content->id,
                        'status' => 'attached',
                    ]);
                }

                if (isset($cont['content_resource_id']) && $cont['content_resource_id'] !== 'noid') {
                    $this->document->where('temp_id', $cont['content_resource_id'])->update([
                        'documentable_type' => Content::class,
                        'documentable_id' => $content->id,
                        'status' => 'attached',
                    ]);
                }

                foreach ($cont['rows'] as $rowIndex => $row) {
                    //add to content row
                    $contentRow = $content->contentRows()->create([
                        "impersion_cnt" => $row["impersion_cnt"] ?? 0,
                        "reach_cnt" => $row["reach_cnt"] ?? 0,
                        "clicks_cnt" => $row["clicks_cnt"] ?? 0,
                        "like_cnt" => $row["like_cnt"] ?? 0,
                        "share_cnt" => $row["share_cnt"] ?? 0,
                        "save_cnt" => $row["save_cnt"] ?? 0,
                        "sticker_tap_cnt" => $row["sticker_tap_cnt"] ?? 0,
                        "comment_cnt" => $row["comment_cnt"] ?? 0,
                    ]);

                    //add for content data
                    $contentData['impersion_cnt'] += $row["impersion_cnt"];
                    $contentData['reach_cnt'] += $row["reach_cnt"];
                    $contentData['clicks_cnt'] += $row["clicks_cnt"];
                    $contentData['like_cnt'] += $row["like_cnt"];
                    $contentData['share_cnt'] += $row["share_cnt"];
                    $contentData['save_cnt'] += $row["save_cnt"];
                    $contentData['sticker_tap_cnt'] += $row["sticker_tap_cnt"];
                    $contentData['comment_cnt'] += $row["comment_cnt"];

                    if (isset($row['contentRow_media_id']) && $row['contentRow_media_id'] !== 'noid') {
                        $this->document->where('temp_id', $row['contentRow_media_id'])->update([
                            'documentable_type' => ContentRow::class,
                            'documentable_id' => $contentRow->id,
                            'status' => 'attached',
                        ]);
                    }

                    if (isset($row['contentRow_resource_id']) && $row['contentRow_resource_id'] !== 'noid') {
                        $this->document->where('temp_id', $row['contentRow_resource_id'])->update([
                            'documentable_type' => ContentRow::class,
                            'documentable_id' => $contentRow->id,
                            'status' => 'attached',
                        ]);
                    }
                }

                //update content
                $content->update($contentData);

                // update campaign metadata
                $campaignMetaData["impersion_cnt"] += $contentData['impersion_cnt'];
                $campaignMetaData["reach_cnt"] += $contentData['reach_cnt'];
                $campaignMetaData["clicks_cnt"] += $contentData['clicks_cnt'];
                $campaignMetaData["like_cnt"] += $contentData['like_cnt'];
                $campaignMetaData["share_cnt"] += $contentData['share_cnt'];
                $campaignMetaData["save_cnt"] += $contentData['save_cnt'];
                $campaignMetaData["sticker_tap_cnt"] += $contentData['sticker_tap_cnt'];
                $campaignMetaData["comment_cnt"] += $contentData['comment_cnt'];
            }

            $campaign->update($campaignMetaData);
        }

        return redirect()->route('admin.campaigns.index')->withSuccess(__('admin.campaigns.messages.created'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeDrafts(storeDraftRequest $request)
    {
        ini_set('max_execution_time', '300');
        $data = $request->all();

        $campaign = Campaign::create([
            'name' => $data['name'],
            'platform' => $data['platform'],
            'start_at' => $data['start_at'],
            'end_at' => $data['end_at'],
            'resource_type' => $data['resource_type'],
        ]);
        $campaign->users()->attach($data['users'] ?? []);
        $campaign->categories()->attach($data['categories'] ?? []);
        $campaign->brands()->attach($data['brands'] ?? []);
        if (!empty($data['document_campaign_unique_id'])) {
            $this->document->where('temp_id', $data['document_campaign_unique_id'])->update([
                'documentable_type' => Campaign::class,
                'documentable_id' => $campaign->id,
                'status' => 'attached',
            ]);
        }
        if ($request->hasFile('excel_file')) {
            $path = $request->file('excel_file')->getRealPath();
            Excel::import(
                $data['platform'] == 'telegram'
                    ? new CampaignPublisherTelegramImport($campaign)
                    : new CampaignPublisherInstagramImport($campaign),
                $request->file('excel_file')
            );
        }

        return redirect()->route('admin.campaigns.edit', $campaign)->withSuccess(__('admin.campaigns.messages.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign $campaign)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function edit(Campaign $campaign, string $tab = null)
    {
        if ($tab === 'contents') {
            $publishers = $this->publisher->all()->pluck('name', 'id')->toArray();
            return view('admin.campaigns.edit_contents')
                ->withCampaign($campaign)
                ->withPublishers($publishers)
                ->withCategories($this->category->all()->pluck('name', 'id')->toArray())
                ->withBrands($this->brand->all()->pluck('name', 'id')->toArray());
        } else if ($tab === 'publishers') {
            return view('admin.campaigns.edit_publishers')
                ->withCampaign($campaign)
                ->withCategories($this->category->all()->pluck('name', 'id')->toArray())
                ->withBrands($this->brand->all()->pluck('name', 'id')->toArray());
        }

        $users = $this->user->all()->pluck('fullName', 'id')->toArray();
        $publishers = $this->publisher->all()->pluck('name', 'id')->toArray();
        return view('admin.campaigns.edit')
            ->withCampaign($campaign)
            ->withUsers($users)
            ->withPublishers($publishers)
            ->withCategories($this->category->all()->pluck('name', 'id')->toArray())
            ->withBrands($this->brand->all()->pluck('name', 'id')->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function update(updateCampaignRequest $request, Campaign $campaign, string $tab = null)
    {
        $data = $request->all();
        $campaign->update([
            'name' => $data['name'] ?? $campaign->name,
            'desc' => $data['desc'] ?? $campaign->desc,
            'platform' => $data['platform'] ?? $campaign->platform,
            'status' => $data['status'] ?? $campaign->status,
            'start_at' => $data['start_at'] ?? $campaign->start_at,
            'end_at' => $data['end_at'] ?? $campaign->end_at,
            'resource_type' => $data['resource_type'] ?? $campaign->resource_type,
        ]);

        $campaign->users()->sync($data['users'] ?? []);
        $campaign->categories()->sync($data['categories'] ?? []);
        $campaign->brands()->sync($data['brands'] ?? []);

        return redirect()->route('admin.campaigns.edit', $campaign->id)->withSuccess(__('admin.campaigns.messages.updated'));
    }

    public function updateContents(Request $request, Campaign $campaign, string $tab = null)
    {
        $data = $request->all();
        $contents = $campaign->contents;
        $campaignMetaData = [
            'impersion_cnt' => 0,
            'like_cnt' => 0,
            'reach_cnt' => 0,
            'clicks_cnt' => 0,
            'share_cnt' => 0,
            'save_cnt' => 0,
            'sticker_tap_cnt' => 0,
            'comment_cnt' => 0,
        ];
        if (isset($data['contents']) && count($data['contents'])) {
            foreach ($data['contents'] as $contentIndex => $cont) {
                $contentData = [
                    "impersion_cnt" => 0,
                    "reach_cnt" => 0,
                    "clicks_cnt" => 0,
                    "like_cnt" => 0,
                    "share_cnt" => 0,
                    "save_cnt" => 0,
                    "sticker_tap_cnt" => 0,
                    "comment_cnt" => 0,
                    "type" => $cont['type'],
                    "our_cost" => $cont['our_cost'],
                    "customer_cost" => $cont['customer_cost'],
                    "dealer_cost" => $cont['customer_cost'],
                    'media_type' => 'rows',
                    'resource_type' => 'rows',
                ];
                if (isset($contents[$contentIndex])) {
                    $content = $contents[$contentIndex];
                    $content->contentPublishers()->delete();
                } else {
                    $content = $campaign->contents()->create($contentData);
                }

                foreach ($cont['publishers'] as $publisherId) {
                    $content->contentPublishers()->create(['publisher_id' => $publisherId]);
                }

                if(isset($cont['media_checked'])) {
                    $contentData['media_type'] = 'content';
                }

                if(isset($cont['resource_checked'])) {
                    $contentData['resource_type'] = 'content';
                }

                if (isset($cont['content_media_id']) && $cont['content_media_id'] !== 'noid') {
                    $this->document->where('temp_id', $cont['content_media_id'])->update([
                        'documentable_type' => Content::class,
                        'documentable_id' => $content->id,
                        'status' => 'attached',
                    ]);
                }

                if (isset($cont['content_resource_id']) && $cont['content_resource_id'] !== 'noid') {
                    $this->document->where('temp_id', $cont['content_resource_id'])->update([
                        'documentable_type' => Content::class,
                        'documentable_id' => $content->id,
                        'status' => 'attached',
                    ]);
                }




                foreach ($cont['rows'] as $rowIndex => $row) {
                    //add to content row
                    if (isset($contents[$contentIndex]) && isset($contents[$contentIndex]->contentRows[$rowIndex])) {
                        $contents[$contentIndex]->contentRows[$rowIndex]->update([
                            "impersion_cnt" => $row["impersion_cnt"] ?? 0,
                            "reach_cnt" => $row["reach_cnt"] ?? 0,
                            "clicks_cnt" => $row["clicks_cnt"] ?? 0,
                            "like_cnt" => $row["like_cnt"] ?? 0,
                            "share_cnt" => $row["share_cnt"] ?? 0,
                            "save_cnt" => $row["save_cnt"] ?? 0,
                            "sticker_tap_cnt" => $row["sticker_tap_cnt"] ?? 0,
                            "comment_cnt" => $row["comment_cnt"] ?? 0,
                        ]);
                        $contentRow = $contents[$contentIndex]->contentRows[$rowIndex];
                    } else {
                        $contentRow = $content->contentRows()->create([
                            "impersion_cnt" => $row["impersion_cnt"] ?? 0,
                            "reach_cnt" => $row["reach_cnt"] ?? 0,
                            "clicks_cnt" => $row["clicks_cnt"] ?? 0,
                            "like_cnt" => $row["like_cnt"] ?? 0,
                            "share_cnt" => $row["share_cnt"] ?? 0,
                            "save_cnt" => $row["save_cnt"] ?? 0,
                            "sticker_tap_cnt" => $row["sticker_tap_cnt"] ?? 0,
                            "comment_cnt" => $row["comment_cnt"] ?? 0,
                        ]);
                    }

                    //add for content data
                    $contentData['impersion_cnt'] += $row["impersion_cnt"];
                    $contentData['reach_cnt'] += $row["reach_cnt"];
                    $contentData['clicks_cnt'] += $row["clicks_cnt"];
                    $contentData['like_cnt'] += $row["like_cnt"];
                    $contentData['share_cnt'] += $row["share_cnt"];
                    $contentData['save_cnt'] += $row["save_cnt"];
                    $contentData['sticker_tap_cnt'] += $row["sticker_tap_cnt"];
                    $contentData['comment_cnt'] += $row["comment_cnt"];

                    if (isset($row['contentRow_media_id']) && $row['contentRow_media_id'] !== 'noid') {
                        $this->document->where('temp_id', $row['contentRow_media_id'])->update([
                            'documentable_type' => ContentRow::class,
                            'documentable_id' => $contentRow->id,
                            'status' => 'attached',
                        ]);
                    }

                    if (isset($row['contentRow_resource_id']) && $row['contentRow_resource_id'] !== 'noid') {
                        $this->document->where('temp_id', $row['contentRow_resource_id'])->update([
                            'documentable_type' => ContentRow::class,
                            'documentable_id' => $contentRow->id,
                            'status' => 'attached',
                        ]);
                    }

                }
                if (count($cont['rows']) < count($contents[$contentIndex]->contentRows ?? [])) {
                    for ($i = count($cont['rows']); $i <= count($contents[$contentIndex]->contentRows) - 1; $i++) {
                        $contents[$contentIndex]->contentRows[$i]->delete();
                    }
                }

                //update content
                $content->update($contentData);

                // update campaign metadata
                $campaignMetaData["impersion_cnt"] += $contentData['impersion_cnt'];
                $campaignMetaData["reach_cnt"] += $contentData['reach_cnt'];
                $campaignMetaData["clicks_cnt"] += $contentData['clicks_cnt'];
                $campaignMetaData["like_cnt"] += $contentData['like_cnt'];
                $campaignMetaData["share_cnt"] += $contentData['share_cnt'];
                $campaignMetaData["save_cnt"] += $contentData['save_cnt'];
                $campaignMetaData["sticker_tap_cnt"] += $contentData['sticker_tap_cnt'];
                $campaignMetaData["comment_cnt"] += $contentData['comment_cnt'];
            }

            if (count($data['contents']) < count($contents ?? [])) {
                for ($i = count($data['contents']); $i <= count($contents) - 1; $i++) {
                    $contents[$contentIndex]->contentPublishers()->delete();
                    $contents[$contentIndex]->contentRows()->delete();
                    $contents[$contentIndex]->delete();
                }
            }

            $campaign->update($campaignMetaData);
        }
        return redirect()->route('admin.campaigns.edit', [$campaign->id, 'contents'])->withSuccess(__('admin.campaigns.messages.updated'));
    }

    public function updateCampaignPublishers(Request $request, Campaign $campaign)
    {
        $data = $request->all();
        $campaignMetaData = [
            'impersion_cnt' => 0,
            'like_cnt' => 0,
            'reach_cnt' => 0,
            'clicks_cnt' => 0,
            'share_cnt' => 0,
            'save_cnt' => 0,
            'sticker_tap_cnt' => 0,
            'comment_cnt' => 0,
        ];
        foreach ($campaign->campiagnPublishers as $campiagnPublisher) {
            if (isset($data['campaignPublishers']) && count($data['campaignPublishers'])) {
                foreach ($data['campaignPublishers'] as $index => $campaignPublishersData) {
                    if (isset($campaignPublishersData['id']) && $campiagnPublisher->id === $campaignPublishersData['id']) {
                        $campiagnPublisher->update([
                            "publisher_id" => $campaignPublishersData['publisher'],
                            "video_url" => $campaignPublishersData["video_url"] ?? '',
                            "impersion_cnt" => $campaignPublishersData["impersion_cnt"] ?? 0,
                            "reach_cnt" => $campaignPublishersData["reach_cnt"] ?? 0,
                            "clicks_cnt" => $campaignPublishersData["clicks_cnt"] ?? 0,
                            "like_cnt" => $campaignPublishersData["like_cnt"] ?? 0,
                            "share_cnt" => $campaignPublishersData["share_cnt"] ?? 0,
                            "save_cnt" => $campaignPublishersData["save_cnt"] ?? 0,
                            "sticker_tap_cnt" => $campaignPublishersData["sticker_tap_cnt"] ?? 0,
                            "comment_cnt" => $campaignPublishersData["comment_cnt"] ?? 0,
                            "insight" => $campaignPublishersData["insight"] ?? '',
                            "type" => $campaignPublishersData["type"] ?? '',
                            "our_cost" => $campaignPublishersData["our_cost"] ?? '0',
                            "customer_cost" => $campaignPublishersData["customer_cost"] ?? '0',
                            "dealer_cost" => $campaignPublishersData["customer_cost"] ?? '0',
                        ]);
                        $campaignMetaData['impersion_cnt'] += ($campaignPublishersData["impersion_cnt"] ?? 0);
                        $campaignMetaData['like_cnt'] += ($campaignPublishersData["like_cnt"] ?? 0);
                        $campaignMetaData['reach_cnt'] += ($campaignPublishersData["reach_cnt"] ?? 0);
                        $campaignMetaData['clicks_cnt'] += ($campaignPublishersData["clicks_cnt"] ?? 0);
                        $campaignMetaData['share_cnt'] += ($campaignPublishersData["share_cnt"] ?? 0);
                        $campaignMetaData['save_cnt'] += ($campaignPublishersData["save_cnt"] ?? 0);
                        $campaignMetaData['sticker_tap_cnt'] += ($campaignPublishersData["sticker_tap_cnt"] ?? 0);
                        $campaignMetaData['comment_cnt'] += ($campaignPublishersData["comment_cnt"] ?? 0);

                        Publisher::where('id', $campaignPublishersData['publisher'])->update([
                            "type" => $campaignPublishersData["type"] ?? '',
                            'impersion_cost' => $campaignPublishersData["our_cost"] / ($campaignPublishersData["impersion_cnt"] ?? 1),
                            "our_cost" => $campaignPublishersData["our_cost"] ?? '0',
                            "customer_cost" => $campaignPublishersData["customer_cost"] ?? '0',
                            "dealer_cost" => $campaignPublishersData["customer_cost"] ?? '0',
                        ]);
                        unset($data['campaignPublishers'][$index]);
                        break;
                    }
                }
            }
            $campiagnPublisher->delete();
        }

        if (isset($data['campaignPublishers']) && count($data['campaignPublishers'])) {
            foreach ($data['campaignPublishers'] as $campaignPublishers) {
                $campaign->publishers()->attach($campaignPublishers['publisher'], [
                    "video_url" => $campaignPublishers["video_url"],
                    "impersion_cnt" => $campaignPublishers["impersion_cnt"],
                    "reach_cnt" => $campaignPublishers["reach_cnt"],
                    "clicks_cnt" => $campaignPublishers["clicks_cnt"],
                    "like_cnt" => $campaignPublishers["like_cnt"],
                    "share_cnt" => $campaignPublishers["share_cnt"],
                    "save_cnt" => $campaignPublishers["save_cnt"],
                    "sticker_tap_cnt" => $campaignPublishers["sticker_tap_cnt"],
                    "comment_cnt" => $campaignPublishers["comment_cnt"],
                    "insight" => $campaignPublishers["insight"] ?? '',
                    "type" => $campaignPublishers["type"] ?? '',
                    "our_cost" => $campaignPublishers["our_cost"] ?? '0',
                    "customer_cost" => $campaignPublishers["customer_cost"] ?? '0',
                    "dealer_cost" => $campaignPublishers["customer_cost"] ?? '0',
                ]);
                $campaignMetaData['impersion_cnt'] += ($campaignPublishers["impersion_cnt"] ?? 0);
                $campaignMetaData['like_cnt'] += ($campaignPublishers["like_cnt"] ?? 0);
                $campaignMetaData['reach_cnt'] += ($campaignPublishers["reach_cnt"] ?? 0);
                $campaignMetaData['clicks_cnt'] += ($campaignPublishers["clicks_cnt"] ?? 0);
                $campaignMetaData['share_cnt'] += ($campaignPublishers["share_cnt"] ?? 0);
                $campaignMetaData['save_cnt'] += ($campaignPublishers["save_cnt"] ?? 0);
                $campaignMetaData['sticker_tap_cnt'] += ($campaignPublishers["sticker_tap_cnt"] ?? 0);
                $campaignMetaData['comment_cnt'] += ($campaignPublishers["comment_cnt"] ?? 0);
                Publisher::where('id', $campaignPublishers['publisher'])->update([
                    "type" => $campaignPublishers["type"] ?? '',
                    'impersion_cost' => $campaignPublishers["our_cost"] / ($campaignPublishers["impersion_cnt"] ?? 1),
                    "our_cost" => $campaignPublishers["our_cost"] ?? '0',
                    "customer_cost" => $campaignPublishers["customer_cost"] ?? '0',
                    "dealer_cost" => $campaignPublishers["customer_cost"] ?? '0',
                ]);
            }
        }

        $campaign->update($campaignMetaData);

        return redirect()->route('admin.campaigns.edit', $campaign->id)->withSuccess(__('admin.campaigns.messages.updated'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function updateNewPublishers(Request $request, Campaign $campaign)
    {
        $data = $request->all();
        if (isset($data['publishers']) && count($data['publishers'])) {
            foreach ($data['publishers'] as $publisherData) {
                $publisher = Publisher::find($publisherData['id']);
                $publisher->update([
                    'name' => $publisherData['name'],
                    'link' => $publisherData['link'],
                    'platform' => $publisherData['platform'],
                    'status' => $publisherData['status'],
                ]);
            }
        }


        return redirect()->route('admin.campaigns.edit', $campaign->id)->withSuccess(__('admin.campaigns.messages.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campaign $campaign)
    {
        $campaign->delete();

        return redirect()->route('admin.campaigns.index')->withSuccess(__('admin.campaigns.messages.deleted'));
    }
}
