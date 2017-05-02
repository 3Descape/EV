@extends('admin.master')

@section('content')

  <div class="col-md-10 mx-auto">
    <div class="form-group">
      <form action="{{route('admin_text_update', $block->id)}}" method="post" id="target_form">
        <input type="text" name="title" class="form-control" value="{{$block->title}}">
        <textarea name="text" id="editor" rows="30">
            {{$block->text}}
        </textarea>
        <input type="submit" class="btn btn-success form-control" value="Speichern">
        {{ csrf_field() }}
      </form>
    </div>
  </div>

@endsection
