@extends('admin.layouts.sitebar')

@section('sitebar_inner')
<div class="container-fluid">
    <div class="row">
    <div class="col-lg-10 col-md-12 mx-auto">
        <form action="{{route('person_store')}}" method="POST" enctype="multipart/form-data">
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
                <div class="custom-file mb-2">
                    <input type="file" class="custom-file-input" name="file">
                    <label class="custom-file-label" for="customFile">
                        <i class="fa fa-upload"></i> Bild hochladen..
                    </label>
                </div>
            @endif
            
            <div class="form-group d-flex">
                <button type="submit" class="btn btn-success mr-2 ml-auto">
                    <i class="fa fa-plus"></i> Hinzufügen
                </button>

                <a href="{{route('person_frontend_index', $category->name)}}" class="btn btn-light border border-dark">
                    <i class="fa fa-times"></i> Abbrechen
                </a>
            </div>
            
            {{ csrf_field() }}
        </form>
    </div>
</div>
@endsection
