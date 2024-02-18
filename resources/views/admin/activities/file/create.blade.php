<div id="addFile" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('activities.files.store') }}" class="createFile" role="form" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Add Activity File') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        {{ Form::hidden('project_id', $activity->project_id) }}
                        {{ Form::hidden('activity_id', $activity->id) }}
                        <div class="col-md-12">
                            <label class="form-check mb-2">
                                <input type="radio" class="form-check-input form-check-input-info" name="type" checked id="uploadFile" value="Upload">
                                <span class="form-check-label">Upload a file</span>
                            </label>
                        </div>
                        <div class="col-md-12">
                            <label class="form-check mb-2">
                                <input type="radio" class="form-check-input form-check-input-info" name="type" id="fileUrl" value="Provide Url">
                                <span class="form-check-label">Provide a URL/path to a file</span>
                            </label>
                        </div>
                    </div>
                    <div class="row uploadFile">
                        <div class="form-group col-lg-12 mb-3">
                            {{ Form::label('fiels') }}
                            {{ Form::file('files[]', ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'multiple','id' => 'fileUpload']) }}
                        </div>
                        <div class="form-group col-lg-12 mb-3" id="fileNames"></div>
                    </div>
                    <div class="row fileUrl" style="display: none;">
                        <div class="form-group col-lg-12 mb-3">
                            {{ Form::label('name') }}
                            {{ Form::text('name', null, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
                        </div>
                        <div class="form-group col-lg-12 mb-3">
                            {{ Form::label('path') }}
                            {{ Form::text('path', null, ['class' => 'form-control' . ($errors->has('path') ? ' is-invalid' : ''), 'placeholder' => 'Path']) }}
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