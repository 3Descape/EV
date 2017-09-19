@extends('admin.layouts.sitebar')


@section('sitebar_inner')
<div class="row">
    <div class="col-md-12">
        {{-- :init-data="{{json_encode(array_values($dates))}}" :init-labels="{{json_encode(array_keys($dates))}} --}}
        <dashboard></dashboard>
    </div>
</div>
@endsection

@section('footer')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script> --}}
{{-- <script>
    var ctx = document.getElementById("myChart").getContext("2d");
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [
            @foreach ($dates as $key => $value)
                {!!json_encode($key)!!},
            @endforeach
            ],
            datasets: [{
                label: 'Seitenbesuche pro Tag',
                data: [
                    @foreach ($dates as $key => $value)
                        {{$value}},
                    @endforeach
                ],
                borderWidth: 1,
                lineTension: 0,
            }],
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        callback: function(value) {
                            if (value % 1 === 0) {return value;}
                        },
                        suggestedMax: 10,
                    }
                }]
            }
        }
    });
    </script> --}}
@endsection
