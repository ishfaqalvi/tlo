@extends('admin.layout.app')

@section('title')
    {{ $site->name ?? "Show Site" }}
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
            <a href="{{ route('sites.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
            <h5 class="mb-0">{{ __('Show') }} Site</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-lg-3 mb-3">
                    <strong>Site Type:</strong>
                    {{ $site->siteType->title }}
                </div>
                <div class="form-group col-lg-3 mb-3">
                    <strong>Province:</strong>
                    {{ $site->province->title }}
                </div>
                <div class="form-group col-lg-3 mb-3">
                    <strong>Name:</strong>
                    {{ $site->name }}
                </div>
                <div class="form-group col-lg-3 mb-3">
                    <strong>Office:</strong>
                    {{ $site->office }}
                </div>
                <div class="form-group col-lg-3 mb-3">
                    <strong>Contact Name:</strong>
                    {{ $site->contact_name }}
                </div>
                <div class="form-group col-lg-3 mb-3">
                    <strong>Contact Number:</strong>
                    {{ $site->contact_number }}
                </div>
                <div class="form-group col-lg-3 mb-3">
                    <strong>Latitude:</strong>
                    {{ $site->latitude }}
                </div>
                <div class="form-group col-lg-3 mb-3">
                    <strong>Longitude:</strong>
                    {{ $site->longitude }}
                </div>
                <div class="form-group col-lg-3 mb-3">
                    <strong>Status:</strong>
                    {{ $site->status }}
                </div>
                <div class="form-group col-lg-9 mb-3">
                    <strong>Note:</strong>
                    {{ $site->note }}
                </div>
                <div class="col-md-12">
                    <div class="map-container" id="map"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap" type="text/javascript"></script>
<script type="text/javascript">
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 6,
            center: {lat: 33.889250452146115, lng: 64.78623096987168}
        });
        var marker = new google.maps.Marker({
            position: {lat: {{ $site->latitude }}, lng: {{ $site->longitude }}},
            map: map,
            title: '{{ $site->name }}'
        });
    }
</script>
@endsection