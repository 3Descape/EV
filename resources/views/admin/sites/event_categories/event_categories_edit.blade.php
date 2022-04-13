@extends('admin.layouts.sitebar')

@section('sitebar_inner')
    <div class="col-lg-10 col-md-12 mx-auto">
        @include('admin.layouts.errors')

        <form class="row mb-3" method="POST" action="{{route('event_category_update', $event_category->id)}}">
            <div class="row mb-3 row">
                <label for="name" class="form-label">Umbenennen zu:</label>
                <input value="{{ old('name') ?: $event_category->name}}" type="text" class="form-control" name="name" id="name">
            </div>

            <div class="mb-3 d-flex">
                <button class="btn btn-warning ms-auto me-2">
                    <i class="fa fa-edit"></i> Bearbeiten
                </button>
                <a href="{{route('event_category_index')}}" class="btn btn-light border border-dark">
                    <i class="fa fa-times"></i> Abbrechen
                </a>
            </div>
            {{method_field('PUT')}}
            {{ csrf_field() }}
        </form>
    </div>
@endsection
