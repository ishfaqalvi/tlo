@extends('admin.layout.app')

@section('title')
    Indicator
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Indicator Management</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <button class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill me-2 collapsed" data-bs-toggle="collapse" data-bs-target="#filters" aria-expanded="true">
                <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                    <i class="ph-funnel"></i>
                </span>
                Filter
            </button>
            @can('indicators-create')
            <a href="{{ route('indicators.create') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
                <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                    <i class="ph-plus"></i>
                </span>
                Add Indicator
            </a>
            @endcan
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="col-sm-12">
    <div class="card collapse {{ !is_null($userRequest) ? 'show' : ''}}" id="filters">
        <div class="card-body">
            <form action="{{route('indicators.filter')}}" method="post">
                @csrf
                @include('admin.indicators.indicator.filter')
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Indicator</h5>
        </div>
        <div class="table-responsive">
            <table class="table text-nowrap">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Format</th>
                        <th>Collection Frequency</th>
                        <th>Status</th>
                        <th>Actual vs Target</th>
                        <th class="text-center" style="width: 20px;"><i class="ph-dots-three"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($groupedIndicators as $key1 => $group)
                        <tr class="table-light">
                            <td colspan="7" class="fw-semibold">{{ $key1 }}</td>
                        </tr>
                        @foreach($group as $key2 => $indicator)
                        <tr>
                            <td>{{ ++$key2 }}</td>
                            <td>
                                {{ $indicator->name }}
                                @if($indicator->key_performance == 'Yes')
                                <a href="#" class="badge bg-warning text-white rounded-pill p-1">
                                    KPI
                                </a>
                                @endif
                            </td>
                            <td>{{ $indicator->format }}</td>
                            <td>{{ $indicator->projectReportingPeriod->title ?? ''}}</td>
                            <td>{{ $indicator->status }}</td>
                            <td>
                                @if($indicator->format != 'Qualitative Only' && $indicator->aggregated !='Yes')
                                    @php($data = getIndicatorActualVsTarget($indicator))
                                    {{ $data['stat'] }} 
                                    <div class="progress">
                                        <div class="progress-bar bg-teal" style="width: {{ $data['percentage'] }}%" aria-valuenow="{{ $data['percentage'] }}" aria-valuemin="0" aria-valuemax="100">{{ $data['percentage'] }}% complete</div>
                                    </div>
                                @endif
                                @if($indicator->format != 'Qualitative Only' && $indicator->aggregated =='Yes')
                                    @php($data = calculateAggregatedTarget($indicator))
                                    {{ $data['stat'] }} 
                                    <div class="progress">
                                        <div class="progress-bar bg-teal" style="width: {{ $data['percentage'] }}%" aria-valuenow="{{ $data['percentage'] }}" aria-valuemin="0" aria-valuemax="100">{{ $data['percentage'] }}% complete</div>
                                    </div>
                                @endif
                            </td>
                            <th class="text-center">@include('admin.indicators.indicator.actions')</th>
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
<script>
    $(function () {
        const swalInit = swal.mixin({
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-light',
                denyButton: 'btn btn-light',
                input: 'form-control'
            }
        });
        $('.select').select2();
        $(".sa-confirm").click(function (event) {
            event.preventDefault();
            swalInit.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                }
            }).then((result) => {
                if (result.value === true)  $(this).closest("form").submit();
            });
        });
    });
</script>
@endsection