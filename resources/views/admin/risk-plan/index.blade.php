@extends('admin.layout.app')

@section('title')
    Risk Plan
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Risk Plan Management</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
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
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Risk Plan</h5>
        </div>
        <table class="table datatable-basic">
            <thead class="thead">
                <tr>
                    <th>No</th>
					<th>Project</th>
					<th>Probability</th>
					<th>Impact</th>
					<th>Priority</th>
					<th>Level</th>
					<th>Strategy</th>
					<th>Date</th>
                    <th>Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($riskPlans as $key => $riskPlan)
                <tr>
                    <td>{{ ++$key }}</td>
					<td>{{ $riskPlan->project->name }}</td>
					<td>{{ $riskPlan->probability }}</td>
					<td>{{ $riskPlan->impact }}</td>
					<td>{{ $riskPlan->priority }}</td>
					<td>{{ $riskPlan->level }}</td>
					<td>{{ $riskPlan->strategy }}</td>
					<td>{{ date('d M Y',$riskPlan->date_identified) }}</td>
                    <td>{{ $riskPlan->status }}</td>
                    <td class="text-center">@include('admin.risk-plan.actions')</td>
                </tr>
            @endforeach
            </tbody>
        </table>
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