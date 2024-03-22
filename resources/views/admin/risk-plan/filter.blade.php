<div class="row">
    <div class="form-group col-md-6 mb-3">
        {{ Form::label('project') }}
        {{ Form::select('project',projects(), !is_null($userRequest) ? $userRequest->project : '', ['class' => 'form-control form-select', 'placeholder' => '--Select Project--']) }}
    </div>
    <div class="form-group col-lg-3 mb-3">
        {{ Form::label('probability') }}
        <select name="probability" class="form-control form-select">
            <option value="">--Select--</option>
            <option 
                value="High 3" 
                class="text-danger" 
                {{ !is_null($userRequest) ? "High 3" == $userRequest->probability ? 'selected' : '' : ''}}>
                High 3
            </option>
            <option 
                value="Medium 2" 
                class="text-warning" 
                {{ !is_null($userRequest) ? "Medium 2" == $userRequest->probability ? 'selected' : '' : ''}}>
                Medium 2
            </option>
            <option 
                value="Low 1" 
                class="text-success" 
                {{ !is_null($userRequest) ? "Low 1" == $userRequest->probability ? 'selected' : '' : ''}}>
                Low 1
            </option>
        </select>
    </div>
    <div class="form-group col-lg-3 mb-3">
        {{ Form::label('impact') }}
        <select name="impact" class="form-control form-select">
            <option value="">--Select--</option>
            <option 
                value="High 3" 
                class="text-danger" 
                {{ !is_null($userRequest) ? "High 3" == $userRequest->impact ? 'selected' : '' : ''}}>
                High 3
            </option>
            <option 
                value="Medium 2" 
                class="text-warning" 
                {{ !is_null($userRequest) ? "Medium 2" == $userRequest->impact ? 'selected' : '' : ''}}>
                Medium 2
            </option>
            <option 
                value="Low 1" 
                class="text-success" 
                {{ !is_null($userRequest) ? "Low 1" == $userRequest->impact ? 'selected' : '' : ''}}>
                Low 1
            </option>
        </select>
    </div>
    <div class="form-group col-lg-3">
        {{ Form::label('priority','Risk Priority') }}
        {{ Form::select('priority', ['1' => '1','2' => '2','3' => '3'], $userRequest->priority ?? '', ['class' => 'form-control form-select', 'placeholder' => '--Select--']) }}
    </div>
    <div class="form-group col-lg-3">
        {{ Form::label('level','Risk Level') }}
        <select name="level" class="form-control form-select">
            <option value="">--Select--</option>
            <option 
                value="9" 
                class="text-danger" 
                {{ !is_null($userRequest) ? "9" == $userRequest->level ? 'selected' : '' : ''}}>
                9
            </option>
            <option 
                value="6" 
                class="text-danger" 
                {{ !is_null($userRequest) ? "6" == $userRequest->level ? 'selected' : '' : ''}}>
                6
            </option>
            <option 
                value="3" 
                class="text-warning" 
                {{ !is_null($userRequest) ? "3" == $userRequest->level ? 'selected' : '' : ''}}>
                3
            </option>
            <option 
                value="2" 
                class="text-success" 
                {{ !is_null($userRequest) ? "2" == $userRequest->level ? 'selected' : '' : ''}}>
                2
            </option>
        </select>
    </div>
    <div class="form-group col-lg-3">
        {{ Form::label('strategy','Risk Strategy') }}
        <select name="strategy" class="form-control form-select">
            <option value="">--Select--</option>
            <option 
                value="Avoid" 
                class="text-danger" 
                {{ !is_null($userRequest) ? "Avoid" == $userRequest->strategy ? 'selected' : '' : '' }}>
                Avoid
            </option>
            <option 
                value="Mitigate" 
                class="text-danger" 
                {{ !is_null($userRequest) ? "Mitigate" == $userRequest->strategy ? 'selected' : '' : '' }}>
                Mitigate
            </option>
            <option 
                value="Transfer" 
                class="text-warning" 
                {{ !is_null($userRequest) ? "Transfer" == $userRequest->strategy ? 'selected' : '' : '' }}>
                Transfer
            </option>
            <option 
                value="Accepted" 
                class="text-success" 
                {{ !is_null($userRequest) ? "Accepted" == $userRequest->strategy ? 'selected' : '' : '' }}>
                Accepted
            </option>
        </select>
    </div>
    <div class="form-group col-lg-3">
        {{ Form::label('status') }}
        {{ Form::select('status', ['Started' => 'Started','Open' => 'Open','Closed' => 'Closed'], $userRequest->status ?? '', ['class' => 'form-control select', 'placeholder' => '--Select--']) }}
    </div>
    <div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
        <button type="submit" class="btn btn-primary ms-3">
            Submit <i class="ph-paper-plane-tilt ms-2"></i>
        </button>
    </div>
</div>