@extends('admin.layouts.sitebar')

@section('header')
    <link rel="stylesheet" href="{{asset('/css/tempusdominus-bootstrap-4.min.css')}}">
@endsection

@section('sitebar_inner')
<div class="col-lg-10 col-md-12 mx-auto">

    <h2 class="text-center">Veranstaltungen</h2>
    @include('admin.layouts.errors')

    <form class="form-group" method="POST" action="{{route('admin_events_store')}}">
        {{ csrf_field() }}

        <div class="form-group row">
            <div class="col-lg-2 col-md-3 col-sm-12">
                Name:
            </div>
            <div class="col-lg-10 col-md-9 col-sm-12">
                <input value="{{ old('name') }}" type="text" class="form-control" name="name">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-2 col-md-3 col-sm-12">
                Datum:
            </div>
            <div class="col-lg-10 col-md-9 col-sm-12">
                <input type="text" name="date" id="" class="form-control" placeholder="dd.MM.yyyy HH:mm" value="{{ old('date') }}">
            </div>
        </div>


        <div class="form-group row">
            <div class="col-lg-2 col-md-3 col-sm-12">
                Ort:
            </div>
            <div class="col-lg-10 col-md-9 col-sm-12">
                <input type="text" value="{{ old('location') }}" class="form-control" name="location">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-2 col-md-3 col-sm-12">
                Beschreibung:
            </div>
            <div class="col-lg-10 col-md-9 col-sm-12">
                <input type="text" value="{{ old('markup') }}" class="form-control" name="markup">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-2 col-md-3 col-sm-12">
                Kategorie
            </div>
            <div class="col-lg-10 col-md-9 col-sm-12">
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

    <table class="table overflow">
        <thead>
            <tr>
                <th>Name</th>
                <th class="d-none d-sm-table-cell">Datum</th>
                <th class="d-none d-md-table-cell">Ort</th>
                <th class="d-none d-md-table-cell">Kategorie</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)
                <tr>
                    <td>{{$event->name}}</td>
                    <td class="d-none d-sm-table-cell">{{$event->date->format('d.m.Y H:i')}}</td>
                    <td class="d-none d-md-table-cell">{{$event->location}}</td>
                    <td class="d-none d-md-table-cell">{{$event->category->name}}</td>
                    <td class="d-flex">
                        <a href="{{route('admin_events_edit', $event->id)}}" class="btn btn-warning ml-auto">
                            <i class="fa fa-edit" aria-hidden="true"></i>
                        </a>
                        <form class="mx-1" action="{{route('admin_events_destroy',$event->id)}}" method="POST">
                            <button type="submit" class="btn btn-danger mx-1">
                                <i class="fa fa-trash"></i>
                            </button>
                            {{ csrf_field() }}
                            {{method_field('DELETE')}}
                        </form>
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
