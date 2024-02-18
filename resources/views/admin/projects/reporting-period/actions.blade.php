@canany(['projectReportingPeriod-edit', 'projectReportingPeriod-delete'])
<div class="d-inline-flex">
    <div class="dropdown">
        <a href="#" class="text-body" data-bs-toggle="dropdown">
            <i class="ph-list"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            <form action="{{ route('projects.reporting-periods.destroy',$period->id) }}" method="POST">
                @csrf
                @method('DELETE')
                    <a href="#" class="dropdown-item addSubRecord" data-id="{{ $period->id}}">
                        <i class="ph-plus me-2"></i>{{ __('Add Range') }}
                    </a>
                @can('projectReportingPeriod-edit')
                    <a href="#" class="dropdown-item editRecord" data-id="{{ $period->id}}" data-title="{{ $period->title}}">
                        <i class="ph-note-pencil me-2"></i>{{ __('Edit') }}
                    </a>
                @endcan
                @can('projectReportingPeriod-delete')
                    <button type="submit" class="dropdown-item sa-confirm">
                        <i class="ph-trash me-2"></i>{{ __('Delete') }}
                    </button>
                @endcan
            </form>
        </div>
    </div>
</div>
@endcanany