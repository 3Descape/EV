@extends('admin.layouts.sitebar')


@section('sitebar_inner')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-10 col-md-12 mx-auto">

            <div class="card">
                <div class="card-header">
                    Users
                </div>
                <div class="card-body">
                    @if (session('exeption'))
                    <div class="alert alert-danger">
                        {{ session('exeption') }}
                    </div>
                    @endif
                    <table class="table overflow">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th class="d-none d-md-table-cell">E-Mail</th>
                                <th class="d-none d-md-table-cell">Berechtigungen</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td scope="row">{{$user->name}}</td>
                                <td class="d-none d-md-table-cell">{{$user->email}}</td>
                                <td class="d-none d-md-table-cell">
                                    @foreach ($user->roles as $role)
                                    <a href="{{route('roles_show') .'#' . $role->name}}" class="role">
                                        <span class="badge badge-secondary">
                                            {{ucfirst($role->name)}}
                                        </span>
                                    </a>
                                    @endforeach
                                </td>
                                <td class="d-flex">
                                    <a href="{{route('api_user_delete', $user->id)}}"
                                        class="btn btn-danger mx-1 ml-auto">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                    <a href="{{route('user_role', $user->id)}}"
                                        class="btn btn-warning mx-1">
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
