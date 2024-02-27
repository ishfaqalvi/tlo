<div id="addRecord" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('indicators.data-disaggregations.store') }}" class="validateCreate" role="form" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Available Disaggregations') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        {{ Form::hidden('collection_id', $dataCollect->id) }}
                        <div class="form-group mb-3">
                            {{ Form::label('disaggregation_id','Available Disaggregations') }}
                            {{ Form::select('disaggregation_id', indicatorDisaggregations($indicator->id), $disaggregation->disaggregation_id, ['class' => 'form-control select', 'placeholder' => '--Select--','required','id'=>'disaggregation_id']) }}
                        </div>
                        <div id="child-fields-container"></div>
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