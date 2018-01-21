@extends('admin.layouts.sitebar') 
@section('sitebar_inner')
<div class="col-lg-10 col-md-12 mx-auto">
    <sites-edit :sites-prop="{{$sites}}" :site-category-prop="{{$site_category}}"></sites-edit>
</div>
@endsection