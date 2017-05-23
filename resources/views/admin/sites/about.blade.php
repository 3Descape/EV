@extends('admin.master')

@section('content')
<div class="col-md-10 mx-auto">
  <div id="about">


    {{-- <div id="accordion" role="tablist" aria-multiselectable="true">
      @foreach ($blocks as $block)
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
      @endforeach

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

    </div> --}}


    {{-- <textarea id="richTextField" style="width: 800px; height: 500px"><div><h1>text</h1></div></textarea> --}}

    <div class="col-md-8 mx-auto">
      <div>
        <button class="btn btn primary" onclick="execCmd('bold');">B</button>
        <button class="btn btn primary" onclick="execCmd('italic');">I</button>
        <button class="btn btn primary" onclick="execCmd('insertOrderedList');">L</button>
        <button class="btn btn primary" onclick="insert_wrp()">HTMl</button>
      </div>
      {{ $block->id}}
      <section id="cont">
        <iframe name="editor" class="form-control">{!!$block->content!!}</iframe>
        <form method="post" @submit.prevent="saveContent" id="textfield">

          <input type="number" hidden name="id" value="{{$block->id}}">
          <input type="submit" class="btn btn-success form-control" value="Speichern">
          {{ csrf_field() }}
        </form>
      </div>
    </section>
    <script type="text/javascript">
    var field = editor.document
    function enableEditMode(){
      //editor.setAttribute("contenteditable", true);
      field.designMode="on"
    }

    function execCmd(command){
      field.execCommand(command, false, null);
    }
    function insert_wrp(){
      div = document.createElement("div");
      div.setAttribute("class", "col-md-10 mx-auto");
      h1 = document.createElement("h1");
      h1.setAttribute("class", "text-center");
      h1.innerHTML = "Titel";
      h1.setAttribute("contenteditable", true);
      div.append(h1);
      p = document.createElement("p");
      p.innerHTML = "Text here";
      p.setAttribute("contenteditable", true);
      div.append(p);
      field.append(div);
      field.append(document.createElement("br"));
    }
    function setCaretAfter(el) {
      var sel, range;
      if (window.getSelection && document.createRange) {
          range = document.createRange();
          range.setStartAfter(el);
          range.collapse(true);
          sel = window.getSelection();
          sel.removeAllRanges();
          sel.addRange(range);
      } else if (document.body.createTextRange) {
          range = document.body.createTextRange();
          range.moveToElementText(el);
          range.collapse(false);
          range.select();
      }
    }
    document.addEventListener('DOMContentLoaded', function() {
      enableEditMode();

      keys = {ctrl: false, enter: false};
      field.addEventListener('keydown', function(event) {
        //keys[event.keyCode] = event.keyCode
        if(event.keyCode == 17){
          keys.ctrl = true;
        }else if(event.keyCode == 13){
          keys.enter = true;
        }
      });

      field.addEventListener('keyup', function(event) {
        if(event.keyCode == 17){
          keys.ctrl = false;
        }else if(event.keyCode == 13){
          if(keys.ctrl && keys.enter){
            br = document.createElement("br");
            document.activeElement
            field.append(br);
            setCaretAfter(br);
          }
          keys.enter == false;
        }
      });

    }, false);


    var getSelectionParents=function(){
      var selection=document.getSelection();
      if(!selection.toString().length)
          return false;
      else
          return {
              start:selection.anchorNode.parentNode,
              end:selection.focusNode.parentNode
          };
}

document.addEventListener('mouseup',function(){
    //console.log(getSelectionParents());
});



    </script>

  </div>

</div>


@endsection
