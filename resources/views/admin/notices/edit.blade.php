@extends('admin.layouts.master')

@section('title', 'Edit Notice - Media Admin')

@section('content')
<div class="container-fluid p-4">
  <div class="admin-page-header">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
      <div>
        <div class="header-badge">
          <i class="fa-solid fa-pen-to-square"></i> Edit Circular
        </div>
        <h3 class="fw-bold mb-1 text-white">Edit Official Notice</h3>
        <p class="text-white-50 mb-0 small">{{ $notice->title }}</p>
      </div>
      <a href="{{ route('admin.notices.index') }}" class="btn btn-outline-light rounded-pill px-4">
        <i class="fa-solid fa-arrow-left me-1"></i> Back to Notices
      </a>
    </div>
  </div>

  <div class="card card-modern p-4 p-lg-5">
    <form action="{{ route('admin.notices.update', $notice) }}" method="POST">
      @csrf
      @method('PUT')

      <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
        <span class="rounded-circle bg-warning-subtle text-warning p-2 d-inline-flex" style="font-size: 0.9rem;"><i class="fa-solid fa-scroll"></i></span>
        Circular Subject &amp; Date
      </h5>
      <div class="row g-3 mb-4">
        <div class="col-md-8">
          <label class="form-label">Notice Headline <span class="text-danger">*</span></label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-newspaper"></i></span>
            <input type="text" name="title" class="form-control" required value="{{ old('title', $notice->title) }}">
          </div>
        </div>

        <div class="col-md-4">
          <label class="form-label">Display Date Text</label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-calendar-day"></i></span>
            <input type="text" name="date" class="form-control" value="{{ old('date', $notice->date) }}">
          </div>
        </div>

        <div class="col-12">
          <label class="form-label">Full Circular Description <span class="text-danger">*</span></label>
          <textarea name="description" class="form-control" rows="6" required>{{ old('description', $notice->description) }}</textarea>
        </div>
      </div>

      <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2 pt-3 border-top">
        <span class="rounded-circle bg-success-subtle text-success p-2 d-inline-flex" style="font-size: 0.9rem;"><i class="fa-solid fa-sliders"></i></span>
        Priority &amp; Status
      </h5>
      <div class="row g-3 mb-4">
        <div class="col-12">
          <div class="d-flex gap-4 p-3 bg-light rounded-3 border">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" name="is_pinned" id="pinSwitch" {{ $notice->is_pinned ? 'checked' : '' }}>
              <label class="form-check-label fw-semibold" for="pinSwitch">Pin to Top of Notice Board</label>
            </div>
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" name="status" id="statSwitch" {{ $notice->status ? 'checked' : '' }}>
              <label class="form-check-label fw-semibold" for="statSwitch">Publish Immediately</label>
            </div>
          </div>
        </div>
      </div>

      <div class="d-flex gap-3 pt-3 border-top">
        <button type="submit" class="btn btn-gold-action px-5 py-2">
          <i class="fa-solid fa-save me-2"></i> Update Notice
        </button>
        <a href="{{ route('admin.notices.index') }}" class="btn btn-light border rounded-pill px-4 py-2">
          Cancel
        </a>
      </div>
    </form>
  </div>
</div>
@endsection
