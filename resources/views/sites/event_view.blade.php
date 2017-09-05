@extends('master')

@section('title')
    {{$event->name}}
@endsection

@section('content')
    <div class="container-fluid menu">@include('layouts.menu')</div>
    <div>
        <div class="col-md-10 mx-auto bg-wrp space">
            <div class="col-md-6 col-sm-12 mx-auto " id="info">
                <h2 class="text-center">{{$event->name}}</h2>
                <p>{{$event->description}}</p>


                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach ($event->images as $key => $image)
                            <li data-target="#carouselExampleControls" data-slide-to="{{$key}}" {{$key==0 ? 'class="active"' : ''}}></li>
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
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

            </div>
        </div>
    @endsection
