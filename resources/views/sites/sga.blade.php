@extends('master')

@section('title')
SGA
@endsection

@section('content')
  <div class="container-fluid">@include('layouts.menu')</div>
  <div>
    <div class="col-md-10 mx-auto bg-wrp space">
      <div class="col-md-10 col-sm-12 mx-auto sizing">
        <h2 class="text-center">Was ist der SGA?</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      </div>
      <div class="col-md-10 col-sm-12 mx-auto sizing">
        <h2 class="text-center">Welche Entscheidung obliegen dem SGA?</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      </div>
      <div class="col-md-10 col-sm-12 mx-auto sizing">
        <h2 class="text-center">Beratungsrolle</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      </div>
      <div class="col-md-10 col-sm-12 mx-auto sizing">
        <h2 class="text-center">Mitglieder</h2>
        <div class="row" id="personen">
          @for ($i = 0; $i < 10; $i++)
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 py-2">
              <div class="card">
                <div class="img-wrp"><img class="img-cls mx-auto" src="http://www.hwsc.net/wp-content/uploads/2016/03/Unknown-person.gif" alt="Card image cap"></div>
                <div class="card-block">
                  <h4 class="card-title">Card title</h4>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
              </div>
            </div>
          @endfor
        </div>
      </div>
    </div>
  </div>
@endsection
