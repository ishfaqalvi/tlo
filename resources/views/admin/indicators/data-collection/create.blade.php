<div id="addRecord" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" action="{{ route('indicators.data-collections.store') }}" class="validateCreate" role="form" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Add Data Collection') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        {{ Form::hidden('indicator_id', $indicator->id) }}
                        @if($indicator->format != 'Qualitative Only')
                        <div class="form-group col-lg-6 mb-3">
                            {{ Form::label('collected_value') }}
                            {{ Form::number('collected_value', null, ['class' => 'form-control' . ($errors->has('collected_value') ? ' is-invalid' : ''), 'placeholder' => 'Collected Value','min'=>'0']) }}
                        </div>
                        @endif
                        <div class="form-group col-lg-6 mb-3">
                            {{ Form::label('date','Collected Date') }}
                            {{ Form::date('date', null, ['class' => 'form-control' . ($errors->has('date') ? ' is-invalid' : ''), 'placeholder' => 'Date','required']) }}
                        </div>
                        <div class="form-group col-lg-6 mb-3">
                            {{ Form::label('identifier') }}
                            {{ Form::text('identifier', null, ['class' => 'form-control' . ($errors->has('identifier') ? ' is-invalid' : ''), 'placeholder' => 'Identifier','required']) }}
                        </div>
                        <div class="form-group col-lg-6 mb-3">
                            {{ Form::label('site') }}
                            {{ Form::select('site_id', projectSites($indicator->project_id), null, ['class' => 'form-control' . ($errors->has('site_id') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
                        </div>
                        <div class="form-group col-lg-6 mb-3">
                            {{ Form::label('evidence') }}
                            {{ Form::file('evidence[]', ['class' => 'form-control' . ($errors->has('evidence') ? ' is-invalid' : ''), 'multiple']) }}
                        </div>
                        <div class="form-group col-lg-12 mb-3">
                            {{ Form::label('notes') }}
                            {{ Form::textarea('notes', null, ['class' => 'form-control' . ($errors->has('notes') ? ' is-invalid' : ''), 'placeholder' => 'Notes','rows'=>'3']) }}
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