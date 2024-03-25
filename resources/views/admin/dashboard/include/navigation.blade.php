<div class="d-flex">
    <a 
        href="{{ route('dashboard.widgets')}}" 
        class="d-flex align-items-center text-body p-2 {{ request()->routeIs('dashboard.widgets') ? 'active' : ''}}">
        <i class="ph-gift me-1"></i>
        Widgets
    </a>
    <a 
        href="{{ route('dashboard.projects')}}"
        class="d-flex align-items-center text-body p-2 {{ request()->routeIs('dashboard.projects') ? 'active' : ''}}">
        <i class="ph-folder me-1"></i>
        Projects
    </a>
    <a 
        href="{{ route('dashboard.budget')}}"
        class="d-flex align-items-center text-body p-2 {{ request()->routeIs('dashboard.budget') ? 'active' : ''}}">
        <i class="ph-currency-circle-dollar me-1"></i>
        Budget
    </a>
    <a 
        href="{{ route('dashboard.indicators')}}"
        class="d-flex align-items-center text-body p-2 {{ request()->routeIs('dashboard.indicators') ? 'active' : ''}}">
        <i class="ph-chart-bar me-1"></i>
        Indicators
    </a>
    <a 
        href="{{ route('dashboard.feadbacks')}}"
        class="d-flex align-items-center text-body p-2 {{ request()->routeIs('dashboard.feadbacks') ? 'active' : ''}}">
        <i class="ph-chat-centered-text me-1"></i>
        Feadbacks
    </a>
    <a 
        href="{{ route('dashboard.lessons')}}"
        class="d-flex align-items-center text-body p-2 {{ request()->routeIs('dashboard.lessons') ? 'active' : ''}}">
        <i class="ph-book me-1"></i>
        Lesson Learnt Log
    </a>
    <a 
        href="{{ route('dashboard.riskPlans')}}"
        class="d-flex align-items-center text-body p-2 {{ request()->routeIs('dashboard.riskPlans') ? 'active' : ''}}">
        <i class="ph-bookmarks me-1"></i>
        Risk Managment Plan
    </a>
</div>