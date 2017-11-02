@extends('master')

@section('title')
    {{$event->name}}
@endsection

@section('content')
    <h2 class="text-center mt-4">{{$event->name}}</h2>
    <p class="col-md-8 mx-auto">{!!$event->html!!}</p>

    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            @foreach ($event->images as $key => $image)
                <li data-target="#carouselExampleControls" data-slide-to="{{$key}}"
                {{$key==0 ? 'class="active"' : ''}}></li>
            @endforeach
        </ol>
        <div class="carousel-inner" role="listbox">
            @foreach ($event->images as $key => $image)
                <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
                    <img class="d-block img-fluid" src="{{asset($image->path)}}" alt="First slide">
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Vorheriges</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Nächstes</span>
        </a>
    </div>
@endsection
