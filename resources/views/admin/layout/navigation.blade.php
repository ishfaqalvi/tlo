<div class="container-fluid" style="padding:0px !important">
    <div class="d-flex d-lg-none me-2">
        <button type="button" class="navbar-toggler sidebar-mobile-main-toggle rounded-pill">
            <i class="ph-list"></i>
        </button>
    </div>
    <a href="index.html" class="d-inline-flex align-items-center">
        <img src="{{ asset('assets/images/logo.jpg') }}" alt="" width="253px">
    </a>
    <ul class="nav flex-row justify-content-end order-1 pe-4">
        <li class="nav-item ms-lg-2">
            <a href="{{ route('notifications.index') }}" class="navbar-nav-link navbar-nav-link-icon rounded-pill">
                <i class="ph-bell"></i>
                <span class="badge bg-yellow text-black position-absolute top-0 end-0 translate-middle-top zindex-1 rounded-pill mt-1 me-1">{{count(auth()->user()->unreadNotifications)}}</span>
            </a>
        </li>
        <li class="nav-item nav-item-dropdown-lg dropdown ms-lg-2">
            <a href="#" class="navbar-nav-link align-items-center rounded-pill p-1" data-bs-toggle="dropdown">
                <div class="status-indicator-container">
                    <img src="{{ Auth::user()->image }}" class="w-32px h-32px rounded-pill" alt="">
                    <span class="status-indicator bg-success"></span>
                </div>
                <span class="d-none d-lg-inline-block mx-lg-2">{{ Auth::user()->name }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end">
                <a href="{{ route('users.profileEdit') }}" class="dropdown-item">
                    <i class="ph-user-circle me-2"></i>
                    My profile
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a 
                        href="{{ route('logout') }}" 
                        class="dropdown-item" 
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="ph-sign-out me-2"></i>
                        Logout
                    </a>
                </form>
            </div>
        </li>
    </ul>
</div>