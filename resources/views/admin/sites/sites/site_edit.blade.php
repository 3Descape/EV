@extends('admin.layouts.sitebar')
@section('title')
    Bearbeiten|{{$site_category->name}}
@endsection
@section('sitebar_inner')
<div class="col-lg-10 col-md-12 mx-auto">
    <sites-edit  :images-prop="{{$images}}" :people-group-prop="{{$peopleGroup}}" :sites-prop="{{$sites}}" :site-category-prop="{{$site_category}}"></sites-edit>
</div>
@endsection