<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class PageController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Page::class, 'page');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::where('id', $id)->first();
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
        $this->validate($request, [
            'title' => 'required',
        ]);

        $page = Page::find($id);

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
        Page::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Page removed.');
    }

    public function trash()
    {
        $pages = Page::onlyTrashed()->get();
        return view('dashboard.page.index', compact('pages'));
    }

    public function restore($id)
    {
        $page = Page::withTrashed()->where('id', $id)->first();
        $page->restore();
        return redirect()->back()->with('success', 'Page restored.');
    }

    public function kill($id)
    {
        $page = Page::withTrashed()->where('id', $id)->first();
        $page->forceDelete();
        return redirect()->back()->with('success', 'Page permanently deleted.');
    }
}
