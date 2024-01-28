<div class="row">
	
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('project_id') }}
        {{ Form::text('project_id', $projectStakeholder->project_id, ['class' => 'form-control' . ($errors->has('project_id') ? ' is-invalid' : ''), 'placeholder' => 'Project Id','required']) }}
        {!! $errors->first('project_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('stakeholder_id') }}
        {{ Form::text('stakeholder_id', $projectStakeholder->stakeholder_id, ['class' => 'form-control' . ($errors->has('stakeholder_id') ? ' is-invalid' : ''), 'placeholder' => 'Stakeholder Id','required']) }}
        {!! $errors->first('stakeholder_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>

	<div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
		<button type="submit" class="btn btn-primary ms-3">
			Submit <i class="ph-paper-plane-tilt ms-2"></i>
		</button>
	</div>
</div>