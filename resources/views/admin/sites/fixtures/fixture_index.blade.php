@extends('admin.layouts.sitebar')

@section('sitebar_inner')
    <div class="col-lg-10 col-md-12 mx-auto row">

        <div class="col-lg-12">
            @if(!$fixturecategories->isEmpty())
                <form action="{{route('fixture_store')}}" method="post">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{old('name') ?: ''}}">
                        @component('admin.components.error', ['name' => 'name', 'class' => "mt-1"]) 
                        @endcomponent
                    </div>

                    <div class="form-group">
                        <label for="name">Beschreibung:</label>
                        <input type="text" name="description" id="name" class="form-control" value="{{old('description') ?: ''}}">
                        @component('admin.components.error', ['name' => 'description', 'class' => "mt-1"]) 
                        @endcomponent
                    </div>

                    <div class="form-group">
                        <label for="fixture_category">Kategorie:</label>
                        <select class="custom-select" name="fixture_category">
                            @foreach ($fixturecategories as $category)
                                <option
                                {{old("fixture_category") ? old("fixture_category") == $category->name ? 'selected=selected' : "" : ""}}
                                    value="{{$category->id}}">{{ucfirst($category->name)}}
                                </option>
                            @endforeach
                        </select>
                        @component('admin.components.error', ['name' => 'fixture_category', 'class' => "mt-1"]) 
                        @endcomponent
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-plus"></i> Hinzufügen
                        </button>
                    </div>

                    {{ csrf_field() }}
                </form>

                <div class="col-lg-12">
                    <table class="table overflow">
                        <colgroup>
                            <col span="1" style="width: 25%;">
                            <col span="1" style="width: 45%;">
                            <col span="1" style="width: 20%;">
                            <col span="1" style="width: 10%;">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Beschreibung</th>
                                <th>Kategorie</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fixtures as $fixture)
                                <tr>
                                    <td scope="row">{{$fixture->name}}</td>
                                    <td class="d-none d-md-table-cell overflow-text">{{$fixture->description}}</td>
                                    <td style="max-width: 2rem">{{$fixture->category->name}}</td>
                                    <td class="d-flex" >
                                        <a href="{{route('fixture_edit', $fixture->id)}}" class="btn btn-warning ml-auto">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <form action="{{route('fixture_destroy', $fixture->id)}}" method="post">
                                            <button class="btn btn-danger mx-1" type="submit">
                                                <i class="fa fa-trash-o"></i>
                                            </button>
                                            {{ csrf_field() }}
                                            {{method_field('DELETE')}}
                                        </form>
                                    </td>
                                </tr>
                             @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p>Bitte fügen Sie zuerst eine Kategorie hinzu.</p>
            @endif
        </div>
    </div>
@endsection