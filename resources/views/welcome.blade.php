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
      <div id="page-wrapper">
        <guest-header></guest-header>
        <guest-content></guest-content>
        <guest-footer></guest-footer>
      </div><!-- /#page-wrapper -->
    </div><!-- /#wrapper -->
  </div><!-- /#app -->

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
