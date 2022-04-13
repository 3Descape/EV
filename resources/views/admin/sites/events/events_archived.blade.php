@extends('admin.layouts.sitebar')

@section('sitebar_inner')
<div class="col-lg-10 col-md-12 mx-auto">
    <h2 class="text-center">Archiv</h2>
    <table class="table overflow">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col" class="d-none d-sm-table-cell">Datum</th>
                <th scope="col" class="d-none d-md-table-cell">Ort</th>
                <th scope="col" class="d-none d-md-table-cell">Kategorie</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)
                <tr>
                    <td>{{$event->name}}</td>
                    <td class="d-none d-sm-table-cell overflow-text">{{$event->date->format('d.m.Y H:i')}}</td>
                    <td class="d-none d-md-table-cell overflow-text">{{$event->location}}</td>
                    <td class="d-none d-md-table-cell overflow-text">{{ucfirst($event->category->name)}}</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{route('event_edit', $event->id)}}?type=archive" class="btn btn-warning ms-auto">
                                <i class="fa fa-pencil-alt" aria-hidden="true"></i>
                            </a>

                            <form action="{{route('event_destroy', $event->id)}}" method="POST">
                                <button type="submit" class="btn btn-danger ms-1">
                                    <i class="fa fa-trash-alt"></i>
                                </button>
                                {{method_field('DELETE')}}
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $events->links('admin.layouts.paginator') }}
</div>
@endsection
