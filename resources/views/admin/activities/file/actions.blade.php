@canany(['projectFile-edit', 'projectFile-delete'])
<div class="d-inline-flex">
    <div class="dropdown">
        <a href="#" class="text-body" data-bs-toggle="dropdown">
            <i class="ph-list"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            <form action="{{ route('projects.files.destroy',$file->id) }}" method="POST">
                @csrf
                @method('DELETE')
                @can('projectFile-edit')
                    <a 
                        href="#" 
                        class="dropdown-item editFile" 
                        data-id="{{ $file->id }}"
                        data-name="{{ $file->name }}"
                        >
                        <i class="ph-note-pencil me-2"></i>{{ __('Edit') }}
                    </a>
                @endcan
                @can('projectFile-delete')
                    <button type="submit" class="dropdown-item sa-confirm">
                        <i class="ph-trash me-2"></i>{{ __('Delete') }}
                    </button>
                @endcan
            </form>
        </div>
    </div>
</div>
@endcanany