@extends('admin.master')

@section('content')

<div class="row">
  <div class="col-md-10 mx-auto">
    <div class="row text-center admin_home_links">
      <div class="col-md-6">
        <a href="{{route('admin_about')}}">Über uns</a>
      </div>
      <div class="col-md-6 admin_home_links">
        <a href="{{route('admin_events')}}">Veranstaltungen</a>
      </div>
      <div class="col-md-6 admin_home_links">
        <a href="{{route('admin_sga')}}">SGA</a>
      </div>
      <div class="col-md-6 admin_home_links">
        <a href="{{route('admin_info')}}">Informationen</a>
      </div>
    </div>
  </div>
</div>

@endsection
