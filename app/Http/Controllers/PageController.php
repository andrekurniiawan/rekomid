<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Page::class);
        $pages = Page::all();
        return view('dashboard.page.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Page::class);
        return view('dashboard.page.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Page::class);

        $this->validate($request, [
            'title' => 'required',
        ]);

        $page = new Page;

        $page->title = $request->title;
        $page->slug = Str::slug($request->title, '-');
        $page->body = $request->body;
        $page->user_id = Auth::id();

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $page->slug . '_' . time() . '.' . $request->thumbnail->getClientOriginalExtension();
            $request->thumbnail->storeAs('public/img/', $thumbnail);
            $page->thumbnail = $thumbnail;
        }

        $page->save();

        return redirect()->route('page.index')->with('success', 'Page created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        $this->authorize('view', $page);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::with('categories', 'tags')->findOrFail($id);
        $this->authorize('update', $page);
        return view('dashboard.page.create', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $page = Page::findOrFail($id);

        $this->authorize('update', $page);

        $this->validate($request, [
            'title' => 'required',
        ]);

        $page->title = $request->title;
        $page->slug = Str::slug($request->title, '-');
        $page->body = $request->body;

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $page->slug . '_' . time() . '.' . $request->thumbnail->getClientOriginalExtension();
            $request->thumbnail->storeAs('public/img/', $thumbnail);
            $page->thumbnail = $thumbnail;
        }

        $page->save();

        return redirect()->route('page.index')->with('success', 'Page edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::findOrFail($id);
        $this->authorize('delete', $page);
        $page->delete();
        return redirect()->back()->with('success', 'Page removed.');
    }

    public function trash()
    {
        $this->authorize('viewAny', Page::class);
        $pages = Page::onlyTrashed()->get();
        return view('dashboard.page.index', compact('pages'));
    }

    public function restore($id)
    {
        $page = Page::withTrashed()->findOrFail($id);
        $this->authorize('restore', $page);
        $page->restore();
        return redirect()->back()->with('success', 'Page restored.');
    }

    public function kill($id)
    {
        $page = Page::withTrashed()->findOrFail($id);
        $this->authorize('forceDelete', $page);
        $page->forceDelete();
        return redirect()->back()->with('success', 'Page permanently deleted.');
    }
}
