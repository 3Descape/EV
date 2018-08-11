@extends('admin.layouts.sitebar')

@section('sitebar_inner')
<div class="col-lg-10 col-sm-12 col-md-12 mx-auto">
    <file-uploud :files="{{$files}}" :images-prop="{{$images}}"></file-uploud>
</div>
@endsection

