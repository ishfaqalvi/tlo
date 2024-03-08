<div class="row">
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('title') }}
        {{ Form::text('title', $complaintType->title, ['class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''), 'placeholder' => 'Title','required']) }}
        {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-3 mb-3">
        {{ Form::label('type') }}
        {{ Form::select('type', ['Sensitive'=>'Sensitive','Insensitive'=>'Insensitive'],$complaintType->type, ['class' => 'form-control form-select' . ($errors->has('type') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
        {!! $errors->first('type', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-3 mb-3">
        {{ Form::label('deadline') }}
        {{ Form::number('deadline', $complaintType->deadline, ['class' => 'form-control' . ($errors->has('deadline') ? ' is-invalid' : ''), 'placeholder' => 'Deadline','required','min'=>'1']) }}
        {!! $errors->first('deadline', '<div class="invalid-feedback">:message</div>') !!}
    </div>
	<div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
		<button type="submit" class="btn btn-primary ms-3">
			Submit <i class="ph-paper-plane-tilt ms-2"></i>
		</button>
	</div>
</div>