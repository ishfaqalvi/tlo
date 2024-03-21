<div class="row">
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('project') }}
        {{ Form::select('project_id', projects(), $lesson->project_id, ['class' => 'form-control select' . ($errors->has('project_id') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
        {!! $errors->first('project_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('date_identified') }}
        {{ Form::text('date_identified', date('m/d/Y',$lesson->date_identified), ['class' => 'form-control date_identified' . ($errors->has('date_identified') ? ' is-invalid' : ''), 'placeholder' => 'Date Identified','required']) }}
        {!! $errors->first('date_identified', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('entered_by') }}
        {{ Form::text('entered_by', $lesson->entered_by, ['class' => 'form-control' . ($errors->has('entered_by') ? ' is-invalid' : ''), 'placeholder' => 'Entered By','required']) }}
        {!! $errors->first('entered_by', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('subject') }}
        {{ Form::text('subject', $lesson->subject, ['class' => 'form-control' . ($errors->has('subject') ? ' is-invalid' : ''), 'placeholder' => 'Subject','required']) }}
        {!! $errors->first('subject', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('situation') }}
        {{ Form::text('situation', $lesson->situation, ['class' => 'form-control' . ($errors->has('situation') ? ' is-invalid' : ''), 'placeholder' => 'Situation','required']) }}
        {!! $errors->first('situation', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('neded') }}
        {{ Form::select('neded', ['Yes' => 'Yes', 'No' => 'No'], $lesson->neded, ['class' => 'form-control select' . ($errors->has('neded') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
        {!! $errors->first('neded', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-12 mb-3">
        {{ Form::label('comments') }}
        {{ Form::text('comments', $lesson->comments, ['class' => 'form-control' . ($errors->has('comments') ? ' is-invalid' : ''), 'placeholder' => 'Comments','required']) }}
        {!! $errors->first('comments', '<div class="invalid-feedback">:message</div>') !!}
    </div>
	<div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
		<button type="submit" class="btn btn-primary ms-3">
			Submit <i class="ph-paper-plane-tilt ms-2"></i>
		</button>
	</div>
</div>