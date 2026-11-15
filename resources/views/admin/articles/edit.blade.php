@extends('admin.layouts.master')

@section('title', 'Edit Article - Media Admin')

@section('content')
<div class="container-fluid p-4">
  <div class="admin-page-header">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
      <div>
        <div class="header-badge">
          <i class="fa-solid fa-pen-to-square"></i> Edit Article
        </div>
        <h3 class="fw-bold mb-1 text-white">Edit Editorial Article</h3>
        <p class="text-white-50 mb-0 small">{{ $article->title }}</p>
      </div>
      <a href="{{ route('admin.articles.index', ['type' => $article->type]) }}" class="btn btn-outline-light rounded-pill px-4">
        <i class="fa-solid fa-arrow-left me-1"></i> Back to Articles
      </a>
    </div>
  </div>

  <div class="card card-modern p-4 p-lg-5">
    <form action="{{ route('admin.articles.update', $article) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
        <span class="rounded-circle bg-warning-subtle text-warning p-2 d-inline-flex" style="font-size: 0.9rem;"><i class="fa-solid fa-heading"></i></span>
        Article Details &amp; Category
      </h5>
      <div class="row g-3 mb-4">
        <div class="col-md-8">
          <label class="form-label">Article Headline <span class="text-danger">*</span></label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-heading"></i></span>
            <input type="text" name="title" class="form-control" required value="{{ old('title', $article->title) }}">
          </div>
        </div>

        <div class="col-md-4">
          <label class="form-label">Editorial Category</label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-layer-group"></i></span>
            <select name="type" class="form-select">
              <option value="director" {{ old('type', $article->type) === 'director' ? 'selected' : '' }}>Director &amp; Producer's Diary</option>
              <option value="artist" {{ old('type', $article->type) === 'artist' ? 'selected' : '' }}>Artist &amp; Actor's Diary</option>
              <option value="opinion" {{ old('type', $article->type) === 'opinion' ? 'selected' : '' }}>Official Editorial Opinion</option>
            </select>
          </div>
        </div>

        <div class="col-md-6">
          <label class="form-label">Author Name <span class="text-danger">*</span></label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-user-pen"></i></span>
            <input type="text" name="author_name" class="form-control" required value="{{ old('author_name', $article->author_name) }}">
          </div>
        </div>

        <div class="col-md-6">
          <label class="form-label">Author Role / Designation</label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-id-card"></i></span>
            <input type="text" name="author_role" class="form-control" value="{{ old('author_role', $article->author_role) }}">
          </div>
        </div>

        <div class="col-md-6">
          <label class="form-label d-flex align-items-center justify-content-between">
            <span>Change Author Avatar</span>
            <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-2 py-1">
              <i class="fa-solid fa-ruler-combined me-1"></i> 300 &times; 300 px (1:1)
            </span>
          </label>
          <div class="file-dropzone">
            <input type="file" name="author_image" accept="image/*">
            <div class="dropzone-icon">
              <i class="fa-solid fa-cloud-arrow-up"></i>
            </div>
            <div class="dropzone-title">Click to upload new author headshot</div>
            <div class="dropzone-subtitle">Recommended: <strong>300 &times; 300 px</strong> (Square) &bull; WebP</div>
            <div class="preview-wrapper d-none"></div>
          </div>
          @if($article->author_image)
            <div class="d-flex align-items-center gap-2 mt-2 p-2 bg-light rounded-3 border" style="max-width: 240px;">
              <img src="{{ asset($article->author_image) }}" class="rounded-circle shadow-xs" width="46" height="46" style="object-fit: cover;">
              <small class="text-muted">Current Author Photo</small>
            </div>
          @endif
        </div>

        <div class="col-md-6">
          <label class="form-label d-flex align-items-center justify-content-between">
            <span>Change Feature Cover Image</span>
            <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-2 py-1">
              <i class="fa-solid fa-ruler-combined me-1"></i> 900 &times; 500 px
            </span>
          </label>
          <div class="file-dropzone">
            <input type="file" name="image" accept="image/*">
            <div class="dropzone-icon">
              <i class="fa-solid fa-cloud-arrow-up"></i>
            </div>
            <div class="dropzone-title">Click to upload new story cover image</div>
            <div class="dropzone-subtitle">Recommended: <strong>900 &times; 500 px</strong> (Landscape) &bull; WebP</div>
            <div class="preview-wrapper d-none"></div>
          </div>
          @if($article->image)
            <div class="d-flex align-items-center gap-2 mt-2 p-2 bg-light rounded-3 border" style="max-width: 260px;">
              <img src="{{ asset($article->image) }}" class="rounded shadow-xs" width="80" height="45" style="object-fit: cover;">
              <small class="text-muted">Current Cover Image</small>
            </div>
          @endif
        </div>

        <div class="col-12">
          <label class="form-label">Full Article Story <span class="text-danger">*</span></label>
          <textarea name="content" class="form-control" rows="8" required>{{ old('content', $article->content) }}</textarea>
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
              <input class="form-check-input" type="checkbox" name="is_featured" id="featSwitch" {{ $article->is_featured ? 'checked' : '' }}>
              <label class="form-check-label fw-semibold" for="featSwitch">Featured on Homepage</label>
            </div>
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" name="status" id="statSwitch" {{ $article->status ? 'checked' : '' }}>
              <label class="form-check-label fw-semibold" for="statSwitch">Published (Active)</label>
            </div>
          </div>
        </div>
      </div>

      <div class="d-flex gap-3 pt-3 border-top">
        <button type="submit" class="btn btn-gold-action px-5 py-2">
          <i class="fa-solid fa-save me-2"></i> Update Article Story
        </button>
        <a href="{{ route('admin.articles.index', ['type' => $article->type]) }}" class="btn btn-light border rounded-pill px-4 py-2">
          Cancel
        </a>
      </div>
    </form>
  </div>
</div>
@endsection
