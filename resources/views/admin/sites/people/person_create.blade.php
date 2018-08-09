@extends('admin.layouts.sitebar')

@section('sitebar_inner')
<div class="container-fluid">
    <div class="row">
        <create-person :category="{{$category}}" :categories="{{$categories}}"></create-person>
    </div>
</div>
@endsection
