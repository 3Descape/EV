@extends('admin.layouts.sitebar')

@section('sitebar_inner')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <form action="{{route('api_person_update', $person->id)}}" method="POST">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{$person->name}}">
                </div>

                <div class="form-group">
                    <label for="description">Beschreibung</label>
                    <input type="text" class="form-control" id="description" name="description" value="{{$person->description}}">
                </div>

                <div class="form-group">
                    <label for="category">Kategory</label>
                    <select name="category" class="form-control" id="category">
                        <option {{("1" == $person->category ? 'selected=selected' : '' )}} value="1">SGA</option>
                        <option {{("0" == $person->category ? 'selected=selected' : '' )}} value="0">Elternvertreter</option>
                    </select>
                </div>

                <input class="btn btn-success" type="submit" value="Bearbeiten">
                <a href="{{$person->category ? route('admin_people_frontend_sga') : route('admin_people_frontend_ev')}}" class="btn btn-primary">
                    Abbrechen
                </a>

                {{method_field('PUT')}}
                {{ csrf_field() }}
            </form>
        </div>
    </div>
</div>
@endsection
