@extends('admin.layouts.sitebar')
@section('header')
<link rel="stylesheet" href="{{asset('css/cropper.min.css')}}" />
@endsection
@section('sitebar_inner')
<div class="container-fluid">
    <div class="row">
    <person :person-prop="{{$person}}" :categories="{{$categories}}"></person>
    </div> 
</div>
@endsection
