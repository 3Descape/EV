@extends('admin.layouts.sitebar')

@section('header')
    <link rel="stylesheet" href="{{asset('/css/tempusdominus-bootstrap-4.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('/css/dropzone.min.css')}}"/>
@endsection
@section('sitebar_inner')
    <div class="col-md-10 mx-auto">

        <h2 class="text-center">Bearbeiten</h2>
        @include('admin.layouts.errors')

        <form class="form-group" method="POST" action="{{route('admin_events_update', $event->id)}}{{request('type') && request('type') == 'archive' ? '?redirect=archived': ''}}">
            {{ csrf_field() }}
            {{method_field('PUT')}}

            <div class="form-group row">
                <div class="col-md-1">
                    Name:
                </div>
                <div class="col-md-11">
                    <input type="text" value="{{old('name') ? old('name') : $event->name}}" class="form-control" name="name" required>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-1">
                    Ort:
                </div>
                <div class="col-md-11">
                    <input type="text" value="{{old('location') ? old('location') : $event->location}}" class="form-control" name="location" required>
                </div>
            </div>
            @if(!app('request')->input('type') == "archive")
                <div class="form-group row">
                    <div class="col-md-1">
                        Datum:
                    </div>
                    <div class="col-md-11">
                        <input type="date" name="date" id="" class="form-control" placeholder="dd.MM.yyyy HH:mm" value="{{old('date') ? old('date') : $event->date->format("d.m.Y H:i")}}">
                    </div>
                </div>
            @endif

            <div class="form-group row">
                <div class="col-md-1">
                    Beschreibung:
                </div>
                <div class="col-md-11">
                    <input type="text" value="{{old('description') ? old('description') : $event->description}}" class="form-control" name="description" required>
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
                            {{old('category') ? old('category') == $category->name ? 'selected=selected' : '' : $event->category->name == $category->name ? 'selected=selected' : ''}}
                                value="{{$category->id}}">{{ucfirst($category->name)}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <input type="submit" class="form-control btn btn-success" value="Aktualisieren">
        </form>

        <div>
            @if (request('type')=='archive')
                <form action="{{route('admin_events_store_image', $event->id)}}" class="dropzone col-md-10 mx-auto">
                    {{ csrf_field() }}
                </form>

                @if($event->images->count())
                    <div class="row col-md-10 mx-auto">
                        @foreach ($event->images as $image)
                            <div class="thumbnail">
                                <img src="{{asset($image->path)}}">
                                <form action="{{route('admin_events_destroy_image', [$event->id, $image->id])}}" method="POST">
                                    {{ csrf_field() }}
                                    {{method_field('DELETE')}}
                                    <div class="d-flex justify-content-center align-items-center">
                                        <button class=""><i class="fa fa-times fa-2x"></i></button>
                                    </div>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @endif

            @endif
        </div>

    </div>
@endsection

@section('footer')
    <script src="{{asset('/js/moment.min.js')}}"></script>
    <script src="{{asset('/js/de.js')}}"></script>
    <script src="{{asset('/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <script src="{{asset('/js/dropzone.js')}}"></script>

    <script type="text/javascript">
    $(function () {
        moment().locale('de')
        $('#datetimepicker1').datetimepicker({
            locale : 'de',
            useCurrent: true,
        });
        $('#field').val('{{old('date')}}');
    });
    </script>
@endsection
