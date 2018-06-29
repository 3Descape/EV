@extends('admin.layouts.sitebar')

@section('sitebar_inner')
    <div class="col-lg-10 col-sm-12 col-md-12 mx-auto">
    <event-edit :event-prop="{{$event}}" :categories="{{$categories}}" :images-prop="{{ $images }}"></event-edit>
    </div>
@endsection

