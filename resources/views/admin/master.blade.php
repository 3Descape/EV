<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <script>
      window.Laravel = {!! json_encode([
          'csrfToken' => csrf_token(),
      ]) !!};
    </script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{asset('ev/public/css/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('ev/public/css/admin.css')}}">
  </head>
  <body>
    <div class="container-fluid" id="app">
      @yield('content')
    </div>

    <footer>
      <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
      <script src="{{asset('ev/public/js/admin.js')}}"></script>
    </footer>
  </body>
</html>
