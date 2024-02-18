@extends('admin.layout.app')

@section('title')
    Project Budget
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Project Budget Management</span>
        </h4>
    </div>
</div>
<div class="page-header-content d-lg-flex border-top">
    @include('admin.projects.navigation')
</div>
@endsection

@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Project Budget</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-9">
                    <div class="chart-container">
                        <div class="chart has-fixed-height" id="pie_basic"></div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group mb-3">
                        <strong>Total Budget:</strong>
                        {{ number_format($data['total']) }}
                    </div>
                    <div class="form-group mb-3">
                        <strong>Spent Amount:</strong>
                        {{ number_format($data['spent']) }}
                    </div>
                    <div class="form-group mb-3">
                        <strong>Remaining Budget:</strong>
                        {{ number_format($data['remaining']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    var EchartsPieBasicLight = function() {
        var _scatterPieBasicLightExample = function() {
        
            var pie_basic_element = document.getElementById('pie_basic');

            var pie_basic = echarts.init(pie_basic_element, null, { renderer: 'svg' });

            pie_basic.setOption({
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
                // Add tooltip
                tooltip: {
                    trigger: 'item',
                    className: 'shadow-sm rounded',
                    backgroundColor: 'var(--white)',
                    borderColor: 'var(--gray-400)',
                    padding: 15,
                    textStyle: {color: '#000'},
                    formatter: "{a} <br/>{b}: {c} ({d}%)"
                },
                // Add legend
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
                // Add series
                series: [{
                    name: 'Budget',
                    type: 'pie',
                    radius: '70%',
                    center: ['50%', '57.5%'],
                    itemStyle: {borderColor: 'var(--card-bg)'},
                    label: {color: 'var(--body-color)'},
                    data: [
                        {value: "{{ $data['total'] }}", name: 'Total Budget'},
                        {value: "{{ $data['spent'] }}", name: 'Spent Amount'},
                        {value: "{{ $data['remaining'] }}", name: 'Remaining Budget'}
                    ]
                }]
            });
            // Resize function
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
        };

        return {
            init: function() {
                _scatterPieBasicLightExample();
            }
        }
    }();
    document.addEventListener('DOMContentLoaded', function() {
        EchartsPieBasicLight.init();
    });
</script>
@endsection