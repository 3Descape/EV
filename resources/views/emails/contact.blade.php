@extends('emails.master')

@section('content')
<div>
        <div class="header bg-dark text-green">
            <div class="container mx-auto py-3 font-bold">
                {{ $name }} hat Ihnen folgendes geschrieben:
            </div>
        </div>
        <div class="container mx-auto py-3 border my-3 px-2">
                {!! $body !!}
        </div>
        <div class="bg-dark text-green py-2">
            <div class="container mx-auto text-center font-bold">
                <a href="{{route('home')}}" class="no-underline text-green">EV Weiz</a>
            </div>
        </div>
    </div>
</div>

@endsection

