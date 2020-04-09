@extends('layouts.admin')

@section('title')
@isset($post)
Edit Post
@else
Create New Post
@endisset
@endsection

@section('content')
<form action="@isset($post){{ route('post.update', $post->id) }}@else{{ route('post.store') }}@endisset" enctype="multipart/form-data" method="POST">
  @csrf
  @isset($post)
  @method('PATCH')
  @endisset
  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" name="title" id="title" value="@isset($post){{ $post->title }}@endisset">
  </div>
  <div class="form-group">
    <label for="category_id">Category</label>
    <select class="form-control custom-select" name="category_id" id="category_id">
      <option value="" holder>Choose category</option>
      @foreach ($categories as $category)
      <option value="{{ $category->id }}">{{ $category->name }}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group">
    <label for="body">Post body</label>
    <textarea class="form-control" name="body" id="body">@isset($post){{ $post->body }}@endisset</textarea>
  </div>
  <div class="form-group">
    <label for="thumbnail">Featured Image</label>
    <input type="file" class="form-control-file" name="thumbnail" id="thumbnail" value="@isset($post){{ $post->thumbnail }}@endisset">
  </div>
  <div class="form-group">
    <button class="btn btn-primary btn-block">Submit</button>
  </div>
</form>
@endsection
