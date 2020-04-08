@extends('layouts.admin')

@section('content')
<form role="form" action=" {{ route('category.store')}} " method="POST">
  {{ csrf_field() }}
  @include('layouts.message')
  <!-- Create content -->
  <div class="card">
    <!-- form start -->
    <div class="card-body">
      <div class="col-lg-6 float-left">
        <div class="form-group">
          <label for="category">Create new category</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="Category Name">
        </div>
      </div>
      <div class="col-lg-6 float-right">
        <div class="form-group">
          <label for="slug">Category slug</label>
          <input type="text" class="form-control" id="slug" name="slug" placeholder="category-slug">
        </div>
      </div>
      <div class="float-right">
        <button type="submit" id="submit" class="btn btn-primary btn-sm mr-3">Submit</button>
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
          <th>Category name</th>
          <th>Category slug</th>
          <th width="130"></th>
        </tr>
      </thead>
      <tbody>
        <?php $count = 0;?>
        @foreach ($categories as $category)
        <tr>
          <td>{{ $category->name }}</td>
          <td>{{ $category->slug }}</td>
          <td>
            <button class="btn btn-success btn-sm" type="button" data-toggle="collapse" id="editButton{{ $category->id }}" data-target="#editCollapse{{ $category->id }}" aria-expanded="true" aria-controls="editCollapse{{ $category->id }}">
              Edit
            </button>
            <form action="{{ route('category.destroy', $category->id) }}" method="POST" style="display:inline">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
              <input type="submit" class="btn btn-danger btn-sm float-right" onClick="deleteConfirm()" value="Delete" @if ($count < 1) disabled @endif>
            </form>
          </td>
        </tr>
        <tr>
          <td colspan="3" id="editCollapse{{ $category->id }}" class="collapse" aria-labelledby="editButton{{ $category->id }}" data-parent="#accordionEdit">
            <div id="editCollapse{{ $category->id }}" class="collapse" aria-labelledby="editButton{{ $category->id }}" data-parent="#accordionEdit">
              <form role="form" action="{{ route('category.update', $category->id) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <!-- form start -->
                <div class="card-body">
                  <div class="col-lg-6 float-left">
                    <div class="form-group">
                      <label for="title"><em>Category name</em></label>
                      <input type="text" class="form-control" id="categoryName" name="name" placeholder="Insert category name" value="{{ $category->name }}">
                    </div>
                  </div>
                  <div class="col-lg-6 float-right">
                    <div class="form-group">
                      <label for="title"><em>Category slug</em></label>
                      <input type="text" class="form-control" id="categorySlug" name="slug" placeholder="Insert category slug" value="{{ $category->slug }}" @if ($count < 1) disabled @endif>
                      <div class="float-right mt-3">
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                      </div>
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
        <?php $count++ ?>
        @endforeach
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
  <div class="mx-auto">
    {{ $categories->links() }}
  </div>
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
