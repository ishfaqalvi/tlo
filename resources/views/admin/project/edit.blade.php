@extends('admin.layout.app')

@section('title')
    {{ __('Update') }} Project
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
            <a href="{{ route('projects.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
                <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                    <i class="ph-arrow-circle-left"></i>
                </span>
                Back
            </a>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">{{ __('Edit ') }} Project </h5>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight mb-3">
                <li class="nav-item">
                    <a href="#detail" class="nav-link" data-bs-toggle="tab">
                        <i class="ph-note-pencil me-2"></i>
                        Detail
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#stakeholders" class="nav-link" data-bs-toggle="tab">
                        <i class="ph-users-three me-2"></i>
                        Stakeholders
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#phases" class="nav-link" data-bs-toggle="tab">
                        <i class="ph-list-numbers me-2"></i>
                        Phases
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#sites" class="nav-link" data-bs-toggle="tab">
                        <i class="ph-globe me-2"></i>
                        Sites
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#activities" class="nav-link" data-bs-toggle="tab">
                        <i class="ph-list-bullets me-2"></i>
                        Activities
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade" id="detail">
                    @include('admin.project.include.detail.form')
                </div>
                <div class="tab-pane fade" id="stakeholders">
                    @include('admin.project.include.stakeholder.index')
                </div>
                <div class="tab-pane fade" id="phases">
                    @include('admin.project.include.phase.index')
                </div>
                <div class="tab-pane fade" id="sites">
                    @include('admin.project.include.site.index')
                </div>
                <div class="tab-pane fade" id="activities">
                    @include('admin.project.include.activity.index')
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var projectId = "{{ $project->id }}";
</script>
@endsection

@section('script')
<script>
    $(function(){
        const errorClass  = 'validation-invalid-label',
            successClass  = 'validation-valid-label',
            validClass    = 'validation-valid-label',
            isInvalidClass= 'is-invalid',
            isValidClass  = 'is-valid',
            _token        = $("input[name='_token']").val();
            swalInit      = swal.mixin({
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-light',
                    denyButton: 'btn btn-light',
                    input: 'form-control'
                }
            });

        // Initialize select2
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

        // Common function for setting up validation
        function setupValidation(selector, rules = {}, messages = {}) {
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
                },
                rules,
                messages
            });
        }
        function intToDate(intV) {
            var date = new Date(intV * 1000);
            var formattedDate = date.getFullYear() + '-' + ('0' + (date.getMonth() + 1)).slice(-2) + '-' + ('0' + date.getDate()).slice(-2);
            return formattedDate;
        }

        // Setup validation
        setupValidation('.detail');
        setupValidation('.stakeholder', {
            stakeholder_id: {
                remote: {
                    url: "{{ route('projects.stakeholder.checkRecord') }}",
                    type: "POST",
                    data: {
                        _token,
                        project_id: "{{ $project->id }}",
                        stakeholder_id: function() {
                            return $("#stakeholder_id").val();
                        }
                    },
                }
            }
        }, {
            stakeholder_id: {
                remote: "Stakeholder is already exist."
            }
        });
        setupValidation('.createPhase');
        setupValidation('.updatePhase');
        setupValidation('.site', {
            site_id: {
                remote: {
                    url: "{{ route('projects.sites.checkRecord') }}",
                    type: "POST",
                    data: {
                        _token,
                        project_id: "{{ $project->id }}",
                        site_id: function() {
                            return $("#site_id").val();
                        }
                    },
                }
            }
        }, {
            site_id: {
                remote: "Site is already exist."
            }
        });
        setupValidation('.createActivity');
        setupValidation('.updateActivity');

        // Datepicker initialization
        ['.start_date', '.end_date'].forEach(selector => {
            const element = document.querySelector(selector);
            if (element) {
                new Datepicker(element, {
                    container: '.content-inner',
                    buttonClass: 'btn',
                    prevArrow: document.dir == 'rtl' ? '&rarr;' : '&larr;',
                    nextArrow: document.dir == 'rtl' ? '&larr;' : '&rarr;',
                    autohide: true
                });
            }
        });

        // CKEditor initialization
        ClassicEditor.create(document.querySelector('#ckeditor'), {
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                    { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                    { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                    { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                ]
            }
        }).catch(console.error);
        $('#milestone').on('change', function(){
            if($(this).val() == 1){
                $('div.activityStartDate').show('slow');
            }else{
                $('div.activityStartDate').hide('slow');
            }
        });
        $('#activityMilestone').on('change', function(){
            if($(this).val() == 1){
                $('div.editActivityStartDate').show('slow');
            }else{
                $('div.editActivityStartDate').hide('slow');
            }
        });
        $('.editPhase').on('click', function(e) {
            e.preventDefault();
            $('#phaseId').val($(this).data('id'));
            $('#phaseName').val($(this).data('name'));
            $('#phaseStartDate').val($(this).data('startDate'));
            $('#phaseEndDate').val($(this).data('endDate'));
            $('#phaseDescription').val($(this).data('description'));
            $('#editPhase').modal('show');
        });
        $('.editActivity').on('click', function(e) {
            e.preventDefault();
            var record = $(this).data('record');
            $('#activityId').val(record.id);
            $('#activitySiteId').val(record.site_id).trigger('change');
            $('#activityPhaseId').val(record.project_phase_id).trigger('change');
            $('#activityAssignTo').val(record.assign_to).trigger('change');
            $('#activityProgressId').val(record.activity_progress_id).trigger('change');
            $('#activityStatus').val(record.status).trigger('change');
            $('#activityMilestone').val(record.milestone).trigger('change');
            $('#activityEndDate').val(intToDate(record.end_date));
            if (record.milestone == 1) {
                $('#activityStartDate').val(intToDate(record.start_date));
                $('.editActivityStartDate').show('slow');
            }
            $('#editActivity').modal('show');
        });
    });
    $(function() {
        var activeTabKey = 'activeTab_project_' + projectId;
        $('a[data-bs-toggle="tab"]').on('click', function(e) {
            const tabId = $(this).attr('href');
            localStorage.setItem(activeTabKey, tabId);
        });
        const activeTab = localStorage.getItem(activeTabKey);
        if(activeTab){
            $('.nav-tabs a[href="' + activeTab + '"]').tab('show');
        } else {
            $('.nav-tabs a:first').tab('show');
        }
    });
</script>
@endsection