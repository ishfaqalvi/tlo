@extends('admin.layout.app')

@section('title')
    Project Activity
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Project Activity Management</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            @can('activities-create')
            <a href="{{ route('activities.create') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
                <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                    <i class="ph-plus"></i>
                </span>
                Add Activity
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
            <h5 class="mb-0">Project Activity</h5>
        </div>
        <table class="table datatable-basic">
            <thead class="thead">
                <tr>
                    <th>No</th>
					<th>Project</th>
					<th>Site</th>
					<th>Phase</th>
					<th>Assign To</th>
					<th>Progress</th>
					<th>Milestone</th>
					<th>Start Date</th>
					<th>End Date</th>
					<th>Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($projectActivities as $key => $projectActivity)
                <tr>
                    <td>{{ ++$key }}</td>
					<td>{{ $projectActivity->project->name }}</td>
					<td>{{ $projectActivity->site->name }}</td>
					<td>{{ $projectActivity->projectPhase->name }}</td>
					<td>{{ $projectActivity->user->name }}</td>
					<td>{{ $projectActivity->activityProgress->title }}</td>
					<td>{{ $projectActivity->milestone == 1 ? 'Yes':'No'}}</td>
					<td>{{ $projectActivity->start_date ? date('d M Y', $projectActivity->start_date) : ''}}</td>
					<td>{{ date('d M Y',$projectActivity->end_date) }}</td>
					<td>{{ $projectActivity->status }}</td>
                    <td class="text-center">@include('admin.activity.actions')</td>
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