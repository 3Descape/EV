@extends('master')

@section('title')
SGA
@endsection

@section('content')
<div class="container-fluid menu">@include('layouts.menu')</div>
<div>
    <div class="col-md-10 mx-auto bg-wrp space">
        @foreach ($texts as $text)
        <div class="col-md-6 col-sm-12 mx-auto " id="{{$text->title}}">
          <h1 class="text-center">{{$text->title}}</h1>
          <p>{!!$text->text!!}</p>
        </div>
        @endforeach

        <div class="col-md-6 col-sm-11 mx-auto ">
            <h1 class="text-center">Mitglieder</h1>
            <div class="row" id="personen">
                @foreach ($people as $person)
                    <div class="card col-md-12" style="background-color: #FFFFFF">
                        <div class="card-body">
                        <h4 class="card-title">{{$person->name}}</h4>
                        @if($person->description)
                            <p class="card-text">{{$person->description}}</p>
                        @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        
    </div>
</div>
@endsection
