@canany(['thematicArea-view', 'thematicArea-edit', 'thematicArea-delete'])
<div class="d-inline-flex">
    <div class="dropdown">
        <a href="#" class="text-body" data-bs-toggle="dropdown">
            <i class="ph-list"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            <form action="{{ route('thematic-areas.destroy',$thematicArea->id) }}" method="POST">
                @csrf
                @method('DELETE')
                @can('thematicArea-view')
                    <a href="{{ route('thematic-areas.show',$thematicArea->id) }}" class="dropdown-item">
                        <i class="ph-eye me-2"></i>{{ __('Show') }}
                    </a>
                @endcan
                @can('thematicArea-edit')
                    <a href="{{ route('thematic-areas.edit',$thematicArea->id) }}" class="dropdown-item">
                        <i class="ph-note-pencil me-2"></i>{{ __('Edit') }}
                    </a>
                @endcan
                @can('thematicArea-delete')
                    <button type="submit" class="dropdown-item sa-confirm">
                        <i class="ph-trash me-2"></i>{{ __('Delete') }}
                    </button>
                @endcan
            </form>
        </div>
    </div>
</div>
@endcanany