<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>@yield('title')</title>
        <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
        </script>
        <link rel="stylesheet" href="{{asset('/css/app.css')}}">
    </head>
    <body>
        @if(! Cookie::get('ev_allow_cookies'))
            @include('layouts.cookie')
        @endif
        <div class="container-fuid" id="app">

            <div class="container-fluid menu">@include('layouts.menu')</div>
            
            @yield('content')
        </div>

        <footer>
            <script src="{{asset('/js/app.js')}}"></script>
        </footer>
    </body>
</html>
