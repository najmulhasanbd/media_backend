@extends('admin.layouts.master')

@section('title', 'Reviews & Testimonials - Media Admin')

@section('content')
<div class="container-fluid p-4">
  <!-- Page Header Banner -->
  <div class="admin-page-header">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
      <div>
        <div class="header-badge">
          <i class="fa-solid fa-star"></i> Testimonials
        </div>
        <h3 class="fw-bold mb-1 text-white">Client &amp; Collaborator Reviews</h3>
        <p class="text-white-50 mb-0 small">Curate testimonials and star ratings from film directors, celebrity actors, and corporate brands (Drag rows to reorder)</p>
      </div>
      <a href="{{ route('admin.reviews.create') }}" class="btn btn-gold-action d-inline-flex align-items-center gap-2">
        <i class="fa-solid fa-plus"></i>
        <span>Add New Review</span>
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
            <th>Reviewer</th>
            <th>Designation</th>
            <th>Star Rating</th>
            <th>Testimonial Statement</th>
            <th>Featured</th>
            <th>Status</th>
            <th class="col-actions text-end pe-4">Actions</th>
          </tr>
        </thead>
        <tbody id="sortableReviewsBody">
          @forelse($reviews as $review)
            <tr data-id="{{ $review->id }}">
              <td class="ps-4 text-center">
                <i class="fa-solid fa-grip-vertical text-muted cursor-grab" title="Drag to reorder review position"></i>
              </td>
              <td>
                <div class="d-flex align-items-center gap-3">
                  <img src="{{ asset($review->photo ?? 'frontend/assets/images/portfolio-casting.jpg') }}" class="rounded-circle shadow-xs" width="46" height="46" style="object-fit: cover;">
                  <div class="fw-bold text-dark fs-6">{{ $review->name }}</div>
                </div>
              </td>
              <td>
                <span class="text-secondary fw-semibold">{{ $review->designation ?? 'Filmmaker / Client' }}</span>
              </td>
              <td>
                <div class="text-warning small">
                  @for($i = 1; $i <= $review->rating; $i++)
                    <i class="fa-solid fa-star"></i>
                  @endfor
                </div>
              </td>
              <td>
                <small class="text-muted d-block" style="max-width: 340px;">{{ Str::limit($review->review, 80) }}</small>
              </td>
              <td>
                @if($review->is_featured)
                  <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle rounded-pill px-2 py-1">
                    <i class="fa-solid fa-star me-1"></i> Featured
                  </span>
                @else
                  <span class="text-muted small">Standard</span>
                @endif
              </td>
              <td>
                @if($review->status)
                  <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1">Active</span>
                @else
                  <span class="badge bg-secondary-subtle text-secondary border rounded-pill px-3 py-1">Inactive</span>
                @endif
              </td>
              <td class="col-actions text-end pe-4">
                <div class="table-actions-group">
                  <a href="{{ route('admin.reviews.edit', $review) }}" class="action-btn-circle text-primary" title="Edit Review">
                    <i class="fa-solid fa-pen small"></i>
                  </a>
                  <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="action-btn-circle text-danger confirm-delete" title="Delete Review">
                      <i class="fa-solid fa-trash small"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8" class="text-center py-5 text-muted">
                <i class="fa-solid fa-star fs-1 d-block mb-2 text-secondary"></i>
                No client reviews registered yet.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($reviews->hasPages())
      <div class="card-footer bg-white border-0 py-3 px-4">
        {{ $reviews->links() }}
      </div>
    @endif
  </div>
</div>
@endsection

@push('scripts')
<script>
  $(document).ready(function() {
    initSortableTable('sortableReviewsBody', '{{ route('admin.reviews.reorder') }}', 'Reviews order updated successfully!');
  });
</script>
@endpush
