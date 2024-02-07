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
        @foreach ($sites as $key => $site)
        <div class="row">
            <div class="col-md-8">
                <div class="map-container" id="map{{ $key }}"></div>
                <script type="text/javascript">
                    var map = L.map('map<?php echo $key ?>').setView([
                        "<?php echo $site->latitude ?>", "<?php echo $site->longitude ?>"], 13);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        className: 'map-leaflet'
                    }).addTo(map);
                    L.marker(["<?php echo $site->latitude ?>", "<?php echo $site->longitude ?>"]).addTo(map).bindPopup("<?php echo $site->name ?>").openPopup();
                </script>
            </div>
            <div class="col-md-4">
                @include('admin.site.actions')
                <div class="form-group mb-3">
                    <strong>Site Type:</strong>
                    {{ $site->siteType->title }}
                </div>
                <div class="form-group mb-3">
                    <strong>Province:</strong>
                    {{ $site->province->title }}
                </div>
                <div class="form-group mb-3">
                    <strong>Name:</strong>
                    {{ $site->name }}
                </div>
                <div class="form-group mb-3">
                    <strong>Office:</strong>
                    {{ $site->office }}
                </div>
                <div class="form-group mb-3">
                    <strong>Contact Name:</strong>
                    {{ $site->contact_name }}
                </div>
                <div class="form-group mb-3">
                    <strong>Contact Number:</strong>
                    {{ $site->contact_number }}
                </div>
                <div class="form-group mb-3">
                    <strong>Latitude:</strong>
                    {{ $site->latitude }}
                </div>
                <div class="form-group mb-3">
                    <strong>Longitude:</strong>
                    {{ $site->longitude }}
                </div>
                <div class="form-group mb-3">
                    <strong>Status:</strong>
                    {{ $site->status }}
                </div>
                <div class="form-group mb-3">
                    <strong>Note:</strong>
                    {{ $site->note }}
                </div>
            </div>
        </div>
        <hr>
        @endforeach
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