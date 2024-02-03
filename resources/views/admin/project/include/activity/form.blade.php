<div class="row">
	
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('project_id') }}
        {{ Form::text('project_id', $projectActivity->project_id, ['class' => 'form-control' . ($errors->has('project_id') ? ' is-invalid' : ''), 'placeholder' => 'Project Id','required']) }}
        {!! $errors->first('project_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('site_id') }}
        {{ Form::text('site_id', $projectActivity->site_id, ['class' => 'form-control' . ($errors->has('site_id') ? ' is-invalid' : ''), 'placeholder' => 'Site Id','required']) }}
        {!! $errors->first('site_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('project_phase_id') }}
        {{ Form::text('project_phase_id', $projectActivity->project_phase_id, ['class' => 'form-control' . ($errors->has('project_phase_id') ? ' is-invalid' : ''), 'placeholder' => 'Project Phase Id','required']) }}
        {!! $errors->first('project_phase_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('assign_to') }}
        {{ Form::text('assign_to', $projectActivity->assign_to, ['class' => 'form-control' . ($errors->has('assign_to') ? ' is-invalid' : ''), 'placeholder' => 'Assign To','required']) }}
        {!! $errors->first('assign_to', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('activity_progress_id') }}
        {{ Form::text('activity_progress_id', $projectActivity->activity_progress_id, ['class' => 'form-control' . ($errors->has('activity_progress_id') ? ' is-invalid' : ''), 'placeholder' => 'Activity Progress Id','required']) }}
        {!! $errors->first('activity_progress_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('milestone') }}
        {{ Form::text('milestone', $projectActivity->milestone, ['class' => 'form-control' . ($errors->has('milestone') ? ' is-invalid' : ''), 'placeholder' => 'Milestone','required']) }}
        {!! $errors->first('milestone', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('start_date') }}
        {{ Form::text('start_date', $projectActivity->start_date, ['class' => 'form-control' . ($errors->has('start_date') ? ' is-invalid' : ''), 'placeholder' => 'Start Date','required']) }}
        {!! $errors->first('start_date', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('end_date') }}
        {{ Form::text('end_date', $projectActivity->end_date, ['class' => 'form-control' . ($errors->has('end_date') ? ' is-invalid' : ''), 'placeholder' => 'End Date','required']) }}
        {!! $errors->first('end_date', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('due_date') }}
        {{ Form::text('due_date', $projectActivity->due_date, ['class' => 'form-control' . ($errors->has('due_date') ? ' is-invalid' : ''), 'placeholder' => 'Due Date','required']) }}
        {!! $errors->first('due_date', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('status') }}
        {{ Form::text('status', $projectActivity->status, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Status','required']) }}
        {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
    </div>

	<div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
		<button type="submit" class="btn btn-primary ms-3">
			Submit <i class="ph-paper-plane-tilt ms-2"></i>
		</button>
	</div>
</div>