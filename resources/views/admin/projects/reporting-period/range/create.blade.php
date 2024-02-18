<div id="addSubRecord" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('projects.reporting-periods.range.store') }}" class="createSubRecord" role="form" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Add Project Reprting Period Range') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        {{ Form::hidden('period_id', null,['id'=>'period_id']) }}
                        <div class="form-group col-lg-12 mb-3">
                            {{ Form::label('title') }}
                            {{ Form::text('title', null, ['class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''), 'placeholder' => 'Title','required']) }}
                        </div>
                        <div class="form-group col-lg-12 mb-3">
                            {{ Form::label('start_date') }}
                            {{ Form::date('start_date', null, ['class' => 'form-control' . ($errors->has('start_date') ? ' is-invalid' : ''), 'placeholder' => 'Start Date','required']) }}
                        </div>
                        <div class="form-group col-lg-12">
                            {{ Form::label('end_date') }}
                            {{ Form::date('end_date', null, ['class' => 'form-control' . ($errors->has('end_date') ? ' is-invalid' : ''), 'placeholder' => 'End Date','required']) }}
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