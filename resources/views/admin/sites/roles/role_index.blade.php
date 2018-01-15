@extends('admin.layouts.sitebar')

@section('sitebar_inner')
<roles :roles-prop="{{$roles}}" :permissions="{{$permissions}}"></roles>
@endsection
