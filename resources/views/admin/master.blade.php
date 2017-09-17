<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <script>
        window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};
    </script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/css/admin.css')}}">
    @yield('header')
</head>
<body>
    <div class="container-fluid" id="app">
        @yield('content')
    </div>

    <footer>
        <script src="{{asset('/js/admin.js')}}"></script>
        @yield('footer')
    </footer>
</body>
</html>
