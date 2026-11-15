@extends('admin.layouts.master')

@section('title', 'Write Article - Media Admin')

@section('content')
<div class="container-fluid p-4">
  <div class="admin-page-header">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
      <div>
        <div class="header-badge">
          <i class="fa-solid fa-pen-nib"></i> New Publication
        </div>
        <h3 class="fw-bold mb-1 text-white">Write Diary or Editorial Article</h3>
        <p class="text-white-50 mb-0 small">Publish stories from directors, artists, or editorial opinions on the frontend</p>
      </div>
      <a href="{{ route('admin.articles.index') }}" class="btn btn-outline-light rounded-pill px-4">
        <i class="fa-solid fa-arrow-left me-1"></i> Back to Articles
      </a>
    </div>
  </div>

  <div class="card card-modern p-4 p-lg-5">
    <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
        <span class="rounded-circle bg-warning-subtle text-warning p-2 d-inline-flex" style="font-size: 0.9rem;"><i class="fa-solid fa-heading"></i></span>
        Article Details &amp; Category
      </h5>
      <div class="row g-3 mb-4">
        <div class="col-md-8">
          <label class="form-label">Article Headline <span class="text-danger">*</span></label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-heading"></i></span>
            <input type="text" name="title" class="form-control" required value="{{ old('title') }}" placeholder="e.g. Navigating Cinema Cinematography in the Modern OTT Era">
          </div>
        </div>

        <div class="col-md-4">
          <label class="form-label">Editorial Category</label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-layer-group"></i></span>
            <select name="type" class="form-select">
              <option value="director" {{ $selectedType === 'director' ? 'selected' : '' }}>Director &amp; Producer's Diary</option>
              <option value="artist" {{ $selectedType === 'artist' ? 'selected' : '' }}>Artist &amp; Actor's Diary</option>
              <option value="opinion" {{ $selectedType === 'opinion' ? 'selected' : '' }}>Official Editorial Opinion</option>
            </select>
          </div>
        </div>

        <div class="col-md-6">
          <label class="form-label">Author Name <span class="text-danger">*</span></label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-user-pen"></i></span>
            <input type="text" name="author_name" class="form-control" required value="{{ old('author_name') }}" placeholder="e.g. Ashfaque Nipun">
          </div>
        </div>

        <div class="col-md-6">
          <label class="form-label">Author Role / Designation</label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-id-card"></i></span>
            <input type="text" name="author_role" class="form-control" placeholder="e.g. Filmmaker &amp; Director" value="{{ old('author_role') }}">
          </div>
        </div>

        <div class="col-md-6">
          <label class="form-label">Author Avatar Photo (Drag &amp; Drop or Browse)</label>
          <div class="file-dropzone">
            <input type="file" name="author_image" accept="image/*">
            <div class="dropzone-icon">
              <i class="fa-solid fa-cloud-arrow-up"></i>
            </div>
            <div class="dropzone-title">Upload author profile photo</div>
            <div class="dropzone-subtitle">Square headshot (Converts to WebP)</div>
            <div class="preview-wrapper d-none"></div>
          </div>
        </div>

        <div class="col-md-6">
          <label class="form-label">Article Feature Cover Image (Drag &amp; Drop or Browse)</label>
          <div class="file-dropzone">
            <input type="file" name="image" accept="image/*">
            <div class="dropzone-icon">
              <i class="fa-solid fa-cloud-arrow-up"></i>
            </div>
            <div class="dropzone-title">Upload article cover picture</div>
            <div class="dropzone-subtitle">Landscape aspect ratio (Converts to WebP)</div>
            <div class="preview-wrapper d-none"></div>
          </div>
        </div>

        <div class="col-12">
          <label class="form-label">Full Article Story <span class="text-danger">*</span></label>
          <textarea name="content" class="form-control" rows="8" required placeholder="Write the full editorial text, insights, thoughts, and industry analysis...">{{ old('content') }}</textarea>
        </div>
      </div>

      <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2 pt-3 border-top">
        <span class="rounded-circle bg-success-subtle text-success p-2 d-inline-flex" style="font-size: 0.9rem;"><i class="fa-solid fa-sliders"></i></span>
        Publication Flags
      </h5>
      <div class="row g-3 mb-4">
        <div class="col-12">
          <div class="d-flex gap-4 p-3 bg-light rounded-3 border">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" name="is_featured" id="featSwitch">
              <label class="form-check-label fw-semibold" for="featSwitch">Featured on Homepage</label>
            </div>
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" name="status" id="statSwitch" checked>
              <label class="form-check-label fw-semibold" for="statSwitch">Publish Immediately</label>
            </div>
          </div>
        </div>
      </div>

      <div class="d-flex gap-3 pt-3 border-top">
        <button type="submit" class="btn btn-gold-action px-5 py-2">
          <i class="fa-solid fa-save me-2"></i> Publish Article Story
        </button>
        <a href="{{ route('admin.articles.index') }}" class="btn btn-light border rounded-pill px-4 py-2">
          Cancel
        </a>
      </div>
    </form>
  </div>
</div>
@endsection
