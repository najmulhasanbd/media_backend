@extends('admin.layouts.master')

@section('title', 'Edit Review - Media Admin')

@section('content')
<div class="container-fluid p-4">
  <div class="admin-page-header">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
      <div>
        <div class="header-badge">
          <i class="fa-solid fa-pen-to-square"></i> Edit Feedback
        </div>
        <h3 class="fw-bold mb-1 text-white">Edit Client Review</h3>
        <p class="text-white-50 mb-0 small">{{ $review->name }}</p>
      </div>
      <a href="{{ route('admin.reviews.index') }}" class="btn btn-outline-light rounded-pill px-4">
        <i class="fa-solid fa-arrow-left me-1"></i> Back to Reviews
      </a>
    </div>
  </div>

  <div class="card card-modern p-4 p-lg-5">
    <form action="{{ route('admin.reviews.update', $review) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
        <span class="rounded-circle bg-warning-subtle text-warning p-2 d-inline-flex" style="font-size: 0.9rem;"><i class="fa-solid fa-user-check"></i></span>
        Reviewer Profile &amp; Rating
      </h5>
      <div class="row g-3 mb-4">
        <div class="col-md-6">
          <label class="form-label">Reviewer Full Name <span class="text-danger">*</span></label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-user-tie"></i></span>
            <input type="text" name="name" class="form-control" required value="{{ old('name', $review->name) }}">
          </div>
        </div>

        <div class="col-md-6">
          <label class="form-label">Professional Role / Designation</label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-id-card"></i></span>
            <input type="text" name="designation" class="form-control" value="{{ old('designation', $review->designation) }}">
          </div>
        </div>

        <div class="col-md-6">
          <label class="form-label">Star Rating</label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-star text-warning"></i></span>
            <select name="rating" class="form-select">
              <option value="5" {{ old('rating', $review->rating) == 5 ? 'selected' : '' }}>★★★★★ (5 Stars - Exceptional)</option>
              <option value="4" {{ old('rating', $review->rating) == 4 ? 'selected' : '' }}>★★★★ (4 Stars - Great)</option>
              <option value="3" {{ old('rating', $review->rating) == 3 ? 'selected' : '' }}>★★★ (3 Stars - Good)</option>
              <option value="2" {{ old('rating', $review->rating) == 2 ? 'selected' : '' }}>★★ (2 Stars - Average)</option>
              <option value="1" {{ old('rating', $review->rating) == 1 ? 'selected' : '' }}>★ (1 Star - Poor)</option>
            </select>
          </div>
        </div>

        <div class="col-md-6">
          <label class="form-label">Change Reviewer Headshot Photo (Drag &amp; Drop or Browse)</label>
          <div class="file-dropzone">
            <input type="file" name="photo" accept="image/*">
            <div class="dropzone-icon">
              <i class="fa-solid fa-cloud-arrow-up"></i>
            </div>
            <div class="dropzone-title">Drop new photo or click to upload</div>
            <div class="dropzone-subtitle">Leave empty to keep current photo (Converts to WebP)</div>
            <div class="preview-wrapper d-none"></div>
          </div>
          @if($review->photo)
            <div class="d-flex align-items-center gap-3 mt-3 p-2 bg-light rounded-3 border">
              <img src="{{ asset($review->photo) }}" class="rounded-circle shadow-xs" width="52" height="52" style="object-fit: cover;">
              <div>
                <span class="badge bg-success-subtle text-success border border-success-subtle">Active Headshot</span>
                <div class="small text-muted mt-1">Currently shown on frontend testimonial cards</div>
              </div>
            </div>
          @endif
        </div>

        <div class="col-12">
          <label class="form-label">Testimonial Statement / Review Text <span class="text-danger">*</span></label>
          <textarea name="review" class="form-control" rows="4" required>{{ old('review', $review->review) }}</textarea>
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
              <input class="form-check-input" type="checkbox" name="is_featured" id="featSwitch" {{ $review->is_featured ? 'checked' : '' }}>
              <label class="form-check-label fw-semibold" for="featSwitch">Featured on Homepage</label>
            </div>
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" name="status" id="statSwitch" {{ $review->status ? 'checked' : '' }}>
              <label class="form-check-label fw-semibold" for="statSwitch">Active Review</label>
            </div>
          </div>
        </div>
      </div>

      <div class="d-flex gap-3 pt-3 border-top">
        <button type="submit" class="btn btn-gold-action px-5 py-2">
          <i class="fa-solid fa-save me-2"></i> Update Review
        </button>
        <a href="{{ route('admin.reviews.index') }}" class="btn btn-light border rounded-pill px-4 py-2">
          Cancel
        </a>
      </div>
    </form>
  </div>
</div>
@endsection
