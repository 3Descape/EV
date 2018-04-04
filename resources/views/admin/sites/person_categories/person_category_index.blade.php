@extends('admin.layouts.sitebar')

@section('sitebar_inner')
    <div class="col-lg-10 col-md-12 mx-auto row">

        <div class="col-lg-12">
            <form action="{{route('person_category_store')}}" method="post">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{old('name') ?: ''}}">
                    @component('admin.components.error', ['name' => 'name', 'class' => "mt-1"]) 
                    @endcomponent
                </div>

                <div class="form-group">
                    <label for="has_image">Besitzt Bild:</label>
                    <select name="has_image" id="has_image" class="custom-select">
                        <option {{old('has_image') == 0 ? "selected" : ""}} value="0">Nein</option>
                        <option {{old('has_image') == 1 ? "selected" : ""}} value="1">Ja</option>
                    </select>
                    @component('admin.components.error', ['name' => 'has_image', 'class' => "mt-1"]) 
                    @endcomponent
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-plus"></i> Hinzufügen
                    </button>
                </div>

                {{ csrf_field() }}
            </form>
        </div>
        <div class="col-lg-12">
            @if(session()->has('error'))
                <div class="alert alert-danger">
                    <strong style="font-weight: 500">
                        {{session()->get('error')}}
                    </strong>
                </div>
            @endif
        </div>
        <div class="col-lg-12">
            <table class="table overflow">
                <thead>
                    <tr>
                        <th scope="col" >Name</th>
                        <th scope="col">Besitzt Bild:</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($person_categories as $category)
                        <tr>
                            <td scope="row">{{ ucfirst($category->name)}}</td>
                            <td>{{$category->has_image ? "Ja" : "Nein"}}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{route('person_category_edit', $category->name)}}" class="btn btn-warning ml-auto">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <form action="{{route('person_category_destroy', $category->name)}}" method="post">
                                        <button class="btn btn-danger mx-1" type="submit">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                        {{ csrf_field() }}
                                        {{method_field('DELETE')}}
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection