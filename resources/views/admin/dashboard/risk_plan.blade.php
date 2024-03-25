@extends('admin.layout.app')

@section('title', 'Dashboard')

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Dashboard</span>
        </h4>
        <a href="#page_header" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
            <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
        </a>
    </div>
</div>
<div class="page-header-content d-lg-flex border-top">
    @include('admin.dashboard.include.navigation')
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Probability Base</h5>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <div class="chart has-fixed-height" id="probabilityBase"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Impact Base</h5>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <div class="chart has-fixed-height" id="impactBase"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Priority Base</h5>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <div class="chart has-fixed-height" id="priorityBase"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Level Base</h5>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <div class="chart has-fixed-height" id="levelBase"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Strategy Base</h5>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <div class="chart has-fixed-height" id="strategyBase"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Status Base</h5>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <div class="chart has-fixed-height" id="statusBase"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card card-body">
            <h6 class="fw-semibold">Project Wise Count</h6>
            <div class="list-group">
                @foreach ($projectWise as $project)
                @if($project->risk_plans_count > 0)
                <div class="list-group-item d-flex">
                    {{ $project->name }}
                    <span class="badge border border-teal text-teal rounded-pill ms-auto">
                        {{ $project->risk_plans_count }}
                    </span>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {

        var probabilityPieChart = echarts.init(document.getElementById('probabilityBase'), null, { renderer: 'svg' });
        probabilityPieChart.setOption({
            color: [
                '#F71414','#F7F714','#15D843',
                '#8d98b3','#e5cf0d','#97b552',
                '#07a2a4','#9a7fd1','#588dd5'
            ],
            textStyle: {
                fontFamily: 'var(--body-font-family)',
                color: 'var(--body-color)',
                fontSize: 12,
                lineHeight: 18,
                textBorderColor: 'transparent'
            },
            tooltip: {
                trigger: 'item',
                className: 'shadow-sm rounded',
                backgroundColor: 'var(--white)',
                borderColor: 'var(--gray-400)',
                padding: 10,
                textStyle: {color: '#000'},
                formatter: "{a} <br/>{b}: {c} ({d}%)"
            },
            legend: {
                orient: 'vertical',
                top: 'center',
                left: 0,
                data: ['High 3', 'Medium 2', 'Low 1'],
                itemHeight: 5,
                itemWidth: 5,
                textStyle: {color: 'var(--body-color)'},
                itemStyle: {borderColor: 'transparent'}
            },
            series: [{
                name: 'Probability Base',
                type: 'pie',
                radius: '40%',
                center: ['50%', '57.5%'],
                itemStyle: {borderColor: 'var(--card-bg)'},
                label: {color: 'var(--body-color)'},
                data: [
                    {value: '{{ $probabilityBase[0]}}', name: 'High 3'},
                    {value: '{{ $probabilityBase[1]}}', name: 'Medium 2'},
                    {value: '{{ $probabilityBase[2]}}', name: 'Low 1'}
                ]
            }]
        });

        var impactPieChart = echarts.init(document.getElementById('impactBase'), null, { renderer: 'svg' });
        impactPieChart.setOption({
            color: [
                '#F71414','#F7F714','#15D843',
                '#8d98b3','#e5cf0d','#97b552',
                '#07a2a4','#9a7fd1','#588dd5'
            ],
            textStyle: {
                fontFamily: 'var(--body-font-family)',
                color: 'var(--body-color)',
                fontSize: 12,
                lineHeight: 18,
                textBorderColor: 'transparent'
            },
            tooltip: {
                trigger: 'item',
                className: 'shadow-sm rounded',
                backgroundColor: 'var(--white)',
                borderColor: 'var(--gray-400)',
                padding: 10,
                textStyle: {color: '#000'},
                formatter: "{a} <br/>{b}: {c} ({d}%)"
            },
            legend: {
                orient: 'vertical',
                top: 'center',
                left: 0,
                data: ['High 3', 'Medium 2', 'Low 1'],
                itemHeight: 5,
                itemWidth: 5,
                textStyle: {color: 'var(--body-color)'},
                itemStyle: {borderColor: 'transparent'}
            },
            series: [{
                name: 'Impact Base',
                type: 'pie',
                radius: '40%',
                center: ['50%', '57.5%'],
                itemStyle: {borderColor: 'var(--card-bg)'},
                label: {color: 'var(--body-color)'},
                data: [
                    {value: '{{ $impactBase[0]}}', name: 'High 3'},
                    {value: '{{ $impactBase[1]}}', name: 'Medium 2'},
                    {value: '{{ $impactBase[2]}}', name: 'Low 1'}
                ]
            }]
        });

        var priorityPieChart = echarts.init(document.getElementById('priorityBase'), null, { renderer: 'svg' });
        priorityPieChart.setOption({
            color: [
                '#2ec7c9','#b6a2de','#5ab1ef',
                '#8d98b3','#e5cf0d','#97b552',
                '#07a2a4','#9a7fd1','#588dd5'
            ],
            textStyle: {
                fontFamily: 'var(--body-font-family)',
                color: 'var(--body-color)',
                fontSize: 12,
                lineHeight: 18,
                textBorderColor: 'transparent'
            },
            tooltip: {
                trigger: 'item',
                className: 'shadow-sm rounded',
                backgroundColor: 'var(--white)',
                borderColor: 'var(--gray-400)',
                padding: 10,
                textStyle: {color: '#000'},
                formatter: "{a} <br/>{b}: {c} ({d}%)"
            },
            legend: {
                orient: 'vertical',
                top: 'center',
                left: 0,
                data: ['1', '2', '3'],
                itemHeight: 5,
                itemWidth: 5,
                textStyle: {color: 'var(--body-color)'},
                itemStyle: {borderColor: 'transparent'}
            },
            series: [{
                name: 'Priority Base',
                type: 'pie',
                radius: '40%',
                center: ['50%', '57.5%'],
                itemStyle: {borderColor: 'var(--card-bg)'},
                label: {color: 'var(--body-color)'},
                data: [
                    {value: '{{ $priorityBase[0]}}', name: '1'},
                    {value: '{{ $priorityBase[1]}}', name: '2'},
                    {value: '{{ $priorityBase[2]}}', name: '3'}
                ]
            }]
        });

        var levelPieChart = echarts.init(document.getElementById('levelBase'), null, { renderer: 'svg' });
        levelPieChart.setOption({
            color: [
                '#F71414','#FA6C75','#F7F714','#15D843'
            ],
            textStyle: {
                fontFamily: 'var(--body-font-family)',
                color: 'var(--body-color)',
                fontSize: 12,
                lineHeight: 18,
                textBorderColor: 'transparent'
            },
            tooltip: {
                trigger: 'item',
                className: 'shadow-sm rounded',
                backgroundColor: 'var(--white)',
                borderColor: 'var(--gray-400)',
                padding: 10,
                textStyle: {color: '#000'},
                formatter: "{a} <br/>{b}: {c} ({d}%)"
            },
            legend: {
                orient: 'vertical',
                top: 'center',
                left: 0,
                data: ['9', '6', '3', '2'],
                itemHeight: 5,
                itemWidth: 5,
                textStyle: {color: 'var(--body-color)'},
                itemStyle: {borderColor: 'transparent'}
            },
            series: [{
                name: 'Priority Base',
                type: 'pie',
                radius: '40%',
                center: ['50%', '57.5%'],
                itemStyle: {borderColor: 'var(--card-bg)'},
                label: {color: 'var(--body-color)'},
                data: [
                    {value: '{{ $levelBase[0]}}', name: '9'},
                    {value: '{{ $levelBase[1]}}', name: '6'},
                    {value: '{{ $levelBase[2]}}', name: '3'},
                    {value: '{{ $levelBase[3]}}', name: '2'}
                ]
            }]
        });

        var strategyPieChart = echarts.init(document.getElementById('strategyBase'), null, { renderer: 'svg' });
        strategyPieChart.setOption({
            color: [
                '#F71414','#FA6C75','#F7F714','#15D843'
            ],
            textStyle: {
                fontFamily: 'var(--body-font-family)',
                color: 'var(--body-color)',
                fontSize: 12,
                lineHeight: 18,
                textBorderColor: 'transparent'
            },
            tooltip: {
                trigger: 'item',
                className: 'shadow-sm rounded',
                backgroundColor: 'var(--white)',
                borderColor: 'var(--gray-400)',
                padding: 10,
                textStyle: {color: '#000'},
                formatter: "{a} <br/>{b}: {c} ({d}%)"
            },
            legend: {
                orient: 'vertical',
                top: 'center',
                left: 0,
                data: ['Avoid', 'Mitigate', 'Transfer', 'Accepted'],
                itemHeight: 5,
                itemWidth: 5,
                textStyle: {color: 'var(--body-color)'},
                itemStyle: {borderColor: 'transparent'}
            },
            series: [{
                name: 'Strategy Base',
                type: 'pie',
                radius: '40%',
                center: ['50%', '57.5%'],
                itemStyle: {borderColor: 'var(--card-bg)'},
                label: {color: 'var(--body-color)'},
                data: [
                    {value: '{{ $strategyBase[0]}}', name: 'Avoid'},
                    {value: '{{ $strategyBase[1]}}', name: 'Mitigate'},
                    {value: '{{ $strategyBase[2]}}', name: 'Transfer'},
                    {value: '{{ $strategyBase[3]}}', name: 'Accepted'}
                ]
            }]
        });

        var statusPieChart = echarts.init(document.getElementById('statusBase'), null, { renderer: 'svg' });
        statusPieChart.setOption({
            color: [
                '#2ec7c9','#b6a2de','#5ab1ef',
                '#8d98b3','#e5cf0d','#97b552',
                '#07a2a4','#9a7fd1','#588dd5'
            ],
            textStyle: {
                fontFamily: 'var(--body-font-family)',
                color: 'var(--body-color)',
                fontSize: 12,
                lineHeight: 18,
                textBorderColor: 'transparent'
            },
            tooltip: {
                trigger: 'item',
                className: 'shadow-sm rounded',
                backgroundColor: 'var(--white)',
                borderColor: 'var(--gray-400)',
                padding: 10,
                textStyle: {color: '#000'},
                formatter: "{a} <br/>{b}: {c} ({d}%)"
            },
            legend: {
                orient: 'vertical',
                top: 'center',
                left: 0,
                data: ['Started', 'Open', 'Closed'],
                itemHeight: 5,
                itemWidth: 5,
                textStyle: {color: 'var(--body-color)'},
                itemStyle: {borderColor: 'transparent'}
            },
            series: [{
                name: 'Status Base',
                type: 'pie',
                radius: '40%',
                center: ['50%', '57.5%'],
                itemStyle: {borderColor: 'var(--card-bg)'},
                label: {color: 'var(--body-color)'},
                data: [
                    {value: '{{ $statusBase[0]}}', name: 'Started'},
                    {value: '{{ $statusBase[1]}}', name: 'Open'},
                    {value: '{{ $statusBase[2]}}', name: 'Closed'}
                ]
            }]
        });
        

        var triggerChartResize = function() {
            pie_basic_element && pie_basic.resize();
        };
        // On sidebar width change
        var sidebarToggle = document.querySelectorAll('.sidebar-control');
        if (sidebarToggle) {
            sidebarToggle.forEach(function(togglers) {
                togglers.addEventListener('click', triggerChartResize);
            });
        }
        // On window resize
        var resizeCharts;
        window.addEventListener('resize', function() {
            clearTimeout(resizeCharts);
            resizeCharts = setTimeout(function () {
                triggerChartResize();
            }, 200);
        });
    });
</script>
@endsection