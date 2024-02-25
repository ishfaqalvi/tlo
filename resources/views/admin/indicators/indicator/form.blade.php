<div class="row">
    <div class="form-group col-lg-2 mb-3">
        {{ Form::label('indicator_number') }}
        {{ Form::text('indicator_number', $indicator->indicator_number, ['class' => 'form-control' . ($errors->has('indicator_number') ? ' is-invalid' : ''), 'placeholder' => 'Indicator Number','required']) }}
    </div>
    <div class="form-group col-lg-2 mb-3">
        {{ Form::label('format') }}
        {{ Form::select('format', ['Numeric'=>'Numeric','Percentage'=>'Percentage','Qualitative Only'=>'Qualitative Only'], $indicator->format, ['class' => 'form-control select' . ($errors->has('format') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
    </div>
    <div class="form-group col-lg-8 mb-3">
        {{ Form::label('name') }}
        {{ Form::text('name', $indicator->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name','required']) }}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('result_framework_id','Results framework element') }}
        {{ Form::select('result_framework_id', resultFrameworks($indicator->project_id), $indicator->result_framework_id, ['class' => 'form-control select' . ($errors->has('result_framework_id') ? ' is-invalid' : ''), 'placeholder' => '--Select--']) }}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('frequency') }}
        {{ Form::select('frequency', projectReportingPeriods($indicator->project_id), $indicator->frequency, ['class' => 'form-control select' . ($errors->has('frequency') ? ' is-invalid' : ''), 'placeholder' => '--Select--']) }}
        {!! $errors->first('frequency', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3 pt-4">
        {{ Form::checkbox('key_performance', 'Yes', $indicator->key_performance, ['class' => 'form-check-input' . ($errors->has('key_performance') ? ' is-invalid' : '')]) }}
        {{ Form::label('key_performance','Key Performance Indicator') }}
    </div>
    <div class="form-group col-lg-12 mb-3">
        {{ Form::label('description') }}
        {{ Form::textarea('description', $indicator->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description','id'=>'ckeditor']) }}
        {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
    </div>
	<div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
		<button type="submit" class="btn btn-primary ms-3">
			Submit <i class="ph-paper-plane-tilt ms-2"></i>
		</button>
	</div>
</div>