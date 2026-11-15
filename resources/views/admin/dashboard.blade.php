@extends('admin.layouts.master')

@section('title', 'Production Dashboard - Media Admin')

@push('styles')
<style>
  /* Cinematic Dashboard Custom Styling */
  .media-hero-banner {
    background: radial-gradient(circle at 10% 20%, rgba(245, 158, 11, 0.22) 0%, transparent 35%),
                radial-gradient(circle at 90% 80%, rgba(99, 102, 241, 0.25) 0%, transparent 45%),
                linear-gradient(135deg, #0a0b12 0%, #121526 50%, #1a1633 100%);
    border: 1px solid rgba(255, 255, 255, 0.08);
    box-shadow: 0 20px 40px rgba(10, 11, 18, 0.35);
    position: relative;
    overflow: hidden;
  }

  .media-hero-banner::after {
    content: '';
    position: absolute;
    top: 0; right: 0; bottom: 0; left: 0;
    background: url('data:image/svg+xml;utf8,<svg width="40" height="40" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg"><g fill="%23ffffff" fill-opacity="0.02" fill-rule="evenodd"><path d="M0 40L40 0H20L0 20M40 40V20L20 40"/></g></svg>');
    pointer-events: none;
  }

  .btn-gold-action {
    background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 50%, #d97706 100%);
    color: #0b0c10 !important;
    font-weight: 700;
    border: none;
    box-shadow: 0 6px 20px rgba(245, 158, 11, 0.35);
    transition: all 0.3s ease;
  }

  .btn-gold-action:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(245, 158, 11, 0.5);
    color: #000 !important;
  }

  .btn-glass-action {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(8px);
    color: #ffffff;
    border: 1px solid rgba(255, 255, 255, 0.15);
    transition: all 0.3s ease;
  }

  .btn-glass-action:hover {
    background: rgba(255, 255, 255, 0.2);
    color: #fff;
    transform: translateY(-2px);
  }

  /* Equalizer Animation */
  .equalizer-bar {
    display: inline-flex;
    align-items: flex-end;
    gap: 3px;
    height: 16px;
  }
  .equalizer-bar span {
    width: 3px;
    background-color: #f59e0b;
    border-radius: 2px;
    animation: eqWave 1.2s ease-in-out infinite alternate;
  }
  .equalizer-bar span:nth-child(1) { height: 60%; animation-delay: 0.1s; }
  .equalizer-bar span:nth-child(2) { height: 100%; animation-delay: 0.3s; }
  .equalizer-bar span:nth-child(3) { height: 40%; animation-delay: 0.2s; }
  .equalizer-bar span:nth-child(4) { height: 80%; animation-delay: 0.4s; }

  @keyframes eqWave {
    0% { height: 25%; }
    100% { height: 100%; }
  }

  /* KPI Card Styling */
  .kpi-card {
    background: #ffffff;
    border: 1px solid #eef2f6;
    border-radius: 16px;
    transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
  }

  .kpi-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 14px 30px rgba(0, 0, 0, 0.07);
    border-color: #cbd5e1;
  }

  .kpi-card .card-glow-bg {
    position: absolute;
    top: -20px;
    right: -20px;
    width: 110px;
    height: 110px;
    border-radius: 50%;
    opacity: 0.12;
    filter: blur(20px);
    pointer-events: none;
  }

  .kpi-icon-wrapper {
    width: 52px;
    height: 52px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.35rem;
  }

  /* Secondary Micro Cards */
  .micro-stat-card {
    background: #ffffff;
    border-radius: 14px;
    border: 1px solid #eef2f6;
    padding: 18px;
    transition: all 0.25s ease;
  }

  .micro-stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
  }

  /* Chart Cards */
  .chart-card {
    background: #ffffff;
    border-radius: 16px;
    border: 1px solid #eef2f6;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
  }

  /* Video Thumbnail Cards */
  .video-card-mini {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    background: #000;
  }
  .video-card-mini img {
    transition: transform 0.4s ease;
    opacity: 0.85;
  }
  .video-card-mini:hover img {
    transform: scale(1.05);
    opacity: 0.95;
  }
  .video-play-overlay {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(0, 0, 0, 0.35);
    color: #fff;
    font-size: 1.8rem;
    transition: all 0.3s ease;
  }
  .video-card-mini:hover .video-play-overlay {
    background: rgba(0, 0, 0, 0.15);
    color: #fbbf24;
  }

  /* Talent Mini Avatars */
  .talent-card-item {
    transition: all 0.25s ease;
    border-radius: 12px;
  }
  .talent-card-item:hover {
    background: #f8fafc;
  }
