@extends('admin.layouts.master')

@section('title', 'Add New Talent - Media Admin')

@section('content')
<div class="container-fluid p-4">
  <div class="admin-page-header">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
      <div>
        <div class="header-badge">
          <i class="fa-solid fa-user-plus"></i> New Performer
        </div>
        <h3 class="fw-bold mb-1 text-white">Add New Artist / Model Profile</h3>
        <p class="text-white-50 mb-0 small">Enroll a new performer into the casting database</p>
      </div>
      <a href="{{ route('admin.talents.index') }}" class="btn btn-outline-light rounded-pill px-4">
        <i class="fa-solid fa-arrow-left me-1"></i> Back to Roster
      </a>
    </div>
  </div>

  <div class="card card-modern p-4 p-lg-5">
    <form action="{{ route('admin.talents.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <!-- Section 1: Basic Identity -->
      <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
        <span class="rounded-circle bg-warning-subtle text-warning p-2 d-inline-flex" style="font-size: 0.9rem;"><i class="fa-solid fa-id-badge"></i></span>
        Identity &amp; Classification
      </h5>
      <div class="row g-3 mb-4">
        <div class="col-md-6">
          <label class="form-label">Full Artist Name <span class="text-danger">*</span></label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-signature"></i></span>
            <input type="text" name="name" class="form-control" required value="{{ old('name') }}" placeholder="e.g. Shakib Al Hasan">
          </div>
        </div>

        <div class="col-md-6">
          <label class="form-label">Category / Division</label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-layer-group"></i></span>
            <select name="category_id" class="form-select">
              <option value="">-- Select Category --</option>
              @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="col-md-6">
          <label class="form-label">Specialty Role / Acting Profile</label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-masks-theater"></i></span>
            <input type="text" name="specialty" class="form-control" placeholder="e.g. Lead Romantic Hero, Commercial Model" value="{{ old('specialty') }}">
          </div>
        </div>

        <div class="col-md-6">
          <label class="form-label">Gender</label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-venus-mars"></i></span>
            <select name="gender" class="form-select">
              <option value="Male" {{ old('gender') === 'Male' ? 'selected' : '' }}>Male</option>
              <option value="Female" {{ old('gender') === 'Female' ? 'selected' : '' }}>Female</option>
              <option value="Other" {{ old('gender') === 'Other' ? 'selected' : '' }}>Other</option>
            </select>
          </div>
        </div>
      </div>

      <!-- Section 2: Physical Attributes -->
      <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2 pt-3 border-top">
        <span class="rounded-circle bg-primary-subtle text-primary p-2 d-inline-flex" style="font-size: 0.9rem;"><i class="fa-solid fa-ruler-vertical"></i></span>
        Physical Stats &amp; Experience
      </h5>
      <div class="row g-3 mb-4">
        <div class="col-md-4">
          <label class="form-label">Age</label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-cake-candles"></i></span>
            <input type="text" name="age" class="form-control" placeholder="e.g. 26 Years" value="{{ old('age') }}">
          </div>
        </div>

        <div class="col-md-4">
          <label class="form-label">Height</label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-arrows-up-down"></i></span>
            <input type="text" name="height" class="form-control" placeholder="e.g. 5' 11&quot;" value="{{ old('height') }}">
          </div>
        </div>

        <div class="col-md-4">
          <label class="form-label">Experience Duration</label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-briefcase"></i></span>
            <input type="text" name="experience" class="form-control" placeholder="e.g. 4 Years" value="{{ old('experience') }}">
          </div>
        </div>
      </div>

      <!-- Section 3: Showreel & Portfolio -->
      <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2 pt-3 border-top">
        <span class="rounded-circle bg-danger-subtle text-danger p-2 d-inline-flex" style="font-size: 0.9rem;"><i class="fa-solid fa-video"></i></span>
        Media &amp; Portfolio Links
      </h5>
      <div class="row g-3 mb-4">
        <div class="col-md-6">
          <label class="form-label">Audition Reel URL (YouTube / Vimeo)</label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-brands fa-youtube text-danger"></i></span>
            <input type="url" name="audition_url" class="form-control" placeholder="https://youtube.com/watch?v=..." value="{{ old('audition_url') }}">
          </div>
        </div>

        <div class="col-md-6">
          <label class="form-label">Portfolio URL (Google Drive / Website)</label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-folder-open text-primary"></i></span>
            <input type="url" name="portfolio_url" class="form-control" placeholder="https://drive.google.com/..." value="{{ old('portfolio_url') }}">
          </div>
        </div>

        <div class="col-12">
          <label class="form-label">Profile Headshot Photo (Drag &amp; Drop or Browse)</label>
          <div class="file-dropzone">
            <input type="file" name="photo" accept="image/*">
            <div class="dropzone-icon">
              <i class="fa-solid fa-cloud-arrow-up"></i>
            </div>
            <div class="dropzone-title">Click to upload or drag &amp; drop talent headshot here</div>
            <div class="dropzone-subtitle">Supported formats: JPG, PNG, WebP (Automatically converted to WebP)</div>
            <div class="preview-wrapper d-none"></div>
          </div>
        </div>

        <div class="col-12">
          <label class="form-label">Biography &amp; Notable Works (Bio)</label>
          <textarea name="bio" class="form-control" rows="4" placeholder="Detail the artist's background, past projects, dialogue strengths, and achievements...">{{ old('bio') }}</textarea>
        </div>
      </div>

      <!-- Section 4: Settings & Switches -->
      <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2 pt-3 border-top">
        <span class="rounded-circle bg-success-subtle text-success p-2 d-inline-flex" style="font-size: 0.9rem;"><i class="fa-solid fa-sliders"></i></span>
        Profile Status &amp; Flags
      </h5>
      <div class="row g-3 mb-4">
        <div class="col-12">
          <div class="d-flex flex-wrap gap-4 p-3 bg-light rounded-3 border">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" name="is_international" id="intlSwitch">
              <label class="form-check-label fw-semibold" for="intlSwitch">International Artist</label>
            </div>

            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" name="is_verified" id="verSwitch" checked>
              <label class="form-check-label fw-semibold" for="verSwitch">Verified Badge</label>
            </div>

            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" name="is_featured" id="featSwitch" checked>
              <label class="form-check-label fw-semibold" for="featSwitch">Featured on Homepage</label>
            </div>

            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" name="status" id="statSwitch" checked>
              <label class="form-check-label fw-semibold" for="statSwitch">Active Profile</label>
            </div>
          </div>
        </div>
      </div>

      <div class="d-flex gap-3 pt-3 border-top">
        <button type="submit" class="btn btn-gold-action px-5 py-2">
          <i class="fa-solid fa-save me-2"></i> Save Talent Profile
        </button>
        <a href="{{ route('admin.talents.index') }}" class="btn btn-light border rounded-pill px-4 py-2">
          Cancel
        </a>
      </div>
    </form>
  </div>
</div>
@endsection
