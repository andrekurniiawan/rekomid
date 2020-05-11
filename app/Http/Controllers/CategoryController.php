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
        $this->authorize('viewAny', Category::class);
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
        // $this->authorize('create', Category::class);
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
        $this->authorize('create', Category::class);

        $this->validate($request, [
            'name' => 'required|max:32',
            'slug' => 'max:32'
        ]);

        $category = new Category;
        $category->name = $request->name;

        if (is_null($request->slug) || $request->slug == '') {
            $requestName = Str::slug($request->name, '-');
            if (Category::whereSlug($requestName)->exists()) {
                $category->slug = $requestName . '-' . dechex(time());
            } else {
                $category->slug = $requestName;
            }
        } else {
            $requestSlug = Str::slug($request->slug, '-');
            if (Category::whereSlug($requestSlug)->exists()) {
                $category->slug = $requestSlug . '-' . dechex(time());
            } else {
                $category->slug = $requestSlug;
            }
        }

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
        // $this->authorize('view', Category::class);
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
        // $this->authorize('update', $category);
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
        $this->authorize('update', $category);

        $this->validate($request, [
            'name' => 'required|max:32',
            'slug' => 'max:32'
        ]);

        $category->name = $request->name;

        $requestSlug = Str::slug($request->slug, '-');

        if (is_null($requestSlug) || $requestSlug == '') {
            $requestSlug = Str::slug($category->name, '-');
        }

        if ($category->slug != $requestSlug) {
            if (Category::whereSlug($requestSlug)->exists()) {
                $category->slug = $requestSlug . '-' . dechex(time());
            } else {
                $category->slug = $requestSlug;
            }
        }

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
        $this->authorize('delete', $category);
        $category->delete();
        return redirect()->back()->with('success', 'Category removed.');
    }

    public function trash()
    {
        $this->authorize('viewAny', Category::class);
        $categories = Category::onlyTrashed()->get();
        return view('dashboard.category', compact('categories'));
    }

    public function restore($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        $this->authorize('restore', $category);
        $category->restore();
        return redirect()->back()->with('success', 'Category restored.');
    }

    public function kill($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        $this->authorize('forceDelete', $category);
        $category->forceDelete();
        return redirect()->back()->with('success', 'Category permanently deleted.');
    }
}
