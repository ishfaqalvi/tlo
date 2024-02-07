@extends('admin.layout.app')

@section('title')
    {{ $projectActivity->name ?? "Show Project Activity" }}
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
            <h5 class="mb-0">{{ __('Show') }} Project Activity</h5>
        </div>
        <div class="card-body">
            <div class="form-group mb-3">
                <strong>Project:</strong>
                {{ $projectActivity->project->name }}
            </div>
            <div class="form-group mb-3">
                <strong>Site:</strong>
                {{ $projectActivity->site->name }}
            </div>
            <div class="form-group mb-3">
                <strong>Phase:</strong>
                {{ $projectActivity->projectPhase->name }}
            </div>
            <div class="form-group mb-3">
                <strong>Assign To:</strong>
                {{ $projectActivity->user->name }}
            </div>
            <div class="form-group mb-3">
                <strong>Progress:</strong>
                {{ $projectActivity->activityProgress->title }}
            </div>
            <div class="form-group mb-3">
                <strong>Milestone:</strong>
                {{ $projectActivity->milestone == 1 ? 'Yes': 'No'}}
            </div>
            <div class="form-group mb-3">
                <strong>Start Date:</strong>
                {{ date('d M Y', $projectActivity->start_date) }}
            </div>
            <div class="form-group mb-3">
                <strong>End Date:</strong>
                {{ date('d M Y', $projectActivity->end_date) }}
            </div>
            <div class="form-group mb-3">
                <strong>Status:</strong>
                {{ $projectActivity->status }}
            </div>
        </div>
    </div>
</div>
@endsection