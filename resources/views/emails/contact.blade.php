@extends('emails.master')

@section('header')
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700" rel="stylesheet">
    <style>
        body{
            font-family: 'Poppins' sans-serif;
        }
        div.container-fluid {
            padding-left: 0em;
            padding-right: 0em;
        }
        div.row{
            margin-left: 0em;
            margin-right: 0em;
        }
        div.header{
            padding: 0.5rem 10px;
            background-color: #1D1D25;
            color: #13ED9A;
        }
        div.text{
            background-color: white;
            border: 1px solid rgb(56, 172, 187);
            box-shadow: 0px 0px 5px 5px rgba(93, 206, 217, 0.2);
            border-radius: 0.1em;
            line-height: 1.5em;
            font-size: 1.5em;
            padding: 0.2rem 1rem;
        }
    </style>

@endsection
@section('content')

    <div class="container-fluid">
        <div class="header">
            <h3 class="text-center">{{ ucwords($data['name'])}} schreibt folgendes:</h3>
        </div>

        <div class="row mt-5">
            <div class="text col-md-6 col-10 mx-auto">
                <p>{!!nl2br($data['text'])!!}</p>
            </div>
        </div>
    </div>
@endsection
