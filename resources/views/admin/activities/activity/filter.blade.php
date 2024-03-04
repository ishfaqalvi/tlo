<div class="row">
    <div class="form-group col-md-3 mb-3">
        {{ Form::label('project') }}
        {{ Form::select('project_id',projects(), !is_null($userRequest) ? $userRequest->project_id : '', ['class' => 'form-control select', 'placeholder' => '--Select--','required']) }}
    </div>
    <div class="form-group col-md-3 mb-3">
        {{ Form::label('assigned_to') }}
        {{ Form::select('assign_to', users(), !is_null($userRequest) ? $userRequest->assign_to : '', ['class' => 'form-control select', 'placeholder' => '--Select--']) }}
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
        {{ Form::label('progress') }}
        {{ Form::select('progress', ['Open'=>'Open','In Progress'=>'In Progress','Closed'=>'Closed'],!is_null($userRequest) ? $userRequest->progress : '', ['class' => 'form-control select', 'placeholder' => '--Select--']) }}
    </div>
    <div class="form-group col-md-9">
        <input type="text" class="form-control" name="search" value="{{ !is_null($userRequest) ? $userRequest->search : ''}}" placeholder="Search (Name, Formula, Description)">  
    </div>
    <div class="form-group col-md-3">
        <button type="submit" class="btn btn-primary w-100">
            Submit <i class="ph-paper-plane-tilt ms-2"></i>
        </button>
    </div>
</div>