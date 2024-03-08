@extends('admin.layout.app')

@section('title')
    Beneficiary
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Beneficiary Management</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            @can('beneficiaries-import')
            <a href="#" data-bs-toggle="modal" data-bs-target="#importData" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill me-1">
                <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                    <i class="ph-file-xls"></i>
                </span>
                Import Data
            </a>
            <a href="{{ asset('csv/sample.xlsx') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill me-1" target="_blank">
                <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                    <i class="ph-download-simple"></i>
                </span>
                Download Sample
            </a>
            @endcan
            @can('beneficiaries-create')
            <a href="{{ route('beneficiaries.create') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
                <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                    <i class="ph-plus"></i>
                </span>
                Add Beneficiary
            </a>
            @endcan
        </div>
    </div>
</div>
@endsection

@section('content')
@include('admin.beneficiary.import')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Beneficiary</h5>
        </div>
        @if(isset($errors) && $errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        @endif
        <table class="table datatable-basic">
            <thead class="thead">
                <tr>
                    <th>No</th>
                    <th>Project</th>
					<th>Name</th>
					<th>Father Name</th>
					<th>Gender</th>
					<th>Contact</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($beneficiaries as $key => $beneficiary)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $beneficiary->project->name }}</td>
					<td>{{ $beneficiary->name }}</td>
					<td>{{ $beneficiary->father_name }}</td>
					<td>{{ $beneficiary->gender }}</td>
					<td>{{ $beneficiary->contact }}</td>
                    <td class="text-center">@include('admin.beneficiary.actions')</td>
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
        $('.select').select2();
        $('.validate').validate({
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
    });
</script>
@endsection