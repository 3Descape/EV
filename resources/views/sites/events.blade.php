@extends('master')

@section('title')
Veranstaltungen
@endsection

@section('content')
  <div class="container-fluid">@include('layouts.menu')</div>
  <div>
    <div class="col-md-10 mx-auto bg-wrp">
     <h1 class="text-center">Veranstaltungen</h1>
      @for($i=0; $i<5; $i++)
        <div class="col-md-10 mx-auto">
          <div class="card">
            <div class="card-block">
              <div class="row">
                <div class="col-md-2">
                  <img class="img-fluid" src="http://www.hwsc.net/wp-content/uploads/2016/03/Unknown-person.gif" alt="Card image cap">
                </div>
                <div class="col-md-10">
                  <div class="row">
                    <div class="col-md-12">
                      <h4 class="card-title">Event Name</h4>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                    <div class="col-md-12 mt-4">
                      <h4 class="card-title">Wo und Wann?</h4>
                      <p class="card-text">Am 3.4.3029 im Gymnasium Weiz</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endfor
    </div>
  </div>
@endsection
