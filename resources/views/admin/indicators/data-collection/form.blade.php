<div class="row">
	
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('indicator_id') }}
        {{ Form::text('indicator_id', $intdicatorDataCollection->indicator_id, ['class' => 'form-control' . ($errors->has('indicator_id') ? ' is-invalid' : ''), 'placeholder' => 'Indicator Id','required']) }}
        {!! $errors->first('indicator_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('collected_value') }}
        {{ Form::text('collected_value', $intdicatorDataCollection->collected_value, ['class' => 'form-control' . ($errors->has('collected_value') ? ' is-invalid' : ''), 'placeholder' => 'Collected Value','required']) }}
        {!! $errors->first('collected_value', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('date') }}
        {{ Form::text('date', $intdicatorDataCollection->date, ['class' => 'form-control' . ($errors->has('date') ? ' is-invalid' : ''), 'placeholder' => 'Date','required']) }}
        {!! $errors->first('date', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('identifier') }}
        {{ Form::text('identifier', $intdicatorDataCollection->identifier, ['class' => 'form-control' . ($errors->has('identifier') ? ' is-invalid' : ''), 'placeholder' => 'Identifier','required']) }}
        {!! $errors->first('identifier', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('site_id') }}
        {{ Form::text('site_id', $intdicatorDataCollection->site_id, ['class' => 'form-control' . ($errors->has('site_id') ? ' is-invalid' : ''), 'placeholder' => 'Site Id','required']) }}
        {!! $errors->first('site_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('evidence') }}
        {{ Form::text('evidence', $intdicatorDataCollection->evidence, ['class' => 'form-control' . ($errors->has('evidence') ? ' is-invalid' : ''), 'placeholder' => 'Evidence','required']) }}
        {!! $errors->first('evidence', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('notes') }}
        {{ Form::text('notes', $intdicatorDataCollection->notes, ['class' => 'form-control' . ($errors->has('notes') ? ' is-invalid' : ''), 'placeholder' => 'Notes','required']) }}
        {!! $errors->first('notes', '<div class="invalid-feedback">:message</div>') !!}
    </div>

	<div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
		<button type="submit" class="btn btn-primary ms-3">
			Submit <i class="ph-paper-plane-tilt ms-2"></i>
		</button>
	</div>
</div>