@extends('admin.master')

@section('content')
    <div class="row">
        <div class="col-md-10 mx-auto">
            <form action="{{route('api_user_role_update', $user->id)}}" method="POST">
                {{method_field('PUT')}}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label for="role">Role</label>
                    <select class="form-control" id="role" name="role">
                          <option {{("admin" == $user->role ? 'selected=selected' : '' )}} value="admin">Admin</option>
                          <option {{("editor" == $user->role ? 'selected=selected' : '' )}} value="editor">Editor</option>
                          <option {{("default" == $user->role ? 'selected=selected' : '' )}} value="default">Default</option>
                    </select>
                </div>

                <input class="btn btn-success" type="submit" value="Bearbeiten">
                <a href="{{route('admin_people_backend')}}" class="btn btn-primary">Abbrechen</a>
            </form>
        </div>
    </div>
@endsection
