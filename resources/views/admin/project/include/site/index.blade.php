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
@foreach ($project->sites as $key => $row)
@php($site = $row->site)
<div class="row">
    <div class="col-md-8">
        <div class="map-container" id="map{{ $key }}"></div>
        <script type="text/javascript">
            var map = L.map('map<?php echo $key ?>').setView([
                "<?php echo $site->latitude ?>", "<?php echo $site->longitude ?>"], 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                className: 'map-leaflet'
            }).addTo(map);
            L.marker(["<?php echo $site->latitude ?>", "<?php echo $site->longitude ?>"]).addTo(map).bindPopup("<?php echo $site->name ?>").openPopup();
        </script>
    </div>
    <div class="col-md-4">
        <form action="{{ route('projects.sites.destroy',$row->id) }}" method="POST">
            @csrf
            @method('DELETE')
            @can('projectSite-delete')
                <button type="submit" class="btn btn-outline-danger sa-confirm">
                    <i class="ph-trash me-2"></i>{{ __('Delete') }}
                </button>
            @endcan
        </form>
        <div class="form-group mb-3">
            <strong>Site Type:</strong>
            {{ $site->siteType->title }}
        </div>
        <div class="form-group mb-3">
            <strong>Province:</strong>
            {{ $site->province->title }}
        </div>
        <div class="form-group mb-3">
            <strong>Name:</strong>
            {{ $site->name }}
        </div>
        <div class="form-group mb-3">
            <strong>Office:</strong>
            {{ $site->office }}
        </div>
        <div class="form-group mb-3">
            <strong>Contact Name:</strong>
            {{ $site->contact_name }}
        </div>
        <div class="form-group mb-3">
            <strong>Contact Number:</strong>
            {{ $site->contact_number }}
        </div>
        <div class="form-group mb-3">
            <strong>Latitude:</strong>
            {{ $site->latitude }}
        </div>
        <div class="form-group mb-3">
            <strong>Longitude:</strong>
            {{ $site->longitude }}
        </div>
        <div class="form-group mb-3">
            <strong>Status:</strong>
            {{ $site->status }}
        </div>
        <div class="form-group mb-3">
            <strong>Note:</strong>
            {{ $site->note }}
        </div>
    </div>
</div>
<hr>
@endforeach
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