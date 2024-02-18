<div class="d-inline-flex">
    <div class="dropdown">
        <a href="#" class="text-body" data-bs-toggle="dropdown">
            <i class="ph-list"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            <form action="{{ route('projects.reporting-periods.range.destroy',$range->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <a 
                    href="#" 
                    class="dropdown-item editSubRecord" 
                    data-id="{{ $range->id }}" 
                    data-title="{{$range->title }}"
                    data-startdate="{{ date('Y-d-m',$range->start_date) }}"
                    data-enddate="{{ date('Y-d-m',$range->end_date) }}"
                    >
                    <i class="ph-note-pencil me-2"></i>{{ __('Edit') }}
                </a>
                <button type="submit" class="dropdown-item sa-confirm">
                    <i class="ph-trash me-2"></i>{{ __('Delete') }}
                </button>
            </form>
        </div>
    </div>
</div>