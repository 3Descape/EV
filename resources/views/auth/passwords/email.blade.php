@extends('auth.master')

@section('title')
    Reset
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row full-height">
            <div class="col-md-4 mx-auto my-auto">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form role="form" method="POST" action="{{ route('password.email') }}">
                        <div class="form-group {{ $errors->has('email') ? 'bg-danger' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Adresse</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                            
                            <div class="ml-2">
                                @component('admin.components.error', ['name' => 'email'])
                                @endcomponent
                            </div>
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
