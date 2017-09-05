@extends('admin.layouts.sitebar')

@section('sitebar_inner')
    <div class="col-md-10 mx-auto">
        <h2 class="text-center">Archiv</h2>
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
                        <td>{{ucfirst($event->category->name)}}</td>
                        <td class="clearfix">

                            <form class="float-right" action="{{route('admin_events_destroy',$event->id)}}" method="POST">
                                <button type="submit" class="btn btn-danger mx-1"><i class="fa fa-trash"></i></button>
                                {{ csrf_field() }}
                                {{method_field('DELETE')}}
                            </form>
                            <a href="{{route('admin_events_edit', $event->id)}}?type=archive" class="btn btn-warning mx-1 float-right"><i class="fa fa-edit" aria-hidden="true"></i></a
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
