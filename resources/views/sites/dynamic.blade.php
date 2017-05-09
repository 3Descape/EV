@extends('master')

@section('title')
Dynamic
@endsection

@section('content')
<div class="container-fluid">@include('layouts.menu')</div>

<div>
  <div class="col-md-10 mx-auto bg-wrp space">
    {!! $content !!}
  </div>
</div>

@endsection
