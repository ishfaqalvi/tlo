@canany(['projectDisaggregation-edit','projectDisaggregation-delete'])
<div class="d-inline-flex">
    <div class="dropdown">
        <a href="#" class="text-body" data-bs-toggle="dropdown">
            <i class="ph-list"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            <form action="{{ route('projects.disaggregation.destroy',$row->id) }}" method="POST">
                @csrf
                @method('DELETE')
                @can('projectDisaggregation-edit')
                    <a 
                        href="#" 
                        class="dropdown-item editRecord" 
                        data-id="{{ $row->id }}"
                        data-type="{{ $row->type }}"
                        data-fields="{{ json_encode($row->fields) }}"
                        >
                        <i class="ph-note-pencil me-2"></i>{{ __('Edit') }}
                    </a>
                @endcan
                @can('projectDisaggregation-delete')
                    <button type="submit" class="dropdown-item sa-confirm">
                        <i class="ph-trash me-2"></i>{{ __('Delete') }}
                    </button>
                @endcan
            </form>
        </div>
    </div>
</div>
@endcanany