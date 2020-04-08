@extends('layouts.admin')

@section('title', 'Create New Post')

@section('content')
<form role="form" action="
@hasSection ('action')
@yield('action')
@else
{{ route('post.store') }}
@endif
" method="POST">
  {{ csrf_field() }}
  @include('layouts.message')
  <div class="card card-outline card-info mb-4">
    <!-- form start -->
    <div class="card-body">
      <div class="col-lg-6 float-left">
        <div class="form-group">
          <label for="category"><em>Category</em></label>
          <select class="custom-select" name="category">
            <option selected>-- Choose category --</option>
            @hasSection ('post-category')
            @yield('post-category')
            @else
            @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
            @endif
          </select>
        </div>
      </div>
      <div class="col-lg-6 float-right">
        <div class="form-group">
          <label for="slug"><em>Post slug</em></label>
          <input type="text" class="form-control" id="slug" name="slug" placeholder="post-slug" value="@yield('post-slug')" @yield('post-slug-edit')>
        </div>
      </div>
      <div class="float-right">
        <button type="submit" id="submit" class="btn btn-primary btn-sm mr-3">Submit</button>
      </div>
    </div>
    <!-- /.card-body -->
  </div>
  <div name="title" id="title">
    <h2>@yield('post-title')</h2>
  </div>
  <input type="hidden" id="titlevalue" name="title" value="@yield('post-title')">
  <div name="body" id="body">
    @yield('post-body')
  </div>
  <input type="hidden" id="bodyvalue" name="body" value="">
</form>

<form role="form" @hasSection ('action') @yield('action') @else {{ route('post.store') }} @endif enctype="multipart/form-data" method="POST">
  {{ csrf_field() }}
  @yield('method')
  @include('layouts.message')
  <div class="card card-outline card-info">
    <div class="card-header">
      <h3 class="card-title">Post Titles</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <div class="col-lg-6 float-left">
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" id="title" name="title" placeholder="Insert title" @yield('post-title')>
        </div>
        <div class="form-group">
          <label for="title">Subtitle</label>
          <input type="text" class="form-control" id="subtitle" name="subtitle" placeholder="Insert subtitle" @yield('post-subtitle')>
        </div>
        <div class="form-group">
          <label for="title">Slug</label>
          <input type="text" class="form-control" id="slug" name="slug" placeholder="Insert slug" @yield('post-slug')>
        </div>
      </div>
      <div class="col-lg-6 float-right">
        <div class="form-group">
          <label>Categories</label>
          <select class="select2bs4" multiple="multiple" data-placeholder="Select a State" style="width: 100%;" name="categories[]">
            @hasSection ('post-category')
            @yield('post-category')
            @else
            @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
            @endif
          </select>
        </div>
        <!-- /.form-group -->
        <div class="form-group">
          <label>Tags</label>
          <select class="select2bs4" multiple="multiple" data-placeholder="Select a State" style="width: 100%;" name="tags[]">
            @hasSection ('post-tag')
            @yield('post-tag')
            @else
            @foreach ($tags as $tag)
            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
            @endforeach
            @endif
          </select>
        </div>
        <!-- /.form-group -->
        <div class="form-group">
          <label for="image">Image</label>
          <div class="input-group">
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="image" name="image" value="@yield('post-image')"">
              <label class=" custom-file-label" for="image">@yield('post-image')</label>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      <div class="float-right">
        <div class="form-check float-left py-2 px-4">
          <input type="checkbox" class="form-check-input" id="status" name="status" value='1' @yield('post-status')>
          <label class="form-check-label" for="status">Publish</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </div>
  <div class="card card-outline card-info">
    <div class="card-header">
      <h3 class="card-title">Post Body</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body pad">
      <div class="mb-3">
        <textarea class="textarea" placeholder="Place some text here" style="width: 100%; height: 500px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" id="body" name="body">@yield('post-body')</textarea>
      </div>
    </div>
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

  //Initialize Select2 Elements
  $('.select2bs4').select2({
    theme: 'bootstrap4'
  })
})

</script>

@endsection
