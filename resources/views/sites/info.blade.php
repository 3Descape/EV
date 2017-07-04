@extends('master')

@section('title')
Info
@endsection

@section('content')
  <div class="container-fluid menu">@include('layouts.menu')</div>
  <div>
    <div class="col-md-10 mx-auto bg-wrp space">
      <div class="col-md-6 col-sm-12 mx-auto " id="info">
        <h2 class="text-center">Aktuelles</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      </div>

      <div class="col-md-6 col-sm-12 mx-auto " id="info">
        <h2 class="text-center">AbsolventInnen</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      </div>

      <div class="col-md-6 col-sm-12 mx-auto " id="info">
        <h2 class="text-center">FUN Club</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      </div>

      <div class="col-md-6 col-sm-12 mx-auto " id="info">
          <h2 class="text-center">Ferien und schulautonome Tage</h2>
        <div class="row">

            <div class="col-md-12">
                <h3>Schulfreie Tage:</h3>
                <table class="table">
                  <tbody>
                    <tr>
                      <td scope="row">Nationalfeiertag</td>
                      <td>26.10.2016 (Mittwoch)</td>
                    </tr>
                    <tr>
                      <td scope="row">Allerheiligen</td>
                      <td>26.10.2016 (Mittwoch)</td>
                    </tr>
                    <tr>
                      <td scope="row">Allerseelen</td>
                      <td>26.10.2016 (Donnerstag)</td>
                    </tr>
                    <tr>
                      <td scope="row">Maria Empfängnis</td>
                      <td>26.10.2016 (Mittwoch)</td>
                    </tr>
                  </tbody>
                </table>
            </div>

            <div class="col-md-12">
                <h3>Ferien:</h3>
                <table class="table">
                  <tbody>
                    <tr>
                      <td scope="row">Weihnachtsferien</td>
                      <td>24.12.2016 - 08.01.2017</td>
                    </tr>
                    <tr>
                      <td scope="row">Semesterferien</td>
                      <td>24.12.2016 - 08.01.2017</td>
                    </tr>
                    <tr>
                      <td scope="row">Osterferien</td>
                      <td>24.12.2016 - 08.01.2017</td>
                    </tr>
                    <tr>
                      <td scope="row">Pfingstferien</td>
                      <td>24.12.2016 - 08.01.2017</td>
                    </tr>
                  </tbody>
                </table>
            </div>

        </div>
      </div>

      <div class="col-md-6 col-sm-12 mx-auto " id="info">
        <h2 class="text-center">Gesetze und Versicherungen</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      </div>

    </div>
  </div>
@endsection
