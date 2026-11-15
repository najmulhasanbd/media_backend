@extends('admin.layouts.master')

@section('title', 'Application Dossier - Media Admin')

@section('content')
<div class="container-fluid p-4">
  <div class="admin-page-header">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
      <div>
        <div class="header-badge">
          <i class="fa-solid fa-address-card"></i> Candidate Dossier
        </div>
        <h3 class="fw-bold mb-1 text-white">{{ $application->name }}</h3>
        <p class="text-white-50 mb-0 small">Submitted for: <strong class="text-warning">{{ $application->category }}</strong> on {{ $application->created_at->format('F d, Y') }}</p>
      </div>
      <a href="{{ route('admin.applications.index') }}" class="btn btn-outline-light rounded-pill px-4">
        <i class="fa-solid fa-arrow-left me-1"></i> Back to Queue
      </a>
    </div>
  </div>

  <div class="row g-4">
    <!-- Left Column: Photo & Status Decision Card -->
    <div class="col-lg-4">
      <div class="card card-modern p-4 text-center h-100">
        <div class="mb-3 position-relative d-inline-block mx-auto">
          @if($application->photo)
            <img src="{{ asset($application->photo) }}" class="rounded-4 shadow-sm img-fluid" style="max-height: 320px; width: 100%; object-fit: cover;">
          @else
            <div class="rounded-4 bg-light text-secondary d-flex align-items-center justify-content-center mx-auto" style="width: 220px; height: 260px;">
              <i class="fa-solid fa-user fs-1 text-muted"></i>
            </div>
          @endif
        </div>

        <h4 class="fw-bold mb-1 text-dark">{{ $application->name }}</h4>
        <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-3 py-1 rounded-pill mb-3">
          {{ $application->category }}
        </span>

        <hr class="my-3">

        <!-- Status Form -->
        <div class="p-3 bg-light rounded-3 text-start border">
          <form action="{{ route('admin.applications.updateStatus', $application) }}" method="POST">
            @csrf
            @method('PATCH')
            <label class="form-label fw-bold small text-uppercase text-secondary mb-2">Change Review Status</label>
            <div class="input-group">
              <select name="status" class="form-select border-primary-subtle fw-semibold">
                <option value="pending" {{ $application->status === 'pending' ? 'selected' : '' }}>⏳ Pending Review</option>
                <option value="shortlisted" {{ $application->status === 'shortlisted' ? 'selected' : '' }}>⭐ Shortlisted</option>
                <option value="approved" {{ $application->status === 'approved' ? 'selected' : '' }}>✅ Approved Candidate</option>
                <option value="rejected" {{ $application->status === 'rejected' ? 'selected' : '' }}>❌ Rejected</option>
              </select>
              <button type="submit" class="btn btn-primary px-4 fw-semibold shadow-xs">
                <i class="fa-solid fa-check me-1"></i> Update
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Right Column: Personal & Professional Dossier -->
    <div class="col-lg-8">
      <div class="card card-modern p-4 p-lg-5 h-100">
        <h5 class="fw-bold text-dark mb-4 pb-2 border-bottom d-flex align-items-center gap-2">
          <span class="rounded-circle bg-primary-subtle text-primary p-2 d-inline-flex" style="font-size: 0.9rem;"><i class="fa-solid fa-address-book"></i></span>
          Contact &amp; Physical Specifications
        </h5>

        <div class="row g-4 mb-4">
          <div class="col-sm-6">
            <span class="text-muted small text-uppercase d-block mb-1">Direct Phone</span>
            <div class="fw-bold fs-5 text-dark">
              <a href="tel:{{ $application->phone }}" class="text-decoration-none text-dark">
                <i class="fa-solid fa-phone text-success me-2"></i>{{ $application->phone }}
              </a>
            </div>
          </div>

          <div class="col-sm-6">
            <span class="text-muted small text-uppercase d-block mb-1">Email Address</span>
            <div class="fw-bold fs-6 text-dark">
              @if($application->email)
                <a href="mailto:{{ $application->email }}" class="text-decoration-none text-dark">
                  <i class="fa-solid fa-envelope text-primary me-2"></i>{{ $application->email }}
                </a>
              @else
                <span class="text-muted">Not provided</span>
              @endif
            </div>
          </div>

          <div class="col-4">
            <span class="text-muted small text-uppercase d-block mb-1">Gender</span>
            <div class="fw-bold text-dark fs-6">{{ $application->gender ?? 'N/A' }}</div>
          </div>

          <div class="col-4">
            <span class="text-muted small text-uppercase d-block mb-1">Age</span>
            <div class="fw-bold text-dark fs-6">{{ $application->age ? $application->age . ' yrs' : 'N/A' }}</div>
          </div>

          <div class="col-4">
            <span class="text-muted small text-uppercase d-block mb-1">Height</span>
            <div class="fw-bold text-dark fs-6">{{ $application->height ?? 'N/A' }}</div>
          </div>
        </div>

        <h5 class="fw-bold text-dark mb-3 pt-3 border-top d-flex align-items-center gap-2">
          <span class="rounded-circle bg-warning-subtle text-warning p-2 d-inline-flex" style="font-size: 0.9rem;"><i class="fa-solid fa-link"></i></span>
          Portfolio &amp; Audition Reel Link
        </h5>

        <div class="mb-4">
          @if($application->portfolio_url)
            <a href="{{ $application->portfolio_url }}" target="_blank" class="btn btn-outline-primary rounded-pill px-4 py-2 d-inline-flex align-items-center gap-2">
              <i class="fa-solid fa-arrow-up-right-from-square"></i>
              <span>Open Candidate Portfolio / Reel</span>
            </a>
          @else
            <div class="p-3 bg-light rounded-3 text-muted small">
              <i class="fa-solid fa-circle-info me-1"></i> No external reel or drive link submitted.
            </div>
          @endif
        </div>

        <h5 class="fw-bold text-dark mb-3 pt-3 border-top d-flex align-items-center gap-2">
          <span class="rounded-circle bg-success-subtle text-success p-2 d-inline-flex" style="font-size: 0.9rem;"><i class="fa-solid fa-file-lines"></i></span>
          Biography &amp; Past Experience
        </h5>

        <div class="p-4 bg-light rounded-3 border text-dark" style="line-height: 1.7;">
          {{ $application->bio ?? 'No additional experience notes provided by the applicant.' }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
