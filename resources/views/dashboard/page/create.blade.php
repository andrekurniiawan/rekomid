@extends('layouts.dashboard')

@section('title')
@isset($page)
Edit Page
@else
Create Page
@endisset
@endsection

@section('button')
<a data-widget="control-sidebar" data-slide="true" href="#" role="button" class="btn btn-primary float-right">Next</a>
@endsection

@section('form')
<form id="form" action="@isset($page){{ route('page.update', $page->id) }}@else{{ route('page.store') }}@endisset" enctype="multipart/form-data" method="POST">
  @csrf
  @isset($page)
  @method('PATCH')
  @endisset
  @endsection

  @section('content')
  <div class="form-group">
    <input type="text" class="form-control" name="title" id="title" style="font-size:30px;" placeholder="Add title..." value="@isset($page){{ $page->title }}@endisset">
  </div>
  <div class="form-group">
    <textarea name="body" id="body" rows="10" style="min-width:500px;max-width:100%;min-height:50px;height:100%;width:100%;">
      @isset($page){!! $page->body !!}@endisset
    </textarea>
  </div>
  @endsection

  @section('right-sidebar')
  <!-- Control Sidebar -->
  <aside class="control-sidebar form-control-sidebar control-sidebar-dark elevation-2 overflow-auto">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <div class="d-flex flex-row justify-content-end">
        <a data-widget="control-sidebar" data-slide="true" href="#" role="button"><i class="fas fa-times-circle"></i></a>
      </div>
      <div class="form-group">
        <label for="slug">Slug</label>
        <input type="text" class="form-control" name="slug" id="slug" placeholder="same-as-title" value="@isset($page){{ $page->slug }}@endisset">
      </div>
      <div class="form-group">
        <label for="thumbnail">Featured Image</label>
        @isset($page)
        @if ($page->thumbnail != null)
        <div class="image mb-2">
          <img src="{{ asset('storage/img/' . $page->thumbnail) }}" alt="{{ $page->thumbnail }}" class="img-fluid">
          <span>{{ $page->thumbnail }}</span>
        </div>
        @endif
        @endisset
        <input type="file" class="form-control-file" name="thumbnail" id="thumbnail" value="@isset($page){{ $page->thumbnail }}@endisset">
      </div>
      <div class="form-group">
        <input type="checkbox" name="publish" id="publish" value="1" @isset($page) @if ($page->publish == 1) checked @endif @endisset>
        <label for="publish">Publish</label>
      </div>
      <div class="form-group">
        <button class="btn btn-primary btn-block" name="submit" id="submit">Submit</button>
      </div>
    </div>
  </aside>
  <!-- /.control-sidebar -->
  @endsection

  @section('script')
  <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
  <script>
  // Select2
  $(function() {
    //Initialize Select2 Elements
    $('.select2').select2()
  })

  // CK Editor
  CKEDITOR.replace('body', {
    filebrowserUploadUrl: "{{ route('image.store', ['_token' => csrf_token() ]) }}",
    filebrowserUploadMethod: 'form',
    height: ['100vh']
  });

  // Disable Enter Key
  $(document).keypress(
    function(event) {
      if (event.which == '13') {
        event.preventDefault();
      }
    }
  );

  </script>
  @endsection
