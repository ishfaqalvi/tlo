<div class="row">
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('project_id') }}
        {{ Form::text('project_id', $indicator->project_id, ['class' => 'form-control' . ($errors->has('project_id') ? ' is-invalid' : ''), 'placeholder' => 'Project Id','required']) }}
        {!! $errors->first('project_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('name') }}
        {{ Form::text('name', $indicator->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name','required']) }}
        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('format') }}
        {{ Form::text('format', $indicator->format, ['class' => 'form-control' . ($errors->has('format') ? ' is-invalid' : ''), 'placeholder' => 'Format','required']) }}
        {!! $errors->first('format', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('direction') }}
        {{ Form::text('direction', $indicator->direction, ['class' => 'form-control' . ($errors->has('direction') ? ' is-invalid' : ''), 'placeholder' => 'Direction','required']) }}
        {!! $errors->first('direction', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('target') }}
        {{ Form::text('target', $indicator->target, ['class' => 'form-control' . ($errors->has('target') ? ' is-invalid' : ''), 'placeholder' => 'Target','required']) }}
        {!! $errors->first('target', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('baseline') }}
        {{ Form::text('baseline', $indicator->baseline, ['class' => 'form-control' . ($errors->has('baseline') ? ' is-invalid' : ''), 'placeholder' => 'Baseline','required']) }}
        {!! $errors->first('baseline', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('aggregated') }}
        {{ Form::text('aggregated', $indicator->aggregated, ['class' => 'form-control' . ($errors->has('aggregated') ? ' is-invalid' : ''), 'placeholder' => 'Aggregated','required']) }}
        {!! $errors->first('aggregated', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('frequency') }}
        {{ Form::text('frequency', $indicator->frequency, ['class' => 'form-control' . ($errors->has('frequency') ? ' is-invalid' : ''), 'placeholder' => 'Frequency','required']) }}
        {!! $errors->first('frequency', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('description') }}
        {{ Form::text('description', $indicator->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description','required']) }}
        {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
    </div>

	<div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
		<button type="submit" class="btn btn-primary ms-3">
			Submit <i class="ph-paper-plane-tilt ms-2"></i>
		</button>
	</div>
</div>