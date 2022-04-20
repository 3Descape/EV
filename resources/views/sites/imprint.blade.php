@extends('master')

@section('title')
    Impressum
@endsection
@section('content')
    @foreach ($sites as $site)
        <div class="col-md-6 col-sm-12 mx-md-auto mx-3 text-block" id="{{Str::slug($site->title, "-")}}">
            <h1 class="text-center">{{$site->title}}</h1>
            <p>{!! $site->text !!}</p>
        </div>
    @endforeach
@endsection
