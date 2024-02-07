@canany(['sites-view', 'sites-edit', 'sites-delete'])
<form action="{{ route('sites.destroy',$site->id) }}" method="POST" class="my-2">
    @csrf
    @method('DELETE')
    @can('sites-view')
        <a href="{{ route('sites.show',$site->id) }}" class="btn btn-outline-success btn-sm">
            <i class="ph-eye me-2"></i>{{ __('Show') }}
        </a>
    @endcan
    @can('sites-edit')
        <a href="{{ route('sites.edit',$site->id) }}" class="btn btn-outline-info btn-sm">
            <i class="ph-note-pencil me-2"></i>{{ __('Edit') }}
        </a>
    @endcan
    @can('sites-delete')
        <button type="submit" class="btn btn-outline-danger btn-sm sa-confirm">
            <i class="ph-trash me-2"></i>{{ __('Delete') }}
        </button>
    @endcan
</form>
@endcanany