@extends('voyager::master')

@section('page_title', 'Admin Dashboard')

@section('page_header')
<div class="container-fluid">
    <h1 class="page-title">
        <i class="voyager-home"></i> {{ __('voyager::generic.dashboard') }}
    </h1>
</div>
@stop

@section('content')
@php
$models = [
'pages' => [
'label' => 'PAGES',
'total' => \App\Models\Page::count(),
'active' => \App\Models\Page::where('status', 1)->count(),
'color' => '#10CFBD',
'icon' => 'voyager-file-text'
]
];

foreach ($models as $key => $data) {
$models[$key]['passive'] = $data['total'] - $data['active'];
}
@endphp

<div class="page-content container-fluid">
    @include('voyager::alerts')

    <div class="row">
        @foreach($models as $key => $data)
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-card-header">
                    <i class="{{ $data['icon'] }} stat-icon" style="color: {{ $data['color'] }};"></i>
                    <span class="stat-label">{{ $data['label'] }}</span>
                </div>
                <div class="stat-chart-wrapper">
                    <canvas id="chart-{{ $key }}"></canvas>
                    <div class="stat-chart-center">
                        <span class="stat-total-val">{{ $data['total'] }}</span>
                        <span class="stat-total-lbl">TOTAL</span>
                    </div>
                </div>
                <div class="stat-footer">
                    <div class="stat-footer-item bordered-right">
                        <span class="stat-val" style="color: {{ $data['color'] }};">{{ $data['active'] }}</span>
                        <span class="stat-lbl">Active</span>
                    </div>
                    <div class="stat-footer-item">
                        <span class="stat-val passive-color">{{ $data['passive'] }}</span>
                        <span class="stat-lbl">Passive</span>
                    </div>
                </div>

            </div>
        </div>
        @endforeach
    </div>
</div>
@stop

@section('javascript')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>

<script>
    var chartData = @json($models);

    Chart.defaults.global.defaultFontFamily = "'Open Sans', sans-serif";
    Chart.defaults.global.legend.display = false;

    Object.keys(chartData).forEach(function(key) {
        var data = chartData[key];
        var ctx = document.getElementById('chart-' + key).getContext('2d');

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Active', 'Passive'],
                datasets: [{
                    data: [data.active, data.passive],
                    backgroundColor: [
                        data.color,
                        '#f1f1f1'
                    ],
                    borderWidth: 0,
                    hoverBorderWidth: 4,
                    hoverBorderColor: '#fff'
                }]
            },
            options: {
                cutoutPercentage: 75,
                responsive: true,
                maintainAspectRatio: false,
                tooltips: {
                    enabled: true,
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var label = data.labels[tooltipItem.index];
                            var value = data.datasets[0].data[tooltipItem.index];
                            return ' ' + label + ': ' + value;
                        }
                    }
                }
            }
        });
    });
</script>
@stop