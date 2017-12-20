@extends('admin.layouts.sitebar')

@section('sitebar_inner')
<div class="col-lg-10 col-md-12 mx-auto">
    <h2 class="text-center">Archiv</h2>
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
                    <td class="d-none d-md-table-cell">{{ucfirst($event->category->name)}}</td>
                    <td class="d-flex">

                        <form class="ml-auto" action="{{route('admin_events_destroy',$event->id)}}" method="POST">
                            <button type="submit" class="btn btn-danger mx-1"><i class="fa fa-trash"></i></button>
                            {{method_field('DELETE')}}
                            {{ csrf_field() }}
                        </form>
                        <a href="{{route('admin_events_edit', $event->id)}}?type=archive" class="btn btn-warning mx-1"><i class="fa fa-edit" aria-hidden="true"></i></a
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
@endsection
