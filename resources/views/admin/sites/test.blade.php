@extends('admin.layouts.sitebar')

@section('sitebar_inner')
<text-area :markup-prop="{{json_encode($site->markup)}}" :images-prop="{{$images}}">
    <div slot-scope="{compiledMarkdown, inputEvents, inputAttrs}">
        <textarea v-on="inputEvents" v-bind="inputAttrs" ></textarea>
        <div v-html="compiledMarkdown"></div>
    </div>
</text-area>
@endsection