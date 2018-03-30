@extends('sites.sites_master')

@section('title')
    SGA
@endsection

@section('content')

    @foreach ($sites as $site)
        <div class="col-sm-11 col-lg-9 col-xl-6 mx-auto text-block" id="{{$site->title}}">
          <h1 class="text-center">{{$site->title}}</h1>
          <p>{!!$site->html!!}</p>
        </div>
    @endforeach

    <div class="col-sm-11 col-md-9 col-lg-9 col-xl-6 mx-auto text-block">
        <h1 class="text-center">Mitglieder</h1>
        <div class="row" id="personen">
            @foreach ($people as $person)
                <div class="col-lg-6 col-md-12 mb-2">
                    <div class="card mx-0 mx-lg-1">
                        <div class="card-body row">
                            @if($person->image_path)
                                <div class="col-sm-3 col-lg-3 px-1">
                                    <img src="{{asset("/storage/{$person->image_path}")}}" class="img-fluid" style="border-radius: 50%">
                                </div>
                             @endif
                            <div class="col-sm-9 col-lg-{{$person->image_path? '9' : '12'}}">
                                <h4 class="card-title mb-2" style="font-weight: 500">{{$person->name}}</h4>
                                @if($person->description)
                                    <p class="card-text" style="line-height: 1.4; font-size: 1.2rem">{{$person->description}}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
