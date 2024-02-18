<div class="d-flex">
    <a 
        href="{{ route('activities.edit',$activity->id)}}" 
        class="d-flex align-items-center text-body p-2 {{ request()->routeIs('activities.edit') ? 'active' : ''}}">
        <i class="ph-note-pencil me-1"></i>
        Detail
    </a>
    @can('activityBudget-list')
    <a 
        href="{{ route('activities.budget.index',$activity->id )}}"
        class="d-flex align-items-center text-body p-2 {{ request()->routeIs('activities.budget.index*') ? 'active' : ''}}">
        <i class="ph-currency-circle-dollar me-1"></i>
        Budget
    </a>
    @endcan
    @can('activityFile-list')
    <a 
        href="{{ route('activities.files.index',$activity->id) }}" 
        class="d-flex align-items-center text-body p-2 {{ request()->routeIs('activities.files.index*') ? 'active' : ''}}">
        <i class="ph-file me-1"></i>
        Files
    </a>
    @endcan
    @can('activitySite-list')
    <a 
        href="{{ route('activities.sites.index',$activity->id)}}"
        class="d-flex align-items-center text-body p-2 {{ request()->routeIs('activities.sites.index*') ? 'active' : ''}}">
        <i class="ph-globe me-1"></i>
        Sites
    </a>
    @endcan
    @can('activityStakeholder-list')
    <a 
        href="{{ route('activities.stakeholder.index',$activity->id)}}" 
        class="d-flex align-items-center text-body p-2 {{ request()->routeIs('activities.stakeholder.index*') ? 'active' : ''}}">
        <i class="ph-users-three me-1"></i>
        Stakeholders
    </a>
    @endcan
    @can('activityIndicator-list')
    <a 
        href="{{ route('activities.indicators.index',$activity->id)}}" 
        class="d-flex align-items-center text-body p-2 {{ request()->routeIs('activities.indicators.index*') ? 'active' : ''}}">
        <i class="ph-chart-bar me-1"></i>
        Indicators
    </a>
    @endcan
</div>