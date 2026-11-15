@extends('admin.layouts.master')

@section('title', 'Add Category - Media Admin')

@section('content')
<div class="container-fluid p-4">
  <div class="admin-page-header">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
      <div>
        <div class="header-badge">
          <i class="fa-solid fa-layer-group"></i> New Category
        </div>
        <h3 class="fw-bold mb-1 text-white">Create Talent Category</h3>
        <p class="text-white-50 mb-0 small">Add a category to populate the frontend registration form dropdown dynamically</p>
      </div>
      <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-light rounded-pill px-4">
        <i class="fa-solid fa-arrow-left me-1"></i> Back to Categories
      </a>
    </div>
  </div>

  <div class="card card-modern p-4 p-lg-5">
    <form action="{{ route('admin.categories.store') }}" method="POST">
      @csrf

      <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
        <span class="rounded-circle bg-warning-subtle text-warning p-2 d-inline-flex" style="font-size: 0.9rem;"><i class="fa-solid fa-tag"></i></span>
        Category Information
      </h5>
      <div class="row g-3 mb-4">
        <div class="col-md-6">
          <label class="form-label">Category Name <span class="text-danger">*</span></label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-font"></i></span>
            <input type="text" name="name" class="form-control" required value="{{ old('name') }}" placeholder="e.g. অভিনেতা, অভিনেত্রী, মডেল, শিশুশিল্পী">
          </div>
        </div>

        <div class="col-md-6">
          <label class="form-label">Slug / URL Key (Optional)</label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-link"></i></span>
            <input type="text" name="slug" class="form-control" value="{{ old('slug') }}" placeholder="e.g. actor, actress, model (auto-generated if empty)">
          </div>
        </div>

        <div class="col-md-6">
          <label class="form-label">Division Type</label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-sitemap"></i></span>
            <select name="type" class="form-select">
              <option value="talent" {{ old('type', 'talent') === 'talent' ? 'selected' : '' }}>Talent / Artist</option>
              <option value="video" {{ old('type') === 'video' ? 'selected' : '' }}>Video Portfolio</option>
              <option value="article" {{ old('type') === 'article' ? 'selected' : '' }}>Article / Diary</option>
            </select>
          </div>
        </div>
      </div>

      <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2 pt-3 border-top">
        <span class="rounded-circle bg-success-subtle text-success p-2 d-inline-flex" style="font-size: 0.9rem;"><i class="fa-solid fa-toggle-on"></i></span>
        Display Status
      </h5>
      <div class="row g-3 mb-4">
        <div class="col-12">
          <div class="form-check form-switch custom-switch-gold">
            <input class="form-check-input" type="checkbox" name="status" id="statusSwitch" value="1" {{ old('status', true) ? 'checked' : '' }}>
            <label class="form-check-label fw-semibold text-dark" for="statusSwitch">Active (Show in registration dropdown and filters)</label>
          </div>
        </div>
      </div>

      <div class="d-flex justify-content-end gap-3 pt-3 border-top">
        <a href="{{ route('admin.categories.index') }}" class="btn btn-light rounded-pill px-4">Cancel</a>
        <button type="submit" class="btn btn-gold-action px-5">
          <i class="fa-solid fa-check me-1"></i> Save Category
        </button>
      </div>
    </form>
  </div>
</div>
@endsection
