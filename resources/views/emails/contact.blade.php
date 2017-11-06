@component('vendor.mail.html.message')
# {{ $greeting }}
{!! $intro !!}
<div>
    {{ $body }}
</div>


@endcomponent
