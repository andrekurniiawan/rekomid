@extends('layouts.dashboard')

@section('title')
@if (url()->current() == route('category.trash'))
Trashed Categories
@else
Category List
@endif
@endsection

@section('button')
@if (url()->current() == route('category.trash'))
<a href="{{ route('category.index') }}" class="btn btn-primary float-right">Category list</a>
@else
@can('create', App\Category::class)
<a data-widget="control-sidebar" data-slide="true" href="#" role="button" class="btn btn-primary float-right">Create Category</a>
@endcan
@endif
@endsection

@section('content')
<!-- Read content -->
<div class="card">
  @if (count($categories) == 0)
  <div class="card-body mt-3">
    <p class="lead">No categories yet.</p>
  </div>
  @else
  <div class="card-body accordion" id="accordionEdit">
    <table class="table table-bordered table-striped dataTable">
      <thead>
        <tr>
          <th>Category Name</th>
          <th>Category Slug</th>
          <th width="1%"></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($categories as $category)
        <tr>
          <td data-label="Category Name">{{ $category->name }}</td>
          <td data-label="Category Slug">{{ $category->slug }}</td>
          <td>
            <div class="d-flex flex-row">
              @if (url()->current() == route('category.trash'))
              @can('restore', $category)
              <form action="{{ route('category.restore', $category->id) }}" method="POST">
                @csrf
                <input type="submit" class="btn btn-success btn-sm mx-1" value="Restore">
              </form>
              @endcan
              @can('forceDelete', $category)
              <form action="{{ route('category.kill', $category->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" class="btn btn-danger btn-sm mx-1" onClick="deleteConfirm()" value="Delete">
              </form>
              @endcan
              @else
              @can('update', $category)
              <button class="btn btn-success btn-sm mx-1" type="button" data-toggle="collapse" id="editButton{{ $category->id }}" data-target="#editCollapse{{ $category->id }}" aria-expanded="true" aria-controls="editCollapse{{ $category->id }}">
                Edit
              </button>
              @endcan
              @can('delete', $category)
              <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" class="btn btn-danger btn-sm mx-1" onClick="deleteConfirm()" value="Remove">
              </form>
              @endcan
              @endif
            </div>
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
                  <div class="col-lg-6 float-left">
                    <div class="form-group">
                      <label for="category">Category Name</label>
                      <input type="text" class="form-control" name="name" placeholder="Add category name..." value="{{ $category->name }}">
                    </div>
                  </div>
                  <div class="col-lg-6 float-right">
                    <div class="form-group">
                      <label for="category">Category Slug</label>
                      <input type="text" class="form-control" name="slug" placeholder="same-as-name" value="{{ $category->slug }}">
                    </div>
                    <div class="float-right">
                      <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    </div>
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
  {{-- <div class="mx-auto">
    {{ $categories->links() }}
</div> --}}
@endif
</div>
<!-- /.card -->
@endsection

@section('right-sidebar')
<!-- Control Sidebar -->
<aside class="control-sidebar form-control-sidebar control-sidebar-dark elevation-2 overflow-auto">
  <!-- Control sidebar content goes here -->
  <div class="p-3">
    <div class="d-flex flex-row justify-content-end">
      <a data-widget="control-sidebar" data-slide="true" href="#" role="button"><i class="fas fa-times-circle"></i></a>
    </div>
    <!-- form start -->
    <form role="form" id="createForm" action="{{ route('category.store')}}" method="POST">
      @csrf
      <div class="form-group">
        <label for="name">Create Category</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Add category name...">
      </div>
      <div class="form-group">
        <label for="slug">Category Slug</label>
        <input type="text" class="form-control" id="slug" name="slug" placeholder="same-as-name">
      </div>
      <div class="float-right">
        <button type="submit" id="submit" class="btn btn-primary btn-sm">Submit</button>
      </div>
    </form>
  </div>
</aside>
<!-- /.control-sidebar -->
@endsection

@section('script')
<script>
// DataTables
$(function() {
  $('.dataTable').DataTable({
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": false,
    "info": false,
    "autoWidth": true,
    "responsive": false
  });
});

</script>
@endsection
