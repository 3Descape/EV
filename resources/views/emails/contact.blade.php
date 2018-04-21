{{-- @component('vendor.mail.html.message')
# {{ $greeting }}
{!! $intro !!}
<div>
    {{ $body }}
</div>


@endcomponent --}}

@extends('emails.master')

@section('content')

    <div clas="row">
        <div class="col-lg-6 col-md-10 col-sm-12 mx-auto">
            <div class="card mt-3">
                <div class="card-header">
                    {{ $name }} hat Ihnen folgendes geschrieben:
                </div>
                <div class="card-body">
                    <div class="border p-2 rounded">
                        {{$body}}

                    </div>
                </div>
                <div class="card-footer text-center">
                    EV Weiz
                </div>
            </div>

        </div>
    </div>

@endsection

