@extends('layouts.dashboard')

@section('title')
@if (url()->current() == route('post.trash'))
Trashed Posts
@else
Post List
@endif
@endsection

@section('button')
@if (url()->current() == route('post.trash'))
<a href="{{ route('post.index') }}" class="btn btn-primary float-right ml-1">
  <i class="fas fa-list mr-1"></i>
  Post List
</a>
@else
@can('create', App\Post::class)
<a href="{{ route('post.create') }}" class="btn btn-primary float-right ml-1">
  <i class="nav-icon fas fa-edit mr-1"></i>
  Create Post
</a>
@endcan
<a href="{{ route('post.trash') }}" class="btn btn-danger float-right ml-1">
  <i class="nav-icon fas fa-trash mr-1"></i>
  Trashed
</a>
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
          {{-- <th width="1%">Tags</th> --}}
          <th width="1%">Date</th>
          <th width="1%">Published</th>
          {{-- <th width="150">Thumbnail</th> --}}
          <th width="1%"></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($posts as $post)
        <tr>
          <td data-label="Title">
            @if($post->title == null)
            <span class="badge badge-danger">no title</span>
            @else
            {{ $post->title }}
            @endif
          </td>
          <td data-label="Slug">
            @if($post->slug == null)
            <span class="badge badge-danger">no slug</span>
            @else
            {{ $post->slug }}
            @endif
          </td>
          <td data-label="Author">{{ $post->user->name }}</td>
          <td data-label="Categories">
            @if(count($post->categories) == 0)
            <span class="badge badge-danger">none</span>
            @endif
            @foreach ($post->categories as $category)
            <span class="badge badge-secondary">{{ $category->name }}</span>
            @endforeach
          </td>
          {{-- <td data-label="Tags">
            @if(count($post->tags) == 0)
            <span class="badge badge-danger">none</span>
            @endif
            @foreach ($post->tags as $tag)
            <span class="badge badge-secondary">{{ $tag->name }}</span>
          @endforeach
          </td> --}}
          <td data-label="Date">{{ $post->created_at->format('Y/m/d') }}</td>
          <td data-label="Published">
            @if ($post->publish == null)
            <span class="badge badge-danger">no</span>
            @else
            <span class="badge badge-primary">yes</span>
            @endif
          </td>
          {{-- <td data-label="Thumbnail">
            @empty($post->thumbnail)
            <span class="badge badge-danger">none</span>
            @endempty
            @if ($post->thumbnail != null)
            <img src="{{ asset('storage/img/' . $post->thumbnail) }}" alt="{{ $post->thumbnail }}" class="img-thumbnail img-fluid" style="max-width:150px;max-height:150px;">
          @endif
          </td> --}}
          <td>
            <div class="d-flex flex-row">
              @if (url()->current() == route('post.trash'))
              @can('restore', $post)
              <form action="{{ route('post.restore', $post->id) }}" method="POST">
                @csrf
                <input type="submit" class="btn btn-success btn-sm mx-1" value="Restore">
              </form>
              @endcan
              @can('forceDelete', $post)
              <form action="{{ route('post.kill', $post->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" class="btn btn-danger btn-sm mx-1" onClick="deleteConfirm()" value="Delete">
              </form>
              @endcan
              @else
              @can('update', $post)
              <a href="{{ route('post.edit', $post->id) }}" class="btn btn-success btn-sm mx-1">
                Edit
              </a>
              @endcan
              @can('delete', $post)
              <form action="{{ route('post.destroy', $post->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" class="btn btn-danger btn-sm mx-1" onClick="deleteConfirm()" value="Remove">
              </form>
              @endcan
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
<script>
// DataTables
$(function() {
  $('.dataTable').DataTable({
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": true,
    "responsive": true
  });
});

</script>
@endsection
