@extends('admin.layout.app')

@section('title')
    Activity
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Activity Management</span>
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
            <h5 class="mb-0">Activity</h5>
        </div>
        <table class="table datatable-basic">
            <thead class="thead">
                <tr>
                    <th>No</th>
					<th>Project</th>
                    <th>Name</th>
					<th>Start Date</th>
					<th>End Date</th>
					<th>Progress</th>
					<th>Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($activities as $key => $activity)
                <tr>
                    <td>{{ ++$key }}</td>
					<td>{{ $activity->project->name }}</td>
                    <td>
                        @if(auth()->user()->can('activities-edit'))
                            <a href="{{ route('activities.edit',$activity->id) }}">
                                {{ $activity->name }}
                            </a>
                        @else
                            {{ $activity->name }}
                        @endif
                        @if($activity->milestone == 'Yes')
                        <a href="#" class="badge bg-warning text-white rounded-pill p-1">
                            M
                        </a>
                        @endif
                    </td>
					<td>{{ !empty($activity->start_date) ? date('d M Y', $activity->start_date) : ''}}</td>
					<td>{{ !empty($activity->end_date) ? date('d M Y', $activity->end_date) : ''}}</td>
					<td>{{ $activity->progress }}</td>
					<td>
                        @if($activity->status == 'Green')
                            <i class="fas fa-circle me-3 fa-1x text-success" title="{{ $activity->status }}"></i>
                        @elseif($activity->status == 'Amber')
                            <i class="fas fa-circle me-3 fa-1x text-warning" title="{{ $activity->status }}"></i>
                        @elseif($activity->status == 'Red')
                            <i class="fas fa-circle me-3 fa-1x text-danger" title="{{ $activity->status }}"></i>
                        @endif
                    </td>
                    <td class="text-center">@include('admin.activities.activity.actions')</td>
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