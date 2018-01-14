@extends('admin.layouts.sitebar')

@section('sitebar_inner')
<roles :options="{{json_encode($permissions)}}" :roles="{{json_encode($roles)}}" inline-template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 col-md-12 mx-auto">
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
                <button type="button" class="btn btn-success my-2"  data-toggle="modal" data-target="#role_add_modal">
                    <i class="fa fa-plus"></i> Berechtigung
                </button>

                @foreach ($roles as $role)
                    <div class="card mb-5">
                        <div class="card-header" id="{{$role->name}}">
                            <div class="d-flex">
                                <div class="mr-auto d-flex">
                                    <h4>{{ucfirst($role->name)}}</h4>
                                    <p class="text-muted ml-2">{{ucfirst($role->label)}}</p>
                                </div>
                                @if ($role->name !== 'administrator')
                                    <form action="{{route('role_delete', $role->id)}}" method="POST">
                                        <button type="submit" class="btn btn-danger float-left mx-1">
                                            <i class="fa fa-trash-o"></i> Löschen
                                        </button>
                                        {{method_field('DELETE')}}
                                        {{ csrf_field() }}
                                    </form>
                                @endif
                            </div>
                        </div>

                        @if ($role->name !== 'administrator')
                            <div class="card-body">
                                <div class="d-flex justify-content-end mb-2">
                                    <h5 class="mr-auto">Rechte:</h5>
                                    <button class="btn btn-success" @click="modal({{$role->id}})">
                                        <i class="fa fa-plus"></i> Recht
                                    </button>
                                </div>
                                @foreach ($role->permissions as $permission)
                                    <div class="card mb-1">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item d-flex justify-content-end">
                                                <span class="mr-auto">{{$permission->label}}</span>
                                                <form action="{{route('role_permission_destroy', [$role->id, $permission->id])}}" method="POST">
                                                    <button class="btn btn-danger mx-1">
                                                        <i class="fa fa-trash-o"></i> Löschen
                                                    </button>
                                                    {{ csrf_field() }}
                                                    {{method_field('DELETE')}}
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                @endforeach
                            </div>
                            @endif
                    </div>
                    @endforeach
            </div>
        </div>

        {{--  Modal for adding a role --}}
        <div class="modal fade" id="role_add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Berechtigung hinzufügen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{route('role_store')}}">
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
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-plus"></i> Hinzufügen
                            </button>
                            <button type="button" class="btn btn-light border border-dark" data-dismiss="modal">
                                <i class="fa fa-times"></i> Abbrechen
                            </button>
                        </div>
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>

        {{--  Modal for adding a permission to a role  --}}
        <div class="modal fade" id="permission_add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Recht hinzufügen..</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{route('permission_role_store')}}">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="permission_add">Recht:</label>
                                <select id="permission_add" name="permission" class="form-control" name="">
                                    <option v-for="option in select_options" :value="option.id">@{{option.label}}</option>
                                </select>
                            </div>
                            <input type="text" hidden v-bind:value="role_id"  name="role_id">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-plus"></i> Hinzufügen
                            </button>
                            <button type="button" class="btn btn-light border border-dark" data-dismiss="modal">
                                <i class="fa fa-times"></i> Abbrechen
                            </button>
                        </div>
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
</roles>
@endsection
