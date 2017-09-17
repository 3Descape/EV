@extends('admin.layouts.sitebar')

@section('sitebar_inner')
<div class="col-md-10 mx-auto">

    <h2 class="text-center">Kategorien</h2>
    @include('admin.layouts.errors')

    <form class="form-group" method="POST" action="{{route('admin_categories_store')}}">

        <div class="form-group row">
            <div class="col-md-1">
                Name:
            </div>
            <div class="col-md-11">
                <input value="{{ old('name') }}" type="text" class="form-control" name="name">
            </div>
        </div>

        <input type="submit" class="form-control btn btn-success" value="Hinzufügen">
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
                    <form class="float-right" action="{{route('admin_categories_destroy',$category->id)}}" method="POST">
                        <button type="submit" class="btn btn-danger mx-1"><i class="fa fa-trash"></i></button>
                        {{method_field('DELETE')}}
                        {{ csrf_field() }}
                    </form>
                    <a href="{{route('admin_categories_edit', $category->id)}}" class="btn btn-warning mx-1 float-right"><i class="fa fa-edit" aria-hidden="true"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
