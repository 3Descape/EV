@extends('admin.layouts.sitebar')

@section('sitebar_inner')
<div class="col-lg-10 col-md-12 mx-auto">
    <h2 class="text-center">Veranstaltungen</h2>
    <form class="mb-5" method="POST" action="{{route('event_store')}}">
        <div class="form-group">
            <label for="name">Name:</label>
            <input value="{{ old('name') }}" type="text" class="form-control" name="name" id="name">
            @component('admin.components.error', ['name' => 'name', 'class' => 'mt-1'])
            @endcomponent
        </div>

        <div class="form-group">
            <label for="description">Datum:</label>
            <input type="text" name="date" id="date" class="form-control" placeholder="dd.MM.yyyy HH:mm" value="{{ old('date') }}">
            @component('admin.components.error', ['name' => 'date', 'class' => 'mt-1'])
            @endcomponent
        </div>


        <div class="form-group">
            <label for="location">Ort:</label>
            <input type="text" id="location" value="{{ old('location') }}" class="form-control" name="location">
            @component('admin.components.error', ['name' => 'location', 'class' => 'mt-1'])
            @endcomponent
        </div>

        <div class="form-group">
            <label for="location">Beschreibung:</label>
            <input type="text" id="description" value="{{ old('markup') }}" class="form-control" name="markup">
            @component('admin.components.error', ['name' => 'markup', 'class' => 'mt-1'])
            @endcomponent
        </div>

        <div class="form-group">
            <label for="category">Kategorie:</label>
            <select class="custom-select" name="category" id="category">
                @foreach ($categories as $category)
                    <option
                    {{old('category') ? old('category') == $category->name ? 'selected=selected' : '' : ''}}
                        value="{{$category->id}}">
                            {{ucfirst($category->name)}}
                    </option>
                @endforeach
            </select>
            @component('admin.components.error', ['name' => 'category', 'class' => 'mt-1'])
            @endcomponent
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success">
                <i class="fa fa-plus"></i> Hinzufügen
            </button>
        </div>
        {{ csrf_field() }}
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
                    <td class="d-none d-sm-table-cell overflow-text">{{$event->date->format('d.m.Y H:i')}}</td>
                    <td class="d-none d-md-table-cell overflow-text">{{$event->location}}</td>
                    <td class="d-none d-md-table-cell overflow-text">{{$event->category->name}}</td>
                    <td class="d-flex">
                        <a href="{{route('event_edit', $event->id)}}" class="btn btn-warning ml-auto">
                            <i class="fa fa-edit" aria-hidden="true"></i>
                        </a>
                        <form class="mx-1" action="{{route('event_destroy',$event->id)}}" method="POST">
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
