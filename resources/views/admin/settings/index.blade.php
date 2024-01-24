@extends('admin.layout.app')

@section('title', 'Settings')

@section('header')
    <div class="page-header-content d-lg-flex">
        <div class="d-flex">
            <h4 class="page-title mb-0">
                Home - <span class="fw-normal">Settings</span>
            </h4>
        </div>
    </div>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">General Settings</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-9 offset-lg-2">
                <form method="POST" action="{{ route('settings.save') }}" enctype="multipart/form-data">
                    @csrf
                    @include('admin.settings.form')
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Save Changes<i class="ph-paper-plane-tilt ms-2"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection