@extends('admin.master')

@section('content')
<div class="col-md-10 mx-auto">
  <div id="about">


    <div id="accordion" role="tablist" aria-multiselectable="true">
      {{-- @foreach ($blocks as $block)
        <div class="card">
          <div class="card-header" role="tab" id="{{"h_".$block->id}}">
            <h5 class="mb-0">
              <a data-toggle="collapse" data-parent="#accordion" href="#{{"id".$block->id}}" aria-expanded="true" aria-controls="{{"id".$block->id}}">
                {{$block->title}}
                <div class="float-right">
                  <a href="{{route('admin_text_edit', $block->id) }}" class="fa fa-edit btn btn-warning"></a>
                  <a href="{{route('admin_text_delete', $block->id)}}" class="fa fa-trash-o btn btn-danger"></a>
                </div>
              </a>
            </h5>
          </div>

          <div id="{{"id".$block->id}}" class="collapse" role="tabpanel" aria-labelledby="{{"h_".$block->id}}">
            <div class="card-block">
              {!! $block->text !!}
            </div>
          </div>
        </div>
      @endforeach --}}

      <div class="form-group">
        <form action="{{route('admin_text_update', $block->id)}}" method="post" id="target_form">
          <input type="text" name="title" class="form-control" value="{{$block->name}}">
          <textarea name="text" id="editor" rows="30">
              {{$block->content}}
          </textarea>
          <input type="submit" class="btn btn-success form-control" value="Speichern">
          {{ csrf_field() }}
        </form>
      </div>

    </div>

  </div>

</div>

@endsection
