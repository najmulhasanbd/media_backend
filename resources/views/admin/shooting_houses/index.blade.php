@extends('admin.layouts.master')

@section('title', 'Shooting Houses - Media Admin')

@section('content')
<div class="container-fluid p-4">
  <!-- Page Header Banner -->
  <div class="admin-page-header">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
      <div>
        <div class="header-badge">
          <i class="fa-solid fa-building"></i> Studio &amp; Locations
        </div>
        <h3 class="fw-bold mb-1 text-white">Shooting Houses &amp; Studio Locations</h3>
        <p class="text-white-50 mb-0 small">Manage filming houses, production sets, and shooting studio rental directories (Drag rows to reorder)</p>
      </div>
      <a href="{{ route('admin.shooting-houses.create') }}" class="btn btn-gold-action d-inline-flex align-items-center gap-2">
        <i class="fa-solid fa-plus"></i>
        <span>Add New House</span>
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
            <th>House Preview</th>
            <th>Name &amp; Location</th>
            <th>Daily Rental Rate</th>
            <th>Contact Phone</th>
            <th>Facilities</th>
            <th>Status</th>
            <th class="col-actions text-end pe-4">Actions</th>
          </tr>
        </thead>
        <tbody id="sortableHousesBody">
          @forelse($houses as $house)
            <tr data-id="{{ $house->id }}">
              <td class="ps-4 text-center">
                <i class="fa-solid fa-grip-vertical text-muted cursor-grab" title="Drag to reorder studio position"></i>
              </td>
              <td>
                <div class="rounded-3 overflow-hidden shadow-xs" style="width: 80px; height: 50px; background: #000;">
                  <img src="{{ asset($house->image ?? 'frontend/assets/images/hero-studio.jpg') }}" class="w-100 h-100" style="object-fit: cover;">
                </div>
              </td>
              <td>
                <div class="fw-bold text-dark fs-6">{{ $house->name }}</div>
                <small class="text-muted"><i class="fa-solid fa-location-dot text-danger me-1"></i> {{ $house->location }}</small>
              </td>
              <td>
                <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-3 py-1 rounded-pill fw-semibold">
                  {{ $house->rent ?? 'Negotiable' }}
                </span>
              </td>
              <td>
                <span class="fw-semibold text-dark"><i class="fa-solid fa-phone text-success me-1"></i> {{ $house->contact }}</span>
              </td>
              <td>
                <small class="text-muted d-block" style="max-width: 260px;">{{ Str::limit($house->facilities, 60) }}</small>
              </td>
              <td>
                @if($house->status)
                  <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1">Active</span>
                @else
                  <span class="badge bg-secondary-subtle text-secondary border rounded-pill px-3 py-1">Inactive</span>
                @endif
              </td>
              <td class="col-actions text-end pe-4">
                <div class="table-actions-group">
                  <a href="{{ route('admin.shooting-houses.edit', $house) }}" class="action-btn-circle text-primary" title="Edit Shooting House">
                    <i class="fa-solid fa-pen small"></i>
                  </a>
                  <form action="{{ route('admin.shooting-houses.destroy', $house) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="action-btn-circle text-danger confirm-delete" title="Delete Shooting House">
                      <i class="fa-solid fa-trash small"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8" class="text-center py-5 text-muted">
                <i class="fa-solid fa-building fs-1 d-block mb-2 text-secondary"></i>
                No shooting houses registered in directory.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($houses->hasPages())
      <div class="card-footer bg-white border-0 py-3 px-4">
        {{ $houses->links() }}
      </div>
    @endif
  </div>
</div>
@endsection

@push('scripts')
<script>
  $(document).ready(function() {
    initSortableTable('sortableHousesBody', '{{ route('admin.shooting-houses.reorder') }}', 'Shooting houses order updated successfully!');
  });
</script>
@endpush
