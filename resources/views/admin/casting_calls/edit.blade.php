@extends('admin.layouts.master')

@section('title', 'Edit Casting Call - Media Admin')

@section('content')
<div class="container-fluid p-4">
  <div class="admin-page-header">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
      <div>
        <div class="header-badge">
          <i class="fa-solid fa-pen-to-square"></i> Edit Notice
        </div>
        <h3 class="fw-bold mb-1 text-white">Edit Casting Call</h3>
        <p class="text-white-50 mb-0 small">{{ $castingCall->title }}</p>
      </div>
      <a href="{{ route('admin.casting-calls.index') }}" class="btn btn-outline-light rounded-pill px-4">
        <i class="fa-solid fa-arrow-left me-1"></i> Back to Calls
      </a>
    </div>
  </div>

  <div class="card card-modern p-4 p-lg-5">
    <form action="{{ route('admin.casting-calls.update', $castingCall) }}" method="POST">
      @csrf
      @method('PUT')

      <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
        <span class="rounded-circle bg-warning-subtle text-warning p-2 d-inline-flex" style="font-size: 0.9rem;"><i class="fa-solid fa-film"></i></span>
        Project Overview &amp; Roles
      </h5>
      <div class="row g-3 mb-4">
        <div class="col-md-8">
          <label class="form-label">Notice Title <span class="text-danger">*</span></label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-heading"></i></span>
            <input type="text" name="title" class="form-control" required value="{{ old('title', $castingCall->title) }}">
          </div>
        </div>

        <div class="col-md-4">
          <label class="form-label">Project Type</label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-clapperboard"></i></span>
            <select name="project_type" class="form-select">
              @php $currentType = old('project_type', $castingCall->project_type); @endphp
              <option value="Film" {{ $currentType === 'Film' ? 'selected' : '' }}>Film / Cinema</option>
              <option value="Drama / Series" {{ $currentType === 'Drama / Series' ? 'selected' : '' }}>Drama / Series</option>
              <option value="OTT Web Series" {{ $currentType === 'OTT Web Series' ? 'selected' : '' }}>OTT Web Series</option>
              <option value="TVC / Commercial" {{ $currentType === 'TVC / Commercial' ? 'selected' : '' }}>TVC / Commercial</option>
              <option value="Music Video" {{ $currentType === 'Music Video' ? 'selected' : '' }}>Music Video</option>
            </select>
          </div>
        </div>

        <div class="col-md-6">
          <label class="form-label">Target Roles / Characters <span class="text-danger">*</span></label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-users-viewfinder"></i></span>
            <input type="text" name="roles" class="form-control" value="{{ old('roles', $castingCall->roles) }}">
          </div>
        </div>

        <div class="col-md-6">
          <label class="form-label">Application Deadline</label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-calendar-xmark"></i></span>
            <input type="text" name="deadline" class="form-control" value="{{ old('deadline', $castingCall->deadline) }}">
          </div>
        </div>

        <div class="col-md-6">
          <label class="form-label">Audition / Shoot Location</label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-location-dot"></i></span>
            <input type="text" name="location" class="form-control" value="{{ old('location', $castingCall->location) }}">
          </div>
        </div>

        <div class="col-md-6">
          <label class="form-label">Notice Status</label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-toggle-on"></i></span>
            <select name="status" class="form-select">
              <option value="open" {{ old('status', $castingCall->status) === 'open' ? 'selected' : '' }}>Open (Accepting Submissions)</option>
              <option value="closed" {{ old('status', $castingCall->status) === 'closed' ? 'selected' : '' }}>Closed (Auditions Concluded)</option>
            </select>
          </div>
        </div>

        <div class="col-12">
          <label class="form-label">Requirements &amp; Audition Details <span class="text-danger">*</span></label>
          <textarea name="requirements" class="form-control" rows="5">{{ old('requirements', $castingCall->requirements) }}</textarea>
        </div>
      </div>

      <div class="d-flex gap-3 pt-3 border-top">
        <button type="submit" class="btn btn-gold-action px-5 py-2">
          <i class="fa-solid fa-save me-2"></i> Update Casting Call
        </button>
        <a href="{{ route('admin.casting-calls.index') }}" class="btn btn-light border rounded-pill px-4 py-2">
          Cancel
        </a>
      </div>
    </form>
  </div>
</div>
@endsection
