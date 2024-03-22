@extends('admin.layout.app')

@section('title')
    Risk Management Plan
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Risk Management Plan</span>
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
            @can('riskPlans-create')
            <a href="{{ route('risk-plans.create') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
                <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                    <i class="ph-plus"></i>
                </span>
                Create New
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
            <form action="{{route('risk-plans.filters')}}" method="post">
                @csrf
                @include('admin.risk-plan.filter')
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Risk Management Plan</h5>
        </div>
        <div class="table-responsive">
            <table class="table text-nowrap">
                <thead class="thead">
                    <tr>
                        <th>No</th>
    					<th>Project</th>
                        <th>Risk Description</th>
                        <th>Consequence</th>
    					<th>Probability</th>
    					<th>Impact</th>
    					<th>Risk Priority</th>
    					<th>Risk Level</th>
    					<th>Risk Strategy</th>
                        <th>Response</th>
    					<th>Action Date</th>
                        <th>Owner</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($riskPlans as $key => $riskPlan)
                    <tr>
                        <td>{{ ++$key }}</td>
    					<td>{{ $riskPlan->project->name }}</td>
    					<td>{{ $riskPlan->description }}</td>
                        <td>{{ $riskPlan->consequence }}</td>
                        <td class="{{ $riskPlan->probability_color }}">{{ $riskPlan->probability }}</td>
    					<td class="{{ $riskPlan->impact_color }}">{{ $riskPlan->impact }}</td>
    					<td>{{ $riskPlan->priority }}</td>
    					<td class="{{ $riskPlan->level_color }}">{{ $riskPlan->level }}</td>
    					<td class="{{ $riskPlan->strategy_color }}">{{ $riskPlan->strategy }}</td>
                        <td>{{ $riskPlan->responce }}</td>
    					<td>{{ date('d M Y',$riskPlan->date_identified) }}</td>
                        <td>{{ $riskPlan->owner }}</td>
                        <td>{{ $riskPlan->status }}</td>
                        <td class="text-center">@include('admin.risk-plan.actions')</td>
                    </tr>
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