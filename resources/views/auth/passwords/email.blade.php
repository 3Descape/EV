@extends('auth.master')

@section('title')
    Reset
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row full-height">
            <div class="col-xl-5 col-lg-10 col-md-10 col-sm-11 mx-auto my-auto">
            <div class="card">
                <div class="card-body">
                    <form role="form" method="POST" action="{{ route('password.email') }}">
                        <div class="form-group">
                            <label for="email" class="control-label">E-Mail Adresse</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                            @include('admin.components.error', ['name' => 'email'])
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                Sende Link um Passwort zu ändern
                            </button>
                        </div>
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
