@extends('auth.master')

@section('title')
    Login
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row full-height">
            <div class="col-xl-5 col-lg-10 col-md-10 col-sm-11 mx-auto my-auto">
                <div class="card">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form class="form-horizontal" role="form" method="POST" action="{{ route('password.request') }}">
                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">E-Mail Adresssffe</label>
                                <input id="email" type="email" class="form-control ml-2" name="email" value="{{ $email or old('email') }}" required autofocus>

                                <div class="ml-2">
                                    @include('admin.components.error', ['name' => 'email'])
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="col-md-4 control-label">Passwort</label>
                                <input id="password" type="password" class="form-control ml-2" name="password" required>
                                <div class="ml-2">
                                    @include('admin.components.error', ['name' => 'password'])
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">Passwort bestätigen</label>
                                <input id="password-confirm" type="password" class="form-control ml-2" name="password_confirmation" required>

                                <div class="ml-2">
                                    @include('admin.components.error', ['name' => 'password_confirmation'])
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    Passwort zurücksetzen
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
