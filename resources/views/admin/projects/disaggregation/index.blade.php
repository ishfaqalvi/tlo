@extends('admin.layout.app')

@section('title')
    Project Disaggregations
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Project Disaggregations Management</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            @can('projectDisaggregation-create')
            <a href="#" data-bs-toggle="modal" data-bs-target="#addDisaggregation" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
                <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                    <i class="ph-plus"></i>
                </span>
                Add Disaggregation
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
            <h5 class="mb-0">Project Disaggregation</h5>
        </div>
        <table class="table datatable-basic">
            <thead class="thead">
                <tr>
                    <th>No</th>
					<th>Disaggregation Type</th>
					<th>Fields</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($project->disaggregations as $key => $row)
                <tr>
                    <td>{{ ++$key }}</td>
					<td>{{ $row->type }}</td>
					<td>
                        @foreach($row->fields as $field)
                            <span class="badge bg-success rounded-0">{{ $field->name }}</span>
                        @endforeach
                    </td>
                    <td class="text-center">@include('admin.projects.disaggregation.actions')</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@include('admin.projects.disaggregation.create')
@include('admin.projects.disaggregation.edit')
@endsection

@section('script')
<script>
    $(function () {
        $('.select').select2();
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
        $('.createAggregation').validate({
            errorClass: 'validation-invalid-label',
            successClass: 'validation-valid-label',
            validClass: 'validation-valid-label',
            highlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
                $(element).addClass('is-invalid');
                $(element).removeClass('is-valid');
            },
            unhighlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
                $(element).removeClass('is-invalid');
                $(element).addClass('is-valid');
            },
            errorPlacement: function(error, element) {
                if (element.hasClass('select2-hidden-accessible')) {
                    error.appendTo(element.parent());
                }else if (element.parents().hasClass('form-control-feedback') || element.parents().hasClass('form-check') || element.parents().hasClass('input-group')) {
                    error.appendTo(element.parent().parent());
                }else {
                    error.insertAfter(element);
                }
            }
        });
        $('.editAggregation').validate({
            errorClass: 'validation-invalid-label',
            successClass: 'validation-valid-label',
            validClass: 'validation-valid-label',
            highlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
                $(element).addClass('is-invalid');
                $(element).removeClass('is-valid');
            },
            unhighlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
                $(element).removeClass('is-invalid');
                $(element).addClass('is-valid');
            },
            errorPlacement: function(error, element) {
                if (element.hasClass('select2-hidden-accessible')) {
                    error.appendTo(element.parent());
                }else if (element.parents().hasClass('form-control-feedback') || element.parents().hasClass('form-check') || element.parents().hasClass('input-group')) {
                    error.appendTo(element.parent().parent());
                }else {
                    error.insertAfter(element);
                }
            }
        });
        $('.editRecord').on('click', function(e) {
            e.preventDefault();
            $('#idField').val($(this).data('id'));
            $('#typeField').val($(this).data('type'));
            $('#fields').empty();
            $.each($(this).data('fields'), function (i, val) {
                $('#fields').append($('<option>',{selected : 'selected', value : val.name, text : val.name}));
            })
            $('#editModal').modal('show');
        });
    });
</script>
@endsection