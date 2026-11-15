@extends('admin.layouts.master')

@section('title', 'Edit FAQ - Media Admin')

@section('content')
<div class="container-fluid p-4">
  <div class="admin-page-header">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
      <div>
        <div class="header-badge">
          <i class="fa-solid fa-pen-to-square"></i> Update FAQ
        </div>
        <h3 class="fw-bold mb-1 text-white">Edit FAQ Item</h3>
        <p class="text-white-50 mb-0 small">Update question wording or answer description</p>
      </div>
      <a href="{{ route('admin.faqs.index') }}" class="btn btn-outline-light rounded-pill px-4">
        <i class="fa-solid fa-arrow-left me-1"></i> Back to FAQs
      </a>
    </div>
  </div>

  <div class="card card-modern p-4 p-lg-5">
    <form action="{{ route('admin.faqs.update', $faq) }}" method="POST">
      @csrf
      @method('PUT')

      <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
        <span class="rounded-circle bg-warning-subtle text-warning p-2 d-inline-flex" style="font-size: 0.9rem;"><i class="fa-solid fa-question"></i></span>
        Question &amp; Answer
      </h5>
      <div class="row g-3 mb-4">
        <div class="col-12">
          <label class="form-label">Question <span class="text-danger">*</span></label>
          <div class="input-group-modern">
            <span class="input-group-text"><i class="fa-solid fa-circle-question"></i></span>
            <input type="text" name="question" class="form-control" required value="{{ old('question', $faq->question) }}">
          </div>
        </div>

        <div class="col-12">
          <label class="form-label">Answer <span class="text-danger">*</span></label>
          <textarea name="answer" class="form-control" rows="5" required>{{ old('answer', $faq->answer) }}</textarea>
        </div>
      </div>

      <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2 pt-3 border-top">
        <span class="rounded-circle bg-success-subtle text-success p-2 d-inline-flex" style="font-size: 0.9rem;"><i class="fa-solid fa-toggle-on"></i></span>
        Display Status
      </h5>
      <div class="row g-3 mb-4">
        <div class="col-12">
          <div class="form-check form-switch custom-switch-gold">
            <input class="form-check-input" type="checkbox" name="status" id="statusSwitch" value="1" {{ old('status', $faq->status) ? 'checked' : '' }}>
            <label class="form-check-label fw-semibold text-dark" for="statusSwitch">Published on homepage FAQ accordion</label>
          </div>
        </div>
      </div>

      <div class="d-flex justify-content-end gap-3 pt-3 border-top">
        <a href="{{ route('admin.faqs.index') }}" class="btn btn-light rounded-pill px-4">Cancel</a>
        <button type="submit" class="btn btn-gold-action px-5">
          <i class="fa-solid fa-check me-1"></i> Update FAQ
        </button>
      </div>
    </form>
  </div>
</div>
@endsection
