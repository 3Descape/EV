@extends('sites.sites_master')

@section('title')
    SGA
@endsection

@section('content')

    @foreach ($texts as $text)
        <div class="col-sm-11 col-lg-9 col-xl-6 mx-auto text-block" id="{{$text->title}}">
          <h1 class="text-center">{{$text->title}}</h1>
          <p>{!!$text->html!!}</p>
        </div>
    @endforeach

    <div class="col-sm-11 col-md-9 col-lg-9 col-xl-6 mx-auto text-block">
        <h1 class="text-center">Mitglieder</h1>
        <div class="row" id="personen">
            @foreach ($people as $person)
                <div class="card col-md-12 mb-2">
                    <div class="card-body row">
                        <div class="col-sm-12 col-lg-10">
                            <h4 class="card-title">{{$person->name}}</h4>
                            @if($person->description)
                                <p class="card-text">{{$person->description}}</p>
                            @endif
                        </div>
                        <div class="col-sm-12 col-lg-2">
                            <img src="{{asset($person->image_path)}}" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
