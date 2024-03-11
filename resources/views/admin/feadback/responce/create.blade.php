<div id="addRespnce{{ $feadback->id }}" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('feadbacks.responces.store') }}" class="createPhase" role="form" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Feadback Responce') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        {{ Form::hidden('feadback_id', $feadback->id) }}
                        @if(in_array($feadback->status,['Pending','Reprocessing']))
                        <div class="form-group col-lg-12 mb-3">
                            {{ Form::label('status') }}
                            {{ Form::select('status', ['Assign' => 'Assign'], null, ['class' => 'form-control form-select' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
                            {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group col-lg-12">
                            {{ Form::label('committee') }}
                            {{ Form::select('description', [
                                    'Finance Team' => 'Finance Team',
                                    'Field Team' => 'Field Team',
                                    'Program Team' => 'Program Team',
                                    'Female Team' => 'Female Team'
                                ],null, ['class' => 'form-control form-select' . ($errors->has('committee') ? ' is-invalid' : ''), 'placeholder' => '-Select--','required']) }}
                            {!! $errors->first('committee', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        @endif
                        @if($feadback->status == 'Assign')
                        <div class="form-group col-lg-12 mb-3">
                            {{ Form::label('status') }}
                            {{ Form::select('status', ['Responce Share' => 'Responce Share'], null, ['class' => 'form-control form-select' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
                            {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group col-lg-12">
                            {{ Form::label('description') }}
                            {{ Form::textarea('description', null, ['class' => 'form-control form-select' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description','required','rows' => '3']) }}
                            {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        @endif
                        @if($feadback->status == 'Processing')
                        <div class="form-group col-lg-12 mb-3">
                            {{ Form::label('status') }}
                            {{ Form::select('status', ['Complainer Agree' => 'Complainer Agree','Complainer DisAgree'=>'Complainer DisAgree'], null, ['class' => 'form-control form-select' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
                            {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group col-lg-12">
                            {{ Form::label('description') }}
                            {{ Form::textarea('description', null, ['class' => 'form-control form-select' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description','required','rows' => '3']) }}
                            {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        @endif
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