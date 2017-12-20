@extends('admin.layouts.sitebar')

@section('sitebar_inner')
<div class="col-lg-10 col-md-12 mx-auto">
    @include('admin.layouts.errors')

    <form action="{{route('holiday_update', $holiday->id)}}" method="post">
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{old('name') ? old('name') : $holiday->name}}">
        </div>

        <div class="form-group">
            <label>Datum</label>
            <input type="text" name="date" class="form-control" value="{{old('date') ? old('date') : $holiday->date}}">
        </div>

        <div class="form-group">
            <label>Kategorie</label>
            <select name="category" class="form-control">
                <option value="ferien" {{old('category') ? old('category') === 'ferien' ? 'selected=selected' : '': $holiday->category === 'ferien' ? 'selected=selected' : ''}}>Ferien</option>
                <option value="schulautonom" {{old('category') ? old('category') === 'schulautonom' ? 'selected=selected' : '': $holiday->category === 'schulautonom' ? 'selected=selected' : ''}}>Schulautonom frei</option>
            </select>
        </div>

        <div class="row">
            <div class="col-md-6">
                <button type="submit" class="form-control btn-success"><i class="fa fa-edit"></i> Bearbeiten</button>
            </div>
            <div class="col-md-6">
                <a href="{{route('holiday_index')}}" class="btn-danger form-control text-center">
                    <i class="fa fa-times"></i> Abbrechen
                </a>
            </div>
        </div>

        {{ csrf_field() }}
        {{method_field('PUT')}}
    </form>
</div>
@endsection
