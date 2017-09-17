@extends('admin.layouts.sitebar')


@section('sitebar_inner')
<div class="container-fluid">
    <div class="row">
    <div class="col-md-10 mx-auto">
        <form action="{{route('api_person_store')}}" method="POST">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" id="name" name="name">
            </div>

            <div class="form-group">
              <label for="description">Beschreibung</label>
              <input type="text" class="form-control" id="description" name="description">
            </div>
            
            <div class="form-group">
                <label for="category">Kategory</label>
                <select name="category" class="form-control" id="category">
                    <option {{($selected == 'sga' or $selected == 'default'  ? 'selected=selected' : '' )}} value="1">SGA</option>
                    <option {{($selected == 'ev' ? 'selected=selected' : '' )}} value="0">Elternvertreter</option>
                </select>
            </div>

            <input class="btn btn-success" type="submit" value="Hinzufügen">
            <a href="{{route('admin_people_frontend_sga')}}" class="btn btn-primary">Abbrechen</a>

            {{ csrf_field() }}
        </form>
    </div>
</div>
@endsection
