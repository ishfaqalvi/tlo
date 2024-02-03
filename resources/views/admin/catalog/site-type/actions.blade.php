@canany(['siteTypes-view', 'siteTypes-edit', 'siteTypes-delete'])
<div class="d-inline-flex">
    <div class="dropdown">
        <a href="#" class="text-body" data-bs-toggle="dropdown">
            <i class="ph-list"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            <form action="{{ route('site-types.destroy',$siteType->id) }}" method="POST">
                @csrf
                @method('DELETE')
                @can('siteTypes-view')
                    <a href="{{ route('site-types.show',$siteType->id) }}" class="dropdown-item">
                        <i class="ph-eye me-2"></i>{{ __('Show') }}
                    </a>
                @endcan
                @can('siteTypes-edit')
                    <a href="{{ route('site-types.edit',$siteType->id) }}" class="dropdown-item">
                        <i class="ph-note-pencil me-2"></i>{{ __('Edit') }}
                    </a>
                @endcan
                @can('siteTypes-delete')
                    <button type="submit" class="dropdown-item sa-confirm">
                        <i class="ph-trash me-2"></i>{{ __('Delete') }}
                    </button>
                @endcan
            </form>
        </div>
    </div>
</div>
@endcanany