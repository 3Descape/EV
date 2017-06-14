@extends('master')

@section('title')
Veranstaltungen Archiv
@endsection

@section('content')
  <div class="container-fluid menu">@include('layouts.menu')</div>
  <div class="bg">

  </div>
  <div>
    <div class="col-md-10 mx-auto bg-wrp">
     <h1 class="text-center">Veranstaltungen Archiv</h1>

     @foreach ($events as $event)


        <div class="col-md-10 mx-auto">
          <div class="card">
            <div class="card-block">
              <div class="row">
                <div class="col-md-2">
                  <img class="img-fluid" src="https://cdn.dribbble.com/users/2915/screenshots/111453/shot_1297091762.jpg" alt="Card image cap">
                </div>
                <div class="col-md-10">
                  <div class="row">
                    <div class="col-md-12">
                      <h3 class="card-title">{{$event->name}}</h3>
                      <p class="card-text">{{$event->description}}</p>
                    </div>
                    <div class="col-md-12 mt-4">
                      <p class="card-text">{{$event->date->diffForHumans() . ' ' . $event->location}}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach

    </div>
  </div>
@endsection
