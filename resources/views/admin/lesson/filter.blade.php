<div class="row">
    <div class="form-group col-md-6">
        {{ Form::select('project',projects(), !is_null($userRequest) ? $userRequest->project : '', ['class' => 'form-control select', 'placeholder' => '--Select Project--']) }}
    </div>
    <div class="form-group col-md-3">
        {{ Form::select('neded', ['Yes'=>'Yes','No'=>'No'],!is_null($userRequest) ? $userRequest->neded : '', ['class' => 'form-control select', 'placeholder' => '--Select Follow-up Needed--']) }}
    </div>
    <div class="form-group col-md-3">
        <button type="submit" class="btn btn-primary w-100">
            Submit <i class="ph-paper-plane-tilt ms-2"></i>
        </button>
    </div>
</div>