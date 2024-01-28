<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            <span class="fw-normal">Project Stakeholders</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            @can('projectStakeholder-create')
            <a href="#" data-bs-toggle="modal" data-bs-target="#addStakeholder" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
                <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                    <i class="ph-plus"></i>
                </span>
                Add New
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
			<th>Role</th>
			<th>Type</th>
			<th>Province</th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($project->stakeholders as $key => $row)
        <tr>
            <td>{{ ++$key }}</td>
			<td>{{ $row->stakeholder->name }}</td>
			<td>{{ $row->stakeholder->role }}</td>
			<td>{{ $row->stakeholder->type }}</td>
			<td>{{ $row->stakeholder->province->title }}</td>
            <td class="text-center">
            	@canany(['projects-view', 'projects-edit', 'projects-delete'])
				<div class="d-inline-flex">
				    <div class="dropdown">
				        <a href="#" class="text-body" data-bs-toggle="dropdown">
				            <i class="ph-list"></i>
				        </a>
				        <div class="dropdown-menu dropdown-menu-end">
				            <form action="{{ route('projects.stakeholder.destroy',$row->id) }}" method="POST">
				                @csrf
				                @method('DELETE')
				                @can('projects-delete')
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
@include('admin.project.include.stakeholder.create')