@extends('admin.layouts.sitebar')

@section('sitebar_inner')
<div class="col-md-10 mx-auto">
    @include('admin.layouts.errors')

    <form action="{{route('holiday_store')}}" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{old('name') ? old('name') : ''}}">
        </div>

        <div class="form-group">
            <label>Datum</label>
            <input type="text" name="date" class="form-control" value="{{old('date') ? old('date') : ''}}">
        </div>

        <div class="form-group">
            <label>Kategorie</label>
            <select name="category" class="form-control">
                <option value="ferien" {{old('category') === 'ferien' ? 'selected=selected' : ''}}>Ferien</option>
                <option value="schulautonom" {{old('category') === 'schulautonom' ? 'selected=selected' : ''}}>Schulautonom frei</option>
            </select>
        </div>
        <button type="submit" class="form-control btn-success"><i class="fa fa-plus"></i> Hinzugügen</button>
    </form>

    <div class="card mt-5">
        <div class="card-body">
            <h3>Ferien</h3>
            <table class="table">
                <thead>
                    <th>Name</th>
                    <th>Datum</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($ferien as $frei)
                        <tr>
                            <td>{{$frei->name}}</td>
                            <td>{{$frei->date}}</td>
                            <td class="clearfix">
                                <form class="float-right" action="{{route('holiday_destroy', $frei->id )}}" method="POST">
                                    <button type="submit" class="btn btn-danger mx-1"><i class="fa fa-trash"></i></button>
                                    {{method_field('DELETE')}}
                                    {{ csrf_field() }}
                                </form>
                                <a href="{{route('holiday_edit', $frei->id )}}" class="btn btn-warning mx-1 float-right"><i class="fa fa-edit" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card mt-5">
        <div class="card-body">
            <h3>Schulautonome Tage</h3>
            <table class="table">
                <thead>
                    <th>Name</th>
                    <th>Datum</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($schulautonom as $frei)
                    <tr>
                        <td>{{$frei->name}}</td>
                        <td>{{$frei->date}}</td>
                        <td class="clearfix">
                            <form class="float-right" action="{{route('holiday_destroy', $frei->id )}}" method="POST">
                                <button type="submit" class="btn btn-danger mx-1"><i class="fa fa-trash"></i></button>
                                {{method_field('DELETE')}}
                                {{ csrf_field() }}
                            </form>
                            <a href="{{route('holiday_edit', $frei->id )}}" class="btn btn-warning mx-1 float-right"><i class="fa fa-edit" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
