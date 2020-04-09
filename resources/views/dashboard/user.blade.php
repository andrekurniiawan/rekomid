@extends('layouts.dashboard')

@section('title')
User List
@endsection

@section('button')
<a href="{{ route('register') }}" class="btn btn-primary float-right">Register new user</a>
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
    <table id="categoryTable" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Role</th>
          <th width="150"></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $user)
        <tr>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td></td>
          <td>
            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-success btn-sm">
              Edit
            </a>
            <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline">
              @csrf
              @method('DELETE')
              <input type="submit" class="btn btn-danger btn-sm" onClick="deleteConfirm()" value="Remove">
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
  <div class="mx-auto">
    {{ $users->links() }}
  </div>
  @endif
</div>
<!-- /.card -->
@endsection

@section('script')
<!-- page script -->
<script>
function deleteConfirm() {
  if (confirm('Are you sure you want to delete this user?')) {
    //
  } else {
    event.preventDefault();
  }
}

</script>

@endsection
