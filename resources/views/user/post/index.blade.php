@extends('layouts.user')

@section('title')
@if (url()->current() == route('post.trash'))
Trashed Posts
@else
Post List
@endif
@endsection

@section('button')
@if (url()->current() == route('post.trash'))
<a href="{{ route('post.index') }}" class="btn btn-primary float-right">Post list</a>
@else
<a href="{{ route('post.create') }}" class="btn btn-primary float-right">Create new post</a>
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
    <table id="categoryTable" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Title</th>
          <th>Slug</th>
          <th width="200">Categories</th>
          <th width="200">Tags</th>
          <th width="150">Thumbnail</th>
          <th width="150"></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($posts as $post)
        <tr>
          <td>{{ $post->title }}</td>
          <td>{{ $post->slug }}</td>
          <td>
            @foreach ($post->categories as $category)
            <span class="badge badge-secondary">{{ $category->name }}</span>
            @endforeach
          </td>
          <td>
            @foreach ($post->tags as $tag)
            <span class="badge badge-secondary">{{ $tag->name }}</span>
            @endforeach
          </td>
          <td><img src="{{ asset('storage/img/' . $post->thumbnail) }}" alt="" class="img-thumbnail img-fluid"></td>
          <td>
            @if (url()->current() == route('post.trash'))
            <form action="{{ route('post.restore', $post->id) }}" method="POST" style="display:inline">
              @csrf
              <input type="submit" class="btn btn-success btn-sm" value="Restore">
            </form>
            <form action="{{ route('post.kill', $post->id) }}" method="POST" style="display:inline">
              @csrf
              @method('DELETE')
              <input type="submit" class="btn btn-danger btn-sm" onClick="deleteConfirm()" value="Delete">
            </form>
            @else
            <a href="{{ route('post.edit', $post->id) }}" class="btn btn-success btn-sm">
              Edit
            </a>
            <form action="{{ route('post.destroy', $post->id) }}" method="POST" style="display:inline">
              @csrf
              @method('DELETE')
              <input type="submit" class="btn btn-danger btn-sm" onClick="deleteConfirm()" value="Remove">
            </form>
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
  <div class="mx-auto">
    {{ $posts->links() }}
  </div>
  @endif
</div>
<!-- /.card -->
@endsection

@section('script')
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
