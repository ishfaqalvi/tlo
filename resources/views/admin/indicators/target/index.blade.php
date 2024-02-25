@extends('admin.layout.app')

@section('title')
    Targets & Disaggregations
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Targets & Disaggregations Management</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('indicators.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
                <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                    <i class="ph-arrow-circle-left"></i>
                </span>
                Back
            </a>
        </div>
    </div>
</div>
<div class="page-header-content d-lg-flex border-top">
    @include('admin.indicators.navigation')
</div>
@endsection

@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Life of program (LOP) Target</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('indicators.update', $indicator->id) }}" class="validate" role="form" enctype="multipart/form-data">
                @csrf
                {{ method_field('PATCH') }}
                <div class="row">
                    <div class="form-group col-lg-4 mb-3">
                        {{ Form::label('target','LOP target value') }}
                        {{ Form::number('target', $indicator->target, ['class' => 'form-control' . ($errors->has('target') ? ' is-invalid' : ''), 'placeholder' => 'LOP target value','required']) }}
                    </div>
                    <div class="form-group col-lg-4 mb-3">
                        {{ Form::label('baseline','Baseline value (BL)') }}
                        {{ Form::number('baseline', $indicator->baseline, ['class' => 'form-control' . ($errors->has('target') ? ' is-invalid' : ''), 'placeholder' => 'Enter Number','required']) }}
                    </div>
                    <div class="form-group col-lg-4 mb-3">
                        {{ Form::label('baseline_date','Baseline Date') }}
                        {{ Form::text('baseline_date', isset($indicator->baseline_date) ? date('m-d-Y',$indicator->baseline_date) : '', ['class' => 'form-control date' . ($errors->has('target') ? ' is-invalid' : ''), 'placeholder' => 'Enter Baseline Date','required']) }}
                    </div>
                    <div class="form-group col-lg-4 mb-3">
                        {{ Form::label('unit_of_measure','Unit of measure') }}
                        {{ Form::text('unit_of_measure', $indicator->unit_of_measure, ['class' => 'form-control' . ($errors->has('unit_of_measure') ? ' is-invalid' : ''), 'placeholder' => 'Enter Text','required']) }}
                    </div>
                    <div class="form-group col-lg-4 mb-3">
                        {{ Form::label('direction') }}
                        {{ Form::select('direction', ['Increasing'=>'Increasing','Decreasing'=>'Decreasing'], $indicator->direction, ['class' => 'form-control select' . ($errors->has('direction') ? ' is-invalid' : ''), 'placeholder' => '--Select--']) }}
                    </div>
                    <div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
                        <button type="submit" class="btn btn-primary ms-3">
                            Submit <i class="ph-paper-plane-tilt ms-2"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
            <h6 class="py-sm-3 mb-sm-0">Linked reporting period types for time-based analysis</h6>
            @can('indicatorTarget-link')
            <div class="ms-sm-auto my-sm-auto">
                {{ Form::select('project_id', projectReportingPeriods($indicator->project_id), null, ['class' => 'form-select wmin-400','placeholder' => '--Select--','id'=>'projectReportingPeriod']) }}
            </div>
            @endcan
        </div>
        <table class="table">
            <thead class="thead">
                <tr>
                    <th>No</th>
                    <th>Reporting Period Type</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($reportingPeriods as $key => $row)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $row->projectReportingPeriod->title }}</td>
                    <td class="text-center">
                        <div class="d-inline-flex">
                            <form action="{{ route('indicators.targets.report.destroy',$row->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                @can('indicatorTarget-unlink')
                                    <a href="#" class="text-danger sa-confirm" title="Unlink">
                                        <i class="ph-link-break"></i>
                                    </a>
                                @endcan
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="card">
        <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
            <h6 class="py-sm-3 mb-sm-0">Available disaggregation types</h6>
            @can('indicatorTarget-link')
            <div class="ms-sm-auto my-sm-auto">
                {{ Form::select('project_id', projectDisaggregations($indicator->project_id), null, ['class' => 'form-select wmin-400','placeholder' => '--Select--','id'=>'projectDisaggregation']) }}
            </div>
            @endcan
        </div>
        <table class="table">
            <thead class="thead">
                <tr>
                    <th>No</th>
                    <th>Disaggregation Type</th>
                    <th>Fields</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($disaggregations as $key => $row)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $row->projectDisaggregation->type }}</td>
                    <td>
                        @foreach($row->projectDisaggregation->fields as $field)
                            <span class="badge bg-success rounded-0">{{ $field }}</span>
                        @endforeach
                    </td>
                    <td class="text-center">
                        <div class="d-inline-flex">
                            <form action="{{ route('indicators.targets.disaggregation.destroy',$row->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                @can('indicatorTarget-unlink')
                                    <a href="#" class="text-danger sa-confirm" title="Unlink">
                                        <i class="ph-link-break"></i>
                                    </a>
                                @endcan
                            </form>
                        </div>
                    </td>
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
        const element = document.querySelector('.date');
        if (element) {
            new Datepicker(element, {
                container: '.content-inner',
                buttonClass: 'btn',
                prevArrow: document.dir == 'rtl' ? '&rarr;' : '&larr;',
                nextArrow: document.dir == 'rtl' ? '&larr;' : '&rarr;',
                autohide: true
            });
        }
        var _token = $("input[name='_token']").val();
        var indicator = "{{ $indicator->id }}";
        $('#projectReportingPeriod').on('change', function(){
            var id = $(this).val();
            if (id !='') {
                $.ajax({
                    url: "{{ route('indicators.targets.report.store') }}",
                    type: 'POST',
                    data: {
                        id: id,
                        indicator: indicator,
                        _token: _token
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            window.location.href = "{{ route('indicators.targets.index',$indicator->id) }}";
                        }else{
                            new Noty({
                                layout: 'bottomCenter',
                                text: response.message,
                                type: 'warning'
                            }).show();    
                        }
                    },
                    error: function(xhr, status, error) {
                        new Noty({
                            layout: 'bottomCenter',
                            text: error,
                            type: 'error'
                        }).show();
                    }
                });
            }
        });
        $('#projectDisaggregation').on('change', function(){
            var id = $(this).val();
            if (id !='') {
                $.ajax({
                    url: "{{ route('indicators.targets.disaggregation.store') }}",
                    type: 'POST',
                    data: {
                        id: id,
                        indicator: indicator,
                        _token: _token
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            window.location.href = "{{ route('indicators.targets.index',$indicator->id) }}";
                        }else{
                            new Noty({
                                layout: 'bottomCenter',
                                text: response.message,
                                type: 'warning'
                            }).show();    
                        }
                    },
                    error: function(xhr, status, error) {
                        new Noty({
                            layout: 'bottomCenter',
                            text: error,
                            type: 'error'
                        }).show();
                    }
                });
            }
        });
    });
</script>
@endsection