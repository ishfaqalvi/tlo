<div id="editModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('projects.disaggregation.update') }}" class="editAggregation" role="form" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Update Project Disaggregation') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        {{ Form::hidden('id', null,['id'=>'idField']) }}
                        <div class="form-group col-lg-12 mb-3">
                            {{ Form::label('disaggregation_type') }}
                            {{ Form::text('type', null, ['class' => 'form-control' . ($errors->has('type') ? ' is-invalid' : ''), 'placeholder' => 'Disaggregation Type','id'=>'typeField']) }}
                        </div>
                        <div class="form-group col-lg-12 mb-3">
                            {{ Form::label('fields') }}
                            {{ Form::select('fields[]', [], null, ['class' => 'form-control select' . ($errors->has('fields') ? ' is-invalid' : ''), 'multiple' => 'multiple', 'data-tags' => 'true','required','id'=>'fields']) }}
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