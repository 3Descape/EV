@extends('admin.layouts.sitebar')
@section('header')
<link rel="stylesheet" href="{{asset('css/cropper.min.css')}}" />
@endsection
@section('sitebar_inner')
<div class="container-fluid">
    <div class="row">
        <update-person :person-prop="{{$person}}" :categories="{{$categories}}"></update-person>
    </div> 
</div>
@endsection
