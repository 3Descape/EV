<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Archivo+Black" rel="stylesheet">

    <style>
        body{
            height: 100vh;
            background-color: rgb(167, 16, 16);
            font-family: 'Archivo Black', sans-serif;
        }
        div{
            position: absolute;
            top: 50%;
            width: 100%;
            text-align: center;
            color: white;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="">
        <h1>403 Keine Berechtigung</h1>
        @if(Auth::user())
            <div class="mt-5 d-flex justify-content-center align-items-start">
                <form class="px-1" action="{{route('logout')}}" method="POST">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-sign-out"><span class="hidden-sm-down">Logout</span></i>
                    </button>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>

                @can('can_access_dashboard', \App\User::class)
                    <a href="{{route('admin_dashboard')}}" class="btn btn-success px-1">Dashboard</a>
                @endcan
            </div>
        @endif

    </div>

</body>
</html>
