@extends('master')

@section('title')
Dynamic
@endsection

@section('content')
<div class="container-fluid">@include('layouts.menu')</div>
<div>
    <div class="col-md-10 mx-auto bg-wrp space">
      @foreach ($contents as $content)
        <div class="col-md-10 col-sm-12 mx-auto sizing">
          <h2 class="text-center">{{ $content->title}}</h2>
          <div class="row">
            <div class="col-md-12 col-sm-12">
             {!! $content->text !!}
            </div>
          </div>
        </div>
      @endforeach
    </div>
</div>
@endsection
