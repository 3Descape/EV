@extends('master')

@section('title')
    SGA
@endsection

@section('content')

    @foreach ($sites as $site)
        <div class="col-sm-11 col-lg-9 col-xl-6 mx-md-auto mx-3 text-block" id="{{$site->title}}">
          <h1 class="text-center">{{$site->title}}</h1>
          <p>{!! $site->text !!}</p>
        </div>
    @endforeach

@endsection
