@extends('layouts.admin')

@section('title', 'Tags')

@section('content')
<form role="form" action="{{ route('tag.store')}}" method="POST">
  {{ csrf_field() }}
  @include('layouts.message')
  <!-- Create content -->
  <div class="card">
    <!-- form start -->
    <div class="card-body">
      <div class="form-group">
        <label for="tag">Create new tag</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Tag Name">
      </div>
      <div class="float-right">
        <button type="submit" id="submit" class="btn btn-primary btn-sm">Submit</button>
      </div>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.content -->
</form>
<!-- Read content -->
<div class="card">
  <div class="card-body accordion" id="accordionEdit">
    <table id="categoryTable" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Tag name</th>
          <th>Tag slug</th>
          <th width="130"></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($tags as $tag)
        <tr>
          <td>{{ $tag->name }}</td>
          <td>{{ $tag->slug }}</td>
          <td>
            <button class="btn btn-success btn-sm" type="button" data-toggle="collapse" id="editButton{{ $tag->id }}" data-target="#editCollapse{{ $tag->id }}" aria-expanded="true" aria-controls="editCollapse{{ $tag->id }}">
              Edit
            </button>
            <form action="{{ route('tag.destroy', $tag->id) }}" method="POST" style="display:inline">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
              <input type="submit" class="btn btn-danger btn-sm float-right" onClick="deleteConfirm()" value="Delete">
            </form>
          </td>
        </tr>
        <tr>
          <td colspan="3" id="editCollapse{{ $tag->id }}" class="collapse" aria-labelledby="editButton{{ $tag->id }}" data-parent="#accordionEdit">
            <div id="editCollapse{{ $tag->id }}" class="collapse" aria-labelledby="editButton{{ $tag->id }}" data-parent="#accordionEdit">
              <form role="form" action="{{ route('tag.update', $tag->id) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <!-- form start -->
                <div class="card-body">
                  <div class="form-group">
                    <label for="tag">Edit tag name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Tag Name" value="{{ $tag->name }}">
                  </div>
                  <div class="float-right">
                    <button type="submit" id="submit" class="btn btn-primary btn-sm">Submit</button>
                  </div>
                </div>
                <!-- /.card-body -->
              </form>
            </div>
          </td>
          <td style="display: none;"></td>
          <td style="display: none;"></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
  <div class="mx-auto">
    {{ $tags->links() }}
  </div>
</div>
<!-- /.card -->
@endsection

@section('script')
<!-- page script -->
<script>
function deleteConfirm() {
  if (confirm('Are you sure you want to delete this tag?')) {
    //
  } else {
    event.preventDefault();
  }
}

</script>
@endsection
