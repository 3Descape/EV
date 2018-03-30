@extends('admin.layouts.sitebar')

@section('sitebar_inner')
<div class="row">
    <div class="col-lg-10 col-md-12 mx-auto">
        @if (session('exeption'))
            <div class="alert alert-danger">
                {{ session('exeption') }}
            </div>
        @endif
        <h3>{{$user->name}} hat derzeit folgende Berechtigungen:</h3>
        <ul class="list-group">
            @foreach ($user->roles as $role)
                <li class="list-group-item d-flex">
                    <span class="mr-auto">{{ucfirst($role->name)}}</span>
                    <form action="{{route('user_role_destroy' , [$user->id, $role->id])}}" method="post" class="align-self-end mx-1">
                        <button class="btn btn-danger">
                            <i class="fa fa-trash-o"></i>
                        </button>
                        {{ csrf_field() }}
                        {{method_field('DELETE')}}
                    </form>
                </li>
            @endforeach
        </ul>

        @if ($roles->count())
            <button type="button" class="btn btn-success my-2" data-toggle="modal" data-target="#role_add_modal">
                <i class="fa fa-plus"></i> Berechtigung
            </button>
        @else
            <p class="text-muted mt-2">Hat bereits alle Berechtigungen..</p>
        @endif

        <div class="modal fade" id="role_add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Berechtigung Hinzufügen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{route('user_role_update', $user->id)}}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="role_add">Berechtigung Hinzufügen</label>
                            <select id="role_add" name="role" class="custom-select" name="">
                                @foreach ($roles as $role)
                                    <option value="{{$role->id}}">{{ucfirst($role->name)}}</option>
                                @endforeach
                            </select>
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
                    {{method_field('PUT')}}
                </form>
            </div>
          </div>
        </div>

    </div>
</div>
@endsection
