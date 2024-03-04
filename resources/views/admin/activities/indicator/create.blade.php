<div id="addRecord" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('activities.indicators.store') }}" class="createRecord" role="form" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Add Activity Indicator') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        {{ Form::hidden('activity_id', $activity->id) }}
                        <div class="form-group col-lg-12">
                            {{ Form::label('indicator') }}
                            {{ Form::select('indicator_id', indicators($activity->project_id), null, ['class' => 'form-control select' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required','id'=>'indicator_id']) }}
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