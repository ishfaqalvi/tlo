@extends('admin.layout.app')

@section('title')
    {{ $intdicatorDataCollection->name ?? "Show Intdicator Data Collection" }}
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Intdicator Data Collection Management</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('intdicator-data-collections.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
            <h5 class="mb-0">{{ __('Show') }} Intdicator Data Collection</h5>
        </div>
        <div class="card-body">
            
                        <div class="form-group mb-3">
                            <strong>Indicator Id:</strong>
                            {{ $intdicatorDataCollection->indicator_id }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Collected Value:</strong>
                            {{ $intdicatorDataCollection->collected_value }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Date:</strong>
                            {{ $intdicatorDataCollection->date }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Identifier:</strong>
                            {{ $intdicatorDataCollection->identifier }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Site Id:</strong>
                            {{ $intdicatorDataCollection->site_id }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Evidence:</strong>
                            {{ $intdicatorDataCollection->evidence }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Notes:</strong>
                            {{ $intdicatorDataCollection->notes }}
                        </div>

        </div>
    </div>
</div>
@endsection