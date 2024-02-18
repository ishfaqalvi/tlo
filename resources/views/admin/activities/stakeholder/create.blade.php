<div id="addStakeholder" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('activities.stakeholder.store') }}" class="validate" role="form" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Add Activity Stakeholder') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        {{ Form::hidden('activity_id', $activity->id) }}
                        <div class="form-group col-lg-12 mb-3">
                            {{ Form::label('Add Stakeholder') }}
                            {{ Form::select('option', ['Add From Existing' => 'Add From Existing', 'New Add' => 'New Add'], null, ['class' => 'form-control select' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
                        </div>
                        <div class="form-group col-lg-12 mb-3 existingStakeholder" style="display: none;">
                            {{ Form::label('Existing stakeholder') }}
                            {{ Form::select('stakeholder_id', stakeholders(), null, ['class' => 'form-control select' . ($errors->has('stakeholder_id') ? ' is-invalid' : ''), 'placeholder' => '--Select--','id'=>'stakeholder_id']) }}
                        </div>
                    </div>
                    <div class="row newStakeholder" style="display: none;">
                        <div class="form-group col-lg-12 mb-3">
                            {{ Form::label('name') }}
                            {{ Form::text('name', null, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
                        </div>
                        <div class="form-group col-lg-12 mb-3">
                            {{ Form::label('type') }}
                            {{ Form::text('type', null, ['class' => 'form-control' . ($errors->has('type') ? ' is-invalid' : ''), 'placeholder' => 'Type']) }}
                        </div>
                        <div class="form-group col-lg-12 mb-3">
                            {{ Form::label('role') }}
                            {{ Form::select('stakeholder_role_id', stakeholderRoles(), null, ['class' => 'form-control select' . ($errors->has('stakeholder_role_id') ? ' is-invalid' : ''), 'placeholder' => '--Select--']) }}
                        </div>
                        <div class="form-group col-lg-12 mb-3">
                            {{ Form::label('province') }}
                            {{ Form::select('province_id', provinces(), null, ['class' => 'form-control select' . ($errors->has('province_id') ? ' is-invalid' : ''), 'placeholder' => '--Select--']) }}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>