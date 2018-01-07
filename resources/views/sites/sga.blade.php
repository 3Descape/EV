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
                <div class="col-lg-6 col-md-12 mb-2">
                    <div class="card mx-0 mx-lg-1">
                        <div class="card-body row">
                            <div class="col-sm-12 col-lg-{{$person->image_path? '9' : '12'}}">
                                <h4 class="card-title">{{$person->name}}</h4>
                                @if($person->description)
                                    <p class="card-text">{{$person->description}}</p>
                                @endif
                            </div>
                            @if($person->image_path)
                                <div class="col-sm-12 col-lg-3">
                                    <img src="{{asset("/storage/{$person->image_path}")}}" alt="" class="img-fluid">
                                </div>
                             @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
