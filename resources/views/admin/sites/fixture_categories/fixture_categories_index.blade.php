@extends('admin.layouts.sitebar')

@section('sitebar_inner')
    <div class="col-lg-10 col-md-12 mx-auto row">

        <div class="col-lg-12">
            <form action="{{route('fixture_category_store')}}" method="post">
                <div class="row mb-3">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{old('name') ?: ''}}">
                    @include('admin.components.error', ['name' => 'name', 'class' => "mt-1"])
                </div>

                <div class="row mb-3">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-plus"></i> Hinzufügen
                    </button>
                </div>

                {{ csrf_field() }}
            </form>
        </div>

        <div class="col-lg-12">
            <table class="table overflow">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fixturecategories as $category)
                        <tr>
                            <td scope="row">{{$category->name}}</td>
                            <td class="d-none d-md-table-cell">{{$category->description}}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{route('fixture_category_edit', $category->id)}}" class="btn btn-warning ms-auto">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{route('fixture_category_destroy', $category->id)}}" method="post">
                                        <button class="btn btn-danger mx-1" type="submit">
                                            <i class="fa fa-trash-alt"></i>
                                        </button>
                                        {{ csrf_field() }}
                                        {{method_field('DELETE')}}
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection