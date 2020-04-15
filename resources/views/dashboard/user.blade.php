@extends('layouts.dashboard')

@section('title')
User List
@endsection

@section('button')
<a href="{{ route('user.create') }}" class="btn btn-primary float-right">Register User</a>
@endsection

@section('content')
<!-- Read content -->
<div class="card">
  @if (count($users) == 0)
  <div class="card-body mt-3">
    <p class="lead">No users yet.</p>
  </div>
  @else
  <div class="card-body">
    <table class="table table-bordered table-striped dataTable">
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Role</th>
          <th width="1%"></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $user)
        <tr>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->role}}</td>
          <td>
            <div class="d-flex flex-row">
              <a href="{{ route('user.edit', $user->id) }}" class="btn btn-success btn-sm mx-1">
                Edit
              </a>
              <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <input type="submit" class="btn btn-danger btn-sm mx-1" onClick="deleteConfirm()" value="Remove">
              </form>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
  {{-- <div class="mx-auto">
    {{ $users->links() }}
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
    "ordering": false,
    "info": false,
    "autoWidth": true,
    "responsive": false
  });
});

</script>
@endsection
