@extends('layouts.admin')

@section('title', 'Categories')

@section('content')
<form role="form" action="{{ route('category.store')}}" method="POST">
  @csrf
  <!-- Create content -->
  <div class="card">
    <!-- form start -->
    <div class="card-body">
      <div class="form-group">
        <label for="category">Create new category</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Category Name">
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
  @if (count($categories) == 0)
  <div class="card-body mt-3">
    <p class="lead">No categories yet.</p>
  </div>
  @else
  <div class="card-body accordion" id="accordionEdit">
    <table id="categoryTable" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Category name</th>
          <th>Category slug</th>
          <th width="130"></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($categories as $category)
        <tr>
          <td>{{ $category->name }}</td>
          <td>{{ $category->slug }}</td>
          <td>
            <button class="btn btn-success btn-sm" type="button" data-toggle="collapse" id="editButton{{ $category->id }}" data-target="#editCollapse{{ $category->id }}" aria-expanded="true" aria-controls="editCollapse{{ $category->id }}">
              Edit
            </button>
            <form action="{{ route('category.destroy', $category->id) }}" method="POST" style="display:inline">
              @csrf
              @method('DELETE')
              <input type="submit" class="btn btn-danger btn-sm float-right" onClick="deleteConfirm()" value="Delete">
            </form>
          </td>
        </tr>
        <tr>
          <td colspan="3" id="editCollapse{{ $category->id }}" class="collapse" aria-labelledby="editButton{{ $category->id }}" data-parent="#accordionEdit">
            <div id="editCollapse{{ $category->id }}" class="collapse" aria-labelledby="editButton{{ $category->id }}" data-parent="#accordionEdit">
              <form role="form" action="{{ route('category.update', $category->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <!-- form start -->
                <div class="card-body">
                  <div class="form-group">
                    <label for="category">Edit category name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Category Name" value="{{ $category->name }}">
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
    {{ $categories->links() }}
  </div>
  @endif
</div>
<!-- /.card -->
@endsection

@section('script')
<!-- page script -->
<script>
function deleteConfirm() {
  if (confirm('Are you sure you want to delete this category?')) {
    //
  } else {
    event.preventDefault();
  }
}

</script>
@endsection
