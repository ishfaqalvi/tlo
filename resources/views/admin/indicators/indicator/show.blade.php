@extends('admin.layout.app')

@section('title')
    {{ $indicator->name ?? "Show Indicator" }}
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
            <a href="{{ route('indicators.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
            <h5 class="mb-0">{{ __('Show') }} Indicator</h5>
        </div>
        <div class="card-body">
            
                        <div class="form-group mb-3">
                            <strong>Project Id:</strong>
                            {{ $indicator->project_id }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Name:</strong>
                            {{ $indicator->name }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Format:</strong>
                            {{ $indicator->format }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Direction:</strong>
                            {{ $indicator->direction }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Target:</strong>
                            {{ $indicator->target }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Baseline:</strong>
                            {{ $indicator->baseline }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Aggregated:</strong>
                            {{ $indicator->aggregated }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Frequency:</strong>
                            {{ $indicator->frequency }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Description:</strong>
                            {{ $indicator->description }}
                        </div>

        </div>
    </div>
</div>
@endsection