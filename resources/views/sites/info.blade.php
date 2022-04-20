@extends('master')

@section('title')
    Info
@endsection

@section('content')
    <div class="col-sm-11 mx-auto">
        @foreach ($sites as $site)
            <div class="col-md-6 col-sm-12 mx-md-auto mx-3 text-block" id="{{Str::slug($site->title, "-")}}">
                <h1 class="text-center">{{$site->title}}</h1>
                <p>{!! $site->text !!}</p>
            </div>
        @endforeach

        {{-- @if(!$fixturecategories->isEmpty())
            <div class="col-sm-11 col-lg-9 col-xl-6 mx-auto text-block" id="thermine">
                <h1 class="text-center">Termine</h1>
                <div class="row">
                    @foreach ($fixturecategories as $category)
                        @if(!$category->fixtures->isEmpty())
                            <div class="col-md-12 card mb-2">
                                <div class="card-body">
                                    <h3>{{$category->name}}</h3>
                                    <div class="list-group">
                                        @foreach ($category->fixtures as $fixture)
                                            <div class="list-group-item flex-column align-items-start">
                                                <div class="d-flex w-100 justify-content-between">
                                                <h4 class="mb-1">{{$fixture->name}}</h4>
                                                </div>
                                                <p class="mb-0">{{$fixture->description}}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif --}}
@endsection
