<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            <span class="fw-normal">Project Activities</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            @can('projectActivity-create')
            <a href="#" data-bs-toggle="modal" data-bs-target="#addActivity" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
                <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                    <i class="ph-plus"></i>
                </span>
                Add Activity
            </a>
            @endcan
        </div>
    </div>
</div>
<table class="table datatable-basic">
    <thead class="thead">
        <tr>
            <th>No</th>
            <th>Site</th>
            <th>Project Phase</th>
            <th>Assign To</th>
            <th>Progress</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($project->activities as $key => $row)
        <tr>
            <td>{{ ++$key }}</td>
            <td>{{ $row->site->name }}</td>
            <td>{{ $row->projectPhase->name }}</td>
            <td>{{ $row->user->name }}</td>
            <td>{{ $row->activityProgress->title }}</td>
            <td>{{ $row->start_date ? date('d M Y', $row->start_date) : ''}}</td>
            <td>{{ date('d M Y', $row->end_date) }}</td>
            <td>{{ $row->status }}</td>
            <td class="text-center">
                @canany(['projectActivity-edit', 'projectActivity-delete'])
                <div class="d-inline-flex">
                    <div class="dropdown">
                        <a href="#" class="text-body" data-bs-toggle="dropdown">
                            <i class="ph-list"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <form action="{{ route('projects.activities.destroy',$row->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                @can('projectActivity-edit')
                                <a href="#" class="dropdown-item editActivity" data-record='@json($row)'>
                                    <i class="ph-note-pencil me-2"></i>{{ __('Edit') }}
                                </a>
                                @endcan
                                @can('projectActivity-delete')
                                    <button type="submit" class="dropdown-item sa-confirm">
                                        <i class="ph-trash me-2"></i>{{ __('Delete') }}
                                    </button>
                                @endcan
                            </form>
                        </div>
                    </div>
                </div>
                @endcanany
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<div id="addActivity" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('projects.activities.store') }}" class="createActivity" role="form" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Add Project Activity') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        {{ Form::hidden('project_id', $project->id) }}
                        <div class="form-group col-lg-6 mb-3">
                            {{ Form::label('site') }}
                            {{ Form::select('site_id', projectSites($project->id), null, ['class' => 'form-control select' . ($errors->has('site_id') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
                        </div>
                        <div class="form-group col-lg-6 mb-3">
                            {{ Form::label('project_phase') }}
                            {{ Form::select('project_phase_id', projectPhases($project->id), null, ['class' => 'form-control select' . ($errors->has('project_phase_id') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
                        </div>
                        <div class="form-group col-lg-6 mb-3">
                            {{ Form::label('assign_to') }}
                            {{ Form::select('assign_to', users(), null, ['class' => 'form-control select' . ($errors->has('assign_to') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
                        </div>
                        <div class="form-group col-lg-6 mb-3">
                            {{ Form::label('progress') }}
                            {{ Form::select('activity_progress_id', activityProgress(), null, ['class' => 'form-control select' . ($errors->has('activity_progress_id') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
                        </div>
                        <div class="form-group col-lg-6 mb-3">
                            {{ Form::label('status') }}
                            {{ Form::select('status', ['Active'=>'Active','InActive'=>'InActive'], null, ['class' => 'form-control form-select' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
                        </div>
                        <div class="form-group col-lg-6 mb-3">
                            {{ Form::label('milestone') }}
                            {{ Form::select('milestone', ['1' => 'Yes','0' => 'No'], null, ['class' => 'form-control form-select' . ($errors->has('milestone') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required', 'id' => 'milestone']) }}
                        </div>
                        <div class="form-group col-lg-6 mb-3 activityStartDate" style="display: none;">
                            {{ Form::label('start_date') }}
                            {{ Form::date('start_date', null, ['class' => 'form-control' . ($errors->has('start_date') ? ' is-invalid' : ''), 'placeholder' => 'Start Date']) }}
                        </div>
                        <div class="form-group col-lg-6 mb-3">
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
<div id="editActivity" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('projects.activities.update') }}" class="updatePhase" role="form" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Update Project Activity') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="id" id="activityId"> 
                        <div class="form-group col-lg-6 mb-3">
                            {{ Form::label('site') }}
                            {{ Form::select('site_id', projectSites($project->id), null, ['class' => 'form-control select' . ($errors->has('site_id') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required','id'=>'activitySiteId']) }}
                        </div>
                        <div class="form-group col-lg-6 mb-3">
                            {{ Form::label('project_phase') }}
                            {{ Form::select('project_phase_id', projectPhases($project->id), null, ['class' => 'form-control select' . ($errors->has('project_phase_id') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required','id'=>'activityPhaseId']) }}
                        </div>
                        <div class="form-group col-lg-6 mb-3">
                            {{ Form::label('assign_to') }}
                            {{ Form::select('assign_to', users(), null, ['class' => 'form-control select' . ($errors->has('assign_to') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required','id'=>'activityAssignTo']) }}
                        </div>
                        <div class="form-group col-lg-6 mb-3">
                            {{ Form::label('progress') }}
                            {{ Form::select('activity_progress_id', activityProgress(), null, ['class' => 'form-control select' . ($errors->has('activity_progress_id') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required','id'=>'activityProgressId']) }}
                        </div>
                        <div class="form-group col-lg-6 mb-3">
                            {{ Form::label('status') }}
                            {{ Form::select('status', ['Active'=>'Active','InActive'=>'InActive'], null, ['class' => 'form-control form-select' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required','id'=>'activityStatus']) }}
                        </div>
                        <div class="form-group col-lg-6 mb-3">
                            {{ Form::label('milestone') }}
                            {{ Form::select('milestone', ['1' => 'Yes','0' => 'No'], null, ['class' => 'form-control form-select' . ($errors->has('milestone') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required', 'id' => 'activityMilestone']) }}
                        </div>
                        <div class="form-group col-lg-6 mb-3 editActivityStartDate" style="display: none;">
                            {{ Form::label('start_date') }}
                            {{ Form::date('start_date', null, ['class' => 'form-control' . ($errors->has('start_date') ? ' is-invalid' : ''), 'placeholder' => 'Start Date','id'=>'activityStartDate']) }}
                        </div>
                        <div class="form-group col-lg-6 mb-3">
                            {{ Form::label('end_date') }}
                            {{ Form::date('end_date', null, ['class' => 'form-control' . ($errors->has('end_date') ? ' is-invalid' : ''), 'placeholder' => 'End Date','required','id'=>'activityEndDate']) }}
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