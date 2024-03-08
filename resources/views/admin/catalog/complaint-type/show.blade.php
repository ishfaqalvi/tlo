@extends('admin.layout.app')

@section('title')
    {{ $complaintType->name ?? "Show Complaint Type" }}
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Complaint Type Management</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('complaint-types.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
            <h5 class="mb-0">{{ __('Show') }} Complaint Type</h5>
        </div>
        <div class="card-body">
            <div class="form-group mb-3">
                <strong>Title:</strong>
                {{ $complaintType->title }}
            </div>
            <div class="form-group mb-3">
                <strong>Type:</strong>
                {{ $complaintType->type }}
            </div>
            <div class="form-group mb-3">
                <strong>Deadline:</strong>
                {{ $complaintType->deadline }}
            </div>
        </div>
    </div>
</div>
@endsection