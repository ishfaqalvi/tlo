<div class="row">
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('project') }}
        {{ Form::select('project_id', projects(), $riskPlan->project_id, ['class' => 'form-control select' . ($errors->has('project_id') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
        {!! $errors->first('project_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('consequence') }}
        {{ Form::text('consequence', $riskPlan->consequence, ['class' => 'form-control' . ($errors->has('consequence') ? ' is-invalid' : ''), 'placeholder' => 'Consequence','required']) }}
        {!! $errors->first('consequence', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('probability') }}
        <select name="probability" class="form-control form-select" required>
            <option value="">--Select--</option>
            <option value="Low" class="text-success" {{ "Low" == $riskPlan->probability ? 'selected' : ''}}>Low</option>
            <option value="Medium" class="text-warning" {{ "Medium" == $riskPlan->probability ? 'selected' : ''}}>Medium</option>
            <option value="High" class="text-danger" {{ "High" == $riskPlan->probability ? 'selected' : ''}}>High</option>
        </select>
        {!! $errors->first('probability', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('impact') }}
        <select name="impact" class="form-control form-select" required>
            <option value="">--Select--</option>
            <option value="Low" class="text-success" {{ "Low" == $riskPlan->impact ? 'selected' : ''}}>Low</option>
            <option value="Medium" class="text-warning" {{ "Medium" == $riskPlan->impact ? 'selected' : ''}}>Medium</option>
            <option value="High" class="text-danger" {{ "High" == $riskPlan->impact ? 'selected' : ''}}>High</option>
        </select>
        {!! $errors->first('impact', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('priority') }}
        {{ Form::select('priority', ['1' => '1','2' => '2','3' => '3'], $riskPlan->priority, ['class' => 'form-control form-select' . ($errors->has('priority') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
        {!! $errors->first('priority', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('level') }}
        <select name="level" class="form-control form-select" required>
            <option value="">--Select--</option>
            <option value="9" class="text-danger" {{ "9" == $riskPlan->level ? 'selected' : ''}}>9</option>
            <option value="6" class="text-danger" {{ "6" == $riskPlan->level ? 'selected' : ''}}>6</option>
            <option value="3" class="text-warning" {{ "3" == $riskPlan->level ? 'selected' : ''}}>3</option>
            <option value="2" class="text-success" {{ "2" == $riskPlan->level ? 'selected' : ''}}>2</option>
        </select>
        {!! $errors->first('level', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('strategy') }}
        <select name="strategy" class="form-control form-select" required>
            <option value="">--Select--</option>
            <option value="Avoid" class="text-danger" {{ "Avoid" == $riskPlan->strategy ? 'selected' : ''}}>Avoid</option>
            <option value="Mitigate" class="text-danger" {{ "Mitigate" == $riskPlan->strategy ? 'selected' : ''}}>Mitigate</option>
            <option value="Transfer" class="text-warning" {{ "Transfer" == $riskPlan->strategy ? 'selected' : ''}}>Transfer</option>
            <option value="Accepted" class="text-success" {{ "Accepted" == $riskPlan->strategy ? 'selected' : ''}}>Accepted</option>
        </select>
        {!! $errors->first('strategy', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('action_date') }}
        {{ Form::text('action_date', date('m/d/Y', $riskPlan->action_date), ['class' => 'form-control action_date' . ($errors->has('action_date') ? ' is-invalid' : ''), 'placeholder' => 'Action Date','required']) }}
        {!! $errors->first('action_date', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('owner') }}
        {{ Form::text('owner', $riskPlan->owner, ['class' => 'form-control' . ($errors->has('owner') ? ' is-invalid' : ''), 'placeholder' => 'Owner','required']) }}
        {!! $errors->first('owner', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('status') }}
        {{ Form::select('status', ['Started' => 'Started','Open' => 'Open','Closed' => 'Closed'], $riskPlan->status, ['class' => 'form-control select' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
        {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="row">
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('responce') }}
        {{ Form::textarea('responce', $riskPlan->responce, ['class' => 'form-control' . ($errors->has('responce') ? ' is-invalid' : ''), 'placeholder' => 'Responce','required','rows'=>'3']) }}
        {!! $errors->first('responce', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('description') }}
        {{ Form::textarea('description', $riskPlan->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description','required','rows'=>'3']) }}
        {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
    </div>
	<div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
		<button type="submit" class="btn btn-primary ms-3">
			Submit <i class="ph-paper-plane-tilt ms-2"></i>
		</button>
	</div>
</div>