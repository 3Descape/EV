@extends('admin.layouts.sitebar')

@section('sitebar_inner')
<div class="col-lg-10 col-md-12 mx-auto card">
    <div class="card-body">
        <h2 class="text-center">Veranstaltungen</h2>
        <events :events-prop="{{$events}}" :categories-prop="{{$categories}}" :images-prop="{{$images}}" :people-group-prop="{{$peopleGroup}}"></events>
    </div>
</div>
@endsection
