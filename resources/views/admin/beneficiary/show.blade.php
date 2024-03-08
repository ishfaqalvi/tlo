@extends('admin.layout.app')

@section('title')
    {{ $beneficiary->name ?? "Show Beneficiary" }}
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Beneficiary Management</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('beneficiaries.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
            <h5 class="mb-0">{{ __('Show') }} Beneficiary</h5>
        </div>
        <div class="card-body">
            <div class="form-group mb-3">
                <strong>Project:</strong>
                {{ $beneficiary->project->name }}
            </div>
            <div class="form-group mb-3">
                <strong>Name:</strong>
                {{ $beneficiary->name }}
            </div>
            <div class="form-group mb-3">
                <strong>Father Name:</strong>
                {{ $beneficiary->father_name }}
            </div>
            <div class="form-group mb-3">
                <strong>Gender:</strong>
                {{ $beneficiary->gender }}
            </div>
            <div class="form-group mb-3">
                <strong>Marital Status:</strong>
                {{ $beneficiary->marital_status }}
            </div>
            <div class="form-group mb-3">
                <strong>Province:</strong>
                {{ $beneficiary->province }}
            </div>
            <div class="form-group mb-3">
                <strong>District:</strong>
                {{ $beneficiary->district }}
            </div>
            <div class="form-group mb-3">
                <strong>Village:</strong>
                {{ $beneficiary->village }}
            </div>
            <div class="form-group mb-3">
                <strong>Contact:</strong>
                {{ $beneficiary->contact }}
            </div>
            <div class="form-group mb-3">
                <strong>Type Of Assistance:</strong>
                {{ $beneficiary->type_of_assistance }}
            </div>
            <div class="form-group mb-3">
                <strong>Residential Type:</strong>
                {{ $beneficiary->residential_type }}
            </div>
            <div class="form-group mb-3">
                <strong>Remarks:</strong>
                {{ $beneficiary->remarks }}
            </div>
        </div>
    </div>
</div>
@endsection