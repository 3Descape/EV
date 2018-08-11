@extends('admin.layouts.sitebar')

@section('sitebar_inner')
<div class="container-fluid">
    <div class="row">
        <create-person :category="{{$category}}" :categories="{{$categories}}" :images-prop="{{$images}}"></create-person>
    </div>
</div>
@endsection
