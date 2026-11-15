@extends('admin.layouts.master')

@section('title', 'Edit Hero Slide - Media Admin')

@section('content')
<div class="container-fluid p-4">
  <div class="admin-page-header">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
      <div>
        <div class="header-badge">
          <i class="fa-solid fa-pen-to-square"></i> Edit Slide
        </div>
        <h3 class="fw-bold mb-1 text-white">Edit Hero Slider</h3>
        <p class="text-white-50 mb-0 small">{{ $slider->title }}</p>
      </div>
      <a href="{{ route('admin.sliders.index') }}" class="btn btn-outline-light rounded-pill px-4">
        <i class="fa-solid fa-arrow-left me-1"></i> Back to Sliders
      </a>
    </div>
  </div>

  <div class="card card-modern p-4 p-lg-5">
    <form action="{{ route('admin.sliders.update', $slider) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
        <span class="rounded-circle bg-warning-subtle text-warning p-2 d-inline-flex" style="font-size: 0.9rem;"><i class="fa-solid fa-heading"></i></span>
        Slide Content &amp; Backdrop
      </h5>
      <div class="row g-3 mb-4">
        <div class="col-md-6">
          <label class="form-label">Headline Title <span class="text-danger">*</span></label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-heading"></i></span>
            <input type="text" name="title" class="form-control" required value="{{ old('title', $slider->title) }}">
          </div>
        </div>

        <div class="col-md-6">
          <label class="form-label">Badge Label Text</label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-certificate text-warning"></i></span>
            <input type="text" name="badge" class="form-control" value="{{ old('badge', $slider->badge) }}">
          </div>
        </div>

        <div class="col-12">
          <label class="form-label">Subtitle / Narrative Description</label>
          <textarea name="subtitle" class="form-control" rows="3">{{ old('subtitle', $slider->subtitle) }}</textarea>
        </div>

        <div class="col-12">
          <label class="form-label">Change Backdrop Cover Image (Drag &amp; Drop or Browse)</label>
          <div class="file-dropzone">
            <input type="file" name="image" accept="image/*">
            <div class="dropzone-icon">
              <i class="fa-solid fa-cloud-arrow-up"></i>
            </div>
            <div class="dropzone-title">Click to upload or drag &amp; drop new backdrop image here</div>
            <div class="dropzone-subtitle">Supported formats: JPG, PNG, WebP (Automatically converted to WebP)</div>
            <div class="preview-wrapper d-none"></div>
          </div>

          @if($slider->image)
            <div class="d-flex align-items-center gap-3 mt-3 p-3 bg-light rounded-3 border" style="max-width: 340px;">
              <img src="{{ asset($slider->image) }}" class="rounded shadow-xs" width="110" height="60" style="object-fit: cover;">
              <div>
                <small class="text-muted d-block">Current Active Backdrop</small>
                <span class="badge bg-success-subtle text-success border">WebP Optimized</span>
              </div>
            </div>
          @endif
        </div>
      </div>

      <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2 pt-3 border-top">
        <span class="rounded-circle bg-primary-subtle text-primary p-2 d-inline-flex" style="font-size: 0.9rem;"><i class="fa-solid fa-hand-pointer"></i></span>
        Call-To-Action (CTA) Button Labels
      </h5>
      <input type="hidden" name="btn_url_1" value="{{ old('btn_url_1', $slider->btn_url_1 ?? '#registration-section') }}">
      <input type="hidden" name="btn_url_2" value="{{ old('btn_url_2', $slider->btn_url_2 ?? '#openShowreelBtn') }}">
      <div class="row g-3 mb-4">
        <div class="col-md-6">
          <label class="form-label">Primary Button Text</label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-tag"></i></span>
            <input type="text" name="btn_text_1" class="form-control" value="{{ old('btn_text_1', $slider->btn_text_1) }}">
          </div>
        </div>

        <div class="col-md-6">
          <label class="form-label">Secondary Button Text</label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-play text-warning"></i></span>
            <input type="text" name="btn_text_2" class="form-control" value="{{ old('btn_text_2', $slider->btn_text_2) }}">
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
              <input class="form-check-input" type="checkbox" name="status" id="statusSwitch" {{ $slider->status ? 'checked' : '' }}>
              <label class="form-check-label fw-semibold" for="statusSwitch">Publish &amp; Activate on Homepage</label>
            </div>
          </div>
        </div>
      </div>

      <div class="d-flex gap-3 pt-3 border-top">
        <button type="submit" class="btn btn-gold-action px-5 py-2">
          <i class="fa-solid fa-save me-2"></i> Update Hero Slide
        </button>
        <a href="{{ route('admin.sliders.index') }}" class="btn btn-light border rounded-pill px-4 py-2">
          Cancel
        </a>
      </div>
    </form>
  </div>
</div>
@endsection
