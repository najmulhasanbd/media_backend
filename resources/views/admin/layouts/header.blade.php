<header class="app-header sticky d-flex align-items-center justify-content-between px-3">
  <div class="header-left d-flex align-items-center gap-3">
    <button class="btn-toggle-sidebar" id="sidebar-toggle">
      <i class="fa fa-bars" id="toggle-icon"></i>
    </button>
    <div class="d-none d-md-flex align-items-center gap-2">
      <span class="badge rounded-pill bg-danger-subtle text-danger border border-danger-subtle px-3 py-2 d-flex align-items-center gap-2">
        <span class="spinner-grow spinner-grow-sm text-danger" style="width: 7px; height: 7px;"></span>
        <span class="fw-bold" style="font-size: 0.75rem; letter-spacing: 0.5px;">MEDIA CMS ACTIVE</span>
      </span>
    </div>
  </div>

  <div class="header-right d-flex align-items-center gap-2 gap-md-3">
    <!-- Quick Action: Clear Cache -->
    <a href="{{ route('admin.clear-cache') }}" class="btn btn-sm btn-light border rounded-pill px-3 py-1 text-secondary fw-semibold d-flex align-items-center gap-2 shadow-xs" title="Clear All Cache">
      <i class="fa-solid fa-broom text-warning"></i>
      <span class="d-none d-sm-inline">Clear Cache</span>
    </a>

    <!-- Quick Action: View Live Website -->
    <a href="{{ route('home') }}" target="_blank" class="btn btn-sm btn-primary rounded-pill px-3 py-1 fw-semibold d-flex align-items-center gap-2 shadow-xs" title="Open Live Website">
      <i class="fa-solid fa-globe"></i>
      <span class="d-none d-sm-inline">Live Website</span>
      <i class="fa-solid fa-arrow-up-right-from-square small"></i>
    </a>

    <!-- User Profile Dropdown -->
    <div class="user-profile dropdown">
      <div class="profile-toggle d-flex align-items-center" id="profileDropdown" onclick="toggleProfileMenu(event)">
        <img src="{{ auth()->user()->avatar ? asset(auth()->user()->avatar) : 'https://classicit.com.bd/images/team/20260218022233F0kxgc.webp' }}" class="rounded-circle user-img shadow-xs"
          alt="{{ auth()->user()->name ?? 'Admin' }}" style="width: 40px; height: 40px; object-fit: cover;" />
        <div class="text-start ms-2 d-none d-md-block">
          <p class="m-0 fw-bold user-name">
            {{ auth()->user()->name ?? 'Admin' }}
            <i class="fa-solid fa-chevron-down ms-1 dropdown-arrow"></i>
          </p>
          <small class="text-muted">Administrator</small>
        </div>
      </div>

      <ul class="dropdown-menu-custom" id="profileMenu">
        <li>
          <a href="{{ route('admin.settings.index', ['tab' => 'profile']) }}">
            <i class="fa-solid fa-user-gear text-primary"></i> Manage Account
          </a>
        </li>
        <li>
          <a href="{{ route('admin.settings.index', ['tab' => 'password']) }}">
            <i class="fa-solid fa-key text-warning"></i> Change Password
          </a>
        </li>
        <li class="border-top">
          <form method="POST" action="{{ route('logout') }}" id="admin-logout-form" class="d-none">
            @csrf
          </form>
          <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();">
            <i class="fa-solid fa-right-from-bracket text-danger"></i> Log out
          </a>
        </li>
      </ul>
    </div>
  </div>
</header>
