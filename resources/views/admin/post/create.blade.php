@extends('layouts.admin')

@section('style')
<link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}">
@endsection

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
    <label for="categories">Categories</label>
    {{-- <select class="form-control custom-select" name="category_id" id="category_id"> --}}
    <select class="select2 form-control" multiple="multiple" data-placeholder="Choose categories" style="width: 100%;" id="categories" name="categories[]">
      @foreach ($categories as $category)
      <option value="{{ $category->id }}">{{ $category->name }}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group">
    <label for="tags">Tags</label>
    <select class="select2 form-control" multiple="multiple" data-placeholder="Choose tags" style="width: 100%;" id="tags" name="tags[]">
      @foreach ($tags as $tag)
      <option value="{{ $tag->id }}">{{ $tag->name }}</option>
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
