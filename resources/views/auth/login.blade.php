@extends('auth.master')

@section('title')
    Login
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row full-height">
            <div class="col-xl-5 col-lg-10 col-md-10 col-sm-11 mx-auto my-auto">
                <h3>Login:</h3>
                <form method="POST" action="{{ route('login') }}">
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email">E-Mail Adresse</label>

                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                        @include('admin.components.error', ['name' => 'email'])

                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="control-label">Passwort</label>
                        <input id="password" type="password" class="form-control" name="password" required>

                        @include('admin.components.error', ['name' => 'password'])

                    </div>

                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Angemeldet bleiben
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            Login
                        </button>

                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            Passwort vergessen?
                        </a>
                    </div>

                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
@endsection
