<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\categories\storeCategoryRequest;
use App\Http\Requests\admin\categories\updateCategoryRequest;
use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $req = $request->all();
        $categories = $this->category
            ->search($req['search'] ?? '')
            ->orderBy($req['order_col'] ?? 'id', $req['order_dir'] ?? 'desc')
            ->paginate($req['perpage'] ?? 10);

        return view('admin.categories.index')
            ->withCategories($categories)
            ->withData($req);   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeCategoryRequest $request)
    {
        $data = $request->all();
        Category::create([
            'name' => $data['name'],
            'slug' => $data['slug'],
        ]);

        return redirect()->route('admin.categories.index')->withSuccess( __('admin.categories.messages.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit')
            ->withCategory($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(updateCategoryRequest $request, Category $category)
    {
        $data = $request->all();
        $category->update([
            'name' => $data['name'] ?? $category->name,
            'slug' => $data['slug'] ?? $category->slug,
        ]);

        return redirect()->route('admin.categories.index')->withSuccess(__('admin.categories.messages.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->withSuccess(__('admin.categories.messages.deleted'));
    }
}
