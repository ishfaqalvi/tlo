<div class="row">
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('project') }}
        {{ Form::select('project_id', projects(), $projectIndicator->project_id, ['class' => 'form-control select' . ($errors->has('project_id') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
        {!! $errors->first('project_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('name') }}
        {{ Form::text('name', $projectIndicator->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name','required']) }}
        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('format') }}
        {{ Form::select('format', ['Numeric'=>'Numeric','Percentage'=>'Percentage','Qualitative Only'=>'Qualitative Only'], $projectIndicator->format, ['class' => 'form-control select' . ($errors->has('format') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required','id'=>'format']) }}
        {!! $errors->first('format', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3 direction" style="display: none;">
        {{ Form::label('direction') }}
        {{ Form::select('direction', ['Increasing'=>'Increasing','Decreasing'=>'Decreasing'], $projectIndicator->direction, ['class' => 'form-control select' . ($errors->has('direction') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required','id'=>'direction']) }}
        {!! $errors->first('direction', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('frequency') }}
        {{ Form::select('frequency', ['Daily'=>'Daily','Weekly'=>'Weekly','Monthly'=>'Monthly','Quarterly'=>'Quarterly','Semi-Annuly'=>'Semi-Annuly','Annuly'=>'Annuly'], $projectIndicator->frequency, ['class' => 'form-control select' . ($errors->has('frequency') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
        {!! $errors->first('frequency', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('target') }}
        {{ Form::number('target', $projectIndicator->target, ['class' => 'form-control' . ($errors->has('target') ? ' is-invalid' : ''), 'placeholder' => 'Target','required','min'=>'0']) }}
        {!! $errors->first('target', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3 aggregated"  style="display: none;">
        <div class="form-check mb-2">
            <input type="checkbox" value="1" class="form-check-input" id="aggregated" name="aggregated" {{ $projectIndicator->aggregated == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="aggregated">Aggregated</label>
        </div>
    </div>
    <div class="form-group col-lg-12 mb-3">
        {{ Form::label('description') }}
        {{ Form::textarea('description', $projectIndicator->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description','required','rows'=>'3','id'=>'ckeditor']) }}
        {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
    </div>
	<div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
		<button type="submit" class="btn btn-primary ms-3">
			Submit <i class="ph-paper-plane-tilt ms-2"></i>
		</button>
	</div>
</div>