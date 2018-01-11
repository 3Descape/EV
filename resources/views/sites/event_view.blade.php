@extends('sites.sites_master')

@section('title')
    {{$event->name}}
@endsection

@section('content')
    <div class="col-md-8 col-sm-11 mx-auto">
        <h2 class="text-center mt-4">{{$event->name}}</h2>
        {!!$event->html!!}

        <div id="carouselExampleControls" class="carousel slide mt-4" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach ($event->images as $key => $image)
                    <li data-target="#carouselExampleControls" data-slide-to="{{$key}}"
                    {{$key==0 ? 'class="active"' : ''}}></li>
                @endforeach
            </ol>
            <div class="carousel-inner" role="listbox">
                @foreach ($event->images as $key => $image)
                    <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
                        <div class="w-100 text-center" alt="First slide">
                                <img style="height: auto; max-width: 90vw; max-height: 50vh;" src="{{asset('storage/'. $image->path)}}">
                        </div>

                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span aria-hidden="true">
                    <i class="fa fa-angle-left fa-3x" style="color:black"></i>
                </span>
                <span class="sr-only">Vorheriges</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span aria-hidden="true"></span>
                    <i class="fa fa-angle-right fa-3x" style="color:black"></i>
                <span class="sr-only">Nächstes</span>
            </a>
        </div>
    </div>
@endsection
