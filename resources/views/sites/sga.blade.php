@extends('master')

@section('title')
SGA
@endsection

@section('content')
  <div class="container-fluid menu">@include('layouts.menu')</div>
  <div class="bg">

  </div>
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
        <vue-people id="2"></vue-people>
      </div>
    </div>
  </div>
@endsection
