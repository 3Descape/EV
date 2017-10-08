@extends('master')

@section('title')
    Über uns
@endsection

@section('content')
    <div class="container-fluid menu">@include('layouts.menu')</div>
    <div>
        <div class="col-md-10 mx-auto space">
            @foreach ($texts as $text)
                @if($text->html)
                    <div class="col-md-6 col-sm-12 mx-auto " id="{{strtolower($text->title)}}">
                        <h1 class="text-center">{{$text->title}}</h1>
                        @if($text->title == 'Vorstand')
                            <div class="row">
                                @if($text->images->first())
                                    <div class="col-md-4 col-sm-12 text-center">
                                        <img src="{{asset($text->images->first()->path)}}" class="img-fluid">
                                    </div>
                                @endif

                                <div class="col-md-{{$text->images->first() ? '8' : '12'}} col-sm-12">
                                    <p>{!!$text->html!!}</p>
                                </div>
                            </div>
                        @else
                            <p>{!!$text->html!!}</p>
                        @endif
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection
