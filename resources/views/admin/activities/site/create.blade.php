<div id="addSite" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" action="{{ route('activities.sites.store') }}" class="validate" role="form" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Add Activity Site') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        {{ Form::hidden('activity_id', $activity->id) }}
                        <div class="form-group col-lg-6 mb-3">
                            {{ Form::label('Add Site') }}
                            {{ Form::select('type', ['Add From Existing' => 'Add From Existing', 'New Add' => 'New Add'], null, ['class' => 'form-control select' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
                        </div>
                        <div class="form-group col-lg-6 mb-3 existingSites" style="display: none;">
                            {{ Form::label('Existing Sites') }}
                            {{ Form::select('site_id', sites(), null, ['class' => 'form-control select' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => '--Select--','id'=>'site_id']) }}
                        </div>
                    </div>
                    <div class="row newSite" style="display: none;">
                        <div class="form-group col-lg-4 mb-3">
                            {{ Form::label('name') }}
                            {{ Form::text('name', null, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
                        </div>
                        <div class="form-group col-lg-4 mb-3">
                            {{ Form::label('thematic_area') }}
                            {{ Form::select('thematic_area_id', thematicAreas(), null, ['class' => 'form-control select' . ($errors->has('thematic_area_id') ? ' is-invalid' : ''), 'placeholder' => '--Select--']) }}
                        </div>
                        <div class="form-group col-lg-4 mb-3">
                            {{ Form::label('status') }}
                            {{ Form::select('status', ['Active'=>'Active','InActive'=>'InActive'], null, ['class' => 'form-control select' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => '--Select--']) }}
                        </div>
                        <div class="form-group col-lg-4 mb-3">
                            {{ Form::label('contact_name') }}
                            {{ Form::text('contact_name', null, ['class' => 'form-control' . ($errors->has('contact_name') ? ' is-invalid' : ''), 'placeholder' => 'Contact Name']) }}
                        </div>
                        <div class="form-group col-lg-4 mb-3">
                            {{ Form::label('contact_number') }}
                            {{ Form::text('contact_number', null, ['class' => 'form-control' . ($errors->has('contact_number') ? ' is-invalid' : ''), 'placeholder' => 'Contact Number']) }}
                        </div>
                        <div class="form-group col-lg-4 mb-3">
                            {{ Form::label('province') }}
                            {{ Form::select('province_id', provinces(), null, ['class' => 'form-control select' . ($errors->has('province_id') ? ' is-invalid' : ''), 'placeholder' => '--Select--']) }}
                        </div>
                        <div class="form-group col-lg-4 mb-3">
                            {{ Form::label('office') }}
                            {{ Form::text('office', null, ['class' => 'form-control' . ($errors->has('office') ? ' is-invalid' : ''), 'placeholder' => 'Office']) }}
                        </div>
                        <div class="form-group col-lg-4 mb-3">
                            {{ Form::label('latitude') }}
                            {{ Form::text('latitude', null, ['class' => 'form-control' . ($errors->has('latitude') ? ' is-invalid' : ''), 'placeholder' => 'Latitude']) }}
                        </div>
                        <div class="form-group col-lg-4 mb-3">
                            {{ Form::label('longitude') }}
                            {{ Form::text('longitude', null, ['class' => 'form-control' . ($errors->has('longitude') ? ' is-invalid' : ''), 'placeholder' => 'Longitude']) }}
                        </div>
                        <div class="form-group col-lg-12 mb-3">
                            {{ Form::label('note') }}
                            {{ Form::textarea('note', null, ['class' => 'form-control' . ($errors->has('note') ? ' is-invalid' : ''), 'placeholder' => 'Note','rows'=>'3','id'=>'ckeditor']) }}
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