@extends('master')

@section('title')
    Info
@endsection

@section('content')
    <div class="container-fluid menu">@include('layouts.menu')</div>
    <div>
        <div class="col-md-10 mx-auto bg-wrp space">
            @foreach ($texts as $text)
                <div class="col-md-6 col-sm-12 mx-auto" id="{{$text->title}}">
                    <h1 class="text-center">{{$text->title}}</h1>
                    <p>{!!$text->text!!}</p>
                </div>
            @endforeach

            <div class="col-md-6 col-sm-12 mx-auto " id="info">
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
        </div>
    </div>
</div>
@endsection
