@extends('sites.sites_master')

@section('title')
    Veranstaltungen Archiv
@endsection

@section('content')
    <div class="col-sm-11 col-lg-9 col-xl-7 mx-auto">
        <div class="row mt-5">
            <div class="col-lg-10 col-md-12 order-2 order-lg-1">
                <h1 class="text-center">Veranstaltungen Archiv</h1>
                @foreach ($events as $event)
                    <div class="col-md-12 mx-auto mt-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1 d-flex">
                                        <div>
                                            <h3>{{ucfirst($event->name)}}</h3>
                                        </div>
                                    </div>
                                    <a href="{{route('events_archive')}}?event={{$event->id}}" class="btn btn-success align-self-start">
                                        <i class="fa fa-arrow-right"></i> Ansehen
                                    </a> 
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex">
                                        <p class="mb-0">{{ucfirst($event->date->diffForHumans())}}</p>
                                        <span class="badge badge-info align-self-center ml-auto">
                                            {{ ucfirst($event->category->name)}}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{ $events->links('layouts.paginator') }}
            </div>

            <div class="col-lg-2 col-md-12 mb-4 mb-lg-0 order-1 order-lg-1">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row" role="group">
                            <div class="col-md-12">
                                <label for="event_select">Filter:</label>
                            </div>
                            <div class="col-md-12">
                                <button id="event_select" type="button" class="btn btn-primary btn-block dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{$text}}
                                </button>
                                <div class="dropdown-menu" aria-labelledby="event_select">
                                    <a class="dropdown-item" href="{{route('events_archive')}}">Alle</a>
                                    @foreach ($categories as $category)
                                        <a class="dropdown-item" href="{{route('events_archive', mb_strtolower($category->name))}}">
                                            {{ucfirst($category->name)}}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
