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
<div class="col-sm-12">
    <div class="card">
        <div class="card-body">
            {{ Form::select('project_id', projects(), $selectedProject, ['class' => 'form-control select','placeholder' => '--Select Project--','id'=>'budgetProject']) }}
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Projects Budget</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-9">
                    <div class="chart-container">
                        <div class="chart has-fixed-height" id="project_pie"></div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group mb-3">
                        <strong>Total Budget:</strong>
                        {{ number_format($projectData['total']) }}
                    </div>
                    <div class="form-group mb-3">
                        <strong>Spent Amount:</strong>
                        {{ number_format($projectData['spent']) }}
                    </div>
                    <div class="form-group mb-3">
                        <strong>Remaining Budget:</strong>
                        {{ number_format($projectData['remaining']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            {{ Form::select('activity_id', activities(), $selectedActivity, ['class' => 'form-control select','placeholder' => '--Select Activity--','id'=>'budgetActivity']) }}
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Activities Budget</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-9">
                    <div class="chart-container">
                        <div class="chart has-fixed-height" id="activity_pie"></div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group mb-3">
                        <strong>Total Budget:</strong>
                        {{ number_format($activityData['total']) }}
                    </div>
                    <div class="form-group mb-3">
                        <strong>Spent Amount:</strong>
                        {{ number_format($activityData['spent']) }}
                    </div>
                    <div class="form-group mb-3">
                        <strong>Remaining Budget:</strong>
                        {{ number_format($activityData['remaining']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(function () {
        $('.select').select2();
        var _token = $("input[name='_token']").val(); 

        function handleChange(url, dropdownId) {
            var id = $(dropdownId).val();
            $.ajax({
                url: url,
                type: 'POST',
                data: { id: id, _token: _token },
                success: function(response) {
                    window.location.href = "{{ route('dashboard.budget') }}";
                },
                error: function(xhr, status, error) {
                    new Noty({
                        layout: 'bottomCenter',
                        text: error,
                        type: 'error'
                    }).show();
                }
            });
        }

        $('#budgetProject').on('change', function() {
            handleChange("{{ route('dashboard.setProject') }}", '#budgetProject');
        });

        $('#budgetActivity').on('change', function(){
            handleChange("{{ route('dashboard.setActivity') }}", '#budgetActivity');
        }); 
    });
    function initEchartsPieBasicLight(elementId, chartData) {
        var pieElement = document.getElementById(elementId);
        if (!pieElement) return;

        var pieChart = echarts.init(pieElement, null, { renderer: 'svg' });

        pieChart.setOption({
            color: [
                '#2ec7c9','#b6a2de','#5ab1ef',
                '#8d98b3','#e5cf0d','#97b552',
                '#07a2a4','#9a7fd1','#588dd5'
            ],
            textStyle: {
                fontFamily: 'var(--body-font-family)',
                color: 'var(--body-color)',
                fontSize: 14,
                lineHeight: 22,
                textBorderColor: 'transparent'
            },
            tooltip: {
                trigger: 'item',
                className: 'shadow-sm rounded',
                backgroundColor: 'var(--white)',
                borderColor: 'var(--gray-400)',
                padding: 15,
                textStyle: {color: '#000'},
                formatter: "{a} <br/>{b}: {c} ({d}%)"
            },
            legend: {
                orient: 'vertical',
                top: 'center',
                left: 0,
                data: ['Total Budget', 'Spent Amount', 'Remaining Budget'],
                itemHeight: 8,
                itemWidth: 8,
                textStyle: {color: 'var(--body-color)'},
                itemStyle: {borderColor: 'transparent'}
            },
            series: [{
                name: 'Budget',
                type: 'pie',
                radius: '70%',
                center: ['50%', '57.5%'],
                itemStyle: {borderColor: 'var(--card-bg)'},
                label: {color: 'var(--body-color)'},
                data: [
                    {value: chartData.total, name: 'Total Budget'},
                    {value: chartData.spent, name: 'Spent Amount'},
                    {value: chartData.remaining, name: 'Remaining Budget'}
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
    }

    document.addEventListener('DOMContentLoaded', function() {
        var projectData = @json($projectData);
        var activityData = @json($activityData);

        initEchartsPieBasicLight('project_pie', projectData);
        initEchartsPieBasicLight('activity_pie', activityData);
    });
</script>
@endsection