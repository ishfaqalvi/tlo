<div class="row">
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('name') }}
        {{ Form::text('name', $activity->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name','required']) }}
        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('phase') }}
        {{ Form::select('phase_id', projectPhases($activity->project_id), $activity->phase_id, ['class' => 'form-control select' . ($errors->has('phase_id') ? ' is-invalid' : ''), 'placeholder' => '--Select--']) }}
        {!! $errors->first('phase_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('assign_to') }}
        {{ Form::select('assign_to', users(), $activity->assign_to, ['class' => 'form-control select' . ($errors->has('assign_to') ? ' is-invalid' : ''), 'placeholder' => '--Select--']) }}
        {!! $errors->first('assign_to', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('progress') }}
        {{ Form::select('progress', ['Open'=>'Open','In Progress'=>'In Progress','Closed'=>'Closed'], $activity->progress, ['class' => 'form-control select' . ($errors->has('progress') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
        {!! $errors->first('progress', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('status') }}
        <select name="status" data-placeholder="--Select--" class="form-control select-icons">
            <option value="Green" data-color="text-success" {{ $activity->status == "Green" ? 'selected' : '' }}>Green</option>
            <option value="Amber" data-color="text-warning" {{ $activity->status == "Amber" ? 'selected' : '' }}>Amber</option>
            <option value="Red" data-color="text-danger" {{ $activity->status == "Red" ? 'selected' : '' }}>Red</option>
        </select>
    </div>
    <div class="form-group col-lg-4 mb-3 pt-4">
        {{ Form::hidden('milestone', null) }}
        {{ Form::checkbox('milestone', 'Yes', $activity->milestone, ['class' => 'form-check-input' . ($errors->has('milestone') ? ' is-invalid' : ''),'id'=>'milestone']) }}
        {!! $errors->first('milestone', '<div class="invalid-feedback">:message</div>') !!}
        {{ Form::label('milestone', 'Milestone') }}
    </div>
    <div class="form-group col-lg-4 mb-3 sdate">
        {{ Form::label('start_date') }}
        {{ Form::text('start_date', !empty($activity->start_date) ? date('m-d-Y', $activity->start_date) : '', ['class' => 'form-control start_date' . ($errors->has('start_date') ? ' is-invalid' : ''), 'placeholder' => 'Start Date']) }}
        {!! $errors->first('start_date', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('end_date/Due_date') }}
        {{ Form::text('end_date', !empty($activity->end_date) ? date('m-d-Y', $activity->end_date) : '', ['class' => 'form-control end_date' . ($errors->has('end_date') ? ' is-invalid' : ''), 'placeholder' => 'End Date','required']) }}
        {!! $errors->first('end_date', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-12 mb-3">
        {{ Form::label('description') }}
        {{ Form::textarea('description', $activity->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description','id'=>'ckeditor']) }}
        {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
    </div>
	<div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
		<button type="submit" class="btn btn-primary ms-3">
			Submit <i class="ph-paper-plane-tilt ms-2"></i>
		</button>
	</div>
</div>