@extends('sites.sites_master')

@section('title')
    {{$event->name}}
@endsection

@section('content')
    <div class="col-md-9 col-sm-11 col-lg-8 col-xl-6 mx-auto">
        <h2 class="text-center mt-4">{{$event->name}}</h2>
        {!!$event->html!!}

        @if ($event->images->count())
            <div class="col-lg-12 mx-auto px-0">
                <image-slider class="owl-carousel owl-theme mt-5">
                    @foreach ($event->images as $key => $image)
                        <img src="{{asset('storage/'. $image->path)}}">
                    @endforeach
                </image-slider>
            </div>
        @endif
    </div>
@endsection
