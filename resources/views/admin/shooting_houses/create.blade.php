@extends('admin.layouts.master')

@section('title', 'Add Shooting House - Media Admin')

@section('content')
<div class="container-fluid p-4">
  <div class="admin-page-header">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
      <div>
        <div class="header-badge">
          <i class="fa-solid fa-building"></i> New Location
        </div>
        <h3 class="fw-bold mb-1 text-white">Add New Shooting House</h3>
        <p class="text-white-50 mb-0 small">Register a film shooting spot, studio floor, or outdoor location</p>
      </div>
      <a href="{{ route('admin.shooting-houses.index') }}" class="btn btn-outline-light rounded-pill px-4">
        <i class="fa-solid fa-arrow-left me-1"></i> Back to Locations
      </a>
    </div>
  </div>

  <div class="card card-modern p-4 p-lg-5">
    <form action="{{ route('admin.shooting-houses.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
        <span class="rounded-circle bg-warning-subtle text-warning p-2 d-inline-flex" style="font-size: 0.9rem;"><i class="fa-solid fa-house"></i></span>
        Location Identity &amp; Rental Rates
      </h5>
      <div class="row g-3 mb-4">
        <div class="col-md-6">
          <label class="form-label">House / Studio Name <span class="text-danger">*</span></label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-building"></i></span>
            <input type="text" name="name" class="form-control" required placeholder="e.g. Royal Palace Filming Spot" value="{{ old('name') }}">
          </div>
        </div>

        <div class="col-md-6">
          <label class="form-label">Physical Address / Area <span class="text-danger">*</span></label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-location-dot text-danger"></i></span>
            <input type="text" name="location" class="form-control" required placeholder="e.g. Pubail, Gazipur" value="{{ old('location') }}">
          </div>
        </div>

        <div class="col-md-6">
          <label class="form-label">Daily Rental Rate</label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-tag text-success"></i></span>
            <input type="text" name="rent" class="form-control" placeholder="e.g. 25,000 BDT / Day" value="{{ old('rent') }}">
          </div>
        </div>

        <div class="col-md-6">
          <label class="form-label">Contact Phone Number</label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-phone text-primary"></i></span>
            <input type="text" name="contact" class="form-control" placeholder="e.g. +880 1700-112233" value="{{ old('contact') }}">
          </div>
        </div>

        <div class="col-12">
          <label class="form-label">Facilities &amp; Amenities</label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-wand-magic-sparkles"></i></span>
            <input type="text" name="facilities" class="form-control" placeholder="e.g. AC Makeup Rooms, Generator, Swimming Pool, Duplex Interior, Open Lawn" value="{{ old('facilities') }}">
          </div>
        </div>

        <div class="col-12">
          <label class="form-label d-flex align-items-center justify-content-between">
            <span>Location Photo (Drag &amp; Drop or Browse)</span>
            <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-2 py-1">
              <i class="fa-solid fa-ruler-combined me-1"></i> Dimension: 1200 &times; 800 px (3:2)
            </span>
          </label>
          <div class="file-dropzone">
            <input type="file" name="image" accept="image/*">
            <div class="dropzone-icon">
              <i class="fa-solid fa-cloud-arrow-up"></i>
            </div>
            <div class="dropzone-title">Click to upload or drag &amp; drop shooting house photo</div>
            <div class="dropzone-subtitle">Recommended size: <strong>1200 &times; 800 px</strong> &bull; Auto-optimized to WebP</div>
            <div class="preview-wrapper d-none"></div>
          </div>
        </div>

        <div class="col-12">
          <label class="form-label">Description &amp; Filming Policy</label>
          <textarea name="description" class="form-control" rows="4" placeholder="Provide full location overview, shooting restrictions, parking details, and booking procedures...">{{ old('description') }}</textarea>
        </div>
      </div>

      <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2 pt-3 border-top">
        <span class="rounded-circle bg-success-subtle text-success p-2 d-inline-flex" style="font-size: 0.9rem;"><i class="fa-solid fa-sliders"></i></span>
        Directory Status
      </h5>
      <div class="row g-3 mb-4">
        <div class="col-12">
          <div class="p-3 bg-light rounded-3 border">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" name="status" id="statusSwitch" checked>
              <label class="form-check-label fw-semibold" for="statusSwitch">Publish in Shooting House Directory</label>
            </div>
          </div>
        </div>
      </div>

      <div class="d-flex gap-3 pt-3 border-top">
        <button type="submit" class="btn btn-gold-action px-5 py-2">
          <i class="fa-solid fa-save me-2"></i> Save Shooting House
        </button>
        <a href="{{ route('admin.shooting-houses.index') }}" class="btn btn-light border rounded-pill px-4 py-2">
          Cancel
        </a>
      </div>
    </form>
  </div>
</div>
@endsection
