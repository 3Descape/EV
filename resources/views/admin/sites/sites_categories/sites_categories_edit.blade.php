@extends('admin.layouts.sitebar')

@section('sitebar_inner')
    <div class="col-lg-10 col-md-12 mx-auto">
        @include('admin.layouts.errors')

        <form class="form-group" method="POST" action="{{route('admin_categories_update', $category->id)}}">
            <div class="form-group row">
                <div class="col-md-2">
                    Umbenennen zu:
                </div>
                <div class="col-md-10">
                    <input value="{{ old('name') ? old('name') : $category->name}}" type="text" class="form-control" name="name">
                </div>
            </div>

            <input type="submit" class="form-control btn btn-success" value="Bearbeiten">
            {{method_field('PUT')}}
            {{ csrf_field() }}
        </form>
    </div>
@endsection
