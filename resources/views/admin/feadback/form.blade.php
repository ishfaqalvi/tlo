<div class="fw-bold border-bottom pb-2 mb-3">Complainer Information</div>
<div class="row">
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('complainer_type') }}
        {{ Form::select('complainer_type', [
            'Beneficiary' => 'Beneficiary',
            'Non-Beneficiary' => 'Non-Beneficiary',
            'Partner & TLO Staff' => 'Partner & TLO Staff',
            'Other Stakeholders' => 'Other Stakeholders'
        ], $feadback->complainer_type, ['class' => 'form-control form-select' . ($errors->has('complainer_type') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
        {!! $errors->first('complainer_type', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('name') }}
        {{ Form::text('name', $feadback->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name','required']) }}
        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('contact_number') }}
        {{ Form::text('contact_number', $feadback->contact_number, ['class' => 'form-control' . ($errors->has('contact_number') ? ' is-invalid' : ''), 'placeholder' => 'Contact Number','required']) }}
        {!! $errors->first('contact_number', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-12 mb-3">
        {{ Form::label('address') }}
        {{ Form::text('address', $feadback->address, ['class' => 'form-control' . ($errors->has('address') ? ' is-invalid' : ''), 'placeholder' => 'Address','required']) }}
        {!! $errors->first('address', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="fw-bold border-bottom pb-2 mb-3">Complaint Information</div>
<div class="row">
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('channel') }}
        {{ Form::select('channel',[
                'Complaint Box' => 'Complaint Box',
                'Designated Community Focal Point' => 'Designated Community Focal Point',
                'Email' => 'Email',
                'Phone Line' => 'Phone Line',
                'Text Message' => 'Text Message',
                'Community Meeting' => 'Community Meeting',
                'Face-to-Face' => 'Face-to-Face',
                'Other Bright Ideas' => 'Other Bright Ideas'
            ], $feadback->channel, ['class' => 'form-control form-select' . ($errors->has('channel') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
        {!! $errors->first('channel', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('other_channel') }}
        {{ Form::text('other_channel', $feadback->other_channel, ['class' => 'form-control' . ($errors->has('other_channel') ? ' is-invalid' : ''), 'placeholder' => 'Other Channel','required','disabled','id'=>'other_channel']) }}
        {!! $errors->first('other_channel', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-4 mb-3">
        {{ Form::label('attachment') }}
        {{ Form::file('attachment', ['class' => 'form-control' . ($errors->has('attachment') ? ' is-invalid' : '')]) }}
        {!! $errors->first('attachment', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-12 mb-3">
        {{ Form::label('complaint_type_id','Type') }}
        <select name="complaint_type_id" class="form-control form-select" required>
            <option value="">--Select--</option>
            @foreach(complaintTypes() as $row)
            <option 
                value="{{ $row->id }}" 
                class="{{ $row->type == 'Sensitive' ? 'text-danger' : 'text-info'}}"
                {{ $row->id == $feadback->complaint_type_id ? 'selected' : ''}}
                >
                {{ $row->title.' ('.$row->deadline.')' }}        
            </option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-lg-12 mb-3">
        {{ Form::label('description') }}
        {{ Form::textarea('description', $feadback->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description','rows'=>'3']) }}
        {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
    </div>
	<div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
		<button type="submit" class="btn btn-primary ms-3">
			Submit <i class="ph-paper-plane-tilt ms-2"></i>
		</button>
	</div>
</div>