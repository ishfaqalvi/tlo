@extends('admin.layout.app')

@section('title')
    {{ $riskPlan->name ?? "Show Risk Management Plan" }}
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Risk Management Plan</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('risk-plans.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
            <h5 class="mb-0">{{ __('Show') }} Risk Management Plan</h5>
        </div>
        <div class="card-body">
            <div class="form-group mb-3">
                <strong>Project:</strong>
                {{ $riskPlan->project->name }}
            </div>
            <div class="form-group mb-3">
                <strong>Risk Description:</strong>
                {{ $riskPlan->description }}
            </div>
            <div class="form-group mb-3">
                <strong>Consequence:</strong>
                {{ $riskPlan->consequence }}
            </div>
            <div class="form-group mb-3 {{ $riskPlan->probability_color }}">
                <strong>Probability:</strong>
                {{ $riskPlan->probability }}
            </div>
            <div class="form-group mb-3  {{ $riskPlan->impact_color }}">
                <strong>Impact:</strong>
                {{ $riskPlan->impact }}
            </div>
            <div class="form-group mb-3">
                <strong>Risk Priority:</strong>
                {{ $riskPlan->priority }}
            </div>
            <div class="form-group mb-3  {{ $riskPlan->level_color }}">
                <strong>Risk Level:</strong>
                {{ $riskPlan->level }}
            </div>
            <div class="form-group mb-3  {{ $riskPlan->strategy_color }}">
                <strong>Risk Strategy:</strong>
                {{ $riskPlan->strategy }}
            </div>
            <div class="form-group mb-3">
                <strong>Responce:</strong>
                {{ $riskPlan->responce }}
            </div>
            <div class="form-group mb-3">
                <strong>Action Date:</strong>
                {{ date('d M Y',$riskPlan->action_date) }}
            </div>
            <div class="form-group mb-3">
                <strong>Owner:</strong>
                {{ $riskPlan->owner }}
            </div>
            <div class="form-group mb-3">
                <strong>Status:</strong>
                {{ $riskPlan->status }}
            </div>
        </div>
    </div>
</div>
@endsection