@extends('emails.master')

@section('content')
<div>
    <div class="card mx-auto">
        <div class="card-header px-2 py-2">
            {{ $name }} hat Ihnen folgendes geschrieben:
        </div>
        <div class="card-body px-2 py-2">
            <div class="border">
                {!! $body !!}
            </div>
        </div>
        <div class="card-footer px-2 text-center">
            EV Weiz
        </div>
    </div>
</div>

@endsection

