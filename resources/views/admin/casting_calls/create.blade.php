@extends('admin.layouts.master')

@section('title', 'Create Casting Call - Media Admin')

@section('content')
<div class="container-fluid p-4">
  <div class="admin-page-header">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
      <div>
        <div class="header-badge">
          <i class="fa-solid fa-bullhorn"></i> New Campaign
        </div>
        <h3 class="fw-bold mb-1 text-white">Create New Casting Call</h3>
        <p class="text-white-50 mb-0 small">Publish an audition notice with role specifications and requirements</p>
      </div>
      <a href="{{ route('admin.casting-calls.index') }}" class="btn btn-outline-light rounded-pill px-4">
        <i class="fa-solid fa-arrow-left me-1"></i> Back to Calls
      </a>
    </div>
  </div>

  <div class="card card-modern p-4 p-lg-5">
    <form action="{{ route('admin.casting-calls.store') }}" method="POST">
      @csrf

      <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
        <span class="rounded-circle bg-warning-subtle text-warning p-2 d-inline-flex" style="font-size: 0.9rem;"><i class="fa-solid fa-film"></i></span>
        Project Overview &amp; Roles
      </h5>
      <div class="row g-3 mb-4">
        <div class="col-md-8">
          <label class="form-label">Notice Title <span class="text-danger">*</span></label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-heading"></i></span>
            <input type="text" name="title" class="form-control" required placeholder="e.g. Lead Female Actor Audition for Upcoming Mega Feature Film" value="{{ old('title') }}">
          </div>
        </div>

        <div class="col-md-4">
          <label class="form-label">Project Type</label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-clapperboard"></i></span>
            <select name="project_type" class="form-select">
              <option value="Film">Film / Cinema</option>
              <option value="Drama / Series">Drama / Series</option>
              <option value="OTT Web Series">OTT Web Series</option>
              <option value="TVC / Commercial">TVC / Commercial</option>
              <option value="Music Video">Music Video</option>
            </select>
          </div>
        </div>

        <div class="col-md-6">
          <label class="form-label">Target Roles / Characters <span class="text-danger">*</span></label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-users-viewfinder"></i></span>
            <input type="text" name="roles" class="form-control" placeholder="e.g. Female Lead (Age 20-25) & Supporting Sister" value="{{ old('roles') }}">
          </div>
        </div>

        <div class="col-md-6">
          <label class="form-label">Application Deadline</label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-calendar-xmark"></i></span>
            <input type="text" name="deadline" class="form-control" placeholder="e.g. 30 Nov 2026" value="{{ old('deadline') }}">
          </div>
        </div>

        <div class="col-md-6">
          <label class="form-label">Audition / Shoot Location</label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-location-dot"></i></span>
            <input type="text" name="location" class="form-control" placeholder="e.g. Banani Studio, Dhaka" value="{{ old('location') }}">
          </div>
        </div>

        <div class="col-md-6">
          <label class="form-label">Notice Status</label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-toggle-on"></i></span>
            <select name="status" class="form-select">
              <option value="open">Open (Accepting Submissions)</option>
              <option value="closed">Closed (Auditions Concluded)</option>
            </select>
          </div>
        </div>

        <div class="col-12">
          <label class="form-label">Requirements &amp; Audition Details <span class="text-danger">*</span></label>
          <textarea name="requirements" class="form-control" rows="5" placeholder="Specify age range, height requirements, dialogue fluency, script reading expectations, and shooting dates...">{{ old('requirements') }}</textarea>
        </div>
      </div>

      <div class="d-flex gap-3 pt-3 border-top">
        <button type="submit" class="btn btn-gold-action px-5 py-2">
          <i class="fa-solid fa-save me-2"></i> Publish Casting Call
        </button>
        <a href="{{ route('admin.casting-calls.index') }}" class="btn btn-light border rounded-pill px-4 py-2">
          Cancel
        </a>
      </div>
    </form>
  </div>
</div>
@endsection
