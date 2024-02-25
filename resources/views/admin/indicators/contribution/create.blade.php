<div id="addRecord" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('indicators.contributions.store') }}" class="createValidate" role="form" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Add Indicator') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        {{ Form::hidden('indicator_id', $indicator->id) }}
                        <div class="form-group col-lg-12 mb-3">
                            {{ Form::label('indicator') }}
                            {{ Form::select('contributer_id', contributerIndicators($indicator), null, ['class' => 'form-control select' . ($errors->has('contributer_id') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required','id'=>'contributer_id']) }}
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