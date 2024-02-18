<div class="d-flex">
    <a 
        href="{{ route('projects.edit',$project->id)}}" 
        class="d-flex align-items-center text-body p-2 {{ request()->routeIs('projects.edit') ? 'active' : ''}}">
        <i class="ph-note-pencil me-1"></i>
        Detail
    </a>
    @can('projectSite-list')
    <a 
        href="{{ route('projects.sites.index',$project->id)}}"
        class="d-flex align-items-center text-body p-2 {{ request()->routeIs('projects.sites.index*') ? 'active' : ''}}">
        <i class="ph-globe me-1"></i>
        Sites
    </a>
    @endcan
    @can('projectPhase-list')
    <a 
        href="{{ route('projects.phase.index',$project->id )}}"
        class="d-flex align-items-center text-body p-2 {{ request()->routeIs('projects.phase.index*') ? 'active' : ''}}">
        <i class="ph-list-numbers me-1"></i>
        Phases
    </a>
    @endcan
    @can('projectStakeholder-list')
    <a 
        href="{{ route('projects.stakeholder.index',$project->id)}}" 
        class="d-flex align-items-center text-body p-2 {{ request()->routeIs('projects.stakeholder.index*') ? 'active' : ''}}">
        <i class="ph-users-three me-1"></i>
        Stakeholders
    </a>
    @endcan
    @can('projectFile-list')
    <a 
        href="{{ route('projects.files.index',$project->id) }}" 
        class="d-flex align-items-center text-body p-2 {{ request()->routeIs('projects.files.index*') ? 'active' : ''}}">
        <i class="ph-file me-1"></i>
        Files
    </a>
    @endcan
    @can('projectDisaggregation-list')
    <a 
        href="{{ route('projects.disaggregation.index',$project->id)}}" 
        class="d-flex align-items-center text-body p-2 {{ request()->routeIs('projects.disaggregation.index*') ? 'active' : ''}}">
        <i class="ph-database me-1"></i>
        Disaggregation Types
    </a>
    @endcan
    @can('projectTeamMember-list')
    <a 
        href="{{ route('projects.team-members.index',$project->id)}}" 
        class="d-flex align-items-center text-body p-2 {{ request()->routeIs('projects.team-members.index*') ? 'active' : ''}}">
        <i class="ph-users-four me-1"></i>
        Team
    </a>
    @endcan
    @can('projectTeamMember-list')
    <a 
        href="{{ route('projects.reporting-periods.index',$project->id)}}" 
        class="d-flex align-items-center text-body p-2 {{ request()->routeIs('projects.reporting-periods.index*') ? 'active' : ''}}">
        <i class="ph-calendar-check me-1"></i>
        Reporting Periods
    </a>
    @endcan
</div>