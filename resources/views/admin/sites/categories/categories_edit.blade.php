@extends('admin.layouts.sitebar')

@section('sitebar_inner')
    <div class="col-md-10 mx-auto">

        <h2 class="text-center">{{$category->name}}</h2>
        @include('admin.layouts.errors')

        <form class="form-group" method="POST" action="{{route('admin_categories_update', $category->id)}}">
            {{ csrf_field() }}
            {{method_field('PUT')}}

            <div class="form-group row">
                <div class="col-md-1">
                    Name:
                </div>
                <div class="col-md-11">
                    <input value="{{ old('name') ? old('name') : $category->name}}" type="text" class="form-control" name="name">
                </div>
            </div>

            <input type="submit" class="form-control btn btn-success" value="Hinzufügen">
        </form>
    </div>
@endsection
