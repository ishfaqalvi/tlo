<div class="row">	
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('project') }}
        {{ Form::select('project_id', projects(), $projectActivity->project_id, ['class' => 'form-control select' . ($errors->has('project_id') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
        {!! $errors->first('project_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3 sites" style="display: none;">
        {{ Form::label('site') }}
        {{ Form::select('site_id', [], $projectActivity->site_id, ['class' => 'form-control select' . ($errors->has('site_id') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
        {!! $errors->first('site_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3 phases" style="display: none;">
        {{ Form::label('phase') }}
        {{ Form::select('project_phase_id', [], $projectActivity->project_phase_id, ['class' => 'form-control select' . ($errors->has('project_phase_id') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
        {!! $errors->first('project_phase_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('assign_to') }}
        {{ Form::select('assign_to', users(), $projectActivity->assign_to, ['class' => 'form-control select' . ($errors->has('assign_to') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
        {!! $errors->first('assign_to', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('progress') }}
        {{ Form::select('activity_progress_id', activityProgress(), $projectActivity->activity_progress_id, ['class' => 'form-control select' . ($errors->has('activity_progress_id') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
        {!! $errors->first('activity_progress_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('status') }}
        {{ Form::select('status', ['Active'=>'Active','InActive'=>'InActive'], $projectActivity->status, ['class' => 'form-control form-select' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
        {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('milestone') }}
        {{ Form::select('milestone', ['1' => 'Yes','0' => 'No'], $projectActivity->milestone, ['class' => 'form-control form-select' . ($errors->has('milestone') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required', 'id' => 'milestone']) }}
        {!! $errors->first('milestone', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3 startDate" style="display: none;">
        {{ Form::label('start_date') }}
        {{ Form::date('start_date', $projectActivity->start_date ? date('Y-m-d',$projectActivity->start_date) : '', ['class' => 'form-control' . ($errors->has('start_date') ? ' is-invalid' : ''), 'placeholder' => 'Start Date']) }}
        {!! $errors->first('start_date', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('end_date') }}
        {{ Form::date('end_date', date('Y-m-d',$projectActivity->end_date), ['class' => 'form-control' . ($errors->has('end_date') ? ' is-invalid' : ''), 'placeholder' => 'End Date','required']) }}
        {!! $errors->first('end_date', '<div class="invalid-feedback">:message</div>') !!}
    </div>
	<div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
		<button type="submit" class="btn btn-primary ms-3">
			Submit <i class="ph-paper-plane-tilt ms-2"></i>
		</button>
	</div>
</div>