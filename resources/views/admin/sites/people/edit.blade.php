@extends('admin.layouts.sitebar')

@section('sitebar_inner')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-10 col-md-12 mx-auto">
            <form action="{{route('api_person_update', $person->id)}}" method="POST" enctype="multipart/form-data">
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
                
                <div class="form-group">
                    <label for="image">Bild:</label>
                    <div class="row">
                        @if($person->image_path)
                            <div class="col-lg-2 col-sm-12 mt-2">
                                <div class="text-center">
                                    <img class="img-fluid img-thumbnail" src="{{asset('storage/'. $person->image_path)}}" />
                                </div>
                            </div>
                        @endif
                        <div class="col-lg-12 mt-2">
                            <label class="custom-file" style="width: 100%;">
                                <input type="file" id="file" class="custom-file-input" name="file">
                                <span class="custom-file-control"> <i class="fa fa-upload"></i> Bild hochladen..</span>
                            </label>                  
                        </div>
                    </div>
                </div>

                <input class="btn btn-success" type="submit" value="Bearbeiten">
                <a href="{{route('a_people_frontend', $person->category->name)}}" class="btn btn-primary">
                    Abbrechen
                </a>

                {{method_field('PUT')}}
                {{ csrf_field() }}
            </form>
        </div>
    </div>
</div>
@endsection
