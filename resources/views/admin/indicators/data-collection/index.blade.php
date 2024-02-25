@extends('admin.layout.app')

@section('title')
    Indicator Data Collection
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Indicator Data Collection Management</span>
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
                    @if($indicator->format != 'Qualitative Only')
                    <div class="form-group col-lg-3">
                        {{ Form::label('total_vs_actual_formula','Total actuals formula') }}
                        {{ Form::select('total_vs_actual_formula', ['Sum'=>'Sum','Average'=>'Average','Median'=>'Median'], $indicator->total_vs_actual_formula, ['class' => 'form-control select' . ($errors->has('direction') ? ' is-invalid' : ''), 'placeholder' => '--Select--']) }}
                    </div>
                    <div class="form-group col-lg-3">
                        {{ Form::label('Actual vs Target') }}
                        <div>
                            @php($data = getIndicatorActualVsTarget($indicator))
                            {{ $data['stat'] }} 
                            <div class="progress">
                                <div class="progress-bar bg-teal" style="width: {{ $data['percentage'] }}%" aria-valuenow="{{ $data['percentage'] }}" aria-valuemin="0" aria-valuemax="100">{{ $data['percentage'] }}% complete</div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="form-group col-md-3 d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary">
                            Save <i class="ph-paper-plane-tilt ms-2"></i>
                        </button>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#addRecord" class="btn btn-primary ms-2">
                            Add Data <i class="ph-plus ms-2"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Collected Data</h5>
        </div>
        <table class="table datatable-basic">
            <thead class="thead">
                <tr>
                    <th>No</th>
                    @if($indicator->format != 'Qualitative Only')
					<th>Collected Value</th>
                    @endif
					<th>Collected Date</th>
					<th>Identifier</th>
					<th>Site</th>
					<th>Added Date</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($indicator->dataCollections as $key => $row)
                <tr>
                    <td>{{ ++$key }}</td>
                    @if($indicator->format != 'Qualitative Only')
					<td>{{ number_format($row->collected_value) }}</td>
                    @endif
					<td>{{ date('d M Y',$row->date) }}</td>
					<td>{{ $row->identifier }}</td>
					<td>{{ $row->site->name }}</td>
					<td>{{ $row->created_at }}</td>
                    <td class="text-center">@include('admin.indicators.data-collection.actions')</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@include('admin.indicators.data-collection.create')
@include('admin.indicators.data-collection.edit')
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
        var _token = $("input[name='_token']").val();
        var indicator_id = "{{ $indicator->id }}";
        $('.validateCreate').validate({
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
                collected_value:{
                    "remote":
                    {
                        url: "{{ route('indicators.data-collections.checklimit') }}",
                        type: "POST",
                        data: {
                            _token:_token,
                            indicator_id:indicator_id,
                            collected_value: function() {
                                return $("input[name='collected_value']").val();
                            }
                        },
                    }
                }
            },
            messages:{
                collected_value:{
                    remote: jQuery.validator.format("{0} is exceed to the actual target.")
                }
            }
        });
        $('.validateUpdate').validate({
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
                collected_value:{
                    "remote":
                    {
                        url: "{{ route('indicators.data-collections.checklimit') }}",
                        type: "POST",
                        data: {
                            _token:_token,
                            indicator_id:indicator_id,
                            id: function() { return $("#editId").val();},
                            collected_value: function() {
                                return $("#editCollectedValue").val();
                            }
                        }
                    }
                }
            },
            messages:{
                collected_value:{
                    remote: jQuery.validator.format("{0} is exceed to the actual target.")
                }
            }
        });
        $('.editRecord').on('click', function(e) {
            e.preventDefault();
            $('#editId').val($(this).data('id'));
            $('#editCollectedValue').val($(this).data('collectedvalue'));
            $('#editDate').val($(this).data('date'));
            $('#editIdentifier').val($(this).data('identifier'));
            $('#editSiteId').val($(this).data('siteid')).trigger('change');
            $('#editNotes').val($(this).data('notes'));
            $('#editRecord').modal('show');
        });
    });
</script>
@endsection