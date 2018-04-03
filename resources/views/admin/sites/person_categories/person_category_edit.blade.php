@extends('admin.layouts.sitebar')

@section('sitebar_inner')
<div class="col-lg-10 col-md-12 mx-auto row">
    <div class="col-lg-12">
        <form action="{{route('person_category_update', $person_category->name)}}" method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{old('name') ?: $person_category->name}}">
                @component('admin.components.error', ['name' => 'name', 'class' => "mt-1"]) 
                @endcomponent
            </div>


            <div class="form-group">
                <label for="has_image">Besitzt Bild:</label>
                <select name="has_image" id="has_image" class="custom-select">
                    <option {{old('has_image') ? old('has_image') == 0 ? "selected" : "" : $person_category->has_image == 0 ? "selected" : ""}} value="0">Nein</option>
                    <option {{old('has_image') ? old('has_image') == 1 ? "selected" : "" : $person_category->has_image == 1 ? "selected" : ""}} value="1">Ja</option>
                </select>
                @component('admin.components.error', ['name' => 'has_image', 'class' => "mt-1"]) 
                @endcomponent
            </div>

            <div class="form-group d-flex">
                <button type="submit" class="btn btn-info ml-auto mr-2">
                    <i class="fa fa-edit"></i> Bearbeiten
                </button>
                <a href="{{route('person_category_index')}}" class="btn btn-light border border-dark">
                    <i class="fa fa-times"></i> Abbrechen
                </a>
            </div>

            {{ csrf_field() }}
            {{method_field('PUT')}}
        </form>
    </div>
</div>
@endsection