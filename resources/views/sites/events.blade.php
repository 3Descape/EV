@extends('sites.sites_master')

@section('title')
    Veranstaltungen
@endsection

@section('content')
    <div class="col-sm-11 col-lg-9 col-xl-7 mx-auto">
        <div class="row mt-4">
            <div class="col-lg-10 col-md-12 order-2 order-lg-1">
                <h1 class="text-center">Kommende Veranstaltungen</h1>
                @foreach ($events as $event)
                    <div class="col-md-12 mx-auto mt-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h3 class="card-title">{{ucfirst($event->name)}}</h3>
                                                <p class="card-text">{!!$event->html!!}</p>
                                            </div>
                                            <div class="col-md-12 mt-4">
                                                <h4>Wo und Wann?</h4>
                                                <div class="d-flex">
                                                    <p class="mb-0 mr-2">Am {{$event->date->formatLocalized('%#d %B %Y') . ' ' . $event->location}}</p>
                                                    <span class="badge badge-info ml-auto align-self-end">{{ ucfirst($event->category->name)}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @if($events->count())
                    {{ $events->links('layouts.paginator')}}
                @else
                    <p class="mt-4 text-center">Es gibt leider keine Veranstaltungen in dieser Kategorie.</p>
                @endif
            </div>

            <div class="col-lg-2 col-md-12 mb-2 mb-lg-0 order-1 order-lg-1">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row" role="group">
                            <div class="col-md-12">
                                <label for="event_select">Kategorie:</label>
                            </div>
                            <div class="col-md-12">
                                <button id="event_select" type="button" class="btn btn-primary btn-block dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{$text}}
                                </button>
                                <div class="dropdown-menu" aria-labelledby="event_select">
                                    <a class="dropdown-item" href="{{route('events')}}">Alle</a>
                                    @foreach ($categories as $category)
                                        <a class="dropdown-item" href="{{route('events', mb_strtolower($category->name))}}">
                                            {{ucfirst($category->name)}}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <div class="row">
                            <div class="col-md-12">
                                <a class="btn btn-block btn-success" href="{{route('events_archive')}}">
                                    <i class="fa fa-arrow-right"></i> Archiv
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
