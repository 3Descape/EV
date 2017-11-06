@extends('sites.sites_master')

@section('title')
    Kontakt
@endsection

@section('content')
    <div class="col-md-6 col-sm-12 mx-auto mt-4" id="contact">
        <h1 class="text-center">Kontakt</h1>
        <p>Möchten Sie mit uns in Kontakt treten? Schreiben Sie uns doch!</p>
        <div class="col-md-12 mb-4">
            <h3>Elternverein</h3>
            @if($msg = session('ev_mail'))
                <div class="alert alert-success" role="alert">
                   {{$msg}}
                </div>
            @endif
            <form action="{{route("mail_ev")}}" method="POST">
                <div class="col-md-12 form-group">
                    <label for="ev_name">Ihr Name:</label>
                    <input type="text" class="form-control" name="name" id="ev_name" required>

                    <label for="ev_email">Ihre E-Mail Adresse:</label>
                    <input type="email" class="form-control" name="mail" id="ev_email" required>

                    <label for="ev_message">Nachricht:</label>
                    <textarea class="form-control" id="ev_message" name="text" rows="5" required placeholder="Text.."></textarea>

                    <input type="submit" class="form-control btn-primary mt-2" value="Senden">
                    {{ csrf_field() }}
                </div>
            </form>
        </div>

        <div class="col-md-12 mt-2">
            <h3>Obmann</h3>
            @if($msg = session('obmann_mail'))
                <div class="alert alert-success" role="alert">
                   {{$msg}}
                </div>
            @endif
            <form action="{{route("mail_obmann")}}" method="POST">
                <div class="col-md-12 form-group">
                    <label for="obmann_name">Ihr Name:</label>
                    <input type="text" class="form-control" name="name" id="obmann_name" required>

                    <label for="obmann_email">Ihre E-Mail Adresse:</label>
                    <input type="email" class="form-control" name="mail" id="obmann_email" required>

                    <label for="obmann_message">Nachricht:</label>
                    <textarea class="form-control" name="text" id="obmann_message" rows="5" required placeholder="Text.."></textarea>

                    <input type="submit" class="form-control btn-primary mt-2" value="Senden">
                    {{ csrf_field() }}
                </div>
            </form>
        </div>
    </div>
@endsection
