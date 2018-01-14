@extends('admin.layouts.sitebar')

@section('sitebar_inner')
    <div class="col-lg-10 col-md-12 mx-auto">

        <h2 class="text-center">Konflikte beim Löschen der Kategorie {{$category->name}}</h2>
        @include('admin.layouts.errors')

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Kategorie derzeit</th>
                    <th>Neue Kategorie</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                <tr>
                    <td>{{$event->name}}</td>
                    <td class="bg-danger">{{$event->category->name}}</td>
                    <td class="clearfix">
                        <form class="float-right" action="{{route('admin_events_update', $event->id)}}?type=conflict" method="POST">
                            <div class="input-group">
                                <select class="form-control" aria-describedby="btnGroupAddon" name="category">
                                    @foreach ($categories as $category)
                                    <option
                                    {{old('category') ? old('category') == $category->name ? 'selected=selected' : '' : ''}}
                                        value="{{$category->id}}">{{ucfirst($category->name)}}
                                    </option>
                                    @endforeach
                                </select>

                                <button type="submit" class="input-group-addon bg-success" id="btnGroupAddon"><i class="fa fa-refresh"></i></button>
                            </div>
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
