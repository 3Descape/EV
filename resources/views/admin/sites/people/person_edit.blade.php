@extends('admin.layouts.sitebar')
@section('sitebar_inner')
{{-- {!! $person->description !!} --}}
<div class="col-lg-10 col-md-12 mx-auto">
    <div class="card">
        <div class="card-body">
            <update-person :person-prop="{{$person}}" :categories="{{$categories}}" :images-prop="{{$images}}" :people-group-prop="{{$peopleGroup}}"></update-person>
        </div>
    </div>
</div>
@endsection
