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
            <a href="{{ route('project-activities.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
                            <strong>Project Id:</strong>
                            {{ $projectActivity->project_id }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Site Id:</strong>
                            {{ $projectActivity->site_id }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Project Phase Id:</strong>
                            {{ $projectActivity->project_phase_id }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Assign To:</strong>
                            {{ $projectActivity->assign_to }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Activity Progress Id:</strong>
                            {{ $projectActivity->activity_progress_id }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Milestone:</strong>
                            {{ $projectActivity->milestone }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Start Date:</strong>
                            {{ $projectActivity->start_date }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>End Date:</strong>
                            {{ $projectActivity->end_date }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Due Date:</strong>
                            {{ $projectActivity->due_date }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Status:</strong>
                            {{ $projectActivity->status }}
                        </div>

        </div>
    </div>
</div>
@endsection