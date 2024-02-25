<div id="editRecord" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('resultFrameworks.update') }}" class="updateRecord" role="form" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Update Results Framework') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        {{ Form::hidden('id', null,['id'=>'editId']) }}
                        <div class="form-group col-lg-12 mb-3">
                            {{ Form::label('title') }}
                            {{ Form::text('title', null, ['class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''), 'placeholder' => 'Title','required', 'id'=>'editTitle']) }}
                        </div>
                        <div class="form-group col-lg-12 mb-3">
                            {{ Form::label('order') }}
                            {{ Form::number('order', null, ['class' => 'form-control' . ($errors->has('order') ? ' is-invalid' : ''), 'placeholder' => 'Order','required','min'=>'1', 'id'=>'editOrder']) }}
                        </div>
                        <div class="form-group col-lg-12 mb-3">
                            {{ Form::label('color') }}
                            <div class="border p-3 rounded">
                                <div class="form-check form-switch text-end mb-2">
                                    <input type="radio" class="form-check-input bg-pink" name="color" id="color1" value="bg-pink" checked required>
                                    <label class="form-check-label" for="color1">Pink</label>
                                </div>
                                <div class="form-check form-switch text-end mb-2">
                                    <input type="radio" class="form-check-input bg-purple" name="color" id="color2" value="bg-purple" required>
                                    <label class="form-check-label" for="color2">Purple</label>
                                </div>
                                <div class="form-check form-switch text-end mb-2">
                                    <input type="radio" class="form-check-input bg-indigo" name="color" id="color3"  value="bg-indigo" required>
                                    <label class="form-check-label" for="color3">Indigo</label>
                                </div>
                                <div class="form-check form-switch text-end mb-2">
                                    <input type="radio" class="form-check-input bg-teal" name="color" id="color4" value="bg-teal" required>
                                    <label class="form-check-label" for="color4">Teal</label>
                                </div>
                                <div class="form-check form-switch text-end mb-2">
                                    <input type="radio" class="form-check-input bg-yellow" name="color" id="color5" value="bg-yellow" required>
                                    <label class="form-check-label" for="color4">Yellow</label>
                                </div>
                            </div>
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