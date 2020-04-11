<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::paginate(10);
        return view('dashboard.tag', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('tag.index');
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

        $tag = new Tag;
        $tag->name = $request->name;
        $tag->slug = Str::slug($request->name, '-');
        $tag->save();

        return redirect()->back()->with('success', 'New tag created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        return redirect()->route('tag.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return redirect()->route('tag.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $tag = Tag::find($tag->id);
        $this->validate($request, [
            'name' => 'required|max:32',
        ]);

        $tag->name = $request->name;
        $tag->slug = Str::slug($request->name, '-');
        $tag->save();

        return redirect()->back()->with('success', 'Tag edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        Tag::where('id', $tag->id)->delete();
        return redirect()->back()->with('success', 'Tag deleted.');
    }

    public function trash()
    {
        $tags = Tag::onlyTrashed()->paginate(10);
        return view('dashboard.tag', compact('tags'));
    }

    public function restore($id)
    {
        $tag = Tag::withTrashed()->where('id', $id)->first();
        $tag->restore();
        return redirect()->back()->with('success', 'Tag restored.');
    }

    public function kill($id)
    {
        $tag = Tag::withTrashed()->where('id', $id)->first();
        $tag->forceDelete();
        return redirect()->back()->with('success', 'Tag permanently deleted.');
    }
}