</style>
@endpush

@section('content')
<div class="container-fluid p-4">

  <!-- ==================== 1. CINEMATIC HERO CONTROL BANNER ==================== -->
  <div class="row mb-4">
    <div class="col-12">
      <div class="card border-0 rounded-4 p-4 p-lg-5 text-white media-hero-banner position-relative">
        <div class="row align-items-center position-relative z-1 g-4">
          <div class="col-xl-7 col-lg-8">
            <div class="d-flex align-items-center gap-3 mb-3">
              <span class="badge px-3 py-2 rounded-pill fw-bold text-dark" style="background: linear-gradient(135deg, #fbbf24, #f59e0b);">
                <i class="fa-solid fa-clapperboard me-1"></i> MIND BLOWING MEDIA &bull; STUDIO DECK
              </span>
              <div class="d-none d-sm-flex align-items-center gap-2 text-warning small fw-semibold">
                <div class="equalizer-bar">
                  <span></span><span></span><span></span><span></span>
                </div>
                <span>4K HDR Pipeline Online</span>
              </div>
            </div>

            <h1 class="fw-black mb-2 display-6 fw-bold tracking-tight">
              Welcome Back, <span class="text-warning">{{ auth()->user()->name }}</span> 👋
            </h1>
            <p class="mb-0 text-white-50 fs-6" style="max-width: 620px; line-height: 1.6;">
              Central command deck for your talent directory, audition pipelines, cinema portfolios, and studio production resources.
            </p>
          </div>

          <div class="col-xl-5 col-lg-4 text-lg-end">
            <div class="d-flex flex-wrap gap-2 justify-content-lg-end">
              <a href="{{ route('admin.talents.create') }}" class="btn btn-gold-action px-3 py-2 rounded-pill d-inline-flex align-items-center gap-2">
                <i class="fa-solid fa-user-plus"></i>
                <span>Add Talent</span>
              </a>
              <a href="{{ route('admin.casting-calls.create') }}" class="btn btn-glass-action px-3 py-2 rounded-pill d-inline-flex align-items-center gap-2">
                <i class="fa-solid fa-bullhorn text-warning"></i>
                <span>New Casting Call</span>
              </a>
              <a href="{{ route('home') }}" target="_blank" class="btn btn-outline-light px-3 py-2 rounded-pill d-inline-flex align-items-center gap-2" title="View Frontend">
                <i class="fa-solid fa-globe"></i>
                <span>Live Site</span>
                <i class="fa-solid fa-arrow-up-right-from-square small"></i>
              </a>
            </div>
          </div>
        </div>

        <!-- Quick Metas Strip on Banner -->
        <div class="mt-4 pt-3 border-top border-white border-opacity-10 position-relative z-1 d-none d-md-flex align-items-center gap-4 text-white-50 small">
          <div><i class="fa-solid fa-shield-halved text-success me-1"></i> WebP Engine: <strong>Active</strong></div>
          <div><i class="fa-solid fa-users-viewfinder text-info me-1"></i> Total Artists: <strong>{{ $stats['total_talents'] }} Profiles</strong></div>
          <div><i class="fa-solid fa-file-signature text-warning me-1"></i> Pending Auditions: <strong>{{ $stats['pending_applications'] }} Awaiting</strong></div>
          <div><i class="fa-solid fa-video text-danger me-1"></i> Productions Released: <strong>{{ $stats['total_videos'] }} Films/TVCs</strong></div>
        </div>
      </div>
    </div>
  </div>

  <!-- ==================== 2. PRIMARY MEDIA KPI METRIC CARDS ==================== -->
  <div class="row g-3 mb-4">
    <!-- Talents Roster -->
    <div class="col-xxl-3 col-md-6">
      <div class="kpi-card p-4 h-100">
        <div class="card-glow-bg" style="background-color: #f59e0b;"></div>
        <div class="d-flex justify-content-between align-items-start mb-3">
          <div>
            <span class="text-muted fw-semibold small text-uppercase tracking-wider">Talent Directory</span>
            <h2 class="fw-bold text-dark mt-1 mb-0">{{ $stats['total_talents'] }}</h2>
          </div>
          <div class="kpi-icon-wrapper" style="background-color: #fef3c7; color: #d97706;">
            <i class="fa-solid fa-user-astronaut"></i>
          </div>
        </div>
        <div class="d-flex align-items-center justify-content-between pt-2 border-top">
          <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle rounded-pill">
            <i class="fa-solid fa-earth-americas me-1"></i> {{ $stats['international_talents'] }} International
          </span>
          <a href="{{ route('admin.talents.index') }}" class="small fw-semibold text-primary text-decoration-none">
            Manage &rarr;
          </a>
        </div>
      </div>
    </div>

    <!-- Audition Applications -->
    <div class="col-xxl-3 col-md-6">
      <div class="kpi-card p-4 h-100">
        <div class="card-glow-bg" style="background-color: #ef4444;"></div>
        <div class="d-flex justify-content-between align-items-start mb-3">
          <div>
            <span class="text-muted fw-semibold small text-uppercase tracking-wider">Audition Inflow</span>
            <h2 class="fw-bold text-dark mt-1 mb-0">{{ $stats['total_applications'] }}</h2>
          </div>
          <div class="kpi-icon-wrapper" style="background-color: #fee2e2; color: #dc2626;">
            <i class="fa-solid fa-id-card-clip"></i>
          </div>
        </div>
        <div class="d-flex align-items-center justify-content-between pt-2 border-top">
          @if($stats['pending_applications'] > 0)
            <span class="badge bg-danger text-white rounded-pill pulse">
              <i class="fa-solid fa-clock me-1"></i> {{ $stats['pending_applications'] }} Need Review
            </span>
          @else
            <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">
              <i class="fa-solid fa-check me-1"></i> All Reviewed
            </span>
          @endif
          <a href="{{ route('admin.applications.index') }}" class="small fw-semibold text-danger text-decoration-none">
            View Queue &rarr;
          </a>
        </div>
      </div>
    </div>

    <!-- Active Casting Calls -->
    <div class="col-xxl-3 col-md-6">
      <div class="kpi-card p-4 h-100">
        <div class="card-glow-bg" style="background-color: #3b82f6;"></div>
        <div class="d-flex justify-content-between align-items-start mb-3">
          <div>
            <span class="text-muted fw-semibold small text-uppercase tracking-wider">Casting Campaigns</span>
            <h2 class="fw-bold text-dark mt-1 mb-0">{{ $stats['casting_calls'] }}</h2>
          </div>
          <div class="kpi-icon-wrapper" style="background-color: #dbeafe; color: #2563eb;">
            <i class="fa-solid fa-bullhorn"></i>
          </div>
        </div>
        <div class="d-flex align-items-center justify-content-between pt-2 border-top">
          <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill">
            <i class="fa-solid fa-fire me-1"></i> Open Auditions Active
          </span>
          <a href="{{ route('admin.casting-calls.index') }}" class="small fw-semibold text-primary text-decoration-none">
            All Calls &rarr;
          </a>
        </div>
      </div>
    </div>

    <!-- Released Video Portfolio -->
    <div class="col-xxl-3 col-md-6">
      <div class="kpi-card p-4 h-100">
        <div class="card-glow-bg" style="background-color: #8b5cf6;"></div>
        <div class="d-flex justify-content-between align-items-start mb-3">
          <div>
            <span class="text-muted fw-semibold small text-uppercase tracking-wider">Video Productions</span>
            <h2 class="fw-bold text-dark mt-1 mb-0">{{ $stats['total_videos'] }}</h2>
          </div>
          <div class="kpi-icon-wrapper" style="background-color: #ede9fe; color: #7c3aed;">
            <i class="fa-solid fa-clapperboard"></i>
          </div>
        </div>
        <div class="d-flex align-items-center justify-content-between pt-2 border-top">
          <span class="badge bg-secondary-subtle text-secondary border rounded-pill">
            <i class="fa-solid fa-film me-1"></i> 4K Showcase Library
          </span>
          <a href="{{ route('admin.videos.index') }}" class="small fw-semibold text-primary text-decoration-none">
            Portfolio &rarr;
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- ==================== 3. SECONDARY MEDIA OPERATIONS STRIP ==================== -->
  <div class="row g-3 mb-4">
    <div class="col-xl-3 col-sm-6">
      <div class="micro-stat-card d-flex align-items-center gap-3">
        <div class="rounded-circle p-3 text-primary bg-primary-subtle">
          <i class="fa-solid fa-building fs-4"></i>
        </div>
        <div>
          <h4 class="fw-bold mb-0 text-dark">{{ $stats['shooting_houses'] }}</h4>
          <span class="text-muted small">Shooting Houses &amp; Sets</span>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-sm-6">
      <div class="micro-stat-card d-flex align-items-center gap-3">
        <div class="rounded-circle p-3 text-success bg-success-subtle">
          <i class="fa-solid fa-book-open fs-4"></i>
        </div>
        <div>
          <h4 class="fw-bold mb-0 text-dark">{{ $stats['articles'] }}</h4>
          <span class="text-muted small">Director &amp; Artist Diaries</span>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-sm-6">
      <div class="micro-stat-card d-flex align-items-center gap-3">
        <div class="rounded-circle p-3 text-info bg-info-subtle">
          <i class="fa-solid fa-newspaper fs-4"></i>
        </div>
        <div>
          <h4 class="fw-bold mb-0 text-dark">{{ $stats['notices'] }}</h4>
          <span class="text-muted small">Official Notices &amp; News</span>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-sm-6">
      <div class="micro-stat-card d-flex align-items-center gap-3">
        <div class="rounded-circle p-3 text-warning bg-warning-subtle">
          <i class="fa-solid fa-star fs-4"></i>
        </div>
        <div>
          <h4 class="fw-bold mb-0 text-dark">{{ $stats['reviews'] }}</h4>
          <span class="text-muted small">5-Star Client Reviews</span>
        </div>
      </div>
    </div>
  </div>

  <!-- ==================== 4. INTERACTIVE PRODUCTION ANALYTICS CHARTS ==================== -->
  <div class="row g-4 mb-4">
    <!-- Chart 1: Talent Inflow & Audition Growth Curve -->
    <div class="col-lg-8">
      <div class="chart-card p-4 h-100">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
          <div>
            <h5 class="fw-bold mb-1 text-dark">
              <i class="fa-solid fa-chart-line text-warning me-2"></i>Audition Submissions &amp; Casting Activity
            </h5>
            <p class="text-muted small mb-0">Monthly candidate influx and project enrollment trends</p>
          </div>
          <span class="badge bg-light text-dark border px-3 py-2 rounded-pill small">
            <i class="fa-solid fa-circle text-success me-1 small"></i> Live Analytics
          </span>
        </div>
        <div style="height: 280px; position: relative;">
          <canvas id="auditionTrendsChart"></canvas>
        </div>
      </div>
    </div>

    <!-- Chart 2: Production Portfolio Breakdown -->
    <div class="col-lg-4">
      <div class="chart-card p-4 h-100">
        <div class="mb-3">
          <h5 class="fw-bold mb-1 text-dark">
            <i class="fa-solid fa-chart-pie text-primary me-2"></i>Media Portfolio Mix
          </h5>
          <p class="text-muted small mb-0">Breakdown by video category</p>
        </div>
        <div style="height: 220px; position: relative;" class="d-flex align-items-center justify-content-center">
          <canvas id="mediaDistributionChart"></canvas>
        </div>
        <div class="d-flex justify-content-around text-center pt-3 border-top mt-2 small text-muted">
          <div>
            <span class="d-block fw-bold text-dark">{{ $videoCategories['Cinema'] ?? 0 }}</span>
            <small>Cinema</small>
          </div>
          <div>
            <span class="d-block fw-bold text-dark">{{ $videoCategories['TVC'] ?? 0 }}</span>
            <small>TVC</small>
          </div>
          <div>
            <span class="d-block fw-bold text-dark">{{ $videoCategories['Drama'] ?? 0 }}</span>
            <small>Drama</small>
          </div>
          <div>
            <span class="d-block fw-bold text-dark">{{ $videoCategories['Music'] ?? 0 }}</span>
            <small>Music</small>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ==================== 5. SUBMISSIONS TABLE & OPEN CASTING CALLS ==================== -->
  <div class="row g-4 mb-4">
    <!-- Recent Applications Queue -->
    <div class="col-xl-8">
      <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center border-bottom">
          <div class="d-flex align-items-center gap-2">
            <div class="rounded p-2 bg-danger-subtle text-danger">
              <i class="fa-solid fa-address-card"></i>
            </div>
            <div>
              <h5 class="fw-bold mb-0">Recent Candidate Applications</h5>
              <small class="text-muted">Live submissions from "Submit Profile" frontend form</small>
            </div>
          </div>
          <a href="{{ route('admin.applications.index') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
            View All ({{ $stats['total_applications'] }})
          </a>
        </div>

        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead class="table-light text-muted small text-uppercase">
              <tr>
                <th class="ps-4">Candidate</th>
                <th>Role Category</th>
                <th>Contact</th>
                <th>Status</th>
                <th>Date</th>
                <th class="text-end pe-4">Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse($latestApplications as $app)
                <tr>
                  <td class="ps-4">
                    <div class="d-flex align-items-center gap-3">
                      @if($app->photo)
                        <img src="{{ asset($app->photo) }}" class="rounded-circle shadow-xs" width="44" height="44" style="object-fit: cover;">
                      @else
                        <div class="rounded-circle bg-secondary-subtle text-secondary d-flex align-items-center justify-content-center fw-bold" style="width: 44px; height: 44px;">
                          {{ strtoupper(substr($app->name, 0, 1)) }}
                        </div>
                      @endif
                      <div>
                        <div class="fw-bold text-dark">{{ $app->name }}</div>
                        <small class="text-muted">{{ $app->gender ?? 'N/A' }} &bull; {{ $app->age ?? 'Age N/A' }}</small>
                      </div>
                    </div>
                  </td>
                  <td>
                    <span class="badge bg-light text-dark border px-2 py-1">
                      {{ $app->category ?? 'General' }}
                    </span>
                  </td>
                  <td>
                    <div class="small fw-semibold text-dark"><i class="fa-solid fa-phone text-muted me-1"></i> {{ $app->phone }}</div>
                    @if($app->email)
                      <small class="text-muted">{{ $app->email }}</small>
                    @endif
                  </td>
                  <td>
                    @if($app->status === 'pending')
                      <span class="badge bg-warning text-dark px-2 py-1">Pending</span>
                    @elseif($app->status === 'approved')
                      <span class="badge bg-success px-2 py-1">Approved</span>
                    @elseif($app->status === 'shortlisted')
                      <span class="badge bg-info text-dark px-2 py-1">Shortlisted</span>
                    @else
                      <span class="badge bg-danger px-2 py-1">Rejected</span>
                    @endif
                  </td>
                  <td>
                    <small class="text-muted">{{ $app->created_at->format('d M, Y') }}</small>
                  </td>
                  <td class="text-end pe-4">
                    <a href="{{ route('admin.applications.show', $app) }}" class="btn btn-sm btn-light border rounded-pill px-3 text-primary fw-semibold" title="Inspect Application">
                      <i class="fa-solid fa-eye me-1"></i> Review
                    </a>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="text-center py-5 text-muted">
                    <i class="fa-regular fa-folder-open fs-1 d-block mb-2 text-secondary"></i>
                    No audition submissions recorded yet.
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Active Casting Calls & Open Auditions -->
    <div class="col-xl-4">
      <div class="card border-0 shadow-sm rounded-4 h-100">
        <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center border-bottom">
          <div class="d-flex align-items-center gap-2">
            <div class="rounded p-2 bg-primary-subtle text-primary">
              <i class="fa-solid fa-bullhorn"></i>
            </div>
            <div>
              <h5 class="fw-bold mb-0">Active Casting Calls</h5>
              <small class="text-muted">Live project notices</small>
            </div>
          </div>
          <a href="{{ route('admin.casting-calls.create') }}" class="btn btn-sm btn-outline-primary rounded-circle" title="Add Casting Call">
            <i class="fa-solid fa-plus"></i>
          </a>
        </div>

        <div class="card-body p-3">
          @forelse($activeCastingCalls as $call)
            <div class="p-3 mb-2 rounded-3 border bg-light bg-opacity-50">
              <div class="d-flex justify-content-between align-items-start mb-2">
                <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-1">
                  {{ $call->project_type }}
                </span>
                <span class="badge bg-success text-white">Open</span>
              </div>
              <h6 class="fw-bold mb-1 text-dark">{{ $call->title }}</h6>
              <div class="small text-muted mb-2">
                <i class="fa-solid fa-masks-theater text-warning me-1"></i> Roles: {{ $call->roles }}
              </div>
              <div class="d-flex justify-content-between align-items-center pt-2 border-top small text-muted">
                <span><i class="fa-regular fa-calendar text-muted me-1"></i> {{ $call->deadline }}</span>
                <a href="{{ route('admin.casting-calls.edit', $call) }}" class="text-primary fw-semibold text-decoration-none">
                  Edit &rarr;
                </a>
              </div>
            </div>
          @empty
            <div class="text-center py-5 text-muted">
              <i class="fa-solid fa-bullhorn fs-2 mb-2 d-block text-secondary"></i>
              No active casting calls found.
            </div>
          @endforelse
        </div>
      </div>
    </div>
  </div>

  <!-- ==================== 6. MEDIA SHOWCASE (VIDEOS & TALENTS) ==================== -->
  <div class="row g-4 mb-4">
    <!-- Featured Video Portfolio Showcase -->
    <div class="col-lg-6">
      <div class="card border-0 shadow-sm rounded-4 h-100">
        <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center border-bottom">
          <div class="d-flex align-items-center gap-2">
            <div class="rounded p-2 bg-warning-subtle text-warning">
              <i class="fa-solid fa-clapperboard"></i>
            </div>
            <div>
              <h5 class="fw-bold mb-0">Production Showcase</h5>
              <small class="text-muted">Featured film &amp; commercial productions</small>
            </div>
          </div>
          <a href="{{ route('admin.videos.index') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
            View All
          </a>
        </div>

        <div class="card-body p-4">
          <div class="row g-3">
            @forelse($featuredVideos as $vid)
              <div class="col-md-4 col-sm-6">
                <div class="video-card-mini shadow-xs mb-2" style="height: 110px;">
                  <img src="{{ asset($vid->thumbnail ?? 'frontend/assets/images/portfolio-film.jpg') }}" class="w-100 h-100" style="object-fit: cover;">
                  <a href="{{ $vid->youtube_url }}" target="_blank" class="video-play-overlay">
                    <i class="fa-solid fa-play"></i>
                  </a>
                </div>
                <h6 class="fw-bold small mb-0 text-truncate text-dark" title="{{ $vid->title }}">{{ $vid->title }}</h6>
                <small class="text-muted d-block">{{ strtoupper($vid->category) }} &bull; {{ $vid->duration ?? '4K' }}</small>
              </div>
            @empty
              <div class="col-12 text-center py-4 text-muted">No video productions available.</div>
            @endforelse
          </div>
        </div>
      </div>
    </div>

    <!-- Featured Talents Directory Spotlight -->
    <div class="col-lg-6">
      <div class="card border-0 shadow-sm rounded-4 h-100">
        <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center border-bottom">
          <div class="d-flex align-items-center gap-2">
            <div class="rounded p-2 bg-info-subtle text-info">
              <i class="fa-solid fa-user-astronaut"></i>
            </div>
            <div>
              <h5 class="fw-bold mb-0">Talent Directory Spotlight</h5>
              <small class="text-muted">Top enrolled actors &amp; models</small>
            </div>
          </div>
          <a href="{{ route('admin.talents.index') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
            All Talents
          </a>
        </div>

        <div class="card-body p-3">
          <div class="row g-2">
            @forelse($latestTalents as $t)
              <div class="col-md-6">
                <div class="talent-card-item p-2 d-flex align-items-center gap-3 border rounded-3">
                  <img src="{{ asset($t->photo ?? 'frontend/assets/images/portfolio-casting.jpg') }}" class="rounded-circle shadow-xs" width="46" height="46" style="object-fit: cover;">
                  <div class="flex-grow-1 overflow-hidden">
                    <div class="fw-bold text-dark text-truncate">{{ $t->name }}</div>
                    <small class="text-muted d-block text-truncate">
                      {{ $t->category->name ?? 'Talent' }}
                      @if($t->is_international)
                        &bull; <span class="text-primary fw-semibold">Global</span>
                      @endif
                    </small>
                  </div>
                  <a href="{{ route('admin.talents.edit', $t) }}" class="btn btn-sm btn-light border rounded-circle" title="Edit">
                    <i class="fa-solid fa-pen small text-secondary"></i>
                  </a>
                </div>
              </div>
            @empty
              <div class="col-12 text-center py-4 text-muted">No talent profiles available.</div>
            @endforelse
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ==================== 7. QUICK PRODUCTION SHORTCUTS ==================== -->
  <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
      <div>
        <h6 class="fw-bold mb-1 text-dark"><i class="fa-solid fa-wand-magic-sparkles text-warning me-2"></i>Quick Production Actions</h6>
        <p class="text-muted small mb-0">Instant shortcuts to update homepage components, media hero slides, and studio configuration</p>
      </div>
      <div class="d-flex flex-wrap gap-2">
        <a href="{{ route('admin.sliders.create') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-2">
          <i class="fa-solid fa-images me-1 text-primary"></i> Add Hero Slide
        </a>
        <a href="{{ route('admin.articles.create') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-2">
          <i class="fa-solid fa-pen-nib me-1 text-success"></i> Write Diary Article
        </a>
        <a href="{{ route('admin.notices.create') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-2">
          <i class="fa-solid fa-bullhorn me-1 text-info"></i> Publish Notice
        </a>
        <a href="{{ route('admin.shooting-houses.create') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-2">
          <i class="fa-solid fa-building me-1 text-warning"></i> Add Shooting House
        </a>
        <a href="{{ route('admin.settings.index') }}" class="btn btn-sm btn-primary rounded-pill px-3 py-2">
          <i class="fa-solid fa-sliders me-1"></i> Site Settings
        </a>
      </div>
    </div>
  </div>

