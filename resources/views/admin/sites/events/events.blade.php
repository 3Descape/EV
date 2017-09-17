@extends('admin.layouts.sitebar')

@section('header')
    <link rel="stylesheet" href="{{asset('/css/tempusdominus-bootstrap-4.min.css')}}">
@endsection

@section('sitebar_inner')
<div class="col-md-10 mx-auto">

    <h2 class="text-center">Veranstaltungen</h2>
    @include('admin.layouts.errors')

    <form class="form-group" method="POST" action="{{route('admin_events_store')}}">
        {{ csrf_field() }}

        <div class="form-group row">
            <div class="col-md-1">
                Name:
            </div>
            <div class="col-md-11">
                <input value="{{ old('name') }}" type="text" class="form-control" name="name">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-1">
                Datum:
            </div>
            <div class="col-md-11">
                <input type="text" name="date" id="" class="form-control" placeholder="dd.MM.yyyy HH:mm" value="{{ old('date') }}">
            </div>
        </div>


        <div class="form-group row">
            <div class="col-md-1">
                Ort:
            </div>
            <div class="col-md-11">
                <input type="text" value="{{ old('location') }}" class="form-control" name="location">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-1">
                Beschreibung:
            </div>
            <div class="col-md-11">
                <input type="text" value="{{ old('description') }}" class="form-control" name="description">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-1">
                Kategorie
            </div>
            <div class="col-md-11">
                <select class="form-control" name="category">
                    @foreach ($categories as $category)
                        <option
                        {{old('category') ? old('category') == $category->name ? 'selected=selected' : '' : ''}}
                            value="{{$category->id}}">{{ucfirst($category->name)}}
                        </option>
                    @endforeach
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
            @foreach ($events as $event)
                <tr>
                    <td>{{$event->name}}</td>
                    <td>{{$event->date->format('d.m.Y H:i')}}</td>
                    <td>{{$event->location}}</td>
                    <td>{{$event->category->name}}</td>
                    <td class="clearfix">

                        <form class="float-right" action="{{route('admin_events_destroy',$event->id)}}" method="POST">
                            <button type="submit" class="btn btn-danger mx-1"><i class="fa fa-trash"></i></button>
                            {{ csrf_field() }}
                            {{method_field('DELETE')}}
                        </form>
                        <a href="{{route('admin_events_edit', $event->id)}}" class="btn btn-warning mx-1 float-right"><i class="fa fa-edit" aria-hidden="true"></i></a>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
@endsection

@section('footer')
<script src="{{asset('/js/moment.min.js')}}"></script>
<script src="{{asset('/js/de.js')}}"></script>
<script src="{{asset('/js/tempusdominus-bootstrap-4.min.js')}}"></script>

<script type="text/javascript">
$(function () {
    $(function () {
        moment().locale('de')
        $('#datetimepicker1').datetimepicker({
            locale : 'de',
            useCurrent: true
        });
        $('#field').val('{{old('date')}}');
    });
});

    $(function () {
        $('#datetimepicker13').datetimepicker({
            inline: true,
            sideBySide: true
        });
    });
</script>
@endsection
