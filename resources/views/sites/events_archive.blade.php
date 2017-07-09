@extends('master')

@section('title')
    Veranstaltungen Archiv
@endsection

@section('content')
    <div class="container-fluid menu">@include('layouts.menu')</div>

    <div>
        <div class="col-md-9 mx-auto bg-wrp">
            <div class="row">
                <div class="col-md-10 col-sm-12 push-md-1">
                    <h1 class="text-center">Veranstaltungen</h1>
                    @foreach ($events as $event)
                        <div class="col-md-12 mx-auto mt-4">
                            <div class="card">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h3 class="card-title">{{ucfirst($event->name)}}</h3>
                                                    <p class="card-text">{{$event->description}}</p>
                                                </div>
                                                <div class="col-md-12 mt-4">
                                                    <h4 class="card-title">Wo und Wann?</h4>
                                                    <p class="card-text">{{ucfirst($event->date->diffForHumans()) . ' ' . $event->location}}</p>
                                                    <span class="badge badge-info float-right">{{ ucfirst($event->category)}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{ $events->links('layouts.paginator') }}
                </div>

                <div class="col-md-2 col-sm-12 push-md-1 mb-4 mb-md-0 flex-first flex-md-unordered">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row" role="group">
                                <div class="col-md-12">
                                    <label for="event_select">Filter:</label>
                                </div>
                                <div class="col-md-12">
                                    <button id="event_select" type="button" class="btn btn-secondary btn-block dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{$text}}
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="event_select">
                                        <a class="dropdown-item" href="{{route('events_archive')}}">Alle</a>
                                        <a class="dropdown-item" href="{{route('events_archive', 'bälle')}}">Bälle</a>
                                        <a class="dropdown-item" href="{{route('events_archive', 'sport')}}">Sport</a>
                                        <a class="dropdown-item" href="{{route('events_archive', 'sonstige')}}">Sonstige</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mt-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <a class="btn btn-success btn-block" href="{{route('events')}}">
                                        <i class="fa fa-arrow-right"></i> Veranstaltungen
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
