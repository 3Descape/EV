<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    <link rel="stylesheet" href="{{asset('/public/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/public/css/app.css')}}">
  </head>
  <body>
    <div class="container-fluid" id="app">
      @yield('content')
    </div>

    <footer>
      <script src="{{asset('/public/js/jquery-3.1.1.min.js')}}"></script>
      <script src="{{asset('/public/js/bootstrap.min.js')}}"></script>
    </footer>
  </body>
</html>
