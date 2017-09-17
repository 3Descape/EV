@extends('admin.layouts.sitebar')


@section('sitebar_inner')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 mx-auto">

            <div class="card">
                <div class="card-header">
                    Users
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>E-Mail</th>
                                <th>Berechtigungen</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td scope="row">{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @foreach ($user->roles as $role)
                                    <a href="{{route('roles_show') .'#' . $role->name}}" class="role">
                                        <span class="badge badge-secondary">
                                            {{ucfirst($role->name)}}
                                        </span>
                                    </a>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{route('api_user_delete', $user->id)}}"
                                        class="btn btn-danger float-right mx-1">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                    <a href="{{route('user_role', $user->id)}}"
                                        class="btn btn-warning float-right mx-1">
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
