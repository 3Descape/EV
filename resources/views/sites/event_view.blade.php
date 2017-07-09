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
        </div>
    </div>
@endsection
