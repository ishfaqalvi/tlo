@extends('admin.layout.app')

@section('title')
    Project Sites
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Project Sites Management</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            @can('projectSite-create')
            <a href="#" data-bs-toggle="modal" data-bs-target="#addSite" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
                <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                    <i class="ph-plus"></i>
                </span>
                Add Site
            </a>
            @endcan
        </div>
    </div>
</div>
<div class="page-header-content d-lg-flex border-top">
    @include('admin.projects.navigation')
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
                @foreach ($project->sites as $key => $row)
                    @php($site = $row->site)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $site->name }}</td>
                        <td>{{ $site->siteType->title }}</td>
                        <td>{{ $site->province->title }}</td>
                        <td>{{ $site->office }}</td>
                        <td>{{ $site->contact_name }}</td>
                        <td>{{ $site->contact_number }}</td>
                        <td>{{ $site->status }}</td>
                        <td class="text-center">
                            <form action="{{ route('projects.sites.destroy',$row->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                @can('projectSite-delete')
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
        @foreach($project->sites as $row)
            @php($site = $row->site)
            var marker = new google.maps.Marker({
                position: {lat: {{ $site->latitude }}, lng: {{ $site->longitude }}},
                map: map,
                title: '{{ $site->name }}'
            });
        @endforeach
    }
</script>
@include('admin.projects.site.create')
@endsection

@section('script')
<script>
    $(function () {
        $('.select').select2();
        const typeSelect = $('select[name=type]');
        const _token = $("input[name='_token']").val();
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
            },
            rules: {
                site_id: {
                    required: isType('Add From Existing'),
                    remote: remoteSettings('#site_id')
                },
                name:           {required: isType('New Add')},
                site_type_id:   {required: isType('New Add')},
                status:         {required: isType('New Add')},
                contact_name:   {required: isType('New Add')},
                contact_number: {required: isType('New Add')},
                province_id:    {required: isType('New Add')},
                office:         {required: isType('New Add')},
                latitude:       {required: isType('New Add')},
                longitude:      {required: isType('New Add')},
                note:           {required: isType('New Add')}
            },
            messages:{
                site_id:{
                    remote: jQuery.validator.format("This site is already added.")
                }
            }
        });
        $(".sa-confirm").click(showConfirmation);
        typeSelect.on('change', function(){
            let type = $(this).val();
            if (type == 'Add From Existing') {
                $('div.existingSites').show('slow');
                $('div.newSite').hide('slow');
            }else if(type == 'New Add'){
                $('div.existingSites').hide('slow');
                $('div.newSite').show('slow');
            }else{
                $('div.existingSites').hide('slow');
                $('div.newSite').hide('slow');
            }
        });
        function isType(desiredType) {
            return function() { return typeSelect.val() == desiredType; };
        }
        function remoteSettings(elementId) {
            return {
                url: "{{ route('projects.sites.checkRecord') }}",
                type: "POST",
                data: {
                    _token,
                    project_id: "{{ $project->id }}",
                    site_id: function() { return $(elementId).val(); }
                },
            };
        }
        function showConfirmation(event) {
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
                if (result.value)  $(event.target).closest("form").submit();
            });
        }
        ClassicEditor.create(document.querySelector('#ckeditor'), {
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                    { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                    { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                    { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                ]
            }
        }).catch(console.error);
    });
</script>
@endsection