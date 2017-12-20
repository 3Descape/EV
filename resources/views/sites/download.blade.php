@extends('sites.sites_master')

@section('title')
    Download
@endsection

@section('content')
    <div class="col-sm-11 col-lg-9 col-xl-6 mx-auto mt-4">
        <div class="col-md-10 col-sm-12 mx-auto">
            <ul class="list-group">
                <li class="list-group-item d-flex">
                    <span class="mr-3 d-">Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis minus pariatur amet quasi commodi cum itaque molestias quibusdam sint, obcaecati corporis voluptatem iste ad, voluptas temporibus quas incidunt dolores vitae!</span>
                    <a href="{{route('pdf_download')}}" class="btn btn-primary ml-auto align-self-start">
                        <i class="fa fa-download" aria-hidden="true"></i>
                    </a>
                </li>
                <li class="list-group-item">Dapibus ac facilisis in</li>
                <li class="list-group-item">Morbi leo risus</li>
                <li class="list-group-item">Porta ac consectetur ac</li>
                <li class="list-group-item">Vestibulum at eros</li>
            </ul>
        </div>
    </div>
@endsection
