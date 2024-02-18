<div class="d-flex">
    <a 
        href="{{ route('indicators.edit',$indicator->id)}}" 
        class="d-flex align-items-center text-body p-2 {{ request()->routeIs('indicators.edit') ? 'active' : ''}}">
        <i class="ph-note-pencil me-1"></i>
        Detail
    </a>
</div>