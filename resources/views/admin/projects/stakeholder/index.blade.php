@extends('admin.layout.app')

@section('title')
    Project Stakeholder
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Project Stakeholder Management</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            @can('projectStakeholder-create')
            <a href="#" data-bs-toggle="modal" data-bs-target="#addStakeholder" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
                <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                    <i class="ph-plus"></i>
                </span>
                Add Stakeholder
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
            <h5 class="mb-0">Stakeholder</h5>
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
                    @php($stakeholder = $row->stakeholder)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $stakeholder->name }}</td>
                        <td>{{ $stakeholder->stakeholderRole->title }}</td>
                        <td>{{ $stakeholder->type }}</td>
                        <td>{{ $stakeholder->province->title }}</td>
                        <td class="text-center">
                            <form action="{{ route('projects.stakeholder.destroy',$row->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                @can('projectStakeholder-delete')
                                    <button type="link" class="btn btn-outline-danger btn-xs sa-confirm">
                                        <i class="ph-trash"></i>
                                    </button>
                                @endcan
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@include('admin.projects.stakeholder.create')
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
        const option = $('select[name=option]');
        const _token = $("input[name='_token']").val();
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
                },
            rules: {
                stakeholder_id: {
                    required: isType('Add From Existing'),
                    remote: remoteSettings('#stakeholder_id')
                },
                name : {required: isType('New Add')},
                type : {required: isType('New Add')},
                stakeholder_role_id : {required: isType('New Add')},
                province_id : {required: isType('New Add')}
            },
            messages:{
                stakeholder_id:{
                    remote: jQuery.validator.format("This stakeholder is already added.")
                }
            }
        });
        option.on('change', function(){
            let type = $(this).val();
            if (type == 'Add From Existing') {
                $('div.existingStakeholder').show('slow');
                $('div.newStakeholder').hide('slow');
            }else if(type == 'New Add'){
                $('div.existingStakeholder').hide('slow');
                $('div.newStakeholder').show('slow');
            }else{
                $('div.existingStakeholder').hide('slow');
                $('div.newStakeholder').hide('slow');
            }
        });
        function isType(desiredType) {
            return function() { return option.val() == desiredType; };
        }
        function remoteSettings(elementId) {
            return {
                url: "{{ route('projects.stakeholder.checkRecord') }}",
                type: "POST",
                data: {
                    _token,
                    project_id: "{{ $project->id }}",
                    stakeholder_id: function() { return $(elementId).val(); }
                }
            };
        }
        $(".sa-confirm").click(function(event) {
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
                if (result.value)  $(event.target).closest("form").submit();
            });
        });
    });
</script>
@endsection