@extends('admin.layouts.sitebar')


@section('sitebar_inner')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-10 col-md-12 mx-auto">
            <div class="card">
                <div class="card-header">
                    Benutzer
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
                                    <td scope="row" class="overflow-text">{{$user->name}}</td>
                                    <td class="d-none d-md-table-cell overflow-text">{{$user->email}}</td>
                                    <td class="d-none d-md-table-cell">
                                        @foreach ($user->roles as $role)
                                            <a href="{{route('role_index') . '#' . $role->name}}" class="role">
                                                <span class="badge badge-secondary">
                                                    {{ucfirst($role->name)}}
                                                </span>
                                            </a>
                                        @endforeach
                                    </td>
                                    <td class="d-flex">
                                        <a href="{{route('user_role_edit', $user->id)}}"
                                            class="btn btn-warning ml-auto">
                                            <i class="fa fa-pencil-alt"></i>
                                        </a>
                                        <a href="{{route('user_delete', $user->id)}}"
                                            class="btn btn-danger mx-1">
                                            <i class="fa fa-trash-alt"></i>
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
