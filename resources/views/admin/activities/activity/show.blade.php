@extends('admin.layout.app')

@section('title')
    {{ $activity->name ?? "Show Activity" }}
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
            <a href="{{ route('activities.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
                <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                    <i class="ph-arrow-circle-left"></i>
                </span>
                Back
            </a>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">{{ __('Show') }} Activity</h5>
        </div>
        <div class="card-body">
            
                        <div class="form-group mb-3">
                            <strong>Project Id:</strong>
                            {{ $activity->project_id }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Phase Id:</strong>
                            {{ $activity->phase_id }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Assign To:</strong>
                            {{ $activity->assign_to }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Name:</strong>
                            {{ $activity->name }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Milestone:</strong>
                            {{ $activity->milestone }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Start Date:</strong>
                            {{ $activity->start_date }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>End Date:</strong>
                            {{ $activity->end_date }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Progress:</strong>
                            {{ $activity->progress }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Status:</strong>
                            {{ $activity->status }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Description:</strong>
                            {{ $activity->description }}
                        </div>

        </div>
    </div>
</div>
@endsection