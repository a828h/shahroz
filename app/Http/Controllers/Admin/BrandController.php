<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\brands\storeBrandRequest;
use App\Http\Requests\admin\brands\updateBrandRequest;
use App\Brand;
use App\Category;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    protected $brand;
    protected $category;
    public function __construct(Brand $brand, Category $category)
    {
        $this->brand = $brand;
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $req = $request->all();
        $brands = $this->brand
            ->search($req['search'] ?? '')
            ->categoryIn($req['categories'] ?? [])
            ->orderBy($req['order_col'] ?? 'id', $req['order_dir'] ?? 'desc')
            ->with('category')
            ->paginate($req['perpage'] ?? 10);

        return view('admin.brands.index')
            ->withBrands($brands)
            ->withData($req)
            ->withCategories($this->category->all()->pluck('name', 'id')->toArray());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brands.create')
            ->withCategories($this->category->all()->pluck('name', 'id')->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeBrandRequest $request)
    {
        $data = $request->all();
        Brand::create([
            'name' => $data['name'],
            'category_id' => $data['category_id'],
        ]);


        return redirect()->route('admin.brands.index')->withSuccess(__('admin.brands.messages.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('admin.brands.edit')
            ->withBrand($brand)
            ->withCategories($this->category->all()->pluck('name', 'id')->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(updateBrandRequest $request, Brand $brand)
    {
        $data = $request->all();
        $brand->update([
            'name' => $data['name'],
            'category_id' => $data['category_id'],
        ]);

        return redirect()->route('admin.brands.index')->withSuccess(__('admin.brands.messages.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();

        return redirect()->route('admin.brands.index')->withSuccess(__('admin.brands.messages.deleted'));
    }
}
