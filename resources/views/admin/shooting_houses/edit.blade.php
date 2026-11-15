@extends('admin.layouts.master')

@section('title', 'Edit Shooting House - Media Admin')

@section('content')
<div class="container-fluid p-4">
  <div class="admin-page-header">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
      <div>
        <div class="header-badge">
          <i class="fa-solid fa-pen-to-square"></i> Edit Location
        </div>
        <h3 class="fw-bold mb-1 text-white">Edit Shooting House</h3>
        <p class="text-white-50 mb-0 small">{{ $shootingHouse->name }}</p>
      </div>
      <a href="{{ route('admin.shooting-houses.index') }}" class="btn btn-outline-light rounded-pill px-4">
        <i class="fa-solid fa-arrow-left me-1"></i> Back to Locations
      </a>
    </div>
  </div>

  <div class="card card-modern p-4 p-lg-5">
    <form action="{{ route('admin.shooting-houses.update', $shootingHouse) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
        <span class="rounded-circle bg-warning-subtle text-warning p-2 d-inline-flex" style="font-size: 0.9rem;"><i class="fa-solid fa-house"></i></span>
        Location Identity &amp; Rental Rates
      </h5>
      <div class="row g-3 mb-4">
        <div class="col-md-6">
          <label class="form-label">House / Studio Name <span class="text-danger">*</span></label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-building"></i></span>
            <input type="text" name="name" class="form-control" required value="{{ old('name', $shootingHouse->name) }}">
          </div>
        </div>

        <div class="col-md-6">
          <label class="form-label">Physical Address / Area <span class="text-danger">*</span></label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-location-dot text-danger"></i></span>
            <input type="text" name="location" class="form-control" required value="{{ old('location', $shootingHouse->location) }}">
          </div>
        </div>

        <div class="col-md-6">
          <label class="form-label">Daily Rental Rate</label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-tag text-success"></i></span>
            <input type="text" name="rent" class="form-control" value="{{ old('rent', $shootingHouse->rent) }}">
          </div>
        </div>

        <div class="col-md-6">
          <label class="form-label">Contact Phone Number</label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-phone text-primary"></i></span>
            <input type="text" name="contact" class="form-control" value="{{ old('contact', $shootingHouse->contact) }}">
          </div>
        </div>

        <div class="col-12">
          <label class="form-label">Facilities &amp; Amenities</label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-wand-magic-sparkles"></i></span>
            <input type="text" name="facilities" class="form-control" value="{{ old('facilities', $shootingHouse->facilities) }}">
          </div>
        </div>

        <div class="col-12">
          <label class="form-label">Change Location Photo (Drag &amp; Drop or Browse)</label>
          <div class="file-dropzone">
            <input type="file" name="image" accept="image/*">
            <div class="dropzone-icon">
              <i class="fa-solid fa-cloud-arrow-up"></i>
            </div>
            <div class="dropzone-title">Click to upload or drag &amp; drop new photo</div>
            <div class="dropzone-subtitle">Supported formats: JPG, PNG, WebP (Converts to WebP)</div>
            <div class="preview-wrapper d-none"></div>
          </div>

          @if($shootingHouse->image)
            <div class="d-flex align-items-center gap-3 mt-3 p-3 bg-light rounded-3 border" style="max-width: 320px;">
              <img src="{{ asset($shootingHouse->image) }}" class="rounded shadow-xs" width="90" height="55" style="object-fit: cover;">
              <div>
                <small class="text-muted d-block">Current Active Photo</small>
                <span class="badge bg-success-subtle text-success border">WebP Optimized</span>
              </div>
            </div>
          @endif
        </div>

        <div class="col-12">
          <label class="form-label">Description &amp; Filming Policy</label>
          <textarea name="description" class="form-control" rows="4">{{ old('description', $shootingHouse->description) }}</textarea>
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
              <input class="form-check-input" type="checkbox" name="status" id="statusSwitch" {{ $shootingHouse->status ? 'checked' : '' }}>
              <label class="form-check-label fw-semibold" for="statusSwitch">Publish in Shooting House Directory</label>
            </div>
          </div>
        </div>
      </div>

      <div class="d-flex gap-3 pt-3 border-top">
        <button type="submit" class="btn btn-gold-action px-5 py-2">
          <i class="fa-solid fa-save me-2"></i> Update Shooting House
        </button>
        <a href="{{ route('admin.shooting-houses.index') }}" class="btn btn-light border rounded-pill px-4 py-2">
          Cancel
        </a>
      </div>
    </form>
  </div>
</div>
@endsection
