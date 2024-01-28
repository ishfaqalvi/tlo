@canany(['stakeholders-view', 'stakeholders-edit', 'stakeholders-delete'])
<div class="d-inline-flex">
    <div class="dropdown">
        <a href="#" class="text-body" data-bs-toggle="dropdown">
            <i class="ph-list"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            <form action="{{ route('stakeholders.destroy',$stakeholder->id) }}" method="POST">
                @csrf
                @method('DELETE')
                @can('stakeholders-view')
                    <a href="{{ route('stakeholders.show',$stakeholder->id) }}" class="dropdown-item">
                        <i class="ph-eye me-2"></i>{{ __('Show') }}
                    </a>
                @endcan
                @can('stakeholders-edit')
                    <a href="{{ route('stakeholders.edit',$stakeholder->id) }}" class="dropdown-item">
                        <i class="ph-note-pencil me-2"></i>{{ __('Edit') }}
                    </a>
                @endcan
                @can('stakeholders-delete')
                    <button type="submit" class="dropdown-item sa-confirm">
                        <i class="ph-trash me-2"></i>{{ __('Delete') }}
                    </button>
                @endcan
            </form>
        </div>
    </div>
</div>
@endcanany