@extends('admin.layouts.sitebar')

@section('sitebar_inner')
<div class="col-lg-10 col-sm-12 col-md-12 mx-auto">
    <form action="{{route('files_update', $file->id)}}" method="post">
        <div class="form-group row">
            <div class="col-lg-2 col-md-3 col-sm-12">
                <label for="name">Name:</label>
            </div>
            <div class="col-lg-10 col-md-9 col-sm-12">
                <input type="text" id="name" class="form-control" name="name" value="{{old("name") ?: $file->name}}">
                @component('admin.components.error', ['name' => 'name', 'class' => "mt-1"]) 
                @endcomponent
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-2 col-md-3 col-sm-12">
                <label for="description">Beschreibung:</label>
            </div>
            <div class="col-lg-10 col-md-9 col-sm-12">
                <input class="form-control" type="text" id="description" name="description" value="{{old('description') ?: $file->description}}">
                @component('admin.components.error', ['name' => 'description', 'class' => "mt-1"]) 
                @endcomponent
            </div> 
        </div>

        <div class="form-group row">
            <div class="col-lg-2 col-md-3 col-sm-12">
            </div>
            <div class="col-lg-10 col-md-9 col-sm-12">
                <button type="submit" class="btn btn-success form-control">
                    Bearbeiten <i class="fa fa-edit"></i>
                </button>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-2 col-md-3 col-sm-12">
            </div>
            <div class="col-lg-10 col-md-9 col-sm-12">
                <a class="btn btn-warning form-control" href="{{route('files')}}">
                    Abbrechen <i class="fa fa-times"></i>
                </a>
            </div>
        </div
        
        {{ csrf_field() }}
        {{method_field('PUT')}}
        
    </form>
</div>
@endsection

