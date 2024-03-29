@extends('admin.layout.app')

@section('title')
    Project
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Project Management</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <button class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill me-2 collapsed" data-bs-toggle="collapse" data-bs-target="#filters" aria-expanded="true">
                <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                    <i class="ph-funnel"></i>
                </span>
                Filter
            </button>
            @can('projects-create')
            <a href="{{ route('projects.create')}}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
                <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                    <i class="ph-plus"></i>
                </span>
                Add Project
            </a>
            @endcan
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="col-sm-12">
    <div class="card collapse {{ !is_null($userRequest) ? 'show' : ''}}" id="filters">
        <div class="card-body">
            <form action="{{route('projects.filter')}}" method="post">
                @csrf
                @include('admin.projects.project.filter')
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Project</h5>
        </div>
        <table class="table datatable-basic">
            <thead class="thead">
                <tr>
                    <th>No</th>
                    <th>Contract #</th>
                    <th>Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Category</th>
                    <th>Donnor</th>
                    <th>Status</th>
                    <th>Created By</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($projects as $key => $project)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $project->project_contract_number }}</td>
                    <td>
                        @if(auth()->user()->can('projects-edit'))
                            <a href="{{ route('projects.edit',$project->id) }}">
                                {{ $project->name }}
                            </a>
                        @else
                            {{ $project->name }}
                        @endif
                    </td>
                    <td>{{ date('d M Y',$project->start_date) }}</td>
                    <td>{{ date('d M Y',$project->end_date) }}</td>
                    <td>{{ $project->category->title ?? "" }}</td>
                    <td>{{ $project->donnor }}</td>
                    <td class="text-center">
                        @if($project->status == 'Green')
                            <i class="fas fa-circle fa-1x text-success" title="{{ $project->status }}"></i>
                        @elseif($project->status == 'Amber')
                            <i class="fas fa-circle fa-1x text-warning" title="{{ $project->status }}"></i>
                        @elseif($project->status == 'Red')
                            <i class="fas fa-circle fa-1x text-danger" title="{{ $project->status }}"></i>
                        @endif
                    </td>
                    <td>{{ $project->creator->name }}</td>
                    <td class="text-center">@include('admin.projects.project.actions')</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('script')
<script>
    $(function () {
        const swalInit = swal.mixin({
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-light',
                denyButton: 'btn btn-light',
                input: 'form-control'
            }
        });
        $(".sa-confirm").click(function (event) {
            event.preventDefault();
            swalInit.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                }
            }).then((result) => {
                if (result.value === true)  $(this).closest("form").submit();
            });
        });
        function iconFormat(icon) {
            var originalOption = icon.element;
            if (!icon.id) { return icon.text; }
            var $icon = '<i class="fas fa-circle fa-1x ' + $(icon.element).data('color') + '"></i>' + icon.text;
            return $icon;
        }
        $('.select-icons').select2({
            templateResult: iconFormat,
            minimumResultsForSearch: Infinity,
            templateSelection: iconFormat,
            escapeMarkup: function(m) { return m; }
        });
        $('.select').select2();
    });
</script>
@endsection