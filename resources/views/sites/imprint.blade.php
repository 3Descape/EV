@extends('sites.sites_master')

@section('title')
    Impressum
@endsection
@section('content')
    @foreach ($sites as $site)
        <div class="col-md-6 col-sm-12 mx-auto text-block" id="{{str_slug($site->title, "-")}}">
            <h1 class="text-center">{{$site->title}}</h1>
            <p>{!!$site->html!!}</p>
        </div>
    @endforeach
@endsection
