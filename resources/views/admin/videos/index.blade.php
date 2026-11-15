@extends('admin.layouts.master')

@section('title', 'Video Portfolio - Media Admin')

@section('content')
<div class="container-fluid p-4">
  <!-- Page Header Banner -->
  <div class="admin-page-header">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
      <div>
        <div class="header-badge">
          <i class="fa-solid fa-clapperboard"></i> Film &amp; Visuals
        </div>
        <h3 class="fw-bold mb-1 text-white">Video Portfolio Management</h3>
        <p class="text-white-50 mb-0 small">Showcase 4K film trailers, television commercials, drama serials, and music video releases (Drag rows to reorder)</p>
      </div>
      <a href="{{ route('admin.videos.create') }}" class="btn btn-gold-action d-inline-flex align-items-center gap-2">
        <i class="fa-solid fa-plus"></i>
        <span>Add New Video</span>
      </a>
    </div>
  </div>

  <!-- Video Portfolio Table Card -->
  <div class="card card-modern">
    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead>
          <tr>
            <th style="width: 50px;" class="ps-4 text-center">Move</th>
            <th>Video Production</th>
            <th>Category</th>
            <th>Director &amp; Client</th>
            <th>Duration</th>
            <th>Featured</th>
            <th>Status</th>
            <th class="text-end pe-4">Actions</th>
          </tr>
        </thead>
        <tbody id="sortableVideosBody">
          @forelse($videos as $video)
            <tr data-id="{{ $video->id }}">
              <td class="ps-4 text-center">
                <i class="fa-solid fa-grip-vertical text-muted cursor-grab" title="Drag to reorder video position"></i>
              </td>
              <td>
                <div class="d-flex align-items-center gap-3">
                  <div class="position-relative rounded-3 overflow-hidden shadow-xs" style="width: 80px; height: 50px; background: #000;">
                    <img src="{{ asset($video->thumbnail ?? 'frontend/assets/images/portfolio-film.jpg') }}" class="w-100 h-100" style="object-fit: cover;">
                    <a href="{{ $video->youtube_url }}" target="_blank" class="position-absolute top-50 start-50 translate-middle text-white small" title="Watch on YouTube">
                      <i class="fa-brands fa-youtube fs-5 text-danger"></i>
                    </a>
                  </div>
                  <div>
                    <div class="fw-bold text-dark fs-6">{{ $video->title }}</div>
                    <small class="text-muted"><a href="{{ $video->youtube_url }}" target="_blank" class="text-decoration-none text-secondary"><i class="fa-solid fa-arrow-up-right-from-square small me-1"></i> Watch Video</a></small>
                  </div>
                </div>
              </td>
              <td>
                <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-1 rounded-pill fw-semibold">
                  {{ strtoupper($video->category) }}
                </span>
              </td>
              <td>
                <div class="fw-semibold text-dark">{{ $video->director ?? '-' }}</div>
                <small class="text-muted">{{ $video->client ?? 'Mind Blowing Media' }}</small>
              </td>
              <td>
                <span class="badge bg-light text-dark border px-2 py-1">
                  <i class="fa-regular fa-clock me-1 text-muted"></i> {{ $video->duration ?? '4K HDR' }}
                </span>
              </td>
              <td>
                @if($video->is_featured)
                  <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle rounded-pill px-2 py-1">
                    <i class="fa-solid fa-star me-1"></i> Featured
                  </span>
                @else
                  <span class="text-muted small">Standard</span>
                @endif
              </td>
              <td>
                @if($video->status)
                  <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1">Active</span>
                @else
                  <span class="badge bg-secondary-subtle text-secondary border rounded-pill px-3 py-1">Inactive</span>
                @endif
              </td>
              <td class="text-end pe-4">
                <a href="{{ route('admin.videos.edit', $video) }}" class="action-btn-circle text-primary me-1" title="Edit Video">
                  <i class="fa-solid fa-pen small"></i>
                </a>
                <form action="{{ route('admin.videos.destroy', $video) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="button" class="action-btn-circle text-danger confirm-delete" title="Delete Video">
                    <i class="fa-solid fa-trash small"></i>
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8" class="text-center py-5 text-muted">
                <i class="fa-solid fa-film fs-1 d-block mb-2 text-secondary"></i>
                No video productions found in portfolio.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($videos->hasPages())
      <div class="card-footer bg-white border-0 py-3 px-4">
        {{ $videos->links() }}
      </div>
    @endif
  </div>
</div>
@endsection

@push('scripts')
<script>
  $(document).ready(function() {
    initSortableTable('sortableVideosBody', '{{ route('admin.videos.reorder') }}', 'Videos order updated successfully!');
  });
</script>
@endpush
