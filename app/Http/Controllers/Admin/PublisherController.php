<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\publishers\storePublisherRequest;
use App\Http\Requests\admin\publishers\updatePublisherRequest;
use App\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    protected $publisher;
    public function __construct(Publisher $publisher)
    {
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
        $publishers = $this->publisher
            ->search($req['search'] ?? '')
            ->platformIs($req['platform'] ?? '')
            ->orderBy($req['order_col'] ?? 'id', $req['order_dir'] ?? 'desc')
            ->paginate($req['perpage'] ?? 10);

        return view('admin.publishers.index')
            ->withPublishers($publishers)
            ->withData($req);   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.publishers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storePublisherRequest $request)
    {
        $data = $request->all();
        Publisher::create([
            'name' => $data['name'],
            'platform' => $data['platform'],
            'status' => $data['status'],
            'link' => $data['link'],
            'type' => $data['type'] ?? 'impression',
            'impersion_cost' => $data['impersion_cost'] ?? 0,
            'our_cost' => $data['our_cost'] ?? 0,
            'dealer_cost' => $data['customer_cost'] ?? 0,
            'customer_cost' => $data['customer_cost'] ?? 0,
            'data' => $data['data'] ?? '',
            'real_id' => $data['real_id'] ?? '',
            'admin_id' => $data['admin_id'] ?? '',
            'image_url' => $data['image_url'] ?? '',
        ]);

        return redirect()->route('admin.publishers.index')->withSuccess( __('admin.publishers.messages.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function show(Publisher $publisher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function edit(Publisher $publisher)
    {
        return view('admin.publishers.edit')
            ->withPublisher($publisher);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function update(updatePublisherRequest $request, Publisher $publisher)
    {
        $data = $request->all();
        $publisher->update([
            'name' => $data['name'] ?? $publisher->name,
            'platform' => $data['platform'] ?? $publisher->platform,
            'status' => $data['status'] ?? $publisher->status,
            'link' => $data['link'] ?? $publisher->link,
            'type' => $data['type'] ?? $publisher->type ?? 'impression',
            'impersion_cost' => $data['impersion_cost'] ?? $publisher->impersion_cost ?? 0,
            'our_cost' => $data['our_cost'] ?? $publisher->our_cost ?? 0,
            'dealer_cost' => $data['customer_cost'] ?? $publisher->dealer_cost ?? 0,
            'customer_cost' => $data['customer_cost'] ?? $publisher->customer_cost ?? 0,
            'data' => $data['data'] ?? $publisher->data,
            'real_id' => $data['real_id'] ?? $publisher->real_id ?? '',
            'admin_id' => $data['admin_id'] ?? $publisher->admin_id ?? '',
            'image_url' => $data['image_url'] ?? $publisher->image_url ?? '',
        ]);

        return redirect()->route('admin.publishers.index')->withSuccess(__('admin.publishers.messages.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publisher $publisher)
    {
        $publisher->delete();

        return redirect()->route('admin.publishers.index')->withSuccess(__('admin.publishers.messages.deleted'));
    }
}
