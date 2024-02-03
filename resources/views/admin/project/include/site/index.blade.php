<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            <span class="fw-normal">Project Sites</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            @can('projectSite-create')
            <a href="#" data-bs-toggle="modal" data-bs-target="#addSite" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
                <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                    <i class="ph-plus"></i>
                </span>
                Add Site
            </a>
            @endcan
        </div>
    </div>
</div>
<table class="table datatable-basic">
    <thead class="thead">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Site Type</th>
            <th>Province</th>
            <th>Office</th>
            <th>Contact Name</th>
            <th>Contact Number</th>
            <th>Status</th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($project->sites as $key => $row)
        <tr>
            <td>{{ ++$key }}</td>
            <td>{{ $row->site->name }}</td>
            <td>{{ $row->site->siteType->title }}</td>
            <td>{{ $row->site->province->title }}</td>
            <td>{{ $row->site->office }}</td>
            <td>{{ $row->site->contact_name }}</td>
            <td>{{ $row->site->contact_number }}</td>
            <td>{{ $row->site->status }}</td>
            <td class="text-center">
                @canany(['projectSite-delete'])
                <div class="d-inline-flex">
                    <div class="dropdown">
                        <a href="#" class="text-body" data-bs-toggle="dropdown">
                            <i class="ph-list"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <form action="{{ route('projects.sites.destroy',$row->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                @can('projectSite-delete')
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
<div id="addSite" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('projects.sites.store') }}" class="site" role="form" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Add Project Site') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        {{ Form::hidden('project_id', $project->id) }}
                        <div class="form-group">
                            {{ Form::label('site') }}
                            {{ Form::select('site_id', sites(), null, ['class' => 'form-control select' . ($errors->has('site_id') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required','id'=>'site_id']) }}
                            {!! $errors->first('site_id', '<div class="invalid-feedback">:message</div>') !!}
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