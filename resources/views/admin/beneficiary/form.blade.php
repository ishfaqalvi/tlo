<div class="row">
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('project_id','Project') }}
        {{ Form::select('project_id', projects(), $beneficiary->project_id, ['class' => 'form-control select' . ($errors->has('project_id') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
        {!! $errors->first('project_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('name') }}
        {{ Form::text('name', $beneficiary->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name','required']) }}
        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('father_name') }}
        {{ Form::text('father_name', $beneficiary->father_name, ['class' => 'form-control' . ($errors->has('father_name') ? ' is-invalid' : ''), 'placeholder' => 'Father Name','required']) }}
        {!! $errors->first('father_name', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('gender') }}
        {{ Form::select('gender', ['Male'=>'Male', 'Female'=>'Female'], $beneficiary->gender, ['class' => 'form-control form-select' . ($errors->has('gender') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
        {!! $errors->first('gender', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('marital_status') }}
        {{ Form::select('marital_status', ['Single'=>'Single', 'Engaged'=>'Engaged', 'Married'=>'Married', 'Divorced'=>'Divorced', 'Widow'=>'Widow'], $beneficiary->marital_status, ['class' => 'form-control form-select' . ($errors->has('marital_status') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
        {!! $errors->first('marital_status', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('residential_type') }}
        {{ Form::select('residential_type',['Local Resident'=>'Local Resident', 'Kochi'=>'Kochi', 'IDP'=>'IDP', 'Refugee'=>'Refugee'], $beneficiary->residential_type, ['class' => 'form-control form-select' . ($errors->has('residential_type') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
        {!! $errors->first('residential_type', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('province') }}
        {{ Form::text('province', $beneficiary->province, ['class' => 'form-control' . ($errors->has('province') ? ' is-invalid' : ''), 'placeholder' => 'Province','required']) }}
        {!! $errors->first('province', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('district') }}
        {{ Form::text('district', $beneficiary->district, ['class' => 'form-control' . ($errors->has('district') ? ' is-invalid' : ''), 'placeholder' => 'District','required']) }}
        {!! $errors->first('district', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('village') }}
        {{ Form::text('village', $beneficiary->village, ['class' => 'form-control' . ($errors->has('village') ? ' is-invalid' : ''), 'placeholder' => 'Village','required']) }}
        {!! $errors->first('village', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('contact') }}
        {{ Form::text('contact', $beneficiary->contact, ['class' => 'form-control' . ($errors->has('contact') ? ' is-invalid' : ''), 'placeholder' => 'Contact','required']) }}
        {!! $errors->first('contact', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-8 mb-3">
        {{ Form::label('type_of_assistance') }}
        {{ Form::text('type_of_assistance', $beneficiary->type_of_assistance, ['class' => 'form-control' . ($errors->has('type_of_assistance') ? ' is-invalid' : ''), 'placeholder' => 'Type Of Assistance','required']) }}
        {!! $errors->first('type_of_assistance', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-12 mb-3">
        {{ Form::label('remarks') }}
        {{ Form::textarea('remarks', $beneficiary->remarks, ['class' => 'form-control' . ($errors->has('remarks') ? ' is-invalid' : ''), 'placeholder' => 'Remarks','required','rows'=>'3']) }}
        {!! $errors->first('remarks', '<div class="invalid-feedback">:message</div>') !!}
    </div>

	<div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
		<button type="submit" class="btn btn-primary ms-3">
			Submit <i class="ph-paper-plane-tilt ms-2"></i>
		</button>
	</div>
</div>