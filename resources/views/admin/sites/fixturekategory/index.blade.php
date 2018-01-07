@extends('admin.layouts.sitebar')

@section('sitebar_inner')
    <div class="col-lg-10 col-md-12 mx-auto row">

        <div class="col-lg-12">
            <form action="{{route('fixture_category_store')}}" method="post">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{old('name') ?: ''}}">
                    @component('admin.components.error', ['name' => 'name', 'class' => "mt-1"]) 
                    @endcomponent
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-plus"></i> Hinzufügen
                    </button>
                </div>

                {{ csrf_field() }}
            </form>
        </div>
    </div>
@endsection