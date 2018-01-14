@extends('sites.sites_master')

@section('title')
    Veranstaltungen Archiv
@endsection

@section('content')
    <div class="col-sm-11 col-lg-9 col-xl-7 mx-auto">
        <div class="row mt-4">
            <div class="col-lg-10 col-md-12 order-2 order-lg-1">
                <h1 class="text-center">Veranstaltungen Archiv</h1>
                @foreach ($events as $event)
                    <div class="col-md-12 mx-auto mt-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    @if($event->thump_path)
                                        <div class="col-lg-2 col-md-12 event_thumb">
                                            <img src="{{asset('storage/'. $event->thump_path)}}" alt="" class="img-responsive">
                                        </div>
                                    @endif
                                    <div class="{{$event->thump_path ? 'col-lg-10 col-md-12' : 'col-lg-12'}}">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="d-flex justify-content-end">
                                                    <h3>{{ucfirst($event->name)}}</h3>
                                                    <a href="{{route('events_archive')}}?event={{$event->id}}" class="btn btn-success ml-auto align-self-start">
                                                        <i class="fa fa-arrow-right"></i> Ansehen
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mt-4 d-flex">
                                                <p class="mb-0">{{ucfirst($event->date->diffForHumans())}}</p>
                                                <span class="badge badge-info ml-auto align-self-start">
                                                    {{ ucfirst($event->category->name)}}
                                                </span>
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

            <div class="col-lg-2 col-md-12 mb-4 mb-md-0 order-1 order-lg-1">
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
@endsection
