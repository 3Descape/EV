@extends('master')

@section('title')
    {{$event->name}}
@endsection

@section('content')
    <div class="col-md-9 col-sm-11 col-lg-8 col-xl-6 mx-md-auto mx-3">
        <h2 class="text-center mt-4">{{$event->name}}</h2>
        {!! $event->description !!}

        @if ($event->images->count())
            <div class="col-lg-12 mx-auto px-0">
                <image-slider class="mt-5" :images-prop="{{$event->images}}"></image-slider>
            </div>
        @endif
    </div>
@endsection
