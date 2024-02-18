@extends('admin.layout.app')

@section('title')
{{ __('Create') }} Project
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Project Management</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('projects.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
            <h5 class="mb-0">{{ __('Create') }} Project</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('projects.store') }}" class="validate" role="form" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-lg-4 mb-3">
                        {{ Form::label('name') }}
                        {{ Form::text('name', $project->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name','required']) }}
                        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group col-lg-4 mb-3">
                        {{ Form::label('start_date') }}
                        {{ Form::text('start_date', $project->start_date, ['class' => 'form-control start_date' . ($errors->has('start_date') ? ' is-invalid' : ''), 'placeholder' => 'Start Date','required']) }}
                        {!! $errors->first('start_date', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group col-lg-4 mb-3">
                        {{ Form::label('end_date') }}
                        {{ Form::text('end_date', $project->end_date, ['class' => 'form-control end_date' . ($errors->has('end_date') ? ' is-invalid' : ''), 'placeholder' => 'End Date','required']) }}
                        {!! $errors->first('end_date', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
                        <button type="submit" class="btn btn-primary ms-3">
                            Save <i class="ph-paper-plane-tilt ms-2"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(function(){
        $('.validate').validate({
            errorClass: 'validation-invalid-label',
            successClass: 'validation-valid-label',
            validClass: 'validation-valid-label',
            highlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
                $(element).addClass('is-invalid');
                $(element).removeClass('is-valid');
            },
            unhighlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
                $(element).removeClass('is-invalid');
                $(element).addClass('is-valid');
            },
            errorPlacement: function(error, element) {
                if (element.hasClass('select2-hidden-accessible')) {
                    error.appendTo(element.parent());
                }else if (element.parents().hasClass('form-control-feedback') || element.parents().hasClass('form-check') || element.parents().hasClass('input-group')) {
                    error.appendTo(element.parent().parent());
                }else {
                    error.insertAfter(element);
                }
            }
        });
        ['.start_date', '.end_date'].forEach(selector => {
            const element = document.querySelector(selector);
            if (element) {
                new Datepicker(element, {
                    container: '.content-inner',
                    buttonClass: 'btn',
                    prevArrow: document.dir == 'rtl' ? '&rarr;' : '&larr;',
                    nextArrow: document.dir == 'rtl' ? '&larr;' : '&rarr;',
                    autohide: true
                });
            }
        });
    });
</script>
@endsection
