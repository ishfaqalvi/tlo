@canany(['activityBudget-edit', 'activityBudget-delete'])
<div class="d-inline-flex">
    <div class="dropdown">
        <a href="#" class="text-body" data-bs-toggle="dropdown">
            <i class="ph-list"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            <form action="{{ route('activities.budget.destroy',$budget->id) }}" method="POST">
                @csrf
                @method('DELETE')
                @can('activityBudget-edit')
                    <a 
                        href="#" 
                        class="dropdown-item editRecord" 
                        data-id="{{ $budget->id }}"
                        data-description="{{ $budget->description }}"
                        data-budgetamount="{{ $budget->budget_amount }}"
                        data-actualspent="{{ $budget->actual_spent }}"
                        >
                        <i class="ph-note-pencil me-2"></i>{{ __('Edit') }}
                    </a>
                @endcan
                @can('activityBudget-delete')
                    <button type="submit" class="dropdown-item sa-confirm">
                        <i class="ph-trash me-2"></i>{{ __('Delete') }}
                    </button>
                @endcan
            </form>
        </div>
    </div>
</div>
@endcanany