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
            @if(isset($feadback->attachment))
            <div class="form-group mb-3">
                <strong>Attachment:</strong>
                <a href="{{ $feadback->attachment }}" target="_blank">View Attachment</a>
            </div>
            @endif
            @if($feadback->responces()->count() > 0)
            <table class="table">
                <thead class="thead">
                    <tr>
                        <th>No</th>
                        <th>Status</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($feadback->responces as $key => $responce)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $responce->status }}</td>
                        <td>{{ $responce->description }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
</div>
@endsection