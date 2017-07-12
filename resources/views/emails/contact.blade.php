@extends('emails.master')

@section('content')
    <div class="container-fluid">
        <h1 class="text-center">{{ ucfirst($data['name'])}} schreibt foldendes:</h1>
        <p>
            {{$data['text']}}
        </p>
    </div>

@endsection
