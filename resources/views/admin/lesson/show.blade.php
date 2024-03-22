@extends('admin.layout.app')

@section('title')
    {{ $lesson->name ?? "Show Lesson Learn Log" }}
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Lessons Learn Log Management</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('lessons.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
            <h5 class="mb-0">{{ __('Show') }} Lesson Learn Log</h5>
        </div>
        <div class="card-body">
            <div class="form-group mb-3">
                <strong>Project:</strong>
                {{ $lesson->project->name }}
            </div>
            <div class="form-group mb-3">
                <strong>Date Identified:</strong>
                {{ date('d M Y',$lesson->date_identified) }}
            </div>
            <div class="form-group mb-3">
                <strong>Entered By:</strong>
                {{ $lesson->entered_by }}
            </div>
            <div class="form-group mb-3">
                <strong>Subject:</strong>
                {{ $lesson->subject }}
            </div>
            <div class="form-group mb-3">
                <strong>Situation:</strong>
                {{ $lesson->situation }}
            </div>
            <div class="form-group mb-3">
                <strong>Recommendation & Comments:</strong>
                {{ $lesson->comments }}
            </div>
            <div class="form-group mb-3">
                <strong>Follow-up Needed:</strong>
                {{ $lesson->neded }}
            </div>
        </div>
    </div>
</div>
@endsection