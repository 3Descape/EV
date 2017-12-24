@extends('sites.sites_master')

@section('title')
    Download
@endsection

@section('content')
    <div class="col-sm-11 col-lg-9 col-xl-6 mx-auto mt-4">
        <div class="col-md-10 col-sm-12 mx-auto">
            <ul class="list-group">
                @foreach ($files as $file)
                    <li class="list-group-item d-flex">
                        <div>
                            <h3>{{$file->name}}</h3>
                            <p>{{$file->description}}</p>
                        </div>
                        <a href="{{route('file_download', $file->id)}}" class="btn btn-primary ml-auto align-self-start">
                            <i class="fa fa-download" aria-hidden="true"></i>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
