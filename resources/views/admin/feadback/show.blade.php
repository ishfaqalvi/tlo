@extends('admin.layout.app')

@section('title')
    {{ $feadback->name ?? "Show Feadback" }}
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Feadback Management</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('feadbacks.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
            <h5 class="mb-0">{{ __('Show') }} Feadback</h5>
        </div>
        <div class="card-body">
            <div class="form-group mb-3">
                <strong>Channel:</strong>
                {{ $feadback->channel == 'Other Bright Ideas' ? $feadback->other_channel : $feadback->channel}}
            </div>
            <div class="form-group mb-3">
                <strong>Name:</strong>
                {{ $feadback->name }}
            </div>
            <div class="form-group mb-3">
                <strong>Contact Number:</strong>
                {{ $feadback->contact_number }}
            </div>
            <div class="form-group mb-3">
                <strong>Address:</strong>
                {{ $feadback->address }}
            </div>
            <div class="form-group mb-3">
                <strong>Complainer Type:</strong>
                {{ $feadback->complainer_type }}
            </div>
            <div class="form-group mb-3">
                <strong>Complaint Type:</strong>
                {{ $feadback->complaintType->title }}
            </div>
            <div class="form-group mb-3">
                <strong>Committee:</strong>
                {{ $feadback->committee }}
            </div>
            <div class="form-group mb-3">
                <strong>Responce Share:</strong>
                {{ $feadback->responce_share }}
            </div>
            <div class="form-group mb-3">
                <strong>Agree:</strong>
                {{ $feadback->agree }}
            </div>
            <div class="form-group mb-3">
                <strong>Description:</strong>
                {{ $feadback->description }}
            </div>
        </div>
    </div>
</div>
@endsection