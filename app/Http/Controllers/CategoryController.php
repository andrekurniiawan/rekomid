<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('dashboard.category', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('category.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:32',
        ]);

        $category = new Category;
        $category->name = $request->name;
        $category->slug = Str::slug($request->name, '-');
        $category->save();

        return redirect()->back()->with('success', 'Category created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return redirect()->route('category.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return redirect()->route('category.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $category = Category::find($category->id);
        $this->validate($request, [
            'name' => 'required|max:32',
        ]);

        $category->name = $request->name;
        $category->slug = Str::slug($request->name, '-');
        $category->save();

        return redirect()->back()->with('success', 'Category edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        Category::where('id', $category->id)->delete();
        return redirect()->back()->with('success', 'Category deleted.');
    }

    public function trash()
    {
        $categories = Category::onlyTrashed()->get();
        return view('dashboard.category', compact('categories'));
    }

    public function restore($id)
    {
        $category = Category::withTrashed()->where('id', $id)->first();
        $category->restore();
        return redirect()->back()->with('success', 'Category restored.');
    }

    public function kill($id)
    {
        $category = Category::withTrashed()->where('id', $id)->first();
        $category->forceDelete();
        return redirect()->back()->with('success', 'Category permanently deleted.');
    }
}
