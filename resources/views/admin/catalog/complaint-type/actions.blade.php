@canany(['complaintTypes-view', 'complaintTypes-edit', 'complaintTypes-delete'])
<div class="d-inline-flex">
    <div class="dropdown">
        <a href="#" class="text-body" data-bs-toggle="dropdown">
            <i class="ph-list"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            <form action="{{ route('complaint-types.destroy',$complaintType->id) }}" method="POST">
                @csrf
                @method('DELETE')
                @can('complaintTypes-view')
                    <a href="{{ route('complaint-types.show',$complaintType->id) }}" class="dropdown-item">
                        <i class="ph-eye me-2"></i>{{ __('Show') }}
                    </a>
                @endcan
                @can('complaintTypes-edit')
                    <a href="{{ route('complaint-types.edit',$complaintType->id) }}" class="dropdown-item">
                        <i class="ph-note-pencil me-2"></i>{{ __('Edit') }}
                    </a>
                @endcan
                @can('complaintTypes-delete')
                    <button type="submit" class="dropdown-item sa-confirm">
                        <i class="ph-trash me-2"></i>{{ __('Delete') }}
                    </button>
                @endcan
            </form>
        </div>
    </div>
</div>
@endcanany