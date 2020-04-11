@extends('layouts.dashboard')

@section('style')
<link rel="stylesheet" href="bower_components/datatables.net-dt/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="bower_components/datatables.net-responsive-dt/css/responsive.dataTables.min.css">
@endsection

@section('title')
@if (url()->current() == route('post.trash'))
Trashed Posts
@else
Post List
@endif
@endsection

@section('button')
@if (url()->current() == route('post.trash'))
<a href="{{ route('post.index') }}" class="btn btn-primary float-right">Post List</a>
@else
<a href="{{ route('post.create') }}" class="btn btn-primary float-right">Create Post</a>
@endif
@endsection

@section('content')
<!-- Read content -->
<div class="card">
  @if (count($posts) == 0)
  <div class="card-body mt-3">
    <p class="lead">No posts yet.</p>
  </div>
  @else
  <div class="card-body">
    <table class="table table-bordered table-striped dataTable">
      <thead>
        <tr>
          <th>Title</th>
          <th>Slug</th>
          <th width="1%">Author</th>
          <th width="1%">Categories</th>
          <th width="1%">Tags</th>
          <th width="150">Thumbnail</th>
          <th width="1%"></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($posts as $post)
        <tr>
          <td data-label="Title">{{ $post->title }}</td>
          <td data-label="Slug">{{ $post->slug }}</td>
          <td data-label="Author">{{ $post->user->name }}</td>
          <td data-label="Categories">
            @if(count($post->categories) == 0)
            <span class="badge badge-danger">none</span>
            @endif
            @foreach ($post->categories as $category)
            <span class="badge badge-secondary">{{ $category->name }}</span>
            @endforeach
          </td>
          <td data-label="Tags">
            @if(count($post->tags) == 0)
            <span class="badge badge-danger">none</span>
            @endif
            @foreach ($post->tags as $tag)
            <span class="badge badge-secondary">{{ $tag->name }}</span>
            @endforeach
          </td>
          <td data-label="Thumbnail">
            @empty($post->thumbnail)
            <span class="badge badge-danger">none</span>
            @endempty
            @if ($post->thumbnail != null)
            <img src="{{ asset('storage/img/' . $post->thumbnail) }}" alt="{{ $post->thumbnail }}" class="img-thumbnail img-fluid">
            @endif
          </td>
          <td>
            <div class="d-flex flex-row">
              @if (url()->current() == route('post.trash'))
              <form action="{{ route('post.restore', $post->id) }}" method="POST">
                @csrf
                <input type="submit" class="btn btn-success btn-sm mx-1" value="Restore">
              </form>
              <form action="{{ route('post.kill', $post->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" class="btn btn-danger btn-sm mx-1" onClick="deleteConfirm()" value="Delete">
              </form>
              @else
              <a href="{{ route('post.edit', $post->id) }}" class="btn btn-success btn-sm mx-1">
                Edit
              </a>
              <form action="{{ route('post.destroy', $post->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" class="btn btn-danger btn-sm mx-1" onClick="deleteConfirm()" value="Remove">
              </form>
              @endif
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
  {{-- <div class="mx-auto">
    {{ $posts->links() }}
</div> --}}
@endif
</div>
<!-- /.card -->
@endsection

@section('script')
<!-- DataTables -->
<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net-responsive-dt/js/responsive.dataTables.min.js') }}"></script>
<script>
$(function() {
  $('.dataTable').DataTable({
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": false,
    "autoWidth": false,
    "responsive": true
  });
});

</script>

<!-- page script -->
<script>
function deleteConfirm() {
  if (confirm('Are you sure you want to delete this post?')) {
    //
  } else {
    event.preventDefault();
  }
}

</script>

@endsection
