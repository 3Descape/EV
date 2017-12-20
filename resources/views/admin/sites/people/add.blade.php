@extends('admin.layouts.sitebar')

@section('sitebar_inner')
<div class="container-fluid">
    <div class="row">
    <div class="col-lg-10 col-md-12 mx-auto">
        <form action="{{route('api_person_store')}}" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" id="name" name="name">
            </div>

            <div class="form-group">
              <label for="description">Beschreibung</label>
              <input type="text" class="form-control" id="description" name="description">
            </div>

            <input type="text" hidden="true" name="people_category_id" value="{{$category->id}}">

            @if($category->has_image)
                <div class="form-group">
                    <label for="image">Bild:</label>
                    <label class="custom-file" style="width: 100%;">
                        <input type="file" id="file" class="custom-file-input" name="file">
                        <span class="custom-file-control"> <i class="fa fa-upload"></i> Bild hochladen..</span>
                    </label>
                </div>
            @endif
            <input class="btn btn-success" type="submit" value="Hinzufügen">
            <a href="{{route('admin_people_frontend', $category->name)}}" class="btn btn-primary">Abbrechen</a>

            {{ csrf_field() }}
        </form>
    </div>
</div>
@endsection
