@extends('admin.layouts.sitebar')

@section('sitebar_inner')

<div class="col-lg-10 col-md-12 mx-auto row">
    <div class="col-lg-12">
        <form action="{{route('fixture_category_update', $fixturecategory->id)}}" method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{old('name') ?: $fixturecategory->name}}">
                @component('admin.components.error', ['name' => 'name', 'class' => "mt-1"]) 
                @endcomponent
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-edit"></i> Bearbeiten
                </button>
            </div>

            {{ csrf_field() }}
            {{method_field('PUT')}}
        </form>
    </div>
</div>
@endsection