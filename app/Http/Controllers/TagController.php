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
        $this->authorize('viewAny', Tag::class);
        $tags = Tag::all();
        return view('dashboard.tag', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $this->authorize('create', Tag::class);
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
        $this->authorize('create', Tag::class);

        $this->validate($request, [
            'name' => 'required|max:32',
        ]);

        $tag = new Tag;
        $tag->name = $request->name;

        if (is_null($request->slug) || $request->slug == '') {
            $requestName = Str::slug($request->name, '-');
            if (Tag::whereSlug($requestName)->exists()) {
                $tag->slug = $requestName . '-' . dechex(time());
            } else {
                $tag->slug = $requestName;
            }
        } else {
            $requestSlug = Str::slug($request->slug, '-');
            if (Tag::whereSlug($requestSlug)->exists()) {
                $tag->slug = $requestSlug . '-' . dechex(time());
            } else {
                $tag->slug = $requestSlug;
            }
        }

        $tag->save();

        return redirect()->back()->with('success', 'Tag created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        // $this->authorize('view', Tag::class);
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
        // $this->authorize('update', $tag);
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
        $this->authorize('update', $tag);

        $this->validate($request, [
            'name' => 'required|max:32',
        ]);

        $tag->name = $request->name;

        $requestSlug = Str::slug($request->slug, '-');

        if (is_null($requestSlug) || $requestSlug == '') {
            $requestSlug = Str::slug($tag->name, '-');
        }

        if ($tag->slug != $requestSlug) {
            if (Tag::whereSlug($requestSlug)->exists()) {
                $tag->slug = $requestSlug . '-' . dechex(time());
            } else {
                $tag->slug = $requestSlug;
            }
        }

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
        $this->authorize('delete', $tag);
        $tag->delete();
        return redirect()->back()->with('success', 'Tag removed.');
    }

    public function trash()
    {
        $this->authorize('viewAny', Tag::class);
        $tags = Tag::onlyTrashed()->get();
        return view('dashboard.tag', compact('tags'));
    }

    public function restore($id)
    {
        $tag = Tag::withTrashed()->findOrFail($id);
        $this->authorize('restore', $tag);
        $tag->restore();
        return redirect()->back()->with('success', 'Tag restored.');
    }

    public function kill($id)
    {
        $tag = Tag::withTrashed()->findOrFail($id);
        $this->authorize('forceDelete', $tag);
        $tag->forceDelete();
        return redirect()->back()->with('success', 'Tag permanently deleted.');
    }
}
