@extends('admin.layouts.master')

@section('title', 'Audition Applications - Media Admin')

@section('content')
<div class="container-fluid p-4">
  <!-- Page Header Banner -->
  <div class="admin-page-header">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
      <div>
        <div class="header-badge">
          <i class="fa-solid fa-id-card-clip"></i> Inflow Queue
        </div>
        <h3 class="fw-bold mb-1 text-white">Auditions &amp; Talent Applications</h3>
        <p class="text-white-50 mb-0 small">Review, shortlist, and evaluate submissions from the "Submit Profile" frontend portal</p>
      </div>
      <div class="d-flex flex-wrap gap-2">
        <a href="{{ route('admin.applications.index') }}" class="btn btn-sm rounded-pill {{ !request()->filled('status') ? 'btn-light text-dark fw-bold' : 'btn-outline-light' }}">All</a>
        <a href="{{ route('admin.applications.index', ['status' => 'pending']) }}" class="btn btn-sm rounded-pill {{ request()->input('status') === 'pending' ? 'btn-warning text-dark fw-bold' : 'btn-outline-light' }}">
          <i class="fa-solid fa-clock me-1"></i> Pending
        </a>
        <a href="{{ route('admin.applications.index', ['status' => 'shortlisted']) }}" class="btn btn-sm rounded-pill {{ request()->input('status') === 'shortlisted' ? 'btn-info text-dark fw-bold' : 'btn-outline-light' }}">
          <i class="fa-solid fa-star me-1"></i> Shortlisted
        </a>
        <a href="{{ route('admin.applications.index', ['status' => 'approved']) }}" class="btn btn-sm rounded-pill {{ request()->input('status') === 'approved' ? 'btn-success fw-bold' : 'btn-outline-light' }}">
          <i class="fa-solid fa-check me-1"></i> Approved
        </a>
        <a href="{{ route('admin.applications.index', ['status' => 'rejected']) }}" class="btn btn-sm rounded-pill {{ request()->input('status') === 'rejected' ? 'btn-danger fw-bold' : 'btn-outline-light' }}">
          <i class="fa-solid fa-xmark me-1"></i> Rejected
        </a>
      </div>
    </div>
  </div>

  <!-- Applications Table Card -->
  <div class="card card-modern">
    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead>
          <tr>
            <th class="ps-4">Applicant</th>
            <th>Target Category</th>
            <th>Direct Contact</th>
            <th>Age &amp; Height</th>
            <th>Submission Date</th>
            <th>Status</th>
            <th class="col-actions text-end pe-4">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($applications as $app)
            <tr>
              <td class="ps-4">
                <div class="d-flex align-items-center gap-3">
                  @if($app->photo)
                    <img src="{{ asset($app->photo) }}" class="rounded-circle shadow-xs" width="48" height="48" style="object-fit: cover;">
                  @else
                    <div class="rounded-circle bg-secondary-subtle text-secondary d-flex align-items-center justify-content-center fw-bold" style="width: 48px; height: 48px;">
                      {{ strtoupper(substr($app->name, 0, 1)) }}
                    </div>
                  @endif
                  <div>
                    <div class="fw-bold text-dark fs-6">{{ $app->name }}</div>
                    <small class="text-muted">{{ $app->gender ?? 'N/A' }}</small>
                  </div>
                </div>
              </td>
              <td>
                <span class="badge bg-light text-dark border px-3 py-1 rounded-pill fw-semibold">
                  {{ $app->category }}
                </span>
              </td>
              <td>
                <div class="fw-semibold small text-dark"><i class="fa-solid fa-phone text-muted me-1"></i> {{ $app->phone }}</div>
                @if($app->email)
                  <small class="text-muted"><i class="fa-solid fa-envelope text-muted me-1"></i> {{ $app->email }}</small>
                @endif
              </td>
              <td>
                <div class="small fw-semibold text-dark">{{ $app->age ?? '-' }}</div>
                <small class="text-muted">{{ $app->height ?? '-' }}</small>
              </td>
              <td>
                <small class="text-muted"><i class="fa-regular fa-calendar me-1"></i> {{ $app->created_at->format('d M, Y') }}</small>
              </td>
              <td>
                @if($app->status === 'pending')
                  <span class="badge bg-warning text-dark px-3 py-1 rounded-pill">Pending</span>
                @elseif($app->status === 'approved')
                  <span class="badge bg-success px-3 py-1 rounded-pill">Approved</span>
                @elseif($app->status === 'shortlisted')
                  <span class="badge bg-info text-dark px-3 py-1 rounded-pill">Shortlisted</span>
                @else
                  <span class="badge bg-danger px-3 py-1 rounded-pill">Rejected</span>
                @endif
              </td>
              <td class="col-actions text-end pe-4">
                <div class="table-actions-group">
                  <a href="{{ route('admin.applications.show', $app) }}" class="action-btn-circle text-primary" title="View Candidate Profile">
                    <i class="fa-solid fa-eye small"></i>
                  </a>
                  <form action="{{ route('admin.applications.destroy', $app) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="action-btn-circle text-danger confirm-delete" title="Delete Submission">
                      <i class="fa-solid fa-trash small"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="text-center py-5 text-muted">
                <i class="fa-solid fa-folder-open fs-1 d-block mb-2 text-secondary"></i>
                No applications found in this category.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($applications->hasPages())
      <div class="card-footer bg-white border-0 py-3 px-4">
        {{ $applications->links() }}
      </div>
    @endif
  </div>
</div>
@endsection
