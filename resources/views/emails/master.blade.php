<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <style>
        body{
            margin: 0px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-weight: 600;
            font-size: 1.2rem;
        }
        .text-center{
            text-align: center;
        }
        .font-bold{
            font-weight: bold;
        }
        .bg-dark{
            background-color: #292D39;
        }
        .text-green{
            color: #40E8AE !important;
        }
        .no-underline{
            text-decoration: none;
        }
        .container{
            width: 60%;
        }
        .mx-auto{
            margin-left: auto;
            margin-right: auto;
        }

        .my-2{
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;
        }
        .my-3{
            margin-top: 1.0rem;
            margin-bottom: 1.0rem
        }

        .px-2{
            padding-left: 0.5rem;
            padding-right: 0.5rem;
        }


        .px-3{
            padding-left:  1.0rem;
            padding-right: 1.0rem;
        }

        .py-2{
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }
        .py-3{
            padding-top: 1.0rem;
            padding-bottom: 1.0rem;
        }

        .border{
            border: 1px solid #e6e6e6;
            border-radius: 0.2rem;
        }
        a {
            color: white;
        }
    </style>
    @yield('header')
  </head>
  <body>
    @yield('content')
  </body>
</html>
