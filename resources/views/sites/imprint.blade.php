@extends('master')

@section('title')
Impressum
@endsection

@section('content')
<div class="container-fluid menu">@include('layouts.menu')</div>
    <div>
        <div class="col-md-10 mx-auto bg-wrp">
          <div class="col-md-12">
            <div class="col-md-10 col-sm-12 mx-auto" id="{{$text->title}}">
                <h1 class="text-center">{{$text->title}}</h1>
                <div class="text-center mt-4">
                    {!!$text->text!!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
