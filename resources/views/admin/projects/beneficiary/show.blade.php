<div id="viewDetail{{$beneficiary->id}}" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Project Benificiary Detail') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group mb-3">
                        <strong>Name:</strong>
                        {{ $beneficiary->name }}
                    </div>
                    <div class="form-group mb-3">
                        <strong>Father Name:</strong>
                        {{ $beneficiary->father_name }}
                    </div>
                    <div class="form-group mb-3">
                        <strong>Gender:</strong>
                        {{ $beneficiary->gender }}
                    </div>
                    <div class="form-group mb-3">
                        <strong>Marital Status:</strong>
                        {{ $beneficiary->marital_status }}
                    </div>
                    <div class="form-group mb-3">
                        <strong>Province:</strong>
                        {{ $beneficiary->province }}
                    </div>
                    <div class="form-group mb-3">
                        <strong>District:</strong>
                        {{ $beneficiary->district }}
                    </div>
                    <div class="form-group mb-3">
                        <strong>Village:</strong>
                        {{ $beneficiary->village }}
                    </div>
                    <div class="form-group mb-3">
                        <strong>Contact:</strong>
                        {{ $beneficiary->contact }}
                    </div>
                    <div class="form-group mb-3">
                        <strong>Type Of Assistance:</strong>
                        {{ $beneficiary->type_of_assistance }}
                    </div>
                    <div class="form-group mb-3">
                        <strong>Residential Type:</strong>
                        {{ $beneficiary->residential_type }}
                    </div>
                    <div class="form-group mb-3">
                        <strong>Remarks:</strong>
                        {{ $beneficiary->remarks }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>