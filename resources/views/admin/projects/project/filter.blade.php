<div class="row">
    <div class="form-group col-md-3 mb-3">
        {{ Form::label('category') }}
        {{ Form::select('category_id', categories(), !is_null($userRequest) ? $userRequest->category_id : '', ['class' => 'form-control select', 'placeholder' => '--Select--']) }}
    </div>
    <div class="form-group col-md-3 mb-3">
        {{ Form::label('assigned_to') }}
        {{ Form::select('assigned_to', users(), !is_null($userRequest) ? $userRequest->assigned_to : '', ['class' => 'form-control select', 'placeholder' => '--Select--']) }}
    </div>
    <div class="form-group col-md-3 mb-3">
        {{ Form::label('stage') }}
        {{ Form::select('stage', [
            'Pipeline/Identification' => 'Pipeline/Identification',
            'Implementation'          => 'Implementation',
            'Finalisation'            => 'Finalisation',
            'Inprogress'              => 'Inprogress',
            'On Track'                => 'On Track',
            'Delays'                  => 'Delays',
            'Closed'                  => 'Closed',
            'Cancelled'               => 'Cancelled',
            'Suspended'               => 'Suspended'
            ], !is_null($userRequest) ? $userRequest->stage : '', ['class' => 'form-control select', 'placeholder' => '--Select--']) }}
    </div>
    <div class="form-group col-md-3 mb-3">
        {{ Form::label('status') }}
        <select name="status" data-placeholder="--Select--" class="form-control select-icons" id="projectStatus">
            <option value="">--Select--</option>
            <option 
                value="Green" data-color="text-success" 
                {{ !is_null($userRequest) ? $userRequest->status == "Green" ? 'selected' : '' : ''}}>
                Green
            </option>
            <option 
                value="Amber" data-color="text-warning"
                {{ !is_null($userRequest) ? $userRequest->status == "Amber" ? 'selected' : '' : ''}}> 
                Amber
            </option>
            <option 
                value="Red" data-color="text-danger" 
                {{ !is_null($userRequest) ? $userRequest->status == "Red" ? 'selected' : '' : ''}}>
                Red
            </option>
        </select>
    </div>
    <div class="form-group col-md-3 mb-3">
        {{ Form::text('donnor', !is_null($userRequest) ? $userRequest->donnor : '', ['class' => 'form-control', 'placeholder' => 'Donnor']) }}
    </div>
    <div class="form-group col-md-3 mb-3">
        {{ Form::text('partner', !is_null($userRequest) ? $userRequest->partner : '', ['class' => 'form-control', 'placeholder' => 'Partner']) }}
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="form-group col-md-9">
                <input type="text" class="form-control" name="search" value="{{ !is_null($userRequest) ? $userRequest->search : ''}}" placeholder="Search (Name, Description)">  
            </div>
            <div class="form-group col-md-3">
                <button type="submit" class="btn btn-primary w-100">
                    Submit <i class="ph-paper-plane-tilt ms-2"></i>
                </button>
            </div>
        </div>
    </div>
</div>