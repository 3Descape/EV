@extends('admin.layouts.sitebar')

@section('sitebar_inner')
<div class="container-fluid" id="role">
    <div class="row">
        <div class="col-md-10 mx-auto">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <h3>Berechtigungen:</h3>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success my-2"  data-toggle="modal" data-target="#myModal">
                <i class="fa fa-plus"></i> Berechtigung
            </button>
            @foreach ($roles as $role)
                <div class="card mb-5">
                    <div class="card-header" id="{{$role->name}}">
                        <div class="d-flex">
                            <div class="mr-auto clearfix">
                                <h4 class="float-left">{{ucfirst($role->name)}}</h4>
                                <p class="text-muted ml-2 pt-1 float-left">{{ucfirst($role->label)}}</p>
                            </div>
                            <form action="{{route('api_role_delete', $role->id)}}" method="POST">
                                <button type="submit" class="btn btn-danger float-left mx-1">
                                    <i class="fa fa-trash-o"></i> {{ucfirst($role->name)}}
                                </button>
                                {{method_field('DELETE')}}
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="d-flex justify-content-end mb-2">
                            <h5 class="mr-auto">Rechte:</h5>
                            <button class="btn btn-success" @click="modal({{$role->id}})"><i class="fa fa-plus"></i> Recht</button>
                        </div>
                        @foreach ($role->permissions as $permission)
                            <div class="card mb-1">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-end">
                                        <span class="mr-auto">{{$permission->label}}</span>
                                        <form action="{{route('api_role_permission_destroy', [$role->id, $permission->id])}}" method="POST">
                                            <button class="btn btn-danger mx-1">
                                                <i class="fa fa-trash-o"></i> Löschen
                                            </button>
                                            {{ csrf_field() }}
                                            {{method_field('DELETE')}}
                                        </form>
                                    </li>
                                </div>
                            </ul>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Add Role Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{route('api_role_add')}}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="role_name">Name:</label>
                            <input class="form-control" type="text" name="name" id="role_name" required>
                        </div>

                        <div class="form-group">
                            <label for="label">Beschreibung:</label>
                            <input class="form-control" type="text" name="label" id="label" >
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal"> Abbrechen</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Hinzufügen</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Add Permission Modal-->
    <div class="modal fade" id="permissionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="/admin/roles/permission/add">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="permission_add"></label>
                            <select id="permission_add" name="permission" class="form-control" name="">
                                @foreach ($permissions as $permission)
                                    <option value="{{$permission->id}}">{{ucfirst($permission->label)}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="text" hidden v-bind:value="role_id" name="role_id">
                    </div>
                    {{ csrf_field() }}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal"> Abbrechen</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Hinzufügen</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
