@extends('admin.layouts.sitebar')

@section('header')
    <link rel="stylesheet" href="{{asset('/css/tempusdominus-bootstrap-4.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('/css/dropzone.min.css')}}"/>
@endsection
@section('sitebar_inner')
<div class="col-md-10 mx-auto">

    <event-edit :event-prop="{{$event}}" :categories="{{$categories}}"></event-edit>

    <div>
        @if (request('type')=='archive')
            <form action="{{route('admin_events_store_image', $event->id)}}" class="dropzone col-md-10 mx-auto">
                {{ csrf_field() }}
            </form>

            @if($event->images->count())
                <div class="row col-md-10 mx-auto">
                    @foreach ($event->images as $image)
                        <div class="thumbnail">
                            <img src="{{asset($image->path)}}">
                            <form action="{{route('admin_events_destroy_image', [$event->id, $image->id])}}" method="POST">
                                <div class="d-flex justify-content-center align-items-center">
                                    <button class=""><i class="fa fa-times fa-2x"></i></button>
                                </div>
                                {{method_field('DELETE')}}
                                {{ csrf_field() }}
                            </form>
                        </div>
                    @endforeach
                </div>
            @endif
        @endif
    </div>
</div>
@endsection

@section('footer')
    <script src="{{asset('/js/moment.min.js')}}"></script>
    <script src="{{asset('/js/de.js')}}"></script>
    <script src="{{asset('/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <script src="{{asset('/js/dropzone.js')}}"></script>

    <script type="text/javascript">
    $(function () {
        moment().locale('de')
        $('#datetimepicker1').datetimepicker({
            locale : 'de',
            useCurrent: true,
        });
        $('#field').val('{{old('date')}}');
    });
    </script>
@endsection
