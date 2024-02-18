<div id="editPhase" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('projects.phase.update') }}" class="updatePhase" role="form" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Update Project Phase') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="id" id="phaseId"> 
                        <div class="form-group col-lg-12 mb-3">
                            {{ Form::label('name') }}
                            {{ Form::text('name', null, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name','required', 'id' => 'phaseName']) }}
                            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group col-lg-6 mb-3">
                            {{ Form::label('start_date') }}
                            {{ Form::date('start_date', null, ['class' => 'form-control' . ($errors->has('start_date') ? ' is-invalid' : ''), 'placeholder' => 'Start Date','required', 'id' => 'phaseStartDate']) }}
                            {!! $errors->first('start_date', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group col-lg-6 mb-3">
                            {{ Form::label('end_date') }}
                            {{ Form::date('end_date', null, ['class' => 'form-control' . ($errors->has('end_date') ? ' is-invalid' : ''), 'placeholder' => 'End Date','required', 'id' => 'phaseEndDate']) }}
                            {!! $errors->first('end_date', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group col-lg-12">
                            {{ Form::label('description') }}
                            {{ Form::textarea('description', null, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description','rows'=>'4', 'id' => 'phaseDescription']) }}
                            {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
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