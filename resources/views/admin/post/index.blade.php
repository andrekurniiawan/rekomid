@extends('layouts.admin')

@section('title', 'Post List')

@section('button')
<a href="{{ route('post.create') }}" class="btn btn-primary float-right">Create new post</a>
@endsection

@section('content')
<!-- Read content -->
<div class="card">
  <div class="card-body">
    <table id="categoryTable" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Post title</th>
          <th>Post slug</th>
          <th width="130"></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($posts as $post)
        <tr>
          <td>{{ $post->title }}</td>
          <td>{{ $post->slug }}</td>
          <td>
            <a href="{{ route('post.edit', $post) }}" class="btn btn-success btn-sm">
              Edit
            </a>
            <form action="{{ route('post.destroy', $post->id) }}" method="POST" style="display:inline">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
              <input type="submit" class="btn btn-danger btn-sm" onClick="deleteConfirm()" value="Delete">
            </form>
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
