@canany(['riskPlans-view', 'riskPlans-edit', 'riskPlans-delete'])
<div class="d-inline-flex">
    <div class="dropdown">
        <a href="#" class="text-body" data-bs-toggle="dropdown">
            <i class="ph-list"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            <form action="{{ route('risk-plans.destroy',$riskPlan->id) }}" method="POST">
                @csrf
                @method('DELETE')
                @can('riskPlans-view')
                    <a href="{{ route('risk-plans.show',$riskPlan->id) }}" class="dropdown-item">
                        <i class="ph-eye me-2"></i>{{ __('Show') }}
                    </a>
                @endcan
                @can('riskPlans-edit')
                    <a href="{{ route('risk-plans.edit',$riskPlan->id) }}" class="dropdown-item">
                        <i class="ph-note-pencil me-2"></i>{{ __('Edit') }}
                    </a>
                @endcan
                @can('riskPlans-delete')
                    <button type="submit" class="dropdown-item sa-confirm">
                        <i class="ph-trash me-2"></i>{{ __('Delete') }}
                    </button>
                @endcan
            </form>
        </div>
    </div>
</div>
@endcanany