@extends('master')

@section('title')
    Über uns
@endsection

@section('content')
    <div class="container-fluid menu">@include('layouts.menu')</div>
    <div>
        <div class="col-md-10 mx-auto bg-wrp space">
            @foreach ($texts as $text)
                <div class="col-md-6 col-sm-12 mx-auto " id="{{strtolower($text->title)}}">
                    <h1 class="text-center">{{$text->title}}</h1>
                    @if($text->title == 'Vorstand')
                        <div class="row">
                            <div class="col-md-4 col-sm-12 text-center">
                                <img src="http://www.hwsc.net/wp-content/uploads/2016/03/Unknown-person.gif" class="img-fluid">
                            </div>
                            <div class="col-md-8 col-sm-12">
                                <p>{!!$text->text!!}</p>
                            </div>
                        </div>
                    @else
                        <p>{!!$text->text!!}</p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection
