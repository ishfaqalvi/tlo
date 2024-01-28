@extends('admin.layout.app')

@section('title')
    {{ $project->name ?? "Show Project" }}
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Project Management</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('projects.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
            <h5 class="mb-0">{{ __('Show') }} Project</h5>
        </div>
        <div class="card-body">
            
                        <div class="form-group mb-3">
                            <strong>Code:</strong>
                            {{ $project->code }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Name:</strong>
                            {{ $project->name }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Start Date:</strong>
                            {{ $project->start_date }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>End Date:</strong>
                            {{ $project->end_date }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Funding:</strong>
                            {{ $project->funding }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Location:</strong>
                            {{ $project->location }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Donnor:</strong>
                            {{ $project->donnor }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Partner:</strong>
                            {{ $project->partner }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Description:</strong>
                            {{ $project->description }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Assigned To:</strong>
                            {{ $project->assigned_to }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Category Id:</strong>
                            {{ $project->category_id }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Status:</strong>
                            {{ $project->status }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Created By:</strong>
                            {{ $project->created_by }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Updated By:</strong>
                            {{ $project->updated_by }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Deleted By:</strong>
                            {{ $project->deleted_by }}
                        </div>

        </div>
    </div>
</div>
@endsection