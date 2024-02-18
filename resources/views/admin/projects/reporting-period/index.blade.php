@extends('admin.layout.app')

@section('title')
    Project Reporting Periods
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Project Reporting Periods Management</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            @can('projectReportingPeriod-create')
            <a href="#" data-bs-toggle="modal" data-bs-target="#addRecord" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
                <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                    <i class="ph-plus"></i>
                </span>
                Add Reporting Period
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
            <h5 class="mb-0">Project Reporting Period</h5>
        </div>
        <div class="table-responsive">
            <table class="table text-nowrap">
                @if(count($project->reportingPeriods) > 0)
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th class="text-center" style="width: 20px;">
                                <i class="ph-dots-three"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($project->reportingPeriods as $period)
                        <tr class="table-light">
                            <td colspan="4" class="fw-semibold">{{ $period->title}}</td>
                            <td class="text-end">
                                @include('admin.projects.reporting-period.actions')
                            </td>
                        </tr>
                        @forelse($period->ranges as $key => $range)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $range->title }}</td>
                            <td>{{ date('d M Y',$range->start_date) }}</td>
                            <td>{{ date('d M Y',$range->end_date) }}</td>
                            <td class="text-center">
                                @include('admin.projects.reporting-period.range.actions')
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No range is added in this period!</td>
                        </tr>
                        @endforelse
                    @endforeach
                    </tbody>
                @else
                    <tbody>
                        <tr>
                            <td class="text-center">No period is added yet!</td>
                        </tr>
                    </tbody>
                @endif
            </table>
        </div>
    </div>
</div>
@include('admin.projects.reporting-period.create')
@include('admin.projects.reporting-period.edit')
@include('admin.projects.reporting-period.range.create')
@include('admin.projects.reporting-period.range.edit')
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
        function applyValidation(selector) {
            $(selector).validate({
                errorClass: 'validation-invalid-label',
                successClass: 'validation-valid-label',
                validClass: 'validation-valid-label',
                highlight: function(element, errorClass) {
                    $(element).removeClass(errorClass).addClass('is-invalid').removeClass('is-valid');
                },
                unhighlight: function(element, errorClass) {
                    $(element).removeClass(errorClass).removeClass('is-invalid').addClass('is-valid');
                },
                errorPlacement: function(error, element) {
                    if (element.hasClass('select2-hidden-accessible')) {
                        error.appendTo(element.parent());
                    } else if (element.parents().hasClass('form-control-feedback') || element.parents().hasClass('form-check') || element.parents().hasClass('input-group')) {
                        error.appendTo(element.parent().parent());
                    } else {
                        error.insertAfter(element);
                    }
                }
            });
        }
        applyValidation('.createRecord');
        applyValidation('.updateRecord');
        applyValidation('.createSubRecord');
        applyValidation('.updateSubRecord');
        $('.editRecord').on('click', function(e) {
            e.preventDefault();
            $('#editId').val($(this).data('id'));
            $('#editTitle').val($(this).data('title'));
            $('#editRecord').modal('show');
        });
        $('.addSubRecord').on('click', function(e) {
            e.preventDefault();
            $('#period_id').val($(this).data('id'));
            $('#addSubRecord').modal('show');
        });
        $('.editSubRecord').on('click', function(e) {
            e.preventDefault();
            $('#editPeriodId').val($(this).data('id'));
            $('#editPeriodTitle').val($(this).data('title'));
            $('#editPeriodSDate').val($(this).data('startdate'));
            $('#editPeriodEDate').val($(this).data('enddate'));
            $('#editSubRecord').modal('show');
        });
    });
</script>
@endsection