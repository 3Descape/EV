@extends('admin.layouts.sitebar')

@section('sitebar_inner')
<div class="col-md-8 mx-auto">
    @foreach ($texts as $text)
        <div class="card mb-5">
            <div class="card-body">
                <div class="d-flex justify-content-end align-items-start">
                    <h1 class="mr-auto">{{$text->title}}</h1>
                    <a href="{{route('admin_sites_edit', $text->id)}}" class="btn btn-success">
                        <i class="fa fa-edit"></i> Bearbeiten
                    </a>
                </div>
                <p>{!! $text->text !!}</p>
            </div>
        </div>
    @endforeach
</div>
@endsection
