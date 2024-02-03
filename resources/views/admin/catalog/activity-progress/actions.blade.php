@canany(['activityProgress-view', 'activityProgress-edit', 'activityProgress-delete'])
<div class="d-inline-flex">
    <div class="dropdown">
        <a href="#" class="text-body" data-bs-toggle="dropdown">
            <i class="ph-list"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            <form action="{{ route('activity-progresses.destroy',$activityProgress->id) }}" method="POST">
                @csrf
                @method('DELETE')
                @can('activityProgress-view')
                    <a href="{{ route('activity-progresses.show',$activityProgress->id) }}" class="dropdown-item">
                        <i class="ph-eye me-2"></i>{{ __('Show') }}
                    </a>
                @endcan
                @can('activityProgress-edit')
                    <a href="{{ route('activity-progresses.edit',$activityProgress->id) }}" class="dropdown-item">
                        <i class="ph-note-pencil me-2"></i>{{ __('Edit') }}
                    </a>
                @endcan
                @can('activityProgress-delete')
                    <button type="submit" class="dropdown-item sa-confirm">
                        <i class="ph-trash me-2"></i>{{ __('Delete') }}
                    </button>
                @endcan
            </form>
        </div>
    </div>
</div>
@endcanany