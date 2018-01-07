@extends('admin.layouts.sitebar')

@section('sitebar_inner')
    <div class="col-lg-10 col-md-12 mx-auto row">
        <image-library :images-prop="{{$images}}"></image-library>
    </div>
@endsection
