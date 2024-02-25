@extends('admin.layout.app')

@section('title')
    Contribution Indicator
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Indicator Contribution Management</span>
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
@php($contributionData = calculateAggregatedTarget($indicator))
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">{{ $indicator->name }}</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('indicators.update', $indicator->id) }}" class="validate" role="form" enctype="multipart/form-data">
                @csrf
                {{ method_field('PATCH') }}
                <div class="row">
                    <div class="form-group col-lg-3">
                        {{ Form::label('status') }}
                        {{ Form::select('status', ['Not yet started'=>'Not yet started','Postponed'=>'Postponed','Paused'=>'Paused','On Track'=>'On Track','Minor Delays'=>'Minor Delays','Major Delays'=>'Major Delays'], $indicator->status, ['class' => 'form-control select' . ($errors->has('direction') ? ' is-invalid' : ''), 'placeholder' => '--Select--']) }}
                    </div>
                    <div class="form-group col-lg-3">
                        {{ Form::label('aggregation_formula') }}
                        {{ Form::select('aggregation_formula', ['Sum'=>'Sum','Subtraction'=>'Subtraction','Multiplication'=>'Multiplication','Division'=>'Division','Average'=>'Average'], $indicator->aggregation_formula, ['class' => 'form-control select', 'placeholder' => '--Select--']) }}
                    </div>
                    <div class="form-group col-lg-3">
                        {{ Form::label('Aggregated target') }}
                        {{ Form::text('', $contributionData['aggregated_target'], ['class' => 'form-control', 'disabled']) }}
                    </div>
                    <div class="form-group col-lg-3">
                        {{ Form::label('Actual vs Target') }}
                        <div>
                            {{ $contributionData['stat'] }} 
                            <div class="progress">
                                <div class="progress-bar bg-teal" style="width: {{ $contributionData['percentage'] }}%" aria-valuenow="{{ $contributionData['percentage'] }}" aria-valuemin="0" aria-valuemax="100">{{ $contributionData['percentage'] }}% complete</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
                        <button type="submit" class="btn btn-primary ms-3">
                            Save <i class="ph-paper-plane-tilt ms-2"></i>
                        </button>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#addRecord" class="btn btn-primary ms-2">
                            Add Indicator <i class="ph-plus ms-2"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Contributing Indicators</h5>
        </div>
        <table class="table datatable-basic">
            <thead class="thead">
                <tr>
                    <th>No</th>
					<th>Indicator</th>
					<th>Format</th>
                    <th>Total Actual</th>
                    <th>LOP Target</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($indicator->contributers as $key => $row)
                <tr>
                    <td>{{ ++$key }}</td>
					<td>{{ $row->contributer->name }}</td>
					<td>{{ $row->contributer->format }}</td>
                    <td>{{ number_format(getIndicatorActualVsTarget($row->contributer)['calculated']) }}</td>
                    <td>{{ number_format($row->contributer->target) }}</td>
                    <td class="text-center">@include('admin.indicators.contribution.actions')</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@include('admin.indicators.contribution.create')
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
        var _token = $("input[name='_token']").val();
        var indicator_id = "{{ $indicator->id }}";
        $('.createValidate').validate({
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
            rules:{
                contributer_id:{
                    "remote":
                    {
                        url: "{{ route('indicators.contributions.checkRecord') }}",
                        type: "POST",
                        data: {
                            _token:_token,
                            indicator_id:indicator_id,
                            contributer_id: function() {
                                return $("#contributer_id").val();
                            }
                        },
                    }
                }
            },
            messages:{
                contributer_id:{
                    remote: jQuery.validator.format("This indicator is already added.")
                }
            }
        });
    });
</script>
@endsection