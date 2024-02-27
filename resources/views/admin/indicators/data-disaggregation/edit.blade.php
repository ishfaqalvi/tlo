<div id="editRecord" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('indicators.data-disaggregations.update') }}" class="validateUpdate" role="form" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Update Data Disaggregation') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        {{ Form::hidden('id', null,['id'=>'editId']) }}
                        <div class="form-group">
                            {{ Form::label('collected_value') }}
                            {{ Form::number('value', null, ['class' => 'form-control', 'placeholder' => 'Collected Value','min'=>'0','id'=>'editValue','required']) }}
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