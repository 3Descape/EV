@extends('master')

@section('title')
    Home
@endsection

@section('content')
    <div class="container-fluid" id="header">
        <div>
            <div class="header">
                <div class="image">
                    <div></div>
                </div>
                <div class="content d-flex align-items-center">
                    <div class="col-md-12">
                        <h1 class="text-center">
                            <span>Der Elternverein des BG/BRG Weiz</span>
                        </h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid" id="featured">
            <div class="row">
                <div class="col-sm-11 col-xl-9 mx-auto row">
                    <div class="col-lg-6">
                        <h1>Kommende Veranstaltungen:</h1>
                        @foreach ($future_events as $event)
                            <div class="card">
                                <div class="card-body">
                                    <h4>{{$event->name}}</h4>
                                    <div class="text-muted">
                                        Am {{$event->date->formatLocalized('%A') ." dem ".
                                            $event->date->formatLocalized('%#d %B') .', '.
                                            $event->location}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-lg-6 mt-4 mt-lg-0">
                        <h1>Vergangene Veranstaltungen:</h1>
                        @foreach ($past_events as $event)
                            <div class="card">
                                <div class="card-body row">
                                    <div class="col-md-8 col-sm-8 col-8">
                                        <div class="col-md-12">
                                            <h4>{{$event->name}}</h4>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="text-muted">
                                                {{ucfirst($event->date->diffForHumans())}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-sm-4 col-4">
                                        <a href="{{route('events_archive')}}?event={{$event->id}}"
                                            class="btn btn-success float-right">
                                            <i class="fas fa-arrow-right"></i> Ansehen
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid" id="download">
            <div class="col-md-9 mx-auto row" id="download">
                <div class="col-md-12">
                    <h1 class="text-center">Förderansuchen und Downloads:</h1>
                </div>
                <div class="card col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{route('downloads_view')}}" class="btn btn-info mt-sm-4 mt-md-0">
                                <i class="fa fa-download"></i> Downloads
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="social-media">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-10 mx-auto">
                        <div class="row">
                            {{-- <div class="col-lg-3 col-md-6 col-sm-12">
                                <a href="#">
                                    <i class="fab fa-youtube-square" aria-hidden="true"></i> YouTube
                                </a>
                            </div>

                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <a href="#">
                                    <i class="fab fa-twitter-square" aria-hidden="true"></i> Twitter
                                </a>
                            </div>

                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <a href="#">
                                    <i class="fab fa-facebook-square" aria-hidden="true"></i> Facebook
                                </a>
                            </div> --}}

                            <div class="col-lg-12 col-md-12 col-sm-12 media-link">
                                <a href="https://www.bgweiz.at">
                                    <i class="fas fa-graduation-cap" aria-hidden="true"></i> BG Weiz
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
