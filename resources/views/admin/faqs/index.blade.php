@extends('admin.layouts.master')

@section('title', 'FAQs - Media Admin')

@section('content')
<div class="container-fluid p-4">
  <!-- Page Header Banner -->
  <div class="admin-page-header">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
      <div>
        <div class="header-badge">
          <i class="fa-solid fa-circle-question"></i> Questions &amp; Answers
        </div>
        <h3 class="fw-bold mb-1 text-white">Frequently Asked Questions (FAQ)</h3>
        <p class="text-white-50 mb-0 small">Manage homepage FAQ accordion items (Drag rows to reorder positions)</p>
      </div>
      <a href="{{ route('admin.faqs.create') }}" class="btn btn-gold-action d-inline-flex align-items-center gap-2">
        <i class="fa-solid fa-plus"></i>
        <span>Add New FAQ</span>
      </a>
    </div>
  </div>

  <!-- Table Card -->
  <div class="card card-modern">
    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead>
          <tr>
            <th style="width: 50px;" class="ps-4 text-center">Move</th>
            <th>Question</th>
            <th>Answer</th>
            <th>Status</th>
            <th class="text-end pe-4">Actions</th>
          </tr>
        </thead>
        <tbody id="sortableFaqsBody">
          @forelse($faqs as $faq)
            <tr data-id="{{ $faq->id }}">
              <td class="ps-4 text-center">
                <i class="fa-solid fa-grip-vertical text-muted cursor-grab" title="Drag to reorder position"></i>
              </td>
              <td>
                <div class="fw-bold text-dark fs-6">{{ $faq->question }}</div>
              </td>
              <td>
                <div class="text-muted small" style="max-width: 480px;">{{ Str::limit($faq->answer, 110) }}</div>
              </td>
              <td>
                @if($faq->status)
                  <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1">Active</span>
                @else
                  <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-3 py-1">Inactive</span>
                @endif
              </td>
              <td class="text-end pe-4">
                <div class="d-inline-flex align-items-center gap-2">
                  <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn btn-action-edit" title="Edit FAQ">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </a>
                  <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this FAQ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-action-delete" title="Delete FAQ">
                      <i class="fa-solid fa-trash-can"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="py-5 text-center text-muted">
                <div class="py-4">
                  <i class="fa-solid fa-circle-question fs-1 text-muted opacity-50 mb-3 d-block"></i>
                  <h5 class="fw-bold">No FAQs added yet</h5>
                  <p class="small text-muted mb-3">Add questions and answers to show in the homepage FAQ accordion.</p>
                  <a href="{{ route('admin.faqs.create') }}" class="btn btn-gold-action btn-sm">
                    <i class="fa-solid fa-plus me-1"></i> Add First FAQ
                  </a>
                </div>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    window.initSortableTable('sortableFaqsBody', '{{ route("admin.faqs.reorder") }}');
  });
</script>
@endpush
