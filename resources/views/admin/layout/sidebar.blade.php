
<li class="nav-item-header pt-0">
    <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Main</div>
    <i class="ph-dots-three sidebar-resize-show"></i>
</li>
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : ''}}" href="{{ route('dashboard.widgets') }}">
        <i class="ph-house"></i>
        <span>Dashboard</span>
    </a>
</li>
@canany(['projects-list','stakeholders-list'])
<li class="nav-item-header">
    <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Project Management</div>
    <i class="ph-dots-three sidebar-resize-show"></i>
</li>
@endcanany
@can('projects-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('projects*') ? 'active' : ''}}" href="{{ route('projects.index') }}">
        <i class="ph-folder"></i>
        <span>Projects</span>
    </a>
</li>
@endcan
@can('resultFrameworks-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('resultFrameworks*') ? 'active' : ''}}" href="{{ route('resultFrameworks.index') }}">
        <i class="ph-tree-structure"></i>
        <span>Results Framework</span>
    </a>
</li>
@endcan
@can('indicators-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('indicators*') ? 'active' : ''}}" href="{{ route('indicators.index') }}">
        <i class="ph-chart-bar"></i>
        <span>Indicators</span>
    </a>
</li>
@endcan
@can('activities-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('activities*') ? 'active' : ''}}" href="{{ route('activities.index') }}">
        <i class="ph-list-bullets"></i>
        <span>Activity</span>
    </a>
</li>
@endcan
@can('stakeholders-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('stakeholders*') ? 'active' : ''}}" href="{{ route('stakeholders.index') }}">
        <i class="ph-users-three"></i>
        <span>Stakeholders</span>
    </a>
</li>
@endcan
@can('sites-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('sites*') ? 'active' : ''}}" href="{{ route('sites.index') }}">
        <i class="ph-globe"></i>
        <span>Sites</span>
    </a>
</li>
@endcan 
@can('beneficiaries-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('beneficiaries*') ? 'active' : ''}}" href="{{ route('beneficiaries.index') }}">
        <i class="ph-users-three"></i>
        <span>Beneficiaries</span>
    </a>
</li>
@endcan
@can('feadbacks-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('feadbacks*') ? 'active' : ''}}" href="{{ route('feadbacks.index') }}">
        <i class="ph-chat-centered-text"></i>
        <span>Feadbacks</span>
    </a>
</li>
@endcan
@can('lessons-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('lessons*') ? 'active' : ''}}" href="{{ route('lessons.index') }}">
        <i class="ph-book"></i>
        <span>Lessons Learnt Log</span>
    </a>
</li>
@endcan
@can('riskPlans-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('risk-plans*') ? 'active' : ''}}" href="{{ route('risk-plans.index') }}">
        <i class="ph-bookmarks"></i>
        <span>Risk Management Plan</span>
    </a>
</li>
@endcan
@canany(['categories-list', 'provinces-list','stakeholderRoles-list','siteTypes-list','complaintTypes-list'])
<li class="nav-item-header">
    <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Catalog Management</div>
    <i class="ph-dots-three sidebar-resize-show"></i>
</li>
@endcanany
@can('categories-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('categories*') ? 'active' : ''}}" href="{{ route('categories.index') }}">
        <i class="ph-list-dashes"></i>
        <span>Categories</span>
    </a>
</li>
@endcan
@can('provinces-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('provinces*') ? 'active' : ''}}" href="{{ route('provinces.index') }}">
        <i class="ph-list-dashes"></i>
        <span>Provinces</span>
    </a>
</li>
@endcan
@can('stakeholderRoles-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('stakeholder-roles*') ? 'active' : ''}}" href="{{ route('stakeholder-roles.index') }}">
        <i class="ph-list-dashes"></i>
        <span>Stakeholder Roles</span>
    </a>
</li>
@endcan
@can('thematicArea-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('thematic-areas*') ? 'active' : ''}}" href="{{ route('thematic-areas.index') }}">
        <i class="ph-list-dashes"></i>
        <span>Thematic Area/Sector</span>
    </a>
</li>
@endcan
@can('complaintTypes-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('complaint-types*') ? 'active' : ''}}" href="{{ route('complaint-types.index') }}">
        <i class="ph-list-dashes"></i>
        <span>Complaint Types</span>
    </a>
</li>
@endcan
@canany(['roles-list', 'users-list'])
<li class="nav-item-header">
    <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Access Management</div>
    <i class="ph-dots-three sidebar-resize-show"></i>
</li>
@endcanany
@can('roles-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('roles*') ? 'active' : ''}}" href="{{ route('roles.index') }}">
        <i class="ph-atom"></i>
        <span>Roles</span>
    </a>
</li>
@endcan
@can('users-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('users*') ? 'active' : ''}}" href="{{ route('users.index') }}">
        <i class="ph-users"></i>
        <span>Users</span>
    </a>
</li>
@endcan
@canany(['notifications-list','audits-list', 'logs-list'])
<li class="nav-item-header">
    <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Configuration</div>
    <i class="ph-dots-three sidebar-resize-show"></i>
</li>
@endcanany
@can('audits-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('notifications*') ? 'active' : ''}}" href="{{ route('notifications.index') }}">
        <i class="ph-bell"></i>
        <span>Notifications</span>
    </a>
</li>
@endcan
@can('audits-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('audits*') ? 'active' : ''}}" href="{{ route('audits.index') }}">
        <i class="ph-diamonds-four"></i>
        <span>Audit</span>
    </a>
</li>
@endcan
@can('logs-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('logs*') ? 'active' : ''}}" href="{{ route('logs') }}" target="_blank">
        <i class="ph-bug"></i>
        <span>Errors</span>
    </a>
</li>
@endcan
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('settings*') ? 'active' : ''}}" href="{{ route('settings.index') }}">
        <i class="ph-gear"></i>
        <span>Settings</span>
    </a>
</li>
