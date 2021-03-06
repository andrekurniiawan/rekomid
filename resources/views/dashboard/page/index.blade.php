@extends('layouts.dashboard')

@section('title')
@if (url()->current() == route('page.trash'))
Trashed Pages
@else
Page List
@endif
@endsection

@section('button')
@if (url()->current() == route('page.trash'))
<a href="{{ route('page.index') }}" class="btn btn-primary float-right ml-1">
  <i class="fas fa-list mr-1"></i>
  Page List
</a>
@else
@can('create', App\Page::class)
<a href="{{ route('page.create') }}" class="btn btn-primary float-right ml-1">
  <i class="fas fa-edit mr-1"></i>
  Create Page
</a>
@endcan
<a href="{{ route('page.trash') }}" class="btn btn-danger float-right ml-1">
  <i class="fas fa-trash mr-1"></i>
  Trashed
</a>
@endif
@endsection

@section('content')
<!-- Read content -->
<div class="card">
  @if (count($pages) == 0)
  <div class="card-body mt-3">
    <p class="lead">No pages yet.</p>
  </div>
  @else
  <div class="card-body">
    <table class="table table-bordered table-striped dataTable">
      <thead>
        <tr>
          <th>Title</th>
          <th>Slug</th>
          <th width="1%">Author</th>
          <th width="1%">Date</th>
          <th width="1%">Published</th>
          {{-- <th width="150">Thumbnail</th> --}}
          <th width="1%"></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($pages as $page)
        <tr>
          <td data-label="Title">{{ $page->title }}</td>
          <td data-label="Slug">{{ $page->slug }}</td>
          <td data-label="Author">{{ $page->user->name }}</td>
          <td data-label="Date">{{ $page->created_at->format('Y/m/d') }}</td>
          <td data-label="Published">
            @if ($page->publish == null)
            <span class="badge badge-danger">no</span>
            @else
            <span class="badge badge-primary">yes</span>
            @endif
          </td>
          {{-- <td data-label="Thumbnail">
            @empty($page->thumbnail)
            <span class="badge badge-danger">none</span>
            @endempty
            @if ($page->thumbnail != null)
            <img src="{{ asset('storage/img/' . $page->thumbnail) }}" alt="{{ $page->thumbnail }}" class="img-thumbnail img-fluid" style="max-width:150px;max-height:150px;">
          @endif
          </td> --}}
          <td>
            <div class="d-flex flex-row">
              @if (url()->current() == route('page.trash'))
              @can('restore', $page)
              <form action="{{ route('page.restore', $page->id) }}" method="POST">
                @csrf
                <input type="submit" class="btn btn-success btn-sm mx-1" value="Restore">
              </form>
              @endcan
              @can('forceDelete', $page)
              <form action="{{ route('page.kill', $page->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" class="btn btn-danger btn-sm mx-1" onClick="deleteConfirm()" value="Delete">
              </form>
              @endcan
              @else
              @can('update', $page)
              <a href="{{ route('page.edit', $page->id) }}" class="btn btn-success btn-sm mx-1">
                Edit
              </a>
              @endcan
              @can('delete', $page)
              <form action="{{ route('page.destroy', $page->id) }}" method="POST">
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
    {{ $pages->links() }}
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
