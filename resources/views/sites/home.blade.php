@extends('master')

@section('title')
    Home
@endsection

@section('content')
<div class="container-fluid">@include('layouts.menu')</div>
<div class="container-fluid page-content" id="home_t">

    <div>
        <div class="start_image">
        </div>

        <div class="content">
            <div class="col-md-12">
                <h1 class="text-center"><span>Der Elternverein des BG/BRG Weiz</span></h1>

            </div>
        </div>
    </div>



    <div class="container-fluid" id="featured">
        <div class="row">
            <div class="col-md-9 mx-auto row">
                <div class="col-md-6">
                    <h1>News:</h1>

                    <div class="card">
                        <div class="card-block">
                            Some news in here
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mt-4">
                    <h1>Featured:</h1>

                    <div class="card">
                        <div class="card-block">
                            This is some text within a card block.
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-block">
                            This is some text within a card block.
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-block">
                            This is some text within a card block.
                        </div>
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
                        <div class="col-md-3 col-sm-12"><a href=""><i class="fa fa-youtube-play" aria-hidden="true"></i> YouTube</a></div>
                        <div class="col-md-3 col-sm-12"><a href=""><i class="fa fa-twitter-square" aria-hidden="true"></i> Twitter</a></div>
                        <div class="col-md-3 col-sm-12"><a href=""><i class="fa fa-facebook-official" aria-hidden="true"></i> Facebook</a></div>
                        <div class="col-md-3 col-sm-12"><a href=""><i class="fa fa-graduation-cap" aria-hidden="true"></i> BG Weiz</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>





@endsection
{{-- @section('content')
<div class="col-md-10 col-sm-12 mx-auto mt-2">
<div class="container-fluid" id="home">
<h1 class="text-center">Elternverein Weiz</h1>
</div>

<div class="mt-4" id="quicklinks">
<div class="card-deck text-center">

<div class="card">
<div class="card-block">
<h4 class="card-title">Über uns</h4>
<p class="card-text">Seit vielen Jahren engagieren wir uns für die Schüler des BG/BRG Weiz. Zahlreiche Mitglieder helfen uns dabei Ehrenamtlich. Lernen Sie sie kennen!</p>
</div>
<div class="card-footer">
<a href="{{ route('about') }}" class="btn btn-primary">Erfahren Sie mehr über uns!</a>
</div>
</div>

<div class="card">
<div class="card-block">
<h4 class="card-title">Veranstaltungen</h4>
<p class="card-text">Besuchen Sie uns auf einer unserer nächsten Veranstaltungen!</p>
</div>
<div class="card-footer">
<a href="{{ route('events') }}" class="btn btn-primary">Zu den Veranstaltungen!</a>
</div>
</div>

<div>
</div>



<div class="col-md-12" id="social_media">
<h2 class="text-center">Folge uns auf:</h2>
<div class="row">
<div class="col-sm-3 col-xs-12 text-center wrapper" id="facebook"><a href=""><i class="fa fa-facebook-official fa-2x" aria-hidden="true"> Facebook</i></a></div>
<div class="col-sm-3 col-xs-12 text-center wrapper" id="youtube"><a href=""><i class="fa fa-youtube-play fa-2x" aria-hidden="true"> YouTube</i></a></div>
<div class="col-sm-3 col-xs-12 text-center wrapper" id="twitter"><a href=""><i class="fa fa-twitter-square fa-2x" aria-hidden="true"> Twitter</i></a></div>
<div class="col-sm-3 col-xs-12 text-center wrapper" id="bgweiz"><a href=""><i class="fa fa-2x" aria-hidden="true"> BGWeiz</i></a></div>
</div>
</div>
</div>
@endsection --}}
