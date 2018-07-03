@extends('admin.layouts.sitebar')

@section('sitebar_inner')

<div class="col-lg-10 col-md-12 mx-auto row">
    <div class="col-lg-12">
        <form action="{{route('fixture_update', $fixture->id)}}" method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{old('name') ?: $fixture->name}}">
                @include('admin.components.error', ['name' => 'name', 'class' => "mt-1"]) 
            </div>

            <div class="form-group">
                <label for="description">Beschreibung:</label>
                <input type="text" name="description" id="description" class="form-control" value="{{old('description') ?: $fixture->description}}">
                @include('admin.components.error', ['name' => 'description', 'class' => "mt-1"]) 
            </div>

            <div class="form-group">
                <label for="fixture_category">Kategorie:</label>
                <select class="custom-select" name="fixture_category">
                    @foreach ($fixturecategories as $category)
                        <option
                        {{old("fixture_category") ? old("fixture_category") == $category->id ? 'selected=selected' : "" : $category->id == $fixture->category->id ? 'selected=selected' : ''}}
                            value="{{$category->id}}">{{ucfirst($category->name)}}
                        </option>
                    @endforeach
                </select>
                @include('admin.components.error', ['name' => 'fixture_category', 'class' => "mt-1"]) 
            </div>


            <div class="form-group d-flex">
                <button type="submit" class="btn btn-info ml-auto mr-2">
                    <i class="fa fa-pencil-alt"></i> Bearbeiten
                </button>

                <a href="{{route('fixture_index')}}" class="btn btn-light border border-dark">
                    <i class="fa fa-times"></i> Abbrechen...
                </a>
            </div>

            {{ csrf_field() }}
            {{method_field('PUT')}}
        </form>
    </div>
</div>
@endsection