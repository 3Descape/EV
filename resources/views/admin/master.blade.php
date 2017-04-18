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
    <link href="https://cdn.quilljs.com/1.2.3/quill.snow.css" rel="stylesheet">
  </head>
  <body>
    <div class="container-fluid" id="app">
      @yield('content')
    </div>

    <footer>
      <script src="//cdn.quilljs.com/1.0.0/quill.js" type="text/javascript"></script>
      <script src="{{asset('ev/public/js/admin.js')}}"></script>
    </footer>
  </body>
</html>
