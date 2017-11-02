@extends('sites.sites_master')

@section('title')
    Impressum
@endsection

@section('content')
    <div class="col-sm-11 col-lg-9 col-xl-6 mx-auto">
        <div class="col-md-10 col-sm-12 mx-auto" id="{{$text->title}}">
            <h1 class="text-center">{{$text->title}}</h1>
            <div class="text-center mt-4">
                {!!$text->html!!}
            </div>
        </div>
    </div>
@endsection
