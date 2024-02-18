@extends('admin.layout.app')

@section('title')
    Project Phases
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Project Phases Management</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            @can('projectPhase-create')
            <a href="#" data-bs-toggle="modal" data-bs-target="#addPhase" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
                <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                    <i class="ph-plus"></i>
                </span>
                Add Phase
            </a>
            @endcan
        </div>
    </div>
</div>
<div class="page-header-content d-lg-flex border-top">
    @include('admin.projects.navigation')
</div>
@endsection

@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Project</h5>
        </div>
        <table class="table datatable-basic">
            <thead class="thead">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Description</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($project->phases as $key => $row)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ date('d M Y', $row->start_date) }}</td>
                    <td>{{ date('d M Y', $row->end_date) }}</td>
                    <td>{{ $row->description }}</td>
                    <td class="text-center">
                        @canany(['projectPhase-edit', 'projectPhase-delete'])
                        <div class="d-inline-flex">
                            <div class="dropdown">
                                <a href="#" class="text-body" data-bs-toggle="dropdown">
                                    <i class="ph-list"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <form action="{{ route('projects.phase.destroy',$row->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        @can('projectPhase-edit')
                                        <a 
                                            href="#" 
                                            class="dropdown-item editPhase" 
                                            data-id="{{ $row->id }}"
                                            data-name="{{ $row->name }}"
                                            data-start-date="{{ date('Y-m-d', $row->start_date) }}"
                                            data-end-date="{{ date('Y-m-d', $row->end_date) }}"
                                            data-description="{{ $row->description }}"
                                            >
                                            <i class="ph-note-pencil me-2"></i>{{ __('Edit') }}
                                        </a>
                                        @endcan
                                        @can('projectPhase-delete')
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
    </div>
</div>
@include('admin.projects.phase.create')
@include('admin.projects.phase.edit')
@endsection

@section('script')
<script>
    $(function () {
        const errorClass  = 'validation-invalid-label',
            successClass  = 'validation-valid-label',
            validClass    = 'validation-valid-label',
            isInvalidClass= 'is-invalid',
            isValidClass  = 'is-valid',
            swalInit      = swal.mixin({
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
        function setupValidation(selector) {
            $(selector).validate({
                errorClass,
                successClass,
                validClass,
                highlight: function(element) {
                    $(element).addClass(isInvalidClass).removeClass(isValidClass);
                },
                unhighlight: function(element) {
                    $(element).addClass(isValidClass).removeClass(isInvalidClass);
                },
                errorPlacement: function(error, element) {
                    if (element.hasClass('select2-hidden-accessible')) {
                        error.appendTo(element.parent());
                    } else if (element.closest('.form-control-feedback, .form-check, .input-group').length) {
                        error.appendTo(element.closest('.form-control-feedback, .form-check, .input-group'));
                    } else {
                        error.insertAfter(element);
                    }
                }
            });
        }
        setupValidation('.createPhase');
        setupValidation('.updatePhase');
        $('.editPhase').on('click', function(e) {
            e.preventDefault();
            $('#phaseId').val($(this).data('id'));
            $('#phaseName').val($(this).data('name'));
            $('#phaseStartDate').val($(this).data('startDate'));
            $('#phaseEndDate').val($(this).data('endDate'));
            $('#phaseDescription').val($(this).data('description'));
            $('#editPhase').modal('show');
        });
    });
</script>
@endsection