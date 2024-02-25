@canany(['indicators-view', 'indicators-edit', 'indicators-delete'])
<div class="d-inline-flex">
    @if($indicator->aggregated == 'Yes')
        <a href="{{ route('indicators.contributions.index',$indicator->id) }}" class="me-2">
            <i class="ph-snowflake"></i>
        </a>
    @else
        <a href="{{ route('indicators.data-collections.index',$indicator->id) }}" class="me-2">
            <i class="ph-database"></i>
        </a>
    @endif
    <div class="dropdown">
        <a href="#" class="text-body" data-bs-toggle="dropdown">
            <i class="ph-list"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            <form action="{{ route('indicators.destroy',$indicator->id) }}" method="POST">
                @csrf
                @method('DELETE')
                @can('indicators-view')
                    <a href="{{ route('indicators.show',$indicator->id) }}" class="dropdown-item">
                        <i class="ph-eye me-2"></i>{{ __('Show') }}
                    </a>
                @endcan
                @can('indicators-edit')
                    <a href="{{ route('indicators.edit',$indicator->id) }}" class="dropdown-item">
                        <i class="ph-note-pencil me-2"></i>{{ __('Edit') }}
                    </a>
                @endcan
                @can('indicators-delete')
                    <button type="submit" class="dropdown-item sa-confirm">
                        <i class="ph-trash me-2"></i>{{ __('Delete') }}
                    </button>
                @endcan
            </form>
        </div>
    </div>
</div>
@endcanany