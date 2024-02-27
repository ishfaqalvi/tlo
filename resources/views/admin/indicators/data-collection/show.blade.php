@extends('admin.layout.app')

@section('title')
    {{ $dataCollect->name ?? "Show Indicator Data Collection" }}
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
            <a href="{{ route('indicators.data-collections.index',$indicator->id) }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
<div class="{{ $indicator->format != 'Qualitative Only' ? 'col-md-4' : 'col-md-12' }}">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Data Collection Detail</h5>
        </div>
        <div class="card-body">
            <div class="form-group mb-3">
                <strong>Collected Value:</strong>
                {{ $dataCollect->collected_value }}
            </div>
            <div class="form-group mb-3">
                <strong>Date:</strong>
                {{ date('d M Y',$dataCollect->date) }}
            </div>
            <div class="form-group mb-3">
                <strong>Identifier:</strong>
                {{ $dataCollect->identifier }}
            </div>
            <div class="form-group mb-3">
                <strong>Site:</strong>
                {{ $dataCollect->site->name }}
            </div>
            <div class="form-group mb-3">
                <strong>Evidence:</strong>
                @if(isset($dataCollect->evidence))
                @foreach(json_decode($dataCollect->evidence) as $key => $evidence)
                    <a href="{{ asset('images/indicator/data-collection/'.$evidence) }}" target="_blank"> Eveidence {{ ++$key }}</a></br>
                @endforeach
                @endif
            </div>
            <div class="form-group mb-3">
                <strong>Notes:</strong>
                {{ $dataCollect->notes }}
            </div>
        </div>
    </div>
</div>
@if($indicator->format != 'Qualitative Only')
<div class="col-md-8">
    <div class="card">
        <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
            <h6 class="py-sm-3 mb-sm-0">Data Collection Disaggregations</h6>
            <div class="ms-sm-auto my-sm-auto">
                @can('indicatorDataDisaggregation-create')
                <button type="button" data-bs-toggle="modal" data-bs-target="#addRecord" class="btn btn-primary btn-icon">
                    <i class="ph-plus"></i>
                </button>
                @endcan
            </div>
        </div>
        <div class="table-responsive">
            <table class="table text-nowrap">
                <thead>
                    <tr>
                        <th>Field Name</th>
                        <th>Data Collected</th>
                        <th class="text-center" style="width: 20px;"><i class="ph-dots-three"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dataCollect->dataDisaggregations as $row)
                    <tr class="table-light">
                        <td colspan="2" class="fw-semibold">
                            {{ $row->projectDisaggregation->type }}
                        </td>
                        <td class="text-end">
                            <div class="d-inline-flex">
                                <form action="{{ route('indicators.data-disaggregations.destroy',$row->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    @can('indicatorDataDisaggregation-delete')
                                        <a href="#" class="text-danger sa-confirm" title="Remove">
                                            <i class="ph-trash"></i>
                                        </a>
                                    @endcan
                                </form>
                            </div>
                        </td>
                    </tr>
                    @foreach($row->dataDisaggregationFields as $field)
                    <tr>
                        <td>{{ $field->projectDisaggregationField->name }}</td>
                        <td>{{ number_format($field->value) }}</td>
                        <td>
                            @can('indicatorDataDisaggregation-edit')
                            <a 
                                href="#" 
                                data-id="{{ $field->id }}"
                                data-collectedvalue="{{ $field->value }}"
                                class="text-info editRecord">
                                <i class="ph-note-pencil"></i>
                            </a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                    @empty
                    <tr class="table-light text-center">
                        <td colspan="3" class="fw-semibold">
                            No data found!
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif
@include('admin.indicators.data-disaggregation.create')
@include('admin.indicators.data-disaggregation.edit')
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
        $('#disaggregation_id').change(function() {
            var id = $(this).val();
            if (id) {
                $.ajax({
                    url: '/admin/indicators/data-disaggregations/get-fields/' + id,
                    type: 'GET',
                    success: function(data) {
                        $('#child-fields-container').html(data);
                    },
                    error: function() {
                        alert('Error loading data');
                    }
                });
            } else {
                $('#child-fields-container').empty();
            }
        });
        var _token = $("input[name='_token']").val();
        var collection_id = "{{ $dataCollect->id }}";
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
                disaggregation_id:{
                    "remote":
                    {
                        url: "{{ route('indicators.data-disaggregations.checkRecord') }}",
                        type: "POST",
                        data: {
                            _token:_token,
                            collection_id:collection_id,
                            disaggregation_id: function() {
                                return $("input[name='collected_value']").val();
                            }
                        },
                    }
                }
            },
            messages:{
                disaggregation_id:{
                    remote: jQuery.validator.format("{0} is already exist.")
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
            }
        });
        $('.editRecord').on('click', function(e) {
            e.preventDefault();
            $('#editId').val($(this).data('id'));
            $('#editValue').val($(this).data('collectedvalue'));
            $('#editRecord').modal('show');
        });
    });
</script>
@endsection