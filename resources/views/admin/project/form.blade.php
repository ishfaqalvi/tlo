<div class="row">
	
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('code') }}
        {{ Form::text('code', $project->code, ['class' => 'form-control' . ($errors->has('code') ? ' is-invalid' : ''), 'placeholder' => 'Code','required']) }}
        {!! $errors->first('code', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('name') }}
        {{ Form::text('name', $project->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name','required']) }}
        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('start_date') }}
        {{ Form::text('start_date', $project->start_date, ['class' => 'form-control' . ($errors->has('start_date') ? ' is-invalid' : ''), 'placeholder' => 'Start Date','required']) }}
        {!! $errors->first('start_date', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('end_date') }}
        {{ Form::text('end_date', $project->end_date, ['class' => 'form-control' . ($errors->has('end_date') ? ' is-invalid' : ''), 'placeholder' => 'End Date','required']) }}
        {!! $errors->first('end_date', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('funding') }}
        {{ Form::text('funding', $project->funding, ['class' => 'form-control' . ($errors->has('funding') ? ' is-invalid' : ''), 'placeholder' => 'Funding','required']) }}
        {!! $errors->first('funding', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('location') }}
        {{ Form::text('location', $project->location, ['class' => 'form-control' . ($errors->has('location') ? ' is-invalid' : ''), 'placeholder' => 'Location','required']) }}
        {!! $errors->first('location', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('donnor') }}
        {{ Form::text('donnor', $project->donnor, ['class' => 'form-control' . ($errors->has('donnor') ? ' is-invalid' : ''), 'placeholder' => 'Donnor','required']) }}
        {!! $errors->first('donnor', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('partner') }}
        {{ Form::text('partner', $project->partner, ['class' => 'form-control' . ($errors->has('partner') ? ' is-invalid' : ''), 'placeholder' => 'Partner','required']) }}
        {!! $errors->first('partner', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('description') }}
        {{ Form::text('description', $project->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description','required']) }}
        {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('assigned_to') }}
        {{ Form::text('assigned_to', $project->assigned_to, ['class' => 'form-control' . ($errors->has('assigned_to') ? ' is-invalid' : ''), 'placeholder' => 'Assigned To','required']) }}
        {!! $errors->first('assigned_to', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('category_id') }}
        {{ Form::text('category_id', $project->category_id, ['class' => 'form-control' . ($errors->has('category_id') ? ' is-invalid' : ''), 'placeholder' => 'Category Id','required']) }}
        {!! $errors->first('category_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('status') }}
        {{ Form::text('status', $project->status, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Status','required']) }}
        {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('created_by') }}
        {{ Form::text('created_by', $project->created_by, ['class' => 'form-control' . ($errors->has('created_by') ? ' is-invalid' : ''), 'placeholder' => 'Created By','required']) }}
        {!! $errors->first('created_by', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('updated_by') }}
        {{ Form::text('updated_by', $project->updated_by, ['class' => 'form-control' . ($errors->has('updated_by') ? ' is-invalid' : ''), 'placeholder' => 'Updated By','required']) }}
        {!! $errors->first('updated_by', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('deleted_by') }}
        {{ Form::text('deleted_by', $project->deleted_by, ['class' => 'form-control' . ($errors->has('deleted_by') ? ' is-invalid' : ''), 'placeholder' => 'Deleted By','required']) }}
        {!! $errors->first('deleted_by', '<div class="invalid-feedback">:message</div>') !!}
    </div>

	<div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
		<button type="submit" class="btn btn-primary ms-3">
			Submit <i class="ph-paper-plane-tilt ms-2"></i>
		</button>
	</div>
</div>