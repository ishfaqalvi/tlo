<div class="d-flex">
    <a 
        href="{{ route('indicators.edit',$indicator->id)}}" 
        class="d-flex align-items-center text-body p-2 {{ request()->routeIs('indicators.edit') ? 'active' : ''}}">
        <i class="ph-note-pencil me-1"></i>
        Detail
    </a>
    @can('indicatorTarget-list')
    <a 
        href="{{ route('indicators.targets.index',$indicator->id)}}" 
        class="d-flex align-items-center text-body p-2 {{ request()->routeIs('indicators.targets*') ? 'active' : ''}}">
        <i class="ph-spiral me-1"></i>
        Targets & Disaggregations
    </a>
    @endcan
    @if($indicator->aggregated != 'Yes' && auth()->user()->can('indicatorDataCollections-list'))
    <a 
        href="{{ route('indicators.data-collections.index',$indicator->id)}}" 
        class="d-flex align-items-center text-body p-2 {{ request()->routeIs('indicators.data-collections*') ? 'active' : ''}}">
        <i class="ph-database me-1"></i>
        Collected Data
    </a>
    @endif
    @if($indicator->aggregated == 'Yes' && auth()->user()->can('indicatorContributions-list'))
    <a 
        href="{{ route('indicators.contributions.index',$indicator->id)}}" 
        class="d-flex align-items-center text-body p-2 {{ request()->routeIs('indicators.contributions*') ? 'active' : ''}}">
        <i class="ph-snowflake me-1"></i>
        Contributing Indicators
    </a>
    @endif
</div>