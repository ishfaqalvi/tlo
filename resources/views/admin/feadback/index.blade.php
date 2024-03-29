@extends('admin.layout.app')

@section('title')
    Feadback
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Feadback Management</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            @can('feadbacks-create')
            <a href="{{ route('feadbacks.create') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
                <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                    <i class="ph-plus"></i>
                </span>
                Create New
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
            <h5 class="mb-0">Feadback</h5>
        </div>
        <table class="table datatable-basic">
            <thead class="thead">
                <tr>
                    <th>No</th>
					<th>Channel</th>
					<th>Name</th>
					<th>Contact Number</th>
					<th>Complainer Type</th>
					<th>Complaint Type</th>
					<th>Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($feadbacks as $key => $feadback)
                @if($feadback->complaintType->type == 'Sensitive')
                    @php($textColor = 'text-danger')
                @else
                    @php($textColor = 'text-info')
                @endif
                <tr>
                    <td>{{ ++$key }}</td>
					<td>{{ $feadback->channel == 'Other Bright Ideas' ? $feadback->other_channel : $feadback->channel}}</td>
					<td>{{ $feadback->name }}</td>
					<td>{{ $feadback->contact_number }}</td>
					<td>{{ $feadback->complainer_type }}</td>
					<td class="{{ $textColor }}">{{ $feadback->complaintType->title }}</td>
					<td>{{ $feadback->status }}</td>
                    <td>@include('admin.feadback.actions')</td>
                </tr>
                @include('admin.feadback.responce.create')
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