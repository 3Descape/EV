@extends('master')

@section('title')
Impressum
@endsection

@section('content')
  <div class="container-fluid menu">@include('layouts.menu')</div>
  <div>
    <div class="col-md-10 mx-auto bg-wrp">

      <div class="col-md-12">
        <div class="col-md-10 col-sm-12 mx-auto" id="imprint">
          <h1 class="text-center">Impressum</h1>
          <div class="text-center mt-4">
            <p>Elternverein Weiz</p>
            <p>Inh. Waldemar Vogel</p>
            <p>Offenburger Gasse 23</p>
            <p>8160 Weiz</p>
            <p>Telefon: 49 2845 / 936 82 38</p>
            <p>Telefax: 49 2845 / 936 82 39</p>
            <p>E-Mail: info@example-sports.de</p>
          </div>

        </div>
      </div>

    </div>
  </div>
@endsection
