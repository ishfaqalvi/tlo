@canany(['stakeholderRoles-view', 'stakeholderRoles-edit', 'stakeholderRoles-delete'])
<div class="d-inline-flex">
    <div class="dropdown">
        <a href="#" class="text-body" data-bs-toggle="dropdown">
            <i class="ph-list"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            <form action="{{ route('stakeholder-roles.destroy',$stakeholderRole->id) }}" method="POST">
                @csrf
                @method('DELETE')
                @can('stakeholderRoles-view')
                    <a href="{{ route('stakeholder-roles.show',$stakeholderRole->id) }}" class="dropdown-item">
                        <i class="ph-eye me-2"></i>{{ __('Show') }}
                    </a>
                @endcan
                @can('stakeholderRoles-edit')
                    <a href="{{ route('stakeholder-roles.edit',$stakeholderRole->id) }}" class="dropdown-item">
                        <i class="ph-note-pencil me-2"></i>{{ __('Edit') }}
                    </a>
                @endcan
                @can('stakeholderRoles-delete')
                    <button type="submit" class="dropdown-item sa-confirm">
                        <i class="ph-trash me-2"></i>{{ __('Delete') }}
                    </button>
                @endcan
            </form>
        </div>
    </div>
</div>
@endcanany