@extends('admin.master')

@section('content')
  <div class="col-md-10 mx-auto">

      <div class="alert alert-danger" style="display:none" v-show="show_errors">
        <ul>
          <li v-for="error in errors">@{{error[0]}}</li>
        </ul>
      </div>

    <form method="post" action="{{route('admin_events_store')}}" @submit.prevent="saveEvent" class="form-group">
      <input type="text" class="form-control" name="name" value="{{ old('name') }}">
      <input type="date" class="form-control" name="date" value="{{ old('date') }}">
      <input type="text" class="form-control" name="text" value="{{ old('text') }}">
      <input type="submit" class="form-control btn btn-success" value="Submit">
      {{ csrf_field() }}
    </form>
    <ul class="list-group">
        <div class="row">
          <div class="col-md-1">
            Index
          </div>
          <div class="col-md-4">
            Name:
          </div>
          <div class="col-md-4">
            Text:
          </div>
          <div class="col-md-1">
            Date:
          </div>
          <div class="col-md-2">
          </div>
        </div>

        <li class="list-group-item" v-for="event in events">
            <div class="col-md-1">
              @{{event.id}}
            </div>
            <div class="col-md-4">
              @{{event.name}}
            </div>
            <div class="col-md-4">
              @{{event.text}}
            </div>
            <div class="col-md-1">
              @{{event.date}}
            </div>
            <div class="col-md-2">
              <button type="button" class="fa fa-edit btn btn-warning" @click="edit_event(event.id)"></button>
              <button type="button" class="fa fa-trash-o btn btn-danger" @click="delete_event(event.id)"></button>
            </div>
        </li>
      </ul>
    </div>

@endsection
