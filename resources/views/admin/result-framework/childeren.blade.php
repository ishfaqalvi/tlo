<div class="col-sm-12 ps-3">
    <div class="card {{ $parent->color }} text-white">
        <div class="card-header d-flex align-items-center">
            <h6 class="mb-0"> {{ $parent->title }}</h6>
            <div class="ms-auto">
                <div class="hstack gap-2">
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
            </div>
        </div>
    </div>
    @if ($parent->children->isNotEmpty())
        @foreach ($parent->children()->orderBy('order','ASC')->get() as $child)
            @include('admin.result-framework.childeren', ['parent' => $child])
        @endforeach
    @endif
</div>