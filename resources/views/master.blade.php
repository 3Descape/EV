<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
<link href="https://fonts.googleapis.com/css?family=Poppins:400,700" rel="stylesheet">
    <title>@yield('title')</title>
    <script>
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
    </script>

    <link rel="stylesheet" href="{{asset('ev/public/css/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('ev/public/css/app.css')}}">
  </head>
  <body>

    <div class="container-fluid">@include('layouts.menu')</div>
    <div class="container-fluid" id="app">
      @yield('content')
    </div>

    <footer>
      <script src="{{asset('ev/public/js/app.js')}}" type="text/javascript"></script>
    </footer>
  </body>
</html>