</div>
@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    // 1. Audition Submissions Spline Chart
    const ctxTrends = document.getElementById('auditionTrendsChart');
    if (ctxTrends) {
      const gradient = ctxTrends.getContext('2d').createLinearGradient(0, 0, 0, 260);
      gradient.addColorStop(0, 'rgba(245, 158, 11, 0.45)');
      gradient.addColorStop(0.6, 'rgba(245, 158, 11, 0.08)');
      gradient.addColorStop(1, 'rgba(245, 158, 11, 0)');

      new Chart(ctxTrends, {
        type: 'line',
        data: {
          labels: ['Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov (Current)'],
          datasets: [{
            label: 'Candidate Applications',
            data: [12, 19, 28, 35, 48, {{ max($stats['total_applications'], 58) }}],
            borderColor: '#f59e0b',
            backgroundColor: gradient,
            borderWidth: 3,
            fill: true,
            tension: 0.4,
            pointBackgroundColor: '#ffffff',
            pointBorderColor: '#d97706',
            pointBorderWidth: 2,
            pointRadius: 5,
            pointHoverRadius: 7
          }, {
            label: 'Casting Calls Active',
            data: [2, 3, 5, 4, 6, {{ max($stats['casting_calls'], 4) }}],
            borderColor: '#4f46e5',
            borderWidth: 2,
            borderDash: [5, 5],
            fill: false,
            tension: 0.3,
            pointRadius: 0
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              position: 'top',
              labels: {
                boxWidth: 12,
                font: { family: "'Inter', sans-serif", size: 12 }
              }
            },
            tooltip: {
              backgroundColor: '#0f172a',
              titleFont: { family: "'Inter', sans-serif", weight: 'bold' },
              padding: 12,
              cornerRadius: 8
            }
          },
          scales: {
            y: {
              beginAtZero: true,
              grid: { color: 'rgba(0, 0, 0, 0.04)' }
            },
            x: {
              grid: { display: false }
            }
          }
        }
      });
    }

    // 2. Media Distribution Doughnut Chart
    const ctxDistribution = document.getElementById('mediaDistributionChart');
    if (ctxDistribution) {
      new Chart(ctxDistribution, {
        type: 'doughnut',
        data: {
          labels: ['Cinema', 'TVC', 'Drama', 'Music', 'OTT'],
          datasets: [{
            data: [
              {{ max($videoCategories['Cinema'] ?? 0, 1) }},
              {{ max($videoCategories['TVC'] ?? 0, 1) }},
              {{ max($videoCategories['Drama'] ?? 0, 1) }},
              {{ max($videoCategories['Music'] ?? 0, 1) }},
              {{ max($videoCategories['OTT'] ?? 0, 1) }}
            ],
            backgroundColor: ['#f59e0b', '#3b82f6', '#10b981', '#8b5cf6', '#ec4899'],
            borderWidth: 3,
            borderColor: '#ffffff',
            hoverOffset: 6
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          cutout: '70%',
          plugins: {
            legend: { display: false }
          }
        }
      });
    }
  });
</script>
@endpush
