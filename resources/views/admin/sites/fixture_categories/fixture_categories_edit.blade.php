@extends('admin.layouts.sitebar')

@section('sitebar_inner')
<div class="col-lg-10 col-md-12 mx-auto row">
    <div class="col-lg-12">
        <form action="{{route('fixture_category_update', $fixturecategory->id)}}" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{old('name') ?: $fixturecategory->name}}">
                @include('admin.components.error', ['name' => 'name', 'class' => "mt-1"])
            </div>

            <div class="mb-3 d-flex">
                <button type="submit" class="btn btn-warning ms-auto me-2">
                    <i class="fa fa-pencil-alt"></i> Bearbeiten
                </button>
                <a href="{{route('fixture_category_index')}}" class="btn btn-light border border-dark">
                    <i class="fa fa-times"></i> Abbrechen
                </a>
            </div>

            {{ csrf_field() }}
            {{method_field('PUT')}}
        </form>
    </div>
</div>
@endsection