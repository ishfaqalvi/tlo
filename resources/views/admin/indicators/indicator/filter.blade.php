<div class="row">
    <div class="form-group col-md-9">
        {{ Form::select('project_id', projects(), !is_null($userRequest) ? $userRequest->project_id : '', ['class' => 'form-control select', 'placeholder' => '--Select Project--']) }}
    </div>
    <div class="form-group col-md-3">
        <button type="submit" class="btn btn-primary w-100">
            Submit <i class="ph-paper-plane-tilt ms-2"></i>
        </button>
    </div>
</div>