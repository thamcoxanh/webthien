@extends('layouts.admin')

@section('content')

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2>Thống kê các tuần trong năm {{ $title_year }}</h2>
        </div>
        <div class="body">
            <div id="bar_chart" class="graph"></div>
        </div>
    </div>
    <div class="card">
        <div class="header">
            <h2>Thống kê các tháng trong năm {{ $title_year }}</h2>

        </div>
        <div class="body">
            <div id="bar_chart_month" class="graph"></div>
        </div>
    </div>
    <div class="card">
        <div class="header">
            <h2>Thống kê các tuần trong năm {{ $title_year_old }}</h2>

        </div>
        <div class="body">
            <div id="bar_chart_old" class="graph"></div>
        </div>
    </div>
    <div class="card">
        <div class="header">
            <h2>Thống kê các tháng trong năm {{ $title_year }}</h2>

        </div>
        <div class="body">
            <div id="bar_chart_month_old" class="graph"></div>
        </div>
    </div>
</div>
<script>
$(function () {
    Morris.Bar({
        element: 'bar_chart',
        data: [
            @foreach($year as $p)
            {
                x: 'Tuần {{$p["week"]}} : {{$p["week_start"]}} - {{$p["week_end"]}}',
                y: '{{$p["price"]}}',
            },
            @endforeach

        ],
        xkey: 'x',
        ykeys: ['y'],
        labels: ['Y'],
        barColors: ['rgb(233, 30, 99)', 'rgb(0, 188, 212)', 'rgb(0, 150, 136)'],
    });

    Morris.Bar({
        element: 'bar_chart_old',
        data: [
            @foreach($year_old as $p)
            {
                x: 'Tuần {{$p["week"]}} : {{$p["week_start"]}} - {{$p["week_end"]}}',
                y: '{{$p["price"]}}',
            },
            @endforeach

        ],
        xkey: 'x',
        ykeys: ['y'],
        labels: ['Y'],
        barColors: ['rgb(233, 30, 99)', 'rgb(0, 188, 212)', 'rgb(0, 150, 136)'],
    });

    Morris.Bar({
        element: 'bar_chart_month',
        data: [
            @foreach($month_year as $p)
            {
                x: 'Tháng {{$p["month"]}} : {{$p["week_start"]}} - {{$p["week_end"]}}',
                y: '{{$p["price"]}}',
            },
            @endforeach

        ],
        xkey: 'x',
        ykeys: ['y'],
        labels: ['Y'],
        barColors: ['rgb(233, 30, 99)', 'rgb(0, 188, 212)', 'rgb(0, 150, 136)'],
    });
    Morris.Bar({
        element: 'bar_chart_month_old',
        data: [
            @foreach($month_year_old as $p)
            {
                x: 'Tháng {{$p["month"]}} : {{$p["week_start"]}} - {{$p["week_end"]}}',
                y: '{{$p["price"]}}',
            },
            @endforeach

        ],
        xkey: 'x',
        ykeys: ['y'],
        labels: ['Y'],
        barColors: ['rgb(233, 30, 99)', 'rgb(0, 188, 212)', 'rgb(0, 150, 136)'],
    });
});



</script>

@endsection
