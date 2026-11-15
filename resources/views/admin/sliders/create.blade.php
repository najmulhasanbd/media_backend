@extends('admin.layouts.master')

@section('title', 'Create Hero Slide - Media Admin')

@section('content')
<div class="container-fluid p-4">
  <div class="admin-page-header">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
      <div>
        <div class="header-badge">
          <i class="fa-solid fa-images"></i> New Slide
        </div>
        <h3 class="fw-bold mb-1 text-white">Create Hero Slider</h3>
        <p class="text-white-50 mb-0 small">Publish a visual headline backdrop and call-to-action buttons for homepage hero</p>
      </div>
      <a href="{{ route('admin.sliders.index') }}" class="btn btn-outline-light rounded-pill px-4">
        <i class="fa-solid fa-arrow-left me-1"></i> Back to Sliders
      </a>
    </div>
  </div>

  <div class="card card-modern p-4 p-lg-5">
    <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
        <span class="rounded-circle bg-warning-subtle text-warning p-2 d-inline-flex" style="font-size: 0.9rem;"><i class="fa-solid fa-heading"></i></span>
        Slide Content &amp; Backdrop
      </h5>
      <div class="row g-3 mb-4">
        <div class="col-md-6">
          <label class="form-label">Headline Title <span class="text-danger">*</span></label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-heading"></i></span>
            <input type="text" name="title" class="form-control" required value="{{ old('title') }}" placeholder="e.g. Media, Production & Casting Portfolio">
          </div>
        </div>

        <div class="col-md-6">
          <label class="form-label">Badge Label Text</label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-certificate text-warning"></i></span>
            <input type="text" name="badge" class="form-control" placeholder="e.g. ★ Official Casting & Media Portal" value="{{ old('badge') }}">
          </div>
        </div>

        <div class="col-12">
          <label class="form-label">Subtitle / Narrative Description</label>
          <textarea name="subtitle" class="form-control" rows="3" placeholder="Write a compelling description highlighting film cinematography and casting prowess...">{{ old('subtitle') }}</textarea>
        </div>

        <div class="col-12">
          <label class="form-label">Backdrop Cover Image (Drag &amp; Drop or Browse)</label>
          <div class="file-dropzone">
            <input type="file" name="image" accept="image/*">
            <div class="dropzone-icon">
              <i class="fa-solid fa-cloud-arrow-up"></i>
            </div>
            <div class="dropzone-title">Click to upload or drag &amp; drop backdrop image here</div>
            <div class="dropzone-subtitle">Supported formats: JPG, PNG, WebP (Automatically converted to WebP)</div>
            <div class="preview-wrapper d-none"></div>
          </div>
        </div>
      </div>

      <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2 pt-3 border-top">
        <span class="rounded-circle bg-primary-subtle text-primary p-2 d-inline-flex" style="font-size: 0.9rem;"><i class="fa-solid fa-hand-pointer"></i></span>
        Call-To-Action (CTA) Button Labels
      </h5>
      <input type="hidden" name="btn_url_1" value="{{ old('btn_url_1', '#registration-section') }}">
      <input type="hidden" name="btn_url_2" value="{{ old('btn_url_2', '#openShowreelBtn') }}">
      <div class="row g-3 mb-4">
        <div class="col-md-6">
          <label class="form-label">Primary Button Text</label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-tag"></i></span>
            <input type="text" name="btn_text_1" class="form-control" value="{{ old('btn_text_1', 'Submit Profile') }}" placeholder="e.g. Submit Profile">
          </div>
        </div>

        <div class="col-md-6">
          <label class="form-label">Secondary Button Text</label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-play text-warning"></i></span>
            <input type="text" name="btn_text_2" class="form-control" value="{{ old('btn_text_2', 'Watch Showreel') }}" placeholder="e.g. Watch Showreel">
          </div>
        </div>
      </div>

      <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2 pt-3 border-top">
        <span class="rounded-circle bg-success-subtle text-success p-2 d-inline-flex" style="font-size: 0.9rem;"><i class="fa-solid fa-sliders"></i></span>
        Display Status
      </h5>
      <div class="row g-3 mb-4">
        <div class="col-12">
          <div class="p-3 bg-light rounded-3 border">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" name="status" id="statusSwitch" checked>
              <label class="form-check-label fw-semibold" for="statusSwitch">Publish &amp; Activate on Homepage</label>
            </div>
          </div>
        </div>
      </div>

      <div class="d-flex gap-3 pt-3 border-top">
        <button type="submit" class="btn btn-gold-action px-5 py-2">
          <i class="fa-solid fa-save me-2"></i> Save Hero Slide
        </button>
        <a href="{{ route('admin.sliders.index') }}" class="btn btn-light border rounded-pill px-4 py-2">
          Cancel
        </a>
      </div>
    </form>
  </div>
</div>
@endsection
