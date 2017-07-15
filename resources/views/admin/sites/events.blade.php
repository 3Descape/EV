@extends('admin.layouts.sitebar')

@section('sitebar_inner')
  <div class="col-md-10 mx-auto" id="events">
    <h2 class="text-center">Veranstaltungen</h2>

    <div class="alert alert-danger" style="display:none" v-show="show_errors">
      <ul>
        <li v-for="(error, index) in errors">@{{error[0]}}</li>
      </ul>
    </div>



    <form class="form-group" @submit.prevent="addEvent">
      {{ csrf_field() }}

      <div class="form-group row">
        <div class="col-md-1">
          Name:
        </div>
        <div class="col-md-11">
          <input type="text" class="form-control" name="event_name">
        </div>
      </div>

      <div class="form-group row">
        <div class="col-md-1">
          Datum:
        </div>
        <div class="col-md-11">
          <vue-datepicker></vue-datepicker>
        </div>
      </div>

      <div class="form-group row">
        <div class="col-md-1">
          Ort:
        </div>
        <div class="col-md-11">
          <input type="text" class="form-control" name="event_location">
        </div>
      </div>

      <div class="form-group row">
        <div class="col-md-1">
          Beschreibung:
        </div>
        <div class="col-md-11">
          <input type="text" class="form-control" name="event_description">
        </div>
      </div>

      <div class="form-group row">
        <div class="col-md-1">
          Kategory
        </div>
        <div class="col-md-11">
            <select class="form-control" name="event_category">
                <option value="bälle">Ball</option>
                <option value="sport">Sport</option>
                <option value="sonstige">Sonstig</option>
            </select>
        </div>
      </div>

      <input type="submit" class="form-control btn btn-success" value="Hinzufügen">
    </form>

    <table class="table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Datum</th>
          <th>Ort</th>
          <th>Kategorie</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(event, index) in events">
          <td>@{{event.name}}</td>
          <td>@{{event.date}}</td>
          <td>@{{event.location}}</td>
          <td>@{{event.category | capitalize}}</td>
          <td class="clearfix">
            <div class="float-right">
              <button type="button" class="btn btn-warning mx-1" @click="editEvent(index)"><i class="fa fa-edit" aria-hidden="true"></i></button>
              <button type="button" class="btn btn-danger mx-1" @click="deleteEvent(event.id, index)"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">@{{eventEdit.name}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="updateEvent">
            <div class="modal-body">
              <input type="text" class="form-control" name="name" :value="eventEdit.name">
              <input type="text" class="form-control" name="description" :value="eventEdit.description">
              <vue-datepicker :starttime="eventEdit.starttime"></vue-datepicker>
              <input type="text" class="form-control" name="location" :value="eventEdit.location">
              <select class="form-control" name="category">
                  <option :selected=" 'bälle' == eventEdit.category" value="bälle">Bälle</option>
                  <option :selected=" 'sport' == eventEdit.category" value="sport">Sport</option>
                  <option :selected=" 'sonstige' == eventEdit.category" value="sonstige">Sonstige</option>
              </select>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
              <button type="submit" class="btn btn-outline-success">Speichern</button>
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>
@endsection
