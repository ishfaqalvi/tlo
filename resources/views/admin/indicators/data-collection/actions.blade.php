@canany(['indicatorDataCollections-view', 'indicatorDataCollections-edit', 'indicatorDataCollections-delete'])
<div class="d-inline-flex">
    <div class="dropdown">
        <a href="#" class="text-body" data-bs-toggle="dropdown">
            <i class="ph-list"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            <form action="{{ route('indicators.data-collections.destroy',$row->id) }}" method="POST">
                @csrf
                @method('DELETE')
                @can('indicatorDataCollections-view')
                    <a href="{{ route('indicators.data-collections.show',$row->id)}}" class="dropdown-item">
                        <i class="ph-eye me-2"></i>{{ __('Show') }}
                    </a>
                @endcan
                @can('indicatorDataCollections-edit')
                    <a 
                        href="#" 
                        data-id="{{ $row->id }}"
                        data-collectedvalue="{{ $row->collected_value }}"
                        data-date="{{ date('Y-m-d',$row->date) }}"
                        data-identifier="{{ $row->identifier }}"
                        data-siteid="{{ $row->site_id }}"
                        data-notes="{{ $row->notes }}"
                        class="dropdown-item editRecord">
                        <i class="ph-note-pencil me-2"></i>{{ __('Edit') }}
                    </a>
                @endcan
                @can('indicatorDataCollections-delete')
                    <button type="submit" class="dropdown-item sa-confirm">
                        <i class="ph-trash me-2"></i>{{ __('Delete') }}
                    </button>
                @endcan
            </form>
        </div>
    </div>
</div>
@endcanany