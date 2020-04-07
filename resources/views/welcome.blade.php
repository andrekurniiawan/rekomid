<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>{{ config('app.name') }}</title>
</head>

<body>
  <div id="app">
    <div class="d-flex" id="wrapper">
      <guest-sidebar></guest-sidebar>
      <!-- Page Content -->
      <div id="page-content-wrapper">
        <guest-header></guest-header>
      </div><!-- /#page-content-wrapper -->
    </div>
  </div>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
