@extends('admin.layouts.sitebar')

@section('sitebar_inner')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-10 col-md-12 mx-auto">
            <div class="card">
                <div class="card-header">
                    {{ucfirst($category->name)}}
                </div>
                <div class="card-body">
                    <a href="{{route('person_add', $category->name)}}" class="btn btn-success mb-3"><i class="fa fa-plus"></i> Hinzufügen</a>
                    <table class="table overflow">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th class="d-none d-md-table-cell">Beschreibung</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($people as $person)
                            <tr>
                                <td scope="row">{{$person->name}}</td>
                                <td class="d-none d-md-table-cell">{{$person->description}}</td>
                                <td class="d-flex">
                                    <a href="{{route('api_person_delete', $person->id)}}" class="btn btn-danger mx-1 ml-auto">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                    <a href="{{route('person_edit', $person->id)}}" class="btn btn-warning mx-1">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
