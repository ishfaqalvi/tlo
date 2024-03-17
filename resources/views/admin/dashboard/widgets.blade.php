@extends('admin.layout.app')

@section('title', 'Dashboard')

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Dashboard</span>
        </h4>
        <a href="#page_header" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
            <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
        </a>
    </div>
</div>
<div class="page-header-content d-lg-flex border-top">
    @include('admin.dashboard.include.navigation')
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-6 col-xl-3">
        <div class="card card-body bg-primary text-white">
            <div class="d-flex align-items-center">
                <div class="flex-fill">
                    <h4 class="mb-0">{{ number_format($widgets['projects']) }}</h4>
                    Total Projects
                </div>
                <i class="ph-folder ph-2x opacity-75 ms-3"></i>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card card-body bg-danger text-white">
            <div class="d-flex align-items-center">
                <div class="flex-fill">
                    <h4 class="mb-0">{{ number_format($widgets['resultFramework']) }}</h4>
                    Result Framework
                </div>
                <i class="ph-tree-structure ph-2x opacity-75 ms-3"></i>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card card-body bg-success text-white">
            <div class="d-flex align-items-center">
                <i class="ph-chart-bar ph-2x opacity-75 me-3"></i>
                <div class="flex-fill text-end">
                    <h4 class="mb-0">{{ number_format($widgets['indicators']) }}</h4>
                    Total Indicators
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card card-body bg-indigo text-white">
            <div class="d-flex align-items-center">
                <i class="ph-list-bullets ph-2x opacity-75 me-3"></i>
                <div class="flex-fill text-end">
                    <h4 class="mb-0">{{ number_format($widgets['activities']) }}</h4>
                    Total Activities
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card card-body bg-secondary text-white">
            <div class="d-flex align-items-center">
                <div class="flex-fill">
                    <h4 class="mb-0">{{ number_format($widgets['stakeholders']) }}</h4>
                    Total Stakeholders
                </div>
                <i class="ph-users-three ph-2x opacity-75 ms-3"></i>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card card-body bg-warning text-white">
            <div class="d-flex align-items-center">
                <div class="flex-fill">
                    <h4 class="mb-0">{{ number_format($widgets['sites']) }}</h4>
                    Total Sites
                </div>
                <i class="ph-globe ph-2x opacity-75 ms-3"></i>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card card-body bg-info text-white">
            <div class="d-flex align-items-center">
                <i class="ph-users-three ph-2x opacity-75 me-3"></i>
                <div class="flex-fill text-end">
                    <h4 class="mb-0">{{ number_format($widgets['beneficiaries']) }}</h4>
                    Total Beneficiaries
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card card-body bg-pink text-white">
            <div class="d-flex align-items-center">
                <i class="ph-chat-centered-text ph-2x opacity-75 me-3"></i>
                <div class="flex-fill text-end">
                    <h4 class="mb-0">{{ number_format($widgets['feadbacks']) }}</h4>
                    Total Feadbacks
                </div>
            </div>
        </div>
    </div>
</div>
@endsection