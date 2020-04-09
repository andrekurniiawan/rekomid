@extends('layouts.user')

@section('style')
<link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}">
@endsection

@section('title')
@if (url()->current() == route('post.edit', $post->id))
Edit Post
@else
Create New Post
@endif
@endsection

@section('content')
<form action="@if (url()->current() == route('post.edit', $post->id)){{ route('post.update', $post->id) }}@else{{ route('post.store') }}@endif" enctype="multipart/form-data" method="POST">
  @csrf
  @if (url()->current() == route('post.edit', $post->id))
  @method('PATCH')
  @endif
  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" name="title" id="title" value="@if (url()->current() == route('post.edit', $post->id)){{ $post->title }}@endif">
  </div>
  <div class="form-group">
    <label for="categories">Categories</label>
    <select class="select2 form-control" multiple="multiple" data-placeholder="Choose categories" style="width: 100%;" id="categories" name="categories[]">
      @if (url()->current() == route('post.edit', $post->id))
      @foreach ($categories as $category)
      <option value="{{ $category->id }}" @foreach ($post->categories as $postCategory)
        @if ($postCategory->id == $category->id)
        selected
        @endif
        @endforeach>{{ $category->name }}</option>
      @endforeach
      @else
      @foreach ($categories as $category)
      <option value="{{ $category->id }}">{{ $category->name }}</option>
      @endforeach
      @endif
    </select>
  </div>
  <div class="form-group">
    <label for="tags">Tags</label>
    <select class="select2 form-control" multiple="multiple" data-placeholder="Choose tags" style="width: 100%;" id="tags" name="tags[]">
      @if (url()->current() == route('post.edit', $post->id))
      @foreach ($tags as $tag)
      <option value="{{ $tag->id }}" @foreach ($post->tags as $postTag)
        @if ($postTag->id == $tag->id)
        selected
        @endif
        @endforeach>{{ $tag->name }}</option>
      @endforeach
      @else
      @foreach ($tags as $tag)
      <option value="{{ $tag->id }}">{{ $tag->name }}</option>
      @endforeach
      @endif
    </select>
  </div>
  <div class="form-group">
    <label for="body">Post body</label>
    <textarea class="form-control" name="body" id="body">@if (url()->current() == route('post.edit', $post->id)){{ $post->body }}@endif</textarea>
  </div>
  <div class="form-group">
    <label for="thumbnail">Featured Image</label>
    <input type="file" class="form-control-file" name="thumbnail" id="thumbnail" value="@if (url()->current() == route('post.edit', $post->id)){{ $post->thumbnail }}@endif">
  </div>
  <div class="form-group">
    <button class="btn btn-primary btn-block">Submit</button>
  </div>
</form>
@endsection

@section('script')
<!-- Select2 -->
<script src="{{ asset('bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script>
$(function() {
  //Initialize Select2 Elements
  $('.select2').select2()
})

</script>
@endsection
