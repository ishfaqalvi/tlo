@extends('admin.layout.app')

@section('title')
{{ __('Create') }} Activity
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Activity Management</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('activities.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
            <h5 class="mb-0">{{ __('Create') }} Activity</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('activities.store') }}" class="validate" role="form" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-lg-4 mb-3">
                        {{ Form::label('project') }}
                        {{ Form::select('project_id',projects(), $activity->project_id, ['class' => 'form-control select' . ($errors->has('project_id') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
                        {!! $errors->first('project_id', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group col-lg-4 mb-3">
                        {{ Form::label('name') }}
                        {{ Form::text('name', $activity->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name','required']) }}
                        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group col-lg-4 mb-3 pt-4">
                        {{ Form::checkbox('milestone', 'Yes', $activity->milestone, ['class' => 'form-check-input' . ($errors->has('milestone') ? ' is-invalid' : ''),'id'=>'milestone']) }}
                        {!! $errors->first('milestone', '<div class="invalid-feedback">:message</div>') !!}
                        {{ Form::label('milestone', 'Milestone') }}
                    </div>
                    <div class="form-group col-lg-4 mb-3 sdate" style="display: none;">
                        {{ Form::label('start_date') }}
                        {{ Form::text('start_date', $activity->start_date, ['class' => 'form-control start_date' . ($errors->has('start_date') ? ' is-invalid' : ''), 'placeholder' => 'Start Date']) }}
                        {!! $errors->first('start_date', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group col-lg-4 mb-3 edate" style="display: none;">
                        {{ Form::label('end_date') }}
                        {{ Form::text('end_date', $activity->end_date, ['class' => 'form-control end_date' . ($errors->has('end_date') ? ' is-invalid' : ''), 'placeholder' => 'End Date']) }}
                        {!! $errors->first('end_date', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
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
            },
            rules: {
                start_date : {
                    required:{function() { return $('#milestone').val() == 'Yes'; }}
                },
                end_date : {
                    required:{function() { return $('#milestone').val() == 'Yes'; }}
                }
            }
        });
        $('#milestone').on('change', function(){
            if(this.checked) {
                $('div.sdate').show('slow');
                $('div.edate').show('slow');
            }else{
                $('div.sdate').hide('slow');
                $('div.edate').hide('slow');
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
