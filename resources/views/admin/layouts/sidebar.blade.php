<aside class="app-sidebar" id="app-sidebar">
  <div class="sidebar-header">
    <a href="{{ route('admin.dashboard') }}" class="logo text-decoration-none">
      <div class="d-flex align-items-center gap-2">
        @php $siteLogo = \App\Models\Setting::get('site_logo'); @endphp
        @if($siteLogo)
          <img src="{{ asset($siteLogo) }}" alt="Logo" style="max-height: 38px; max-width: 140px; object-fit: contain;">
        @else
          <span class="rounded p-2 text-white shadow-xs" style="background: linear-gradient(135deg, #f59e0b, #ef4444); font-weight: bold; font-size: 1.1rem; line-height: 1;">MBM</span>
          <span class="fw-bold text-white fs-5">Media Admin</span>
        @endif
      </div>
    </a>
  </div>

  <div class="sidebar-content">
    <ul class="nav-list">
      <!-- Dashboard -->
      <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <a href="{{ route('admin.dashboard') }}">
          <i class="fa-solid fa-house-chimney"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <!-- Hero Sliders -->
      <li class="nav-item has-dropdown {{ request()->routeIs('admin.sliders.*') ? 'active open' : '' }}">
        <div class="dropdown-header">
          <i class="fa-solid fa-images"></i>
          <span>Hero Sliders</span>
          <i class="fa-solid fa-chevron-right arrow"></i>
        </div>
        <ul class="submenu">
          <li><a href="{{ route('admin.sliders.index') }}" class="{{ request()->routeIs('admin.sliders.index') ? 'text-primary fw-bold' : '' }}">All Sliders</a></li>
          <li><a href="{{ route('admin.sliders.create') }}" class="{{ request()->routeIs('admin.sliders.create') ? 'text-primary fw-bold' : '' }}">Add New Slider</a></li>
        </ul>
      </li>

      <!-- Talents & Artists -->
      <li class="nav-item has-dropdown {{ request()->routeIs('admin.talents.*') ? 'active open' : '' }}">
        <div class="dropdown-header">
          <i class="fa-solid fa-user-astronaut"></i>
          <span>Talents & Models</span>
          <i class="fa-solid fa-chevron-right arrow"></i>
        </div>
        <ul class="submenu">
          <li><a href="{{ route('admin.talents.index') }}" class="{{ request()->routeIs('admin.talents.index') && !request()->filled('type') ? 'text-primary fw-bold' : '' }}">All Talents</a></li>
          <li><a href="{{ route('admin.talents.index', ['type' => 'international']) }}" class="{{ request()->input('type') === 'international' ? 'text-primary fw-bold' : '' }}">International Artists</a></li>
          <li><a href="{{ route('admin.talents.create') }}" class="{{ request()->routeIs('admin.talents.create') ? 'text-primary fw-bold' : '' }}">Add New Talent</a></li>
        </ul>
      </li>

      <!-- Casting Calls -->
      <li class="nav-item has-dropdown {{ request()->routeIs('admin.casting-calls.*') ? 'active open' : '' }}">
        <div class="dropdown-header">
          <i class="fa-solid fa-bullhorn"></i>
          <span>Casting Calls</span>
          <i class="fa-solid fa-chevron-right arrow"></i>
        </div>
        <ul class="submenu">
          <li><a href="{{ route('admin.casting-calls.index') }}" class="{{ request()->routeIs('admin.casting-calls.index') ? 'text-primary fw-bold' : '' }}">All Casting Calls</a></li>
          <li><a href="{{ route('admin.casting-calls.create') }}" class="{{ request()->routeIs('admin.casting-calls.create') ? 'text-primary fw-bold' : '' }}">Add Casting Call</a></li>
        </ul>
      </li>

      <!-- Video Portfolio -->
      <li class="nav-item has-dropdown {{ request()->routeIs('admin.videos.*') ? 'active open' : '' }}">
        <div class="dropdown-header">
          <i class="fa-solid fa-clapperboard"></i>
          <span>Video Portfolio</span>
          <i class="fa-solid fa-chevron-right arrow"></i>
        </div>
        <ul class="submenu">
          <li><a href="{{ route('admin.videos.index') }}" class="{{ request()->routeIs('admin.videos.index') ? 'text-primary fw-bold' : '' }}">All Videos</a></li>
          <li><a href="{{ route('admin.videos.create') }}" class="{{ request()->routeIs('admin.videos.create') ? 'text-primary fw-bold' : '' }}">Add New Video</a></li>
        </ul>
      </li>

      <!-- Shooting Houses -->
      <li class="nav-item has-dropdown {{ request()->routeIs('admin.shooting-houses.*') ? 'active open' : '' }}">
        <div class="dropdown-header">
          <i class="fa-solid fa-building"></i>
          <span>Shooting Houses</span>
          <i class="fa-solid fa-chevron-right arrow"></i>
        </div>
        <ul class="submenu">
          <li><a href="{{ route('admin.shooting-houses.index') }}" class="{{ request()->routeIs('admin.shooting-houses.index') ? 'text-primary fw-bold' : '' }}">All Houses</a></li>
          <li><a href="{{ route('admin.shooting-houses.create') }}" class="{{ request()->routeIs('admin.shooting-houses.create') ? 'text-primary fw-bold' : '' }}">Add New House</a></li>
        </ul>
      </li>

      <!-- Diaries & Articles -->
      <li class="nav-item has-dropdown {{ request()->routeIs('admin.articles.*') ? 'active open' : '' }}">
        <div class="dropdown-header">
          <i class="fa-solid fa-book-open"></i>
          <span>Diaries & Opinions</span>
          <i class="fa-solid fa-chevron-right arrow"></i>
        </div>
        <ul class="submenu">
          <li><a href="{{ route('admin.articles.index', ['type' => 'director']) }}" class="{{ request()->input('type') === 'director' ? 'text-primary fw-bold' : '' }}">Director's Diary</a></li>
          <li><a href="{{ route('admin.articles.index', ['type' => 'artist']) }}" class="{{ request()->input('type') === 'artist' ? 'text-primary fw-bold' : '' }}">Artist's Diary</a></li>
          <li><a href="{{ route('admin.articles.index', ['type' => 'opinion']) }}" class="{{ request()->input('type') === 'opinion' ? 'text-primary fw-bold' : '' }}">Editorial Opinions</a></li>
          <li><a href="{{ route('admin.articles.create') }}" class="{{ request()->routeIs('admin.articles.create') ? 'text-primary fw-bold' : '' }}">Write New Article</a></li>
        </ul>
      </li>

      <!-- Notices -->
      <li class="nav-item has-dropdown {{ request()->routeIs('admin.notices.*') ? 'active open' : '' }}">
        <div class="dropdown-header">
          <i class="fa-solid fa-newspaper"></i>
          <span>Notice Board</span>
          <i class="fa-solid fa-chevron-right arrow"></i>
        </div>
        <ul class="submenu">
          <li><a href="{{ route('admin.notices.index') }}" class="{{ request()->routeIs('admin.notices.index') ? 'text-primary fw-bold' : '' }}">All Notices</a></li>
          <li><a href="{{ route('admin.notices.create') }}" class="{{ request()->routeIs('admin.notices.create') ? 'text-primary fw-bold' : '' }}">Post Notice</a></li>
        </ul>
      </li>

      <!-- Reviews -->
      <li class="nav-item has-dropdown {{ request()->routeIs('admin.reviews.*') ? 'active open' : '' }}">
        <div class="dropdown-header">
          <i class="fa-solid fa-star"></i>
          <span>Reviews & Ratings</span>
          <i class="fa-solid fa-chevron-right arrow"></i>
        </div>
        <ul class="submenu">
          <li><a href="{{ route('admin.reviews.index') }}" class="{{ request()->routeIs('admin.reviews.index') ? 'text-primary fw-bold' : '' }}">All Reviews</a></li>
          <li><a href="{{ route('admin.reviews.create') }}" class="{{ request()->routeIs('admin.reviews.create') ? 'text-primary fw-bold' : '' }}">Add New Review</a></li>
        </ul>
      </li>

      <!-- Audition Applications -->
      <li class="nav-item {{ request()->routeIs('admin.applications.*') ? 'active' : '' }}">
        <a href="{{ route('admin.applications.index') }}" class="d-flex align-items-center justify-content-between">
          <div>
            <i class="fa-solid fa-id-card-clip"></i>
            <span>Audition Applications</span>
          </div>
          @php $pendingCount = \App\Models\Application::where('status', 'pending')->count(); @endphp
          @if($pendingCount > 0)
            <span class="badge bg-danger rounded-pill">{{ $pendingCount }}</span>
          @endif
        </a>
      </li>

      <!-- Settings -->
      <li class="nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
        <a href="{{ route('admin.settings.index') }}">
          <i class="fa-solid fa-sliders"></i>
          <span>Site Settings</span>
        </a>
      </li>

    </ul>
  </div>
</aside>
