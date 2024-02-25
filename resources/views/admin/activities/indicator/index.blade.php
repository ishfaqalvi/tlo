@extends('admin.layout.app')

@section('title')
    Activity Indicator
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Activity Indicator Management</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            @can('activityIndicator-create')
            <a href="#" data-bs-toggle="modal" data-bs-target="#addRecord" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
                <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                    <i class="ph-plus"></i>
                </span>
                Add Indicator
            </a>
            @endcan
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Activity Indicators</h5>
        </div>
        <table class="table datatable-basic">
            <thead class="thead">
                <tr>
                    <th>No</th>
					<th>Name</th>
					<th>Level</th>
                    <th>Status</th>
                    <th>Actual VS Target</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($activity->indicators as $key => $row)
                @php($indicator = $row->indicator)
                <tr>
                    <td>{{ ++$key }}</td>
					<td>{{ $indicator->name }}</td>
					<td>{{ $indicator->resultFramework->title ?? '' }}</td>
                    <td>{{ $indicator->status }}</td>
                    <td>
                        @if($indicator->format != 'Qualitative Only' && $indicator->aggregated !='Yes')
                            @php($data = getIndicatorActualVsTarget($indicator))
                            {{ $data['stat'] }} 
                            <div class="progress">
                                <div class="progress-bar bg-teal" style="width: {{ $data['percentage'] }}%" aria-valuenow="{{ $data['percentage'] }}" aria-valuemin="0" aria-valuemax="100">{{ $data['percentage'] }}% complete</div>
                            </div>
                        @endif
                        @if($indicator->format != 'Qualitative Only' && $indicator->aggregated =='Yes')
                            @php($data = calculateAggregatedTarget($indicator))
                            {{ $data['stat'] }} 
                            <div class="progress">
                                <div class="progress-bar bg-teal" style="width: {{ $data['percentage'] }}%" aria-valuenow="{{ $data['percentage'] }}" aria-valuemin="0" aria-valuemax="100">{{ $data['percentage'] }}% complete</div>
                            </div>
                        @endif
                    </td>
                    <td class="text-center">
                        <form action="{{ route('activities.indicators.destroy',$row->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            @can('activityIndicator-delete')
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
@include('admin.activities.indicator.create')
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
    });
</script>
@endsection