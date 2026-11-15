@extends('admin.layouts.master')

@section('title', 'Casting Calls - Media Admin')

@section('content')
<div class="container-fluid p-4">
  <!-- Page Header Banner -->
  <div class="admin-page-header">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
      <div>
        <div class="header-badge">
          <i class="fa-solid fa-bullhorn"></i> Auditions &amp; Roles
        </div>
        <h3 class="fw-bold mb-1 text-white">Casting Calls &amp; Audition Notices</h3>
        <p class="text-white-50 mb-0 small">Publish audition campaigns for cinema, television, commercials, and OTT productions (Drag rows to reorder)</p>
      </div>
      <a href="{{ route('admin.casting-calls.create') }}" class="btn btn-gold-action d-inline-flex align-items-center gap-2">
        <i class="fa-solid fa-plus"></i>
        <span>Create Casting Call</span>
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
            <th>Notice Title</th>
            <th>Project Type</th>
            <th>Target Characters</th>
            <th>Deadline</th>
            <th>Location</th>
            <th>Status</th>
            <th class="col-actions text-end pe-4">Actions</th>
          </tr>
        </thead>
        <tbody id="sortableCallsBody">
          @forelse($calls as $call)
            <tr data-id="{{ $call->id }}">
              <td class="ps-4 text-center">
                <i class="fa-solid fa-grip-vertical text-muted cursor-grab" title="Drag to reorder campaign position"></i>
              </td>
              <td>
                <div class="fw-bold text-dark fs-6">{{ $call->title }}</div>
                <small class="text-muted d-block" style="max-width: 320px;">{{ Str::limit($call->requirements, 75) }}</small>
              </td>
              <td>
                <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-1 rounded-pill fw-semibold">
                  {{ $call->project_type }}
                </span>
              </td>
              <td>
                <span class="fw-semibold text-secondary"><i class="fa-solid fa-masks-theater text-warning me-1"></i> {{ $call->roles }}</span>
              </td>
              <td>
                <span class="badge bg-light text-dark border px-2 py-1">
                  <i class="fa-regular fa-calendar-days text-muted me-1"></i> {{ $call->deadline }}
                </span>
              </td>
              <td>
                <small class="text-muted"><i class="fa-solid fa-location-dot text-danger me-1"></i> {{ $call->location }}</small>
              </td>
              <td>
                @if($call->status === 'open')
                  <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1">
                    <i class="fa-solid fa-circle-dot me-1"></i> Open
                  </span>
                @else
                  <span class="badge bg-secondary-subtle text-secondary border rounded-pill px-3 py-1">Closed</span>
                @endif
              </td>
              <td class="col-actions text-end pe-4">
                <div class="table-actions-group">
                  <a href="{{ route('admin.casting-calls.edit', $call) }}" class="action-btn-circle text-primary" title="Edit Casting Call">
                    <i class="fa-solid fa-pen small"></i>
                  </a>
                  <form action="{{ route('admin.casting-calls.destroy', $call) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="action-btn-circle text-danger confirm-delete" title="Delete Casting Call">
                      <i class="fa-solid fa-trash small"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8" class="text-center py-5 text-muted">
                <i class="fa-solid fa-bullhorn fs-1 d-block mb-2 text-secondary"></i>
                No active casting notices found.
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
  $(document).ready(function() {
    initSortableTable('sortableCallsBody', '{{ route('admin.casting-calls.reorder') }}', 'Casting calls order updated successfully!');
  });
</script>
@endpush
