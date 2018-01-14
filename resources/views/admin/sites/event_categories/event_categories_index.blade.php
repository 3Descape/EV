@extends('admin.layouts.sitebar')

@section('sitebar_inner')
<div class="col-lg-10 col-md-12 mx-auto">

    <h2 class="text-center">Veranstaltungskategorien</h2>
    @include('admin.layouts.errors')

    <form method="POST" action="{{route('event_category_store')}}">

        <div class="form-group">
            <label for="name">Name:</label>
            <input value="{{ old('name') }}" type="text" class="form-control" name="name" id="name" required>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success">
                <i class="fa fa-plus"></i> Hinzufügen
            </button>
        </div>

        {{ csrf_field() }}
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <td>{{$category->name}}</td>
                <td>
                    <div class="d-flex align-items-start">
                        <a href="{{route('event_category_edit', $category->id)}}" class="btn btn-warning ml-auto mr-1">
                            <i class="fa fa-edit" aria-hidden="true"></i>
                        </a>
                        <form action="{{route('event_category_destroy', $category->id)}}" method="POST">
                            <button type="submit" class="btn btn-danger mx-1">
                                <i class="fa fa-trash"></i>
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
</div>
@endsection
