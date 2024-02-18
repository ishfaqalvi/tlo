@extends('admin.layout.app')

@section('title')
    Project Files
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Project Files Management</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            @can('projectFile-create')
            <a href="#" data-bs-toggle="modal" data-bs-target="#addFile" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
                <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                    <i class="ph-plus"></i>
                </span>
                Add File
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
            <h5 class="mb-0">Project Files</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-lg">
                <tbody>
                    <tr class="table-light">
                        <th colspan="5">Project Files</th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>File Name</th>
                        <th>Path</td>
                        <th>Added Date</td>
                        <th class="text-center">Actions</td>
                    </tr>
                    @forelse($project->files()->whereNull('activity_id')->get() as $key => $file)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $file->name }}</td>
                            <td>{{ $file->path }}</td>
                            <td>{{ Carbon\Carbon::parse($file->created_at)->format('d M Y') }}</td>
                            <td class="text-center">@include('admin.projects.file.actions')</td>
                        </tr>
                    @empty
                        <tr align="center">
                            <th colspan="5">No file is available!</th>
                        </tr>
                    @endforelse
                    <tr class="table-light">
                        <th colspan="5">Activity Files</th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>Activity</th>
                        <th>File Name</th>
                        <th>Path</td>
                        <th>Added Date</td>
                    </tr>
                    @forelse($project->files()->whereNotNull('activity_id')->get() as $key => $file)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $file->activity->name }}</td>
                            <td>{{ $file->name }}</td>
                            <td>{{ $file->path }}</td>
                            <td>{{ $file->created_at }}</td>
                        </tr>
                    @empty
                        <tr align="center">
                            <th colspan="5">No file is available!</th>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('admin.projects.file.create')
@include('admin.projects.file.edit')
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
        $.validator.addMethod("conditionalRequired", function(value, element, params) {
            var typeVal = $("input[name='type']:checked").val();
            if (typeVal === params[0] && this.optional(element)) {
                return false;
            }
            return true;
        }, "This field is required.");
        $('.createFile').validate({
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
            },
            rules: {
                'files[]': {
                    conditionalRequired: ['Upload']
                },
                name: {
                    conditionalRequired: ['Provide Url']
                },
                path: {
                    conditionalRequired: ['Provide Url']
                }
            }
        });
        $('.editFileName').validate({
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
        $('input[type="radio"][name="type"]').change(function() {
            if($('#uploadFile').is(':checked')) {
                $('div.uploadFile').show('slow');
                $('div.fileUrl').hide('slow');
            } else if($('#fileUrl').is(':checked')) {
                $('div.fileUrl').show('slow');
                $('div.uploadFile').hide('slow');
            }
        });
        $('#fileUpload').change(function() {
            var files = this.files;
            $('#fileNames').empty();
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var fileNameWithoutExtension = file.name.replace(/\.[^/.]+$/, "");
                $('#fileNames').append('<input type="text" class="form-control" name="fileNames[' + i + ']" value="' + fileNameWithoutExtension + '"><br>');
            }
        });
        $('.editFile').on('click', function(e) {
            e.preventDefault();
            $('#fileId').val($(this).data('id'));
            $('#fileName').val($(this).data('name'));
            $('#editFile').modal('show');
        });
    });
</script>
@endsection