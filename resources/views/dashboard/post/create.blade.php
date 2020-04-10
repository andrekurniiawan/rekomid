@extends('layouts.dashboard')

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

@section('button')
<a data-widget="control-sidebar" data-slide="true" href="#" role="button" class="btn btn-primary float-right">Next</a>
@endsection

@section('content')
<form action="@isset($post){{ route('post.update', $post->id) }}@else{{ route('post.store') }}@endisset" enctype="multipart/form-data" method="POST">
  @csrf
  @isset($post)
  @method('PATCH')
  @endisset
  <div class="form-group">
    <label for="categories">Categories</label>
    <select class="select2 form-control" multiple="multiple" data-placeholder="Choose categories" style="width: 100%;" id="categories" name="categories[]">
      @isset($post)
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
      @endisset
    </select>
  </div>
  <div class="form-group">
    <label for="tags">Tags</label>
    <select class="select2 form-control" multiple="multiple" data-placeholder="Choose tags" style="width: 100%;" id="tags" name="tags[]">
      @isset($post)
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
      @endisset
    </select>
  </div>
  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" name="title" id="title" style="font-size:30px;" placeholder="Insert post title" value="@isset($post){{ $post->title }}@endisset">
  </div>
  <div class="form-group">
    <label for="body">Post Body</label>
    <div class="bg-white p-4 rounded border">
      <div class="ml-4" name="body" id="body">
        @isset($post){!! $post->body !!}@endisset
      </div>
    </div>
    <input type="hidden" id="bodyValue" name="body" value="">
  </div>
  <div class="form-group">
    <label for="thumbnail">Featured Image</label>
    <input type="file" class="form-control-file" name="thumbnail" id="thumbnail" value="@isset($post){{ $post->thumbnail }}@endisset">
  </div>
  <div class="form-group">
    <button class="btn btn-primary btn-block" name="submit" id="submit">Submit</button>
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

<!-- CK Editor -->
<script src="{{ asset('plugins/ckeditor5-build-balloon-block/ckeditor.js') }}"></script>
<script>
BalloonEditor
  .create(document.querySelector('#body'), {
    // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
    placeholder: 'Insert post body here...',
  })
  .then(editor => {
    window.body = editor;
  })
  .catch(err => {
    console.error(err.stack);
  });
$(document).on('click', '#submit', function() {
  document.getElementById('bodyValue').value = window.body.getData();
});

</script>
@endsection
