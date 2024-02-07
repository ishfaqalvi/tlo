@extends('admin.layout.app')

@section('title')
    {{ $projectIndicator->name ?? "Show Project Indicator" }}
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Project Indicator Management</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('project-indicators.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
            <h5 class="mb-0">{{ __('Show') }} Project Indicator</h5>
        </div>
        <div class="card-body">
            
                        <div class="form-group mb-3">
                            <strong>Project Id:</strong>
                            {{ $projectIndicator->project_id }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Name:</strong>
                            {{ $projectIndicator->name }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Format:</strong>
                            {{ $projectIndicator->format }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Direction:</strong>
                            {{ $projectIndicator->direction }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Frequency:</strong>
                            {{ $projectIndicator->frequency }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Target:</strong>
                            {{ $projectIndicator->target }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Aggregated:</strong>
                            {{ $projectIndicator->aggregated }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Description:</strong>
                            {{ $projectIndicator->description }}
                        </div>

        </div>
    </div>
</div>
@endsection