<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
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
        $posts = Post::paginate(10);
        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.post.create', compact('categories', 'tags'));
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

        $post = new Post;
        
        $post->title = $request->title;
        $post->slug = Str::slug($request->title, '-');
        $post->body = $request->body;

        if ($request->hasFile('thumbnail')) {
            // $thumbnailName = pathinfo($request->thumbnail->getClientOriginalName(), PATHINFO_FILENAME);
            // $thumbnailExtension = $request->thumbnail->getClientOriginalExtension();
            // $thumbnail = time() . '_' . Str::slug($thumbnailName, '-') . '.' . $thumbnailExtension;

            $thumbnail = $post->slug . '.' . $request->thumbnail->getClientOriginalExtension();
            $request->thumbnail->storeAs('public/img/', $thumbnail);
            $post->thumbnail = $thumbnail;
        }

        $post->save();
        
        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);

        return redirect()->route('post.index')->with('success', 'New post created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::with('categories', 'tags')->where('id', $id)->first();
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.post.create', compact('post', 'categories', 'tags'));
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
        $this->validate($request, [
            'title' => 'required',
        ]);

        $post = Post::find($id);
        
        $post->title = $request->title;
        $post->slug = Str::slug($request->title, '-');
        $post->body = $request->body;

        if ($request->hasFile('thumbnail')) {
            // $thumbnailName = pathinfo($request->thumbnail->getClientOriginalName(), PATHINFO_FILENAME);
            // $thumbnailExtension = $request->thumbnail->getClientOriginalExtension();
            // $thumbnail = time() . '_' . Str::slug($thumbnailName, '-') . '.' . $thumbnailExtension;

            $thumbnail = $post->slug . '.' . $request->thumbnail->getClientOriginalExtension();
            $request->thumbnail->storeAs('public/img/', $thumbnail);
            $post->thumbnail = $thumbnail;
        }

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
        Post::where('id', $id)->delete();
        return redirect()->route('post.index')->with('success', 'Post deleted.');
    }
}
