@if (count($errors) > 0)
  <div class="alert alert-danger pb-0 pt-3">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif