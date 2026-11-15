@extends('admin.layouts.master')

@section('title', 'Add Review - Media Admin')

@section('content')
<div class="container-fluid p-4">
  <div class="admin-page-header">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
      <div>
        <div class="header-badge">
          <i class="fa-solid fa-star"></i> New Feedback
        </div>
        <h3 class="fw-bold mb-1 text-white">Add Client / Collaborator Review</h3>
        <p class="text-white-50 mb-0 small">Publish a 5-star testimonial statement for the homepage testimonial section</p>
      </div>
      <a href="{{ route('admin.reviews.index') }}" class="btn btn-outline-light rounded-pill px-4">
        <i class="fa-solid fa-arrow-left me-1"></i> Back to Reviews
      </a>
    </div>
  </div>

  <div class="card card-modern p-4 p-lg-5">
    <form action="{{ route('admin.reviews.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
        <span class="rounded-circle bg-warning-subtle text-warning p-2 d-inline-flex" style="font-size: 0.9rem;"><i class="fa-solid fa-user-check"></i></span>
        Reviewer Profile &amp; Rating
      </h5>
      <div class="row g-3 mb-4">
        <div class="col-md-6">
          <label class="form-label">Reviewer Full Name <span class="text-danger">*</span></label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-user-tie"></i></span>
            <input type="text" name="name" class="form-control" required placeholder="e.g. Mostofa Sarwar Farooki" value="{{ old('name') }}">
          </div>
        </div>

        <div class="col-md-6">
          <label class="form-label">Professional Role / Designation</label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-id-card"></i></span>
            <input type="text" name="designation" class="form-control" placeholder="e.g. Film Director &amp; Screenwriter" value="{{ old('designation') }}">
          </div>
        </div>

        <div class="col-md-6">
          <label class="form-label">Star Rating</label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-star text-warning"></i></span>
            <select name="rating" class="form-select">
              <option value="5" selected>★★★★★ (5 Stars - Exceptional)</option>
              <option value="4">★★★★ (4 Stars - Great)</option>
              <option value="3">★★★ (3 Stars - Good)</option>
              <option value="2">★★ (2 Stars - Average)</option>
              <option value="1">★ (1 Star - Poor)</option>
            </select>
          </div>
        </div>

        <div class="col-md-6">
          <label class="form-label d-flex align-items-center justify-content-between">
            <span>Reviewer Headshot Photo</span>
            <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-2 py-1">
              <i class="fa-solid fa-ruler-combined me-1"></i> 300 &times; 300 px (1:1)
            </span>
          </label>
          <div class="file-dropzone">
            <input type="file" name="photo" accept="image/*">
            <div class="dropzone-icon">
              <i class="fa-solid fa-cloud-arrow-up"></i>
            </div>
            <div class="dropzone-title">Upload reviewer avatar photo</div>
            <div class="dropzone-subtitle">Recommended size: <strong>300 &times; 300 px</strong> &bull; Auto-optimized to WebP</div>
            <div class="preview-wrapper d-none"></div>
          </div>
        </div>

        <div class="col-12">
          <label class="form-label">Testimonial Statement / Review Text <span class="text-danger">*</span></label>
          <textarea name="review" class="form-control" rows="4" required placeholder="Write the testimonial statement praising talent casting quality, production reliability, and studio facilities...">{{ old('review') }}</textarea>
        </div>
      </div>

      <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2 pt-3 border-top">
        <span class="rounded-circle bg-success-subtle text-success p-2 d-inline-flex" style="font-size: 0.9rem;"><i class="fa-solid fa-sliders"></i></span>
        Display Settings
      </h5>
      <div class="row g-3 mb-4">
        <div class="col-12">
          <div class="d-flex gap-4 p-3 bg-light rounded-3 border">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" name="is_featured" id="featSwitch" checked>
              <label class="form-check-label fw-semibold" for="featSwitch">Featured on Homepage</label>
            </div>
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" name="status" id="statSwitch" checked>
              <label class="form-check-label fw-semibold" for="statSwitch">Active Review</label>
            </div>
          </div>
        </div>
      </div>

      <div class="d-flex gap-3 pt-3 border-top">
        <button type="submit" class="btn btn-gold-action px-5 py-2">
          <i class="fa-solid fa-save me-2"></i> Save Review
        </button>
        <a href="{{ route('admin.reviews.index') }}" class="btn btn-light border rounded-pill px-4 py-2">
          Cancel
        </a>
      </div>
    </form>
  </div>
</div>
@endsection
