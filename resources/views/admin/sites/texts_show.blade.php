@extends('admin.layouts.sitebar')

@section('sitebar_inner')
<div class="col-md-8 mx-auto">
    <sites-edit :sites-prop="{{$texts}}"></sites-edit>
</div>
@endsection
