@extends('admin.layouts.sitebar')

@section('sitebar_inner')
<div class="col-lg-10 col-md-12 mx-auto">
    <form  action="{{route('admin_sites_update', $text->id)}}" method="POST">
        <div class="form-group">
            <label for="title">Überschrift:</label>
            <input class="form-control" type="text" name="title" value="{{$text->title}}" id="title">
        </div>

        <div class="form-group">
            <label for="text">Text:</label>
            <textarea class="form-control" name="text" rows="8" id="text">{{$text->formattedText()}}</textarea>
        </div>
        
        <input class="btn btn-success form-control" type="submit" value="Bearbeiten">
        {{method_field('PUT')}}
        {{ csrf_field() }}
    </form>
</div>

@endsection
