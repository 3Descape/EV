@extends('admin.layouts.sitebar')

@section('sitebar_inner')
    <div class="col-lg-10 col-md-12 mx-auto">

        <h2 class="text-center">Konflikte beim Löschen der Kategorie {{$event_category->name}}</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Kategorie derzeit</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                <tr>
                    <td>{{$event->name}}</td>
                    <td class="">{{$event->category->name}}</td>
                    <td class="d-flex">
                        <form class="ml-auto d-flex" action="{{route('event_resolve_conflict', $event->id)}}" method="POST">
                            
                            <select class="custom-select mr-2" name="event_category_id">
                                @foreach ($categories as $category)
                                    <option
                                    {{old('category') ? old('category') == $category->name ? 'selected=selected' : '' : ''}}
                                        value="{{$category->id}}">{{ucfirst($category->name)}}
                                    </option>
                                @endforeach
                            </select>

                            <button type="submit" class="btn btn-info">
                                <div class="fa fa-refresh"></div>
                            </button>
                            
                            {{method_field('PUT')}}
                            {{ csrf_field() }}
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
