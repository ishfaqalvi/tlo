<div class="d-inline-flex">
    <form action="{{ route('indicators.contributions.destroy',$row->id) }}" method="POST">
        @csrf
        @method('DELETE')
        @can('indicatorContributions-delete')
            <a href="#" class="text-danger sa-confirm" title="Remove">
                <i class="ph-trash"></i>
            </a>
        @endcan
    </form>
</div>