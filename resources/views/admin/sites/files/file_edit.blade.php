@extends('admin.layouts.sitebar')

@section('sitebar_inner')
<div class="col-lg-10 col-sm-12 col-md-12 mx-auto">
    <form action="{{route('file_update', $file->id)}}" method="post">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" class="form-control" name="name" value="{{old("name") ?: $file->name}}">
            @component('admin.components.error', ['name' => 'name', 'class' => "mt-1"]) 
            @endcomponent
        </div>

        <div class="form-group">
            <label for="description">Beschreibung:</label>
            <input class="form-control" type="text" id="description" name="description" value="{{old('description') ?: $file->description}}">
            @component('admin.components.error', ['name' => 'description', 'class' => "mt-1"]) 
            @endcomponent
        </div>

        <div class="form-group d-flex">
            <button type="submit" class="btn btn-info ml-auto mr-2">
                Bearbeiten <i class="fa fa-edit"></i>
            </button>

            <a class="btn btn-light border border-dark align-self-start" href="{{route('file_index')}}">
                Abbrechen <i class="fa fa-times"></i>
            </a>
        </div>

        {{ csrf_field() }}
        {{method_field('PUT')}}
        
    </form>
</div>
@endsection

