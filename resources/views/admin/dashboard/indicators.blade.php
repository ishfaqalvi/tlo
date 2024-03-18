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
            {{ Form::select('project_id', projects(), $selectedProject, ['class' => 'form-control select','placeholder' => '--Select Project--','id'=>'indicatorProject']) }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Status wise Indicator Count</h5>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <div class="chart" id="d3-bar-vertical"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-body">
        <h6 class="fw-semibold">Actual VS Target</h6>
        @foreach($indicators as $indicator)
            @if($indicator->format != 'Qualitative Only')
            <div class="row">
                <div class="col-sm-6">
                    {{ $indicator->name }}
                </div>
                <div class="col-sm-6">
                    @if($indicator->aggregated !='Yes')
                        @php($data = getIndicatorActualVsTarget($indicator))
                        {{ $data['stat'] }} 
                        <div class="progress">
                            <div class="progress-bar bg-teal" style="width: {{ $data['percentage'] }}%" aria-valuenow="{{ $data['percentage'] }}" aria-valuemin="0" aria-valuemax="100">{{ $data['percentage'] }}% complete</div>
                        </div>
                    @endif
                    @if($indicator->aggregated =='Yes')
                        @php($data = calculateAggregatedTarget($indicator))
                        {{ $data['stat'] }} 
                        <div class="progress">
                            <div class="progress-bar bg-teal" style="width: {{ $data['percentage'] }}%" aria-valuenow="{{ $data['percentage'] }}" aria-valuemin="0" aria-valuemax="100">{{ $data['percentage'] }}% complete</div>
                        </div>
                    @endif
                </div>
            </div>
            @endif
        @endforeach
    </div>
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Date Wise Data Collection</h5>
        </div>
        <div class="table-responsive">
            <table class="table text-nowrap">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Collected Data</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($dataindicators as $indicator)
                <tr class="table-light">
                    <td colspan="7" class="fw-semibold">{{ $indicator->name }}</td>
                </tr>
                    @foreach(
                        $indicator->dataCollections()
                            ->orderBy('date', 'asc')
                            ->get()
                            ->groupBy('date') as $date => $collection)
                    <tr>
                        <td>{{ date('d M Y',$date) }}</td>
                        <td>
                            {{ $collection->sum('collected_value') }}
                        </td>
                    </tr>
                    @endforeach
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $(function () {
        $('.select').select2();
        var _token = $("input[name='_token']").val(); 

        function handleChange(url, dropdownId) {
            var id = $(dropdownId).val();
            $.ajax({
                url: url,
                type: 'POST',
                data: { id: id, _token: _token, type: 'Indicator'},
                success: function(response) {
                    window.location.href = "{{ route('dashboard.indicators') }}";
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

        $('#indicatorProject').on('change', function() {
            handleChange("{{ route('dashboard.setProject') }}", '#indicatorProject');
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        var rawData = @json($statusCounts);
        var data = Object.keys(rawData).map(function(key) {
            return { letter: key, frequency: rawData[key] };
        });
        var D3BarVertical = function() {
            if (typeof d3 == 'undefined') {
                console.warn('Warning - d3.min.js is not loaded.');
                return;
            }
            var element = document.getElementById('d3-bar-vertical'),
                height = 400;
                if(element) {
                    var d3Container = d3.select(element),
                        margin = {top: 5, right: 10, bottom: 20, left: 40},
                        width = d3Container.node().getBoundingClientRect().width - margin.left - margin.right,
                        height = height - margin.top - margin.bottom - 5;

                    var x = d3.scale.ordinal().rangeRoundBands([0, width], .7, .5);

                    var y = d3.scale.linear().range([height, 0]);

                    var color = d3.scale.category20c();

                    var xAxis = d3.svg.axis().scale(x).orient("bottom");

                    var yAxis = d3.svg.axis().scale(y).orient("left").ticks(10);

                    var container = d3Container.append("svg");

                    var svg = container
                        .attr("width", width + margin.left + margin.right)
                        .attr("height", height + margin.top + margin.bottom)
                        .append("g").attr("transform", "translate(" + margin.left + "," + margin.top + ")");

                    x.domain(data.map(function(d) { return d.letter; }));
                    y.domain([0, d3.max(data, function(d) { return d.frequency; })]);

                    svg.append("g")
                        .attr("class", "d3-axis d3-axis-horizontal")
                        .attr("transform", "translate(0," + height + ")")
                        .call(xAxis);

                    var verticalAxis = svg.append("g").attr("class", "d3-axis d3-axis-vertical").call(yAxis);

                    verticalAxis.append("text")
                        .attr("class", "d3-axis-title")
                        .attr("transform", "rotate(-90)")
                        .attr("y", 10)
                        .attr("dy", ".71em")
                        .style("text-anchor", "end")
                        .text("Status Wise Count");

                    svg.selectAll(".d3-bar")
                        .data(data)
                        .enter()
                        .append("rect")
                            .attr("class", "d3-bar")
                            .attr("x", function(d) { return x(d.letter); })
                            .attr("width", x.rangeBand())
                            .attr("y", function(d) { return y(d.frequency); })
                            .attr("height", function(d) { return height - y(d.frequency); })
                            .style("fill", function(d) { return color(d.letter); });
                }
            };
        D3BarVertical();
    });
</script>
@endsection