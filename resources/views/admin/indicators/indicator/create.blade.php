@extends('admin.layout.app')

@section('title')
{{ __('Create') }} Indicator
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Indicator Management</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('indicators.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
            <h5 class="mb-0">{{ __('Create') }} Indicator</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('indicators.store') }}" class="validate" role="form" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-lg-4 mb-3">
                        {{ Form::label('project') }}
                        {{ Form::select('project_id', projects(), $indicator->project_id, ['class' => 'form-control select' . ($errors->has('project_id') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
                        {!! $errors->first('project_id', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group col-lg-4 mb-3">
                        {{ Form::label('name') }}
                        {{ Form::text('name', $indicator->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name','required']) }}
                        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group col-lg-4 mb-3">
                        {{ Form::label('format') }}
                        {{ Form::select('format', ['Numeric'=>'Numeric','Percentage'=>'Percentage','Qualitative Only'=>'Qualitative Only'], $indicator->format, ['class' => 'form-control select' . ($errors->has('format') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
                        {!! $errors->first('format', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                </div>
                <div class="row numericRow" style="display: none;">
                    <div class="form-group col-lg-4 mb-3">
                        {{ Form::label('direction') }}
                        {{ Form::select('direction', ['Increasing'=>'Increasing','Decreasing'=>'Decreasing'], $indicator->direction, ['class' => 'form-control select' . ($errors->has('direction') ? ' is-invalid' : ''), 'placeholder' => '--Select--']) }}
                        {!! $errors->first('direction', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group col-lg-4 mb-3">
                        {{ Form::label('Life of program (LOP) target') }}
                        {{ Form::number('target', $indicator->target, ['class' => 'form-control' . ($errors->has('target') ? ' is-invalid' : ''), 'placeholder' => 'Target']) }}
                        {!! $errors->first('target', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group col-lg-4 mb-3">
                        {{ Form::label('Baseline (BL)') }}
                        {{ Form::number('baseline', $indicator->baseline, ['class' => 'form-control' . ($errors->has('baseline') ? ' is-invalid' : ''), 'placeholder' => 'Baseline']) }}
                        {!! $errors->first('baseline', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group col-lg-4 mb-3">
                        {{ Form::checkbox('aggregated', 'Yes', $indicator->aggregated, ['class' => 'form-check-input' . ($errors->has('aggregated') ? ' is-invalid' : ''),'id'=>'aggregated']) }}
                        {{ Form::label('aggregated', 'Aggregated') }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
                        <button type="submit" class="btn btn-primary ms-3">
                            Submit <i class="ph-paper-plane-tilt ms-2"></i>
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
        $('.select').select2();
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
        $('select[name=format]').on('change', function(){
            var format = $(this).val();
            if (format == 'Numeric' || format == 'Percentage') {
                $('div.numericRow').show('slow');
            }else{
                $('div.numericRow').hide('slow');
            }
        });
    });
</script>
@endsection
