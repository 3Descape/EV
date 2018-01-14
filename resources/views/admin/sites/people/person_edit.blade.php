@extends('admin.layouts.sitebar')

@section('sitebar_inner')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-10 col-md-12 mx-auto">
            <form action="{{route('person_update', $person->id)}}" method="POST" enctype='multipart/form-data'>
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
                    <select name="people_category_id" class="form-control" id="category">
                        @foreach ($categories as $category)
                            <option {{($category->id === $person->people_category_id ? 'selected=selected' : '' )}} value="{{$category->id}}">
                                {{ucfirst($category->name)}}
                            </option>
                        @endforeach
                        
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
                                <div class="custom-file mb-2">
                                    <input type="file" class="custom-file-input" name="file">
                                    <label class="custom-file-label" for="customFile">
                                        <i class="fa fa-upload"></i> Bild hochladen..
                                    </label>
                                </div>                
                        </div>
                    </div>
                </div>

                <div class="form-group d-flex">
                    <button type="submit" class="btn btn-info mr-2 ml-auto">
                        <i class="fa fa-edit"></i> Bearbeiten
                    </button>
    
                    <a href="{{route('person_frontend_index', $person->category->name)}}" class="btn btn-light border border-dark">
                        <i class="fa fa-times"></i> Abbrechen
                    </a>
                </div>


                {{method_field('PUT')}}
                {{ csrf_field() }}
            </form>
        </div>
    </div>
</div>
@endsection
