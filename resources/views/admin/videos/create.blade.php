@extends('admin.layouts.master')

@section('title', 'Add Video - Media Admin')

@section('content')
<div class="container-fluid p-4">
  <div class="admin-page-header">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
      <div>
        <div class="header-badge">
          <i class="fa-solid fa-clapperboard"></i> New Production
        </div>
        <h3 class="fw-bold mb-1 text-white">Add Video to Portfolio</h3>
        <p class="text-white-50 mb-0 small">Embed YouTube links, upload custom thumbnails, and assign production credits</p>
      </div>
      <a href="{{ route('admin.videos.index') }}" class="btn btn-outline-light rounded-pill px-4">
        <i class="fa-solid fa-arrow-left me-1"></i> Back to Portfolio
      </a>
    </div>
  </div>

  <div class="card card-modern p-4 p-lg-5">
    <form action="{{ route('admin.videos.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
        <span class="rounded-circle bg-warning-subtle text-warning p-2 d-inline-flex" style="font-size: 0.9rem;"><i class="fa-solid fa-video"></i></span>
        Production Meta &amp; Stream URL
      </h5>
      <div class="row g-3 mb-4">
        <div class="col-md-8">
          <label class="form-label">Video Title <span class="text-danger">*</span></label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-heading"></i></span>
            <input type="text" name="title" class="form-control" required value="{{ old('title') }}" placeholder="e.g. Shadows of Tomorrow — Official 4K Teaser">
          </div>
        </div>

        <div class="col-md-4">
          <label class="form-label">Production Category</label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-film"></i></span>
            <select name="category" class="form-select">
              <option value="cinema">Cinema / Feature Film</option>
              <option value="drama">Drama / Fiction</option>
              <option value="tvc">TVC / Brand Commercial</option>
              <option value="music">Music Video</option>
              <option value="ott">OTT Web Series</option>
            </select>
          </div>
        </div>

        <div class="col-md-6">
          <label class="form-label">YouTube Video URL <span class="text-danger">*</span></label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-brands fa-youtube text-danger"></i></span>
            <input type="url" name="youtube_url" class="form-control" required placeholder="https://www.youtube.com/watch?v=..." value="{{ old('youtube_url') }}">
          </div>
        </div>

        <div class="col-md-6">
          <label class="form-label">Director</label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-user-tie"></i></span>
            <input type="text" name="director" class="form-control" placeholder="Director name" value="{{ old('director') }}">
          </div>
        </div>

        <div class="col-md-6">
          <label class="form-label">Client / Studio</label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-building"></i></span>
            <input type="text" name="client" class="form-control" placeholder="Client or production house" value="{{ old('client') }}">
          </div>
        </div>

        <div class="col-md-6">
          <label class="form-label">Video Duration</label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-regular fa-clock"></i></span>
            <input type="text" name="duration" class="form-control" placeholder="e.g. 2:45 min" value="{{ old('duration') }}">
          </div>
        </div>

        <div class="col-12">
          <label class="form-label">Custom Video Thumbnail (Drag &amp; Drop or Browse)</label>
          <div class="file-dropzone">
            <input type="file" name="thumbnail" accept="image/*">
            <div class="dropzone-icon">
              <i class="fa-solid fa-cloud-arrow-up"></i>
            </div>
            <div class="dropzone-title">Click to upload or drag &amp; drop video poster thumbnail</div>
            <div class="dropzone-subtitle">Supported formats: JPG, PNG, WebP (Converts to WebP)</div>
            <div class="preview-wrapper d-none"></div>
          </div>
        </div>
      </div>

      <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2 pt-3 border-top">
        <span class="rounded-circle bg-success-subtle text-success p-2 d-inline-flex" style="font-size: 0.9rem;"><i class="fa-solid fa-sliders"></i></span>
        Visibility Flags
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
              <label class="form-check-label fw-semibold" for="statSwitch">Active Video Release</label>
            </div>
          </div>
        </div>
      </div>

      <div class="d-flex gap-3 pt-3 border-top">
        <button type="submit" class="btn btn-gold-action px-5 py-2">
          <i class="fa-solid fa-save me-2"></i> Save Video Production
        </button>
        <a href="{{ route('admin.videos.index') }}" class="btn btn-light border rounded-pill px-4 py-2">
          Cancel
        </a>
      </div>
    </form>
  </div>
</div>
@endsection
