@canany(['feadbacks-view', 'feadbacks-edit', 'feadbacks-delete'])
<div class="d-inline-flex">
    <div class="dropdown">
        <a href="#" class="text-body" data-bs-toggle="dropdown">
            <i class="ph-list"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            <form action="{{ route('feadbacks.destroy',$feadback->id) }}" method="POST">
                @csrf
                @method('DELETE')
                @can('feadbacks-view')
                    <a href="{{ route('feadbacks.show',$feadback->id) }}" class="dropdown-item">
                        <i class="ph-eye me-2"></i>{{ __('Show') }}
                    </a>
                @endcan
                @can('feadbacks-edit')
                    <a href="{{ route('feadbacks.edit',$feadback->id) }}" class="dropdown-item">
                        <i class="ph-note-pencil me-2"></i>{{ __('Edit') }}
                    </a>
                @endcan
                @can('feadbacks-delete')
                    <button type="submit" class="dropdown-item sa-confirm">
                        <i class="ph-trash me-2"></i>{{ __('Delete') }}
                    </button>
                @endcan
            </form>
        </div>
    </div>
</div>
@endcanany