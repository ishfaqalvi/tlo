@extends('admin.layout.app')

@section('title')
    {{ __('Update') }} Project Activity
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Project Activity Management</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('activities.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
            <h5 class="mb-0">{{ __('Edit ') }} Project Activity </h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('activities.update', $projectActivity->id) }}" class="validate" role="form" enctype="multipart/form-data">
                @csrf
                {{ method_field('PATCH') }}
                @include('admin.activity.form')
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(function(){
        var default_site_id = "<?php echo $projectActivity->site_id ?>";
        var default_phase_id = "<?php echo $projectActivity->project_phase_id ?>";
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
        $('#milestone').on('change', function(){
            if($(this).val() == 1){
                $('div.startDate').show('slow');
            }else{
                $('div.startDate').hide('slow');
            }
        }).trigger('change');
        $('select[name=project_id]').change(function () {
            let id = $(this).val();
            $('select[name=site_id]').html('<option value="">--Select--</option>');
            $('select[name=project_phase_id]').html('<option value="">--Select--</option>');
            $.get('/admin/activities/get-dropdowns', {id: id}).done(function (result) {
                let data = JSON.parse(result);
                $('div.sites').show('slow');
                $.each(data.sites, function (i, val) {
                    if(val.id == default_site_id){
                        $('select[name=site_id]').append($('<option>', 
                            {selected : 'selected', value : val.id, text : val.name}
                        ));
                    }else{
                        $('select[name=site_id]').append($('<option>', 
                            {value : val.id,  text : val.name}
                        ));
                    }
                });
                $('div.phases').show('slow');
                $.each(data.phase, function (i, val) {
                    if(val.id == default_phase_id){
                        $('select[name=project_phase_id]').append($('<option>', 
                            {selected : 'selected', value : val.id, text : val.name}
                        ));
                    }else{
                        $('select[name=project_phase_id]').append($('<option>', 
                            {value : val.id,  text : val.name}
                        ));
                    }
                });
            });
        }).trigger('change');
    });
</script>
@endsection
