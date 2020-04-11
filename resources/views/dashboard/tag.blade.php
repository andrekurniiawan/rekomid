@extends('layouts.dashboard')

@section('title', 'Tags')

@section('style')
<style>
@media screen and (max-width: 600px) {
  table thead {
    border: none;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
  }

  table tr {
    display: block;
    margin-bottom: .625em;
  }

  table td {
    display: block;
    font-size: .8em;
    text-align: right;
  }

  table td::before {
    /*
  * aria-label has no advantage, it won't be read inside a table
  content: attr(aria-label);
  */
    content: attr(data-label);
    font-weight: bold;
    float: left;
  }
}

</style>
@endsection

@section('content')
<form role="form" action="{{ route('tag.store')}}" method="POST">
  @csrf
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
  @if (count($tags) == 0)
  <div class="card-body mt-3">
    <p class="lead">No tags yet.</p>
  </div>
  @else
  <div class="card-body accordion" id="accordionEdit">
    <table id="categoryTable" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Tag name</th>
          <th>Tag slug</th>
          <th width="1%"></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($tags as $tag)
        <tr>
          <td data-label="Tag name">{{ $tag->name }}</td>
          <td data-label="Tag slug">{{ $tag->slug }}</td>
          <td>
            <div class="d-flex flex-row">
              <button class="btn btn-success btn-sm mx-1" type="button" data-toggle="collapse" id="editButton{{ $tag->id }}" data-target="#editCollapse{{ $tag->id }}" aria-expanded="true" aria-controls="editCollapse{{ $tag->id }}">
                Edit
              </button>
              <form action="{{ route('tag.destroy', $tag->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" class="btn btn-danger btn-sm mx-1" onClick="deleteConfirm()" value="Delete">
              </form>
            </div>
          </td>
        </tr>
        <tr>
          <td colspan="3" id="editCollapse{{ $tag->id }}" class="collapse" aria-labelledby="editButton{{ $tag->id }}" data-parent="#accordionEdit">
            <div id="editCollapse{{ $tag->id }}" class="collapse" aria-labelledby="editButton{{ $tag->id }}" data-parent="#accordionEdit">
              <form role="form" action="{{ route('tag.update', $tag->id) }}" method="POST">
                @csrf
                @method('PATCH')
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
  @endif
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
