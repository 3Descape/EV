<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <style>
        .mx-auto{
            margin-left: auto;
            margin-right: auto;
        }

        .px-2{
            padding-left: 0.5rem;
            padding-right: 0.5rem;
        }

        .py-2{
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }
        .card{
            color: #4e4e50;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f8f8;
            border-radius: 0.3rem;
            width: 90%;
            border: 2px solid #f2f0f9;
            box-shadow: 0px 0px 8px 8px rgba(102, 217, 255, 0.15),  0px 0px 2px 2px rgba(0, 163, 204, 0.05);
            border: 2px solid rgba(0, 82, 102, 0.15);
        }

        @media only screen and (min-width: 577px){
            .card{
                width: 70%;
            }
        }

        @media only screen and (min-width: 720px) {
            .card{
                width: 60%;
            }
        }

        .card-header{
            font-weight: 600;
            font-size: 1.3rem;
        }
        .card-body{
            
        }

        .border{
            border: 1px solid #e6e6e6;
            padding: 0.5rem;
            margin: 0.3rem;
            border-radius: 0.2rem;
        }
        .card-footer{
            text-align: center;
            background-color: #f0f0f0;
            padding: 0.5rem;
            font-weight: 600;
        }
    </style>
    @yield('header')
  </head>
  <body>
    @yield('content')
  </body>
</html>
