@extends('sites.sites_master') 
@section('title') Über uns
@endsection
 
@section('content') @if ($gruppenbild)
<div class="col-sm-11 col-lg-9 col-xl-6 mx-auto text-block text-center">
    <img src="{{asset('storage/'. $gruppenbild->path)}}" class="img-fluid">
</div>
@endif
<div class="col-sm-11 col-lg-9 col-xl-6 mx-auto text-block" id="vorstand">
    <h1 class="text-center">Vorstand</h1>
    <div class="row">
        @foreach($committe as $person)
        <div class="col-lg-6 pb-2">
            <div class="card h-100">
                <div class="card-body py-2 people flex-wrap d-flex">
                    <div class="text order-2 order-lg-1">
                        <h5>{{$person->name}}</h5>
                        <p class="mb-0">{{$person->description}}</p>
                    </div>
                    @if($person->image_path)
                    <div class="image mb-3 mb-lg-0 ml-0 ml-lg-2 order-1 order-lg-2">
                        <img src="{{asset('storage/'. $person->image_path)}}" class="img-fluid">
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@foreach ($texts as $text) @if($text->html)
<div class="col-sm-11 col-lg-9 col-xl-6 mx-auto text-block" id="test">
    <h1 class="text-center">{{$text->title}}</h1>
    <p>{!!$text->html!!}</p>
</div>
@endif @endforeach
@endsection