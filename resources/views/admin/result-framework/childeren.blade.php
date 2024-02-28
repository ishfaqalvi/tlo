<li>
    <div style="width: 200px;" class="mx-auto">
        <div class="card mb-0">
            <div class="{{ $parent->color }} text-white card-header d-flex align-items-center justify-content-center p-1">
                <form action="{{ route('resultFrameworks.destroy',$parent->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    @can('resultFrameworks-create')
                    <a href="#" data-parentid="{{ $parent->id }}" class="text-white addFramework">
                        <i class="ph-plus-circle"></i>
                    </a>
                    @endcan
                    @can('resultFrameworks-edit')
                    <a 
                        href="#" 
                        data-id="{{ $parent->id }}"
                        data-title="{{ $parent->title }}"
                        data-color="{{ $parent->color }}"
                        data-order="{{ $parent->order }}"
                        data-description="{{ $parent->description }}"
                        class="text-white editFramework">
                        <i class="ph-note-pencil"></i>
                    </a>
                    @endcan
                    @can('resultFrameworks-delete')
                    <a href="#" class="text-white sa-confirm">
                        <i class="ph-trash"></i>
                    </a>
                    @endcan
                </form>
            </div>
            <div class="card-body p-1">
                <div class="fw-bold"> {{ $parent->title }}</div>
                <p class="fw-normal">
                    @if (strlen($parent->description) > 25)
                        <a href="#" data-bs-popup="tooltip" title="{{ $parent->description }}">{{ \Illuminate\Support\Str::limit($parent->description, 25) }}</a>
                    @else
                        {{ $parent->description }}
                    @endif
                </p>
            </div>
        </div>
    </div>
    @if ($parent->children->isNotEmpty())
        <ul>
            @foreach ($parent->children()->orderBy('order','ASC')->get() as $child)
                @include('admin.result-framework.childeren', ['parent' => $child])
            @endforeach
        </ul>
    @endif
</li>