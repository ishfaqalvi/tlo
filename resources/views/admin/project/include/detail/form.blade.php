<form method="POST" action="{{ route('projects.update', $project->id) }}" class="validate" role="form" enctype="multipart/form-data">
    @csrf
    {{ method_field('PATCH') }}
    <div class="row">   
        <div class="form-group col-lg-4 mb-3">
            {{ Form::label('name') }}
            {{ Form::text('name', $project->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name','required']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group col-lg-4 mb-3">
            {{ Form::label('start_date') }}
            {{ Form::text('start_date', date('m/d/Y',$project->start_date), ['class' => 'form-control start_date' . ($errors->has('start_date') ? ' is-invalid' : ''), 'placeholder' => 'Start Date','required']) }}
            {!! $errors->first('start_date', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group col-lg-4 mb-3">
            {{ Form::label('end_date') }}
            {{ Form::text('end_date', date('m/d/Y',$project->end_date), ['class' => 'form-control end_date' . ($errors->has('end_date') ? ' is-invalid' : ''), 'placeholder' => 'End Date','required']) }}
            {!! $errors->first('end_date', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group col-lg-4 mb-3">
            {{ Form::label('funding') }}
            {{ Form::text('funding', $project->funding, ['class' => 'form-control' . ($errors->has('funding') ? ' is-invalid' : ''), 'placeholder' => 'Funding']) }}
            {!! $errors->first('funding', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group col-lg-4 mb-3">
            {{ Form::label('location') }}
            {{ Form::text('location', $project->location, ['class' => 'form-control' . ($errors->has('location') ? ' is-invalid' : ''), 'placeholder' => 'Location']) }}
            {!! $errors->first('location', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group col-lg-4 mb-3">
            {{ Form::label('donnor') }}
            {{ Form::text('donnor', $project->donnor, ['class' => 'form-control' . ($errors->has('donnor') ? ' is-invalid' : ''), 'placeholder' => 'Donnor']) }}
            {!! $errors->first('donnor', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group col-lg-4 mb-3">
            {{ Form::label('partner') }}
            {{ Form::text('partner', $project->partner, ['class' => 'form-control' . ($errors->has('partner') ? ' is-invalid' : ''), 'placeholder' => 'Partner']) }}
            {!! $errors->first('partner', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group col-lg-4 mb-3">
            {{ Form::label('assigned_to') }}
            {{ Form::select('assigned_to', users(), $project->assigned_to, ['class' => 'form-control select' . ($errors->has('assigned_to') ? ' is-invalid' : ''), 'placeholder' => '--Select--']) }}
            {!! $errors->first('assigned_to', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group col-lg-4 mb-3">
            {{ Form::label('category') }}
            {{ Form::select('category_id', categories(), $project->category_id, ['class' => 'form-control select' . ($errors->has('category_id') ? ' is-invalid' : ''), 'placeholder' => '--Select--']) }}
            {!! $errors->first('category_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group col-lg-4 mb-3">
            {{ Form::label('status') }}
            {{ Form::select('status', ['Pipeline/Identification'=>'Pipeline/Identification','Implementation'=>'Implementation','Finalisation'=>'Finalisation','Closed'=>'Closed','Cancelled'=>'Cancelled','Suspended'=>'Suspended'], $project->status, ['class' => 'form-control select' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => '--Select--']) }}
            {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group col-lg-12 mb-3">
            {{ Form::label('description') }}
            {{ Form::text('description', $project->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description','id'=>'ckeditor']) }}
            {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
            <button type="submit" class="btn btn-primary ms-3">
                Submit <i class="ph-paper-plane-tilt ms-2"></i>
            </button>
        </div>
    </div>
</form>