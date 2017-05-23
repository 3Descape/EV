@extends('master')

@section('title')
Kontakt
@endsection

@section('content')
  <div class="container-fluid">@include('layouts.menu')</div>
  <div>
    <div class="col-md-10 mx-auto bg-wrp">

      <div class="col-md-12">
        <div class="col-md-10 col-sm-12 mx-auto" id="contact">
          <h1 class="text-center">Kontakt</h1>

          <p>Möchten Sie mit uns in Kontakt treten? Schreiben Sie uns doch!</p>
          <div class="col-md-12">
            <h3>EV</h3>
            <div class="col-md-12 form-group">
              <label for="ev_email">Ihre E-Mail:</label>
              <input type="email" class="form-control" id="ev_email" required>
              <label for="ev_message">Nachricht:</label>
              <textarea class="form-control" id="ev_message" required placeholder="Text.."></textarea>
              <input type="submit" class="form-control btn-primary mt-2" value="Senden">
            </div>
          </div>

          <div class="col-md-12">
            <h3>Obmann:</h3>
            <div class="col-md-12 form-group">
              <label for="ev_email">Ihre E-Mail:</label>
              <input type="email" class="form-control" id="ev_email" required>
              <label for="ev_message">Nachricht:</label>
              <textarea class="form-control" id="ev_message" required placeholder="Text.."></textarea>
              <input type="submit" class="form-control btn-primary mt-2" value="Senden">
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection
