@extends('admin.layout.app')

@section('title')
    Results Framework
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Results Framework Management</span>
        </h4>
    </div>
</div>
@endsection

@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-body">
            {{ Form::select('project_id', projects(), $resultFrameworkProjectId, ['class' => 'select','placeholder' => '--Select--','id'=>'frameworkProject']) }}
        </div>
    </div>
    @if(!empty($project))
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h6 class="mb-0">Results Framework</h6>
                <div class="ms-auto">
                    <div class="hstack gap-2">
                        @can('resultFrameworks-create')
                        <a href="#" data-parentid="" class="text-body addFramework">
                            <i class="ph-plus-circle"></i>
                        </a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        @foreach ($project->resultFrameworks()->whereNull('parent_id')->orderBy('order','ASC')->with('children')->get() as $parent)
            @include('admin.result-framework.childeren', ['parent' => $parent])
        @endforeach
    @endif
</div>
@include('admin.result-framework.create')
@include('admin.result-framework.edit')
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
        $('.select').select2();
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
        $('.createRecord').validate({
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
        $('.updateRecord').validate({
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
        $('.addFramework').on('click', function(e) {
            e.preventDefault();
            $('#createParentId').val($(this).data('parentid'));
            $('#addRecord').modal('show');
        });
        $('.editFramework').on('click', function(e) {
            e.preventDefault();
            $('#editId').val($(this).data('id'));
            $('#editTitle').val($(this).data('title'));
            $('#editOrder').val($(this).data('order'));
            $('input[name="color"][value="' + $(this).data('color') + '"]').prop('checked', true);
            $('#editRecord').modal('show');
        });
        var _token = $("input[name='_token']").val(); 
        $('#frameworkProject').on('change', function(){
            var id = $(this).val();
            $.ajax({
                url: "{{ route('resultFrameworks.setProject') }}",
                type: 'POST',
                data: {
                    id: id,
                    _token: _token
                },
                success: function(response) {
                    window.location.href = "{{ route('resultFrameworks.index') }}";
                },
                error: function(xhr, status, error) {
                    new Noty({
                        layout: 'bottomCenter',
                        text: error,
                        type: 'error'
                    }).show();
                }
            });
        });
    });
</script>
@endsection