@extends('admin.layout.app')

@section('title')
    Site
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Site Management</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            @can('sites-create')
            <a href="{{ route('sites.create') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
                <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                    <i class="ph-plus"></i>
                </span>
                Add Site
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
            <h5 class="mb-0">Site</h5>
        </div>
        <table class="table datatable-basic">
            <thead class="thead">
                <tr>
                    <th>No</th>
					<th>Name</th>
                    <th>Site Type</th>
                    <th>Province</th>
					<th>Office</th>
					<th>Contact Name</th>
					<th>Contact Number</th>
					<th>Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($sites as $key => $site)
                <tr>
                    <td>{{ ++$key }}</td>
					<td>{{ $site->name }}</td>
                    <td>{{ $site->siteType->title }}</td>
                    <td>{{ $site->province->title }}</td>
					<td>{{ $site->office }}</td>
					<td>{{ $site->contact_name }}</td>
					<td>{{ $site->contact_number }}</td>
					<td>{{ $site->status }}</td>
                    <td class="text-center">@include('admin.site.actions')</td>
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