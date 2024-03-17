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
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Stage Wise Projects</h5>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <div class="chart" id="d3-bar-vertical"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="card card-body">
            <h6 class="fw-semibold">Category Wise Projects</h6>
            @foreach($categoriesData as $category)
            <div class="progress">
                <div class="progress-bar bg-teal" style="width: {{ $category['percentage'] }}%" aria-valuenow="{{ $category['percentage'] }}" aria-valuemin="0" aria-valuemax="100">{{ $category['category_name'].'('.$category['projects_count'].')' }}</div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card card-body">
            <h6 class="fw-semibold">Province Wise Projects</h6>
            <div class="list-group">
                @foreach ($provinces as $province)
                @if($province->projects_count > 0)
                <div class="list-group-item d-flex">
                    {{ $province->title }}
                    <span class="badge border border-teal text-teal rounded-pill ms-auto">
                        {{ $province->projects_count }}
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
<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function() {
    var rawData = @json($projectsCountByStage);
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

                var x = d3.scale.ordinal().rangeRoundBands([0, width], .4, .5);

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
                    .text("Stage Wise Count");

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