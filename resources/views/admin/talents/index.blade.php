@extends('admin.layouts.master')

@section('title', 'Talents Directory - Media Admin')

@section('content')
<div class="container-fluid p-4">
  <!-- Page Header Banner -->
  <div class="admin-page-header">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
      <div>
        <div class="header-badge">
          <i class="fa-solid fa-user-astronaut"></i> Talent Roster
        </div>
        <h3 class="fw-bold mb-1 text-white">Talents &amp; Artists Directory</h3>
        <p class="text-white-50 mb-0 small">Manage actors, models, and international performers enrolled in the casting roster (Drag rows to reorder)</p>
      </div>
      <div class="d-flex flex-wrap align-items-center gap-2">
        <div class="btn-group bg-white bg-opacity-10 p-1 rounded-pill">
          <a href="{{ route('admin.talents.index') }}" class="btn btn-sm rounded-pill {{ !request()->filled('type') ? 'btn-light fw-bold text-dark' : 'text-white' }}">All Artists</a>
          <a href="{{ route('admin.talents.index', ['type' => 'international']) }}" class="btn btn-sm rounded-pill {{ request()->input('type') === 'international' ? 'btn-warning text-dark fw-bold' : 'text-white' }}">
            <i class="fa-solid fa-earth-americas me-1"></i> International
          </a>
        </div>
        <a href="{{ route('admin.talents.create') }}" class="btn btn-gold-action d-inline-flex align-items-center gap-2">
          <i class="fa-solid fa-plus"></i>
          <span>Add New Talent</span>
        </a>
      </div>
    </div>
  </div>

  <!-- Talents Table Card -->
  <div class="card card-modern">
    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead>
          <tr>
            <th style="width: 50px;" class="ps-4 text-center">Move</th>
            <th>Artist Profile</th>
            <th>Specialty Role</th>
            <th>Category</th>
            <th>Age &amp; Height</th>
            <th>Experience</th>
            <th>Verified</th>
            <th class="col-actions text-end pe-4">Actions</th>
          </tr>
        </thead>
        <tbody id="sortableTalentsBody">
          @forelse($talents as $talent)
            <tr data-id="{{ $talent->id }}">
              <td class="ps-4 text-center">
                <i class="fa-solid fa-grip-vertical text-muted cursor-grab" title="Drag to reorder artist display position"></i>
              </td>
              <td>
                <div class="d-flex align-items-center gap-3">
                  <img src="{{ asset($talent->photo ?? 'frontend/assets/images/portfolio-casting.jpg') }}" class="rounded-circle shadow-xs" width="48" height="48" style="object-fit: cover;">
                  <div>
                    <div class="fw-bold text-dark d-flex align-items-center gap-1">
                      {{ $talent->name }}
                      @if($talent->is_international)
                        <span class="badge bg-info-subtle text-info-emphasis border border-info-subtle rounded-pill small" style="font-size: 0.65rem;">Global</span>
                      @endif
                    </div>
                    <small class="text-muted">{{ $talent->gender ?? 'N/A' }}</small>
                  </div>
                </div>
              </td>
              <td>
                <span class="fw-semibold text-secondary">{{ $talent->specialty ?? 'General Actor' }}</span>
              </td>
              <td>
                <span class="badge bg-light text-dark border px-3 py-1 rounded-pill">
                  {{ $talent->category->name ?? 'Talent' }}
                </span>
              </td>
              <td>
                <div class="small fw-semibold text-dark">{{ $talent->age ?? '-' }}</div>
                <small class="text-muted">{{ $talent->height ?? '-' }}</small>
              </td>
              <td>
                <span class="badge bg-secondary-subtle text-secondary px-2 py-1 rounded">
                  <i class="fa-solid fa-briefcase me-1 small"></i>{{ $talent->experience ?? '-' }}
                </span>
              </td>
              <td>
                @if($talent->is_verified)
                  <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">
                    <i class="fa-solid fa-circle-check me-1"></i> Verified
                  </span>
                @else
                  <span class="badge bg-light text-muted border rounded-pill">Standard</span>
                @endif
              </td>
              <td class="col-actions text-end pe-4">
                <div class="table-actions-group">
                  <a href="{{ route('admin.talents.edit', $talent) }}" class="action-btn-circle text-primary" title="Edit Talent">
                    <i class="fa-solid fa-pen small"></i>
                  </a>
                  <form action="{{ route('admin.talents.destroy', $talent) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="action-btn-circle text-danger confirm-delete" title="Delete Talent">
                      <i class="fa-solid fa-trash small"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8" class="text-center py-5 text-muted">
                <i class="fa-solid fa-user-slash fs-1 d-block mb-2 text-secondary"></i>
                No talent profiles found in directory.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($talents->hasPages())
      <div class="card-footer bg-white border-0 py-3 px-4">
        {{ $talents->links() }}
      </div>
    @endif
  </div>
</div>
@endsection

@push('scripts')
<script>
  $(document).ready(function() {
    initSortableTable('sortableTalentsBody', '{{ route('admin.talents.reorder') }}', 'Talents order updated successfully!');
  });
</script>
@endpush
