@extends('master')

@section('title')
Über uns
@endsection

@section('content')
<div class="container-fluid menu">@include('layouts.menu')</div>

<div>
    <div class="col-md-10 mx-auto bg-wrp space">

      <div class="col-md-6 col-sm-12 mx-auto " id="vorstand">
        <h1 class="text-center">Vorstand</h1>
        <div class="row">
          <div class="col-md-4 col-sm-12 text-center">
            <img src="http://www.hwsc.net/wp-content/uploads/2016/03/Unknown-person.gif" alt="Herr X" class="img-fluid">
          </div>
          <div class="col-md-8 col-sm-12">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-sm-12 mx-auto " id="elternvertreterInnen">
        <h1 class="text-center" >ElternvertreterInnen</h1>
        <div class="row" id="personen">
            {{-- @foreach ($people as $person)

                <div class="card col-md-3">
                  <div class="card-block">
                    <h4 class="card-title">{{$person->name}}</h4>
                    <p class="card-text">{{$person->description}}</p>
                  </div>
                </div>

            @endforeach --}}

            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
      </div>

      <div class="col-md-6 col-sm-12 mx-auto " id="mitgliedsbeitrag">
        <h1 class="text-center">Mitgliedsbeitrag</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    </div>


      <div class="col-md-6 col-sm-12 mx-auto " id="statuten">
        <h1 class="text-center">Statuten</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      </div>


    </div>
</div>
@endsection
