@extends('sites.sites_master') 
@section('title') Über uns
@endsection
 
@section('content') @if ($gruppenbild)
<div class="col-sm-11 col-lg-9 col-xl-6 mx-auto text-block text-center">
    <img src="{{asset('storage/'. $gruppenbild->path)}}" class="image-style" style="max-height: 30em">
</div>
@endif
@foreach ($sites as $site)
    @if($site->html)
        <div class="col-sm-11 col-lg-9 col-xl-6 mx-auto text-block" id="{{str_slug($site->title, '-')}}">
            <h1 class="text-center">{{$site->title}}</h1>
            <p>{!!$site->html!!}</p>
        </div>
    @endif 
@endforeach
@endsection