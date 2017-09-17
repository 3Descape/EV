@extends('admin.layouts.sitebar')

@section('sitebar_inner')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 mx-auto">

            <div class="card person">
                <div class="card-header">
                    SGA
                </div>
                <div class="card-body">
                    <a href="{{route('person_add')}}/sga" class="btn btn-success mb-3"><i class="fa fa-plus"></i> Hinzufügen</a>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Beschreibung</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sga as $person)
                            <tr>
                                <td scope="row">{{$person->name}}</td>
                                <td>{{$person->description}}</td>
                                <td>
                                    <a href="{{route('api_person_delete', $person->id)}}" class="btn btn-danger float-right mx-1">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                    <a href="{{route('api_person_edit', $person->id)}}" class="btn btn-warning float-right mx-1">
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
