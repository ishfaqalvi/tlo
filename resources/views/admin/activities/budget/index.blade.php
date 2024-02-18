@extends('admin.layout.app')

@section('title')
    Activity Budget
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Activity Budget Management</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            @can('activityBudget-create')
            <a href="#" data-bs-toggle="modal" data-bs-target="#addRecord" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
                <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                    <i class="ph-plus"></i>
                </span>
                Add Budget
            </a>
            @endcan
        </div>
    </div>
</div>
<div class="page-header-content d-lg-flex border-top">
    @include('admin.activities.navigation')
</div>
@endsection

@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Activity Budget</h5>
        </div>
        <table class="table datatable-basic">
            <thead class="thead">
                <tr>
                    <th>No</th>
					<th>Description</th>
					<th>Budget Amount</th>
					<th>Actual Spent</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($activity->budgets as $key => $budget)
                <tr>
                    <td>{{ ++$key }}</td>
					<td>{{ $budget->description }}</td>
					<td>{{ number_format($budget->budget_amount) }}</td>
					<td>{{ number_format($budget->actual_spent) }}</td>
                    <td class="text-center">@include('admin.activities.budget.actions')</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@include('admin.activities.budget.create')
@include('admin.activities.budget.edit')
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
        setupValidation('.createRecord');
        setupValidation('.updateRecord');
        $('.editRecord').on('click', function(e) {
            e.preventDefault();
            $('#editId').val($(this).data('id'));
            $('#editDescription').val($(this).data('description'));
            $('#editBudgetAmoun').val($(this).data('budgetamount'));
            $('#editActualSpent').val($(this).data('actualspent'));
            $('#editRecord').modal('show');
        });
    });
</script>
@endsection