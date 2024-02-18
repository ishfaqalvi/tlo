<div id="editRecord" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('activities.budget.update') }}" class="updateRecord" role="form" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Update Activity Budget') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        {{ Form::hidden('id', null,['id'=>'editId']) }}
                        <div class="form-group col-lg-12 mb-3">
                            {{ Form::label('description') }}
                            {{ Form::text('description', null, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description','required','id'=>'editDescription']) }}
                        </div>
                        <div class="form-group col-lg-12 mb-3">
                            {{ Form::label('budget_amount') }}
                            {{ Form::number('budget_amount', null, ['class' => 'form-control' . ($errors->has('budget_amount') ? ' is-invalid' : ''), 'placeholder' => 'Budget Amount','required','id'=>'editBudgetAmoun']) }}
                        </div>
                        <div class="form-group col-lg-12">
                            {{ Form::label('actual_spent') }}
                            {{ Form::text('actual_spent', null, ['class' => 'form-control' . ($errors->has('actual_spent') ? ' is-invalid' : ''), 'placeholder' => 'Actual Spent','required','id'=>'editActualSpent']) }}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>