<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>{{ config('app.name') }}</title>
</head>

<body>
  <div id="app">
    <guest-header></guest-header>
  </div>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
</body>

</html>
