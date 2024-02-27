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
                    <th>Thematic Area</th>
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
                        <td>{{ $site->thematicArea->title }}</td>
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
        <div class="map-container" id="map"></div>
    </div>
</div>
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap" type="text/javascript"></script>
<script type="text/javascript">
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 6,
            center: {lat: 33.889250452146115, lng: 64.78623096987168}
        });
        @foreach($sites as $site)
            var marker = new google.maps.Marker({
                position: {lat: {{ $site->latitude }}, lng: {{ $site->longitude }}},
                map: map,
                title: '{{ $site->name }}'
            });
        @endforeach
    }
</script>
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