@extends('admin.layouts.master')

@section('title', 'Platform Settings - Media Admin')

@section('content')
<div class="container-fluid p-4">
  <!-- Page Header Banner -->
  <div class="admin-page-header">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
      <div>
        <div class="header-badge">
          <i class="fa-solid fa-sliders"></i> System Config &amp; Profile
        </div>
        <h3 class="fw-bold mb-1 text-white">Platform Control &amp; Account Settings</h3>
        <p class="text-white-50 mb-0 small">Manage brand identity, logos, admin profile credentials, password security, and studio information</p>
      </div>
      <a href="{{ route('home') }}" target="_blank" class="btn btn-outline-light rounded-pill px-4">
        <i class="fa-solid fa-globe me-1"></i> Preview Live Website
      </a>
    </div>
  </div>

  @php
    $currentTab = request()->query('tab', $tab ?? 'brand');
  @endphp

  <!-- Modern Navigation Tabs -->
  <div class="settings-tabs-wrapper mb-4">
    <ul class="nav nav-pills custom-settings-pills gap-2 p-2 rounded-4 shadow-sm">
      <li class="nav-item">
        <a class="nav-link {{ $currentTab === 'brand' ? 'active' : '' }}" href="{{ route('admin.settings.index', ['tab' => 'brand']) }}">
          <i class="fa-solid fa-gem me-2"></i> Brand &amp; Logo
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ $currentTab === 'profile' ? 'active' : '' }}" href="{{ route('admin.settings.index', ['tab' => 'profile']) }}">
          <i class="fa-solid fa-user-gear me-2"></i> Admin Profile
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ $currentTab === 'password' ? 'active' : '' }}" href="{{ route('admin.settings.index', ['tab' => 'password']) }}">
          <i class="fa-solid fa-shield-halved me-2"></i> Password &amp; Security
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ $currentTab === 'contact' ? 'active' : '' }}" href="{{ route('admin.settings.index', ['tab' => 'contact']) }}">
          <i class="fa-solid fa-location-dot me-2"></i> Studio &amp; Contact
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ $currentTab === 'counters' ? 'active' : '' }}" href="{{ route('admin.settings.index', ['tab' => 'counters']) }}">
          <i class="fa-solid fa-calculator me-2"></i> Homepage Stats
        </a>
      </li>
    </ul>
  </div>

  <!-- TAB 1: Brand & Logo -->
  @if($currentTab === 'brand')
    <div class="card card-modern p-4 p-lg-5">
      <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="active_tab" value="brand">

        <h5 class="fw-bold text-dark mb-4 d-flex align-items-center gap-2">
          <span class="rounded-circle bg-warning-subtle text-warning p-2 d-inline-flex" style="font-size: 0.9rem;"><i class="fa-solid fa-gem"></i></span>
          Brand Identity, Logos &amp; Master Showreel
        </h5>

        <div class="row g-4 mb-4">
          <div class="col-md-6">
            <label class="form-label">Platform / Company Name <span class="text-danger">*</span></label>
            <div class="input-group-modern">
              <span class="input-group-text"><i class="fa-solid fa-building"></i></span>
              <input type="text" name="site_name" class="form-control" required value="{{ $settings['site_name'] ?? 'Mind Blowing Media' }}">
            </div>
          </div>

          <div class="col-md-6">
            <label class="form-label">Brand Tagline</label>
            <div class="input-group-modern">
              <span class="input-group-text"><i class="fa-solid fa-quote-left"></i></span>
              <input type="text" name="site_tagline" class="form-control" value="{{ $settings['site_tagline'] ?? 'Casting & Media House' }}">
            </div>
          </div>

          <!-- Logo Upload Dropzone -->
          <div class="col-md-6">
            <label class="form-label d-flex align-items-center justify-content-between">
              <span>Main Brand Logo</span>
              <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-2 py-1">
                <i class="fa-solid fa-ruler-combined me-1"></i> 600 &times; 200 px
              </span>
            </label>
            <div class="file-dropzone">
              <input type="file" name="site_logo" accept="image/*">
              <div class="dropzone-icon">
                <i class="fa-solid fa-cloud-arrow-up"></i>
              </div>
              <div class="dropzone-title">Upload Official Brand Logo</div>
              <div class="dropzone-subtitle">Recommended: <strong>600 &times; 200 px</strong> (Transparent PNG/WebP)</div>
              <div class="preview-wrapper d-none"></div>
            </div>
            @if(!empty($settings['site_logo']))
              <div class="d-flex align-items-center gap-3 mt-3 p-3 bg-light rounded-3 border">
                <div class="p-2 bg-dark rounded-3 d-inline-flex align-items-center justify-content-center" style="min-width: 100px; height: 50px;">
                  <img src="{{ asset($settings['site_logo']) }}" style="max-height: 40px; max-width: 120px; object-fit: contain;">
                </div>
                <div>
                  <span class="badge bg-success-subtle text-success border border-success-subtle">Active Site Logo</span>
                  <div class="small text-muted mt-1">Displayed in sidebar and public navigation header</div>
                </div>
              </div>
            @endif
          </div>

          <!-- Favicon Upload Dropzone -->
          <div class="col-md-6">
            <label class="form-label d-flex align-items-center justify-content-between">
              <span>Site Favicon</span>
              <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-2 py-1">
                <i class="fa-solid fa-ruler-combined me-1"></i> 128 &times; 128 px (1:1)
              </span>
            </label>
            <div class="file-dropzone">
              <input type="file" name="site_favicon" accept="image/*">
              <div class="dropzone-icon">
                <i class="fa-solid fa-shield-cat"></i>
              </div>
              <div class="dropzone-title">Upload Browser Tab Favicon</div>
              <div class="dropzone-subtitle">Recommended: <strong>128 &times; 128 px</strong> (PNG/ICO)</div>
              <div class="preview-wrapper d-none"></div>
            </div>
            @if(!empty($settings['site_favicon']))
              <div class="d-flex align-items-center gap-3 mt-3 p-3 bg-light rounded-3 border">
                <img src="{{ asset($settings['site_favicon']) }}" width="40" height="40" class="rounded shadow-xs">
                <div>
                  <span class="badge bg-success-subtle text-success border border-success-subtle">Active Favicon</span>
                  <div class="small text-muted mt-1">Displayed on browser tabs and bookmark bars</div>
                </div>
              </div>
            @endif
          </div>

          <div class="col-12">
            <label class="form-label">Master Showreel YouTube Embed URL</label>
            <div class="input-group-modern">
              <span class="input-group-text"><i class="fa-brands fa-youtube text-danger"></i></span>
              <input type="url" name="showreel_url" class="form-control" value="{{ $settings['showreel_url'] ?? 'https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1&enablejsapi=1' }}">
            </div>
            <small class="text-muted"><i class="fa-solid fa-circle-info me-1"></i> Plays automatically when visitors click "Watch Showreel" on the website hero section.</small>
          </div>
        </div>

        <div class="pt-3 border-top">
          <button type="submit" class="btn btn-gold-action px-5 py-2">
            <i class="fa-solid fa-save me-2"></i> Save Brand &amp; Logo Settings
          </button>
        </div>
      </form>
    </div>
  @endif

  <!-- TAB 2: Admin Profile -->
  @if($currentTab === 'profile')
    <div class="card card-modern p-4 p-lg-5">
      <form action="{{ route('admin.settings.profile') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <h5 class="fw-bold text-dark mb-4 d-flex align-items-center gap-2">
          <span class="rounded-circle bg-primary-subtle text-primary p-2 d-inline-flex" style="font-size: 0.9rem;"><i class="fa-solid fa-user-gear"></i></span>
          Admin Profile &amp; Avatar Configuration
        </h5>

        <div class="row g-4 mb-4">
          <div class="col-md-6">
            <label class="form-label">Administrator Full Name <span class="text-danger">*</span></label>
            <div class="input-group-modern">
              <span class="input-group-text"><i class="fa-solid fa-user-tie"></i></span>
              <input type="text" name="name" class="form-control" required value="{{ old('name', $user->name) }}">
            </div>
          </div>

          <div class="col-md-6">
            <label class="form-label">Administrator Email Address <span class="text-danger">*</span></label>
            <div class="input-group-modern">
              <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
              <input type="email" name="email" class="form-control" required value="{{ old('email', $user->email) }}">
            </div>
          </div>

          <!-- Avatar Upload Dropzone -->
          <div class="col-12">
            <label class="form-label d-flex align-items-center justify-content-between">
              <span>Change Administrator Avatar Photo</span>
              <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-2 py-1">
                <i class="fa-solid fa-ruler-combined me-1"></i> Dimension: 400 &times; 400 px (1:1)
              </span>
            </label>
            <div class="file-dropzone">
              <input type="file" name="avatar" accept="image/*">
              <div class="dropzone-icon">
                <i class="fa-solid fa-camera"></i>
              </div>
              <div class="dropzone-title">Upload new profile photo</div>
              <div class="dropzone-subtitle">Recommended size: <strong>400 &times; 400 px</strong> (Square) &bull; Auto-optimized to WebP</div>
              <div class="preview-wrapper d-none"></div>
            </div>

            <div class="d-flex align-items-center gap-3 mt-3 p-3 bg-light rounded-3 border">
              <img src="{{ $user->avatar ? asset($user->avatar) : 'https://classicit.com.bd/images/team/20260218022233F0kxgc.webp' }}" class="rounded-circle shadow-xs" width="60" height="60" style="object-fit: cover;">
              <div>
                <span class="badge bg-success-subtle text-success border border-success-subtle">Current Active Avatar</span>
                <div class="small text-muted mt-1">Displayed in the top navigation bar and administrator dropdown</div>
              </div>
            </div>
          </div>
        </div>

        <div class="pt-3 border-top">
          <button type="submit" class="btn btn-gold-action px-5 py-2">
            <i class="fa-solid fa-save me-2"></i> Update Admin Profile
          </button>
        </div>
      </form>
    </div>
  @endif

  <!-- TAB 3: Security & Password Change -->
  @if($currentTab === 'password')
    <div class="card card-modern p-4 p-lg-5">
      <form action="{{ route('admin.settings.password') }}" method="POST">
        @csrf

        <h5 class="fw-bold text-dark mb-4 d-flex align-items-center gap-2">
          <span class="rounded-circle bg-danger-subtle text-danger p-2 d-inline-flex" style="font-size: 0.9rem;"><i class="fa-solid fa-shield-halved"></i></span>
          Change Administrator Password
        </h5>

        <div class="row g-4 mb-4">
          <div class="col-md-12">
            <label class="form-label">Current Password <span class="text-danger">*</span></label>
            <div class="input-group-modern" style="max-width: 500px;">
              <span class="input-group-text"><i class="fa-solid fa-lock text-muted"></i></span>
              <input type="password" name="current_password" class="form-control" required placeholder="Enter your current password">
            </div>
            @error('current_password')
              <small class="text-danger d-block mt-1">{{ $message }}</small>
            @enderror
          </div>

          <div class="col-md-6">
            <label class="form-label">New Password <span class="text-danger">*</span></label>
            <div class="input-group-modern">
              <span class="input-group-text"><i class="fa-solid fa-key text-warning"></i></span>
              <input type="password" name="password" class="form-control" required placeholder="Minimum 8 characters">
            </div>
            @error('password')
              <small class="text-danger d-block mt-1">{{ $message }}</small>
            @enderror
          </div>

          <div class="col-md-6">
            <label class="form-label">Confirm New Password <span class="text-danger">*</span></label>
            <div class="input-group-modern">
              <span class="input-group-text"><i class="fa-solid fa-check-double text-success"></i></span>
              <input type="password" name="password_confirmation" class="form-control" required placeholder="Re-type new password">
            </div>
          </div>
        </div>

        <div class="pt-3 border-top">
          <button type="submit" class="btn btn-gold-action px-5 py-2">
            <i class="fa-solid fa-lock me-2"></i> Update Password
          </button>
        </div>
      </form>
    </div>
  @endif

  <!-- TAB 4: Studio Contact -->
  @if($currentTab === 'contact')
    <div class="card card-modern p-4 p-lg-5">
      <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        <input type="hidden" name="active_tab" value="contact">

        <h5 class="fw-bold text-dark mb-4 d-flex align-items-center gap-2">
          <span class="rounded-circle bg-primary-subtle text-primary p-2 d-inline-flex" style="font-size: 0.9rem;"><i class="fa-solid fa-location-dot"></i></span>
          Studio Location &amp; Contact Details
        </h5>

        <div class="row g-4 mb-4">
          <div class="col-md-6">
            <label class="form-label">Official Hotline / Phone</label>
            <div class="input-group-modern">
              <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
              <input type="text" name="site_phone" class="form-control" value="{{ $settings['site_phone'] ?? '+880 1700-000123' }}">
            </div>
          </div>

          <div class="col-md-6">
            <label class="form-label">Official Casting Email</label>
            <div class="input-group-modern">
              <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
              <input type="email" name="site_email" class="form-control" value="{{ $settings['site_email'] ?? 'casting@mindblowingmedia.bd' }}">
            </div>
          </div>

          <div class="col-12">
            <label class="form-label">Headquarters &amp; Studio Floor Address</label>
            <div class="input-group-modern">
              <span class="input-group-text"><i class="fa-solid fa-map-pin"></i></span>
              <input type="text" name="site_address" class="form-control" value="{{ $settings['site_address'] ?? 'Road 11, Banani, Dhaka-1213, Bangladesh' }}">
            </div>
          </div>
        </div>

        <h5 class="fw-bold text-dark mb-4 mt-2 pt-3 border-top d-flex align-items-center gap-2">
          <span class="rounded-circle bg-warning-subtle text-warning p-2 d-inline-flex" style="font-size: 0.9rem;"><i class="fa-solid fa-share-nodes"></i></span>
          Social Media Profiles &amp; Channel URLs
        </h5>

        <div class="row g-4 mb-4">
          <div class="col-md-6">
            <label class="form-label">Facebook Page URL</label>
            <div class="input-group-modern">
              <span class="input-group-text"><i class="fa-brands fa-facebook-f text-primary"></i></span>
              <input type="url" name="social_facebook" class="form-control" placeholder="https://facebook.com/..." value="{{ $settings['social_facebook'] ?? '' }}">
            </div>
          </div>

          <div class="col-md-6">
            <label class="form-label">Instagram Profile URL</label>
            <div class="input-group-modern">
              <span class="input-group-text"><i class="fa-brands fa-instagram text-danger"></i></span>
              <input type="url" name="social_instagram" class="form-control" placeholder="https://instagram.com/..." value="{{ $settings['social_instagram'] ?? '' }}">
            </div>
          </div>

          <div class="col-md-6">
            <label class="form-label">YouTube Channel URL</label>
            <div class="input-group-modern">
              <span class="input-group-text"><i class="fa-brands fa-youtube text-danger"></i></span>
              <input type="url" name="social_youtube" class="form-control" placeholder="https://youtube.com/@..." value="{{ $settings['social_youtube'] ?? '' }}">
            </div>
          </div>

          <div class="col-md-6">
            <label class="form-label">Vimeo / LinkedIn URL</label>
            <div class="input-group-modern">
              <span class="input-group-text"><i class="fa-brands fa-vimeo-v text-info"></i></span>
              <input type="url" name="social_vimeo" class="form-control" placeholder="https://vimeo.com/..." value="{{ $settings['social_vimeo'] ?? '' }}">
            </div>
          </div>
        </div>

        <div class="pt-3 border-top">
          <button type="submit" class="btn btn-gold-action px-5 py-2">
            <i class="fa-solid fa-save me-2"></i> Save Contact Settings
          </button>
        </div>
      </form>
    </div>
  @endif

  <!-- TAB 5: Homepage Stats -->
  @if($currentTab === 'counters')
    <div class="card card-modern p-4 p-lg-5">
      <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        <input type="hidden" name="active_tab" value="counters">

        <h5 class="fw-bold text-dark mb-4 d-flex align-items-center gap-2">
          <span class="rounded-circle bg-success-subtle text-success p-2 d-inline-flex" style="font-size: 0.9rem;"><i class="fa-solid fa-calculator"></i></span>
          Homepage Counter Metrics (Odometer Statistics)
        </h5>

        <div class="row g-4 mb-4">
          <div class="col-md-3 col-6">
            <label class="form-label">Completed Productions</label>
            <div class="input-group-modern">
              <span class="input-group-text"><i class="fa-solid fa-clapperboard text-warning"></i></span>
              <input type="text" name="stat_projects" class="form-control fw-bold" value="{{ $settings['stat_projects'] ?? '500+' }}">
            </div>
          </div>

          <div class="col-md-3 col-6">
            <label class="form-label">Enrolled Performers</label>
            <div class="input-group-modern">
              <span class="input-group-text"><i class="fa-solid fa-users text-primary"></i></span>
              <input type="text" name="stat_artists" class="form-control fw-bold" value="{{ $settings['stat_artists'] ?? '1200+' }}">
            </div>
          </div>

          <div class="col-md-3 col-6">
            <label class="form-label">Films &amp; OTT Series</label>
            <div class="input-group-modern">
              <span class="input-group-text"><i class="fa-solid fa-film text-danger"></i></span>
              <input type="text" name="stat_films" class="form-control fw-bold" value="{{ $settings['stat_films'] ?? '85+' }}">
            </div>
          </div>

          <div class="col-md-3 col-6">
            <label class="form-label">Client Approval Ratio</label>
            <div class="input-group-modern">
              <span class="input-group-text"><i class="fa-solid fa-star text-warning"></i></span>
              <input type="text" name="stat_satisfaction" class="form-control fw-bold" value="{{ $settings['stat_satisfaction'] ?? '99%' }}">
            </div>
          </div>
        </div>

        <div class="pt-3 border-top">
          <button type="submit" class="btn btn-gold-action px-5 py-2">
            <i class="fa-solid fa-save me-2"></i> Save Counter Statistics
          </button>
        </div>
      </form>
    </div>
  @endif
</div>

<style>
.custom-settings-pills {
  background: #0f1424 !important;
  border: 1px solid rgba(255, 255, 255, 0.08) !important;
}

.custom-settings-pills .nav-link {
  color: #94a3b8 !important;
  font-weight: 600;
  font-size: 0.9rem;
  border-radius: 12px;
  padding: 10px 22px;
  transition: all 0.25s ease;
  border: 1px solid transparent;
  background-color: transparent !important;
}

.custom-settings-pills .nav-link:hover {
  color: #fbbf24 !important;
  background-color: rgba(245, 158, 11, 0.12) !important;
  border-color: rgba(245, 158, 11, 0.3) !important;
}

.custom-settings-pills .nav-link.active,
.custom-settings-pills .nav-link.active:hover,
.custom-settings-pills .nav-link.active:focus {
  background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 50%, #d97706 100%) !important;
  color: #08090e !important;
  font-weight: 700 !important;
  border-color: transparent !important;
  box-shadow: 0 6px 20px rgba(245, 158, 11, 0.35) !important;
}
</style>
@endsection
