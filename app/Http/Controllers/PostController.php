<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Post::class);
        $posts = Post::all();
        return view('dashboard.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Post::class);
        $categories = Category::all();
        $tags = Tag::all();
        return view('dashboard.post.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Post::class);

        $post = new Post;

        $post->title = $request->title;

        if (is_null($request->slug) || $request->slug == '') {
            $requestTitle = Str::slug($request->title, '-');
            if (Post::whereSlug($requestTitle)->exists()) {
                $post->slug = $requestTitle . '-' . dechex(time());
            } else {
                $post->slug = $requestTitle;
            }
        } else {
            $requestSlug = Str::slug($request->slug, '-');
            if (Post::whereSlug($requestSlug)->exists()) {
                $post->slug = $requestSlug . '-' . dechex(time());
            } else {
                $post->slug = $requestSlug;
            }
        }

        $post->body = $request->body;
        $post->user_id = Auth::id();

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $post->slug . '-' . dechex(time()) . '.' . $request->thumbnail->getClientOriginalExtension();
            $request->thumbnail->storeAs('public/img/', $thumbnail);
            $post->thumbnail = $thumbnail;
        }

        $post->publish = $request->publish;

        $post->save();

        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);

        return redirect()->route('post.index')->with('success', 'Post created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $this->authorize('view', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::with('categories', 'tags')->findOrFail($id);
        $this->authorize('update', $post);
        $categories = Category::all();
        $tags = Tag::all();
        return view('dashboard.post.create', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $this->authorize('update', $post);

        $post->title = $request->title;

        if ($post->slug != $request->slug) {
            $requestSlug = Str::slug($request->slug, '-');
            if (Post::whereSlug($requestSlug)->exists()) {
                $post->slug = $requestSlug . '-' . dechex(time());
            } else {
                $post->slug = $requestSlug;
            }
        }

        $post->body = $request->body;

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $post->slug . '-' . dechex(time()) . '.' . $request->thumbnail->getClientOriginalExtension();
            $request->thumbnail->storeAs('public/img/', $thumbnail);
            $post->thumbnail = $thumbnail;
        }

        $post->publish = $request->publish;

        $post->save();

        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);

        return redirect()->route('post.index')->with('success', 'Post edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $this->authorize('delete', $post);
        $post->delete();
        return redirect()->back()->with('success', 'Post removed.');
    }

    public function trash()
    {
        $this->authorize('viewAny', Post::class);
        $posts = Post::onlyTrashed()->get();
        return view('dashboard.post.index', compact('posts'));
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $this->authorize('restore', $post);
        $post->restore();
        return redirect()->back()->with('success', 'Post restored.');
    }

    public function kill($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $this->authorize('forceDelete', $post);
        $post->forceDelete();
        return redirect()->back()->with('success', 'Post permanently deleted.');
    }
}
