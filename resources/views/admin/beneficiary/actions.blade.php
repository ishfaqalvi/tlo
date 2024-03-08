@canany(['beneficiaries-view', 'beneficiaries-edit', 'beneficiaries-delete'])
<div class="d-inline-flex">
    <div class="dropdown">
        <a href="#" class="text-body" data-bs-toggle="dropdown">
            <i class="ph-list"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            <form action="{{ route('beneficiaries.destroy',$beneficiary->id) }}" method="POST">
                @csrf
                @method('DELETE')
                @can('beneficiaries-view')
                    <a href="{{ route('beneficiaries.show',$beneficiary->id) }}" class="dropdown-item">
                        <i class="ph-eye me-2"></i>{{ __('Show') }}
                    </a>
                @endcan
                @can('beneficiaries-edit')
                    <a href="{{ route('beneficiaries.edit',$beneficiary->id) }}" class="dropdown-item">
                        <i class="ph-note-pencil me-2"></i>{{ __('Edit') }}
                    </a>
                @endcan
                @can('beneficiaries-delete')
                    <button type="submit" class="dropdown-item sa-confirm">
                        <i class="ph-trash me-2"></i>{{ __('Delete') }}
                    </button>
                @endcan
            </form>
        </div>
    </div>
</div>
@endcanany