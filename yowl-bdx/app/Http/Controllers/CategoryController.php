<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $all =  Category::all();
        return response($all, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreCategoryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        if (auth()->user()->is_admin == 1) {
            $categoryCreated = Category::create($request->only('name'));
       return response(json_encode($categoryCreated), 200);
        } else {
            return response('You cannot create category', 403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Category $categories
     * @return \Illuminate\Http\Response
     */
    public function show(Category $categories)

    {
        return response(json_encode($categories), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Category $categories
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $categories)

    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateCategoryRequest $request
     * @param \App\Models\Category $categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $id)
    {
        if (auth()->user()->is_admin == 1) {
            $id->update($request->only('name'));
            return response(json_encode($id), 200);
        } else {
            return response('You cannot update category', 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Category $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy( Category $id)
    {
        if (auth()->user()->is_admin == 1) {
            Category::destroy($id);
            return response('user destroyed', 200);
        } else {
            return response('You cannot delete category', 403);
        }
    }

    public function search(Request $request)
    {
        $key = trim($request->get('searchTerm'));

        $categoriesSearch = Category::query()
            ->where('name', 'like', "%{$key}%")
            ->orderBy('created_at', 'desc')
            ->get();

        return response(json_encode($categoriesSearch), 200);
    }
}
