@extends('layouts.admin')

@section('title', 'Create New Post')

@section('content')
<form action="{{ route('post.store') }}" enctype="multipart/form-data" method="POST">
  @csrf
  @include('layouts.message')
  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" name="title" id="title">
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
    <textarea class="form-control" name="body" id="body"></textarea>
  </div>
  <div class="form-group">
    <label for="thumbnail">Featured Image</label>
    <input type="file" class="form-control-file" name="thumbnail" id="thumbnail">
  </div>
  <div class="form-group">
    <button class="btn btn-primary btn-block">Submit</button>
  </div>
</form>
@endsection
