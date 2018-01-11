@extends('admin.layouts.sitebar')

@section('header')
    <link rel="stylesheet" href="{{asset('/css/tempusdominus-bootstrap-4.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('/css/dropzone.min.css')}}"/>
@endsection
@section('sitebar_inner')
<div class="col-lg-10 col-sm-12 col-md-12 mx-auto">

    <event-edit :event-prop="{{$event}}" :categories="{{$categories}}"></event-edit>

    <div>
        {{--  @if (request('type')=='archive')
            <form action="{{route('admin_events_store_image', $event->id)}}" class="dropzone">
                {{ csrf_field() }}
            </form>

            @if($event->images->count())
                <div class="row col-md-9 col-lg-10 col-xl-11 mx-auto mt-2">
                    @foreach ($event->images as $image)
                        <div class="thumbnail">
                            <img src="{{asset('storage/'.$image->path)}}">
                            <form action="{{route('image_delete', [$image->id])}}" method="POST">
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
        @endif  --}}
    </div>
</div>
@endsection

@section('footer')
    {{--  <script src="{{asset('/js/dropzone.js')}}"></script>  --}}

    {{--  <script type="text/javascript">
    $(function () {
        $('#datetimepicker1').datetimepicker({
            locale : 'de',
            useCurrent: true,
        });
        $('#field').val('{{old('date')}}');
    });
    </script>  --}}
@endsection
