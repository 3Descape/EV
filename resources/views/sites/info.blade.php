@extends('sites.sites_master')

@section('title')
    Info
@endsection

@section('content')
    <div class="col-sm-11 mx-auto">
        @foreach ($texts as $text)
            <div class="col-md-6 col-sm-12 mx-auto text-block" id="{{str_slug($text->title, "-")}}">
                <h1 class="text-center">{{$text->title}}</h1>
                <p>{!!$text->html!!}</p>
            </div>
        @endforeach

        <div class="col-sm-11 col-lg-9 col-xl-6 mx-auto text-block" id="ferien">
            <h1 class="text-center">Ferien und schulautonome Tage</h1>
            <div class="row">
                <div class="col-md-12">
                    <h3>Ferien:</h3>
                    <table class="table">
                        <tbody>
                            @foreach ($schulfrei as $frei)
                                <tr>
                                    <td>{{$frei->name}}</td>
                                    <td>{{$frei->date}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    <h3>Schulautonome Tage:</h3>
                    <table class="table">
                        <tbody>
                            @foreach ($autonom as $frei)
                                <tr>
                                    <td>{{$frei->name}}</td>
                                    <td>{{$frei->date}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection
