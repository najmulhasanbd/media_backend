@extends('admin.layouts.master')

@section('title', 'Notice Board - Media Admin')

@section('content')
<div class="container-fluid p-4">
  <!-- Page Header Banner -->
  <div class="admin-page-header">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
      <div>
        <div class="header-badge">
          <i class="fa-solid fa-bullhorn"></i> Official Notices
        </div>
        <h3 class="fw-bold mb-1 text-white">Notice Board &amp; Announcements</h3>
        <p class="text-white-50 mb-0 small">Publish operational circulars, mega audition date changes, and company guidelines (Drag rows to reorder)</p>
      </div>
      <a href="{{ route('admin.notices.create') }}" class="btn btn-gold-action d-inline-flex align-items-center gap-2">
        <i class="fa-solid fa-plus"></i>
        <span>Post New Notice</span>
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
            <th>Priority</th>
            <th>Notice Title</th>
            <th>Publication Date</th>
            <th>Content Summary</th>
            <th>Status</th>
            <th class="text-end pe-4">Actions</th>
          </tr>
        </thead>
        <tbody id="sortableNoticesBody">
          @forelse($notices as $notice)
            <tr data-id="{{ $notice->id }}">
              <td class="ps-4 text-center">
                <i class="fa-solid fa-grip-vertical text-muted cursor-grab" title="Drag to reorder notice position"></i>
              </td>
              <td>
                @if($notice->is_pinned)
                  <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-3 py-1">
                    <i class="fa-solid fa-thumbtack me-1"></i> Pinned
                  </span>
                @else
                  <span class="badge bg-light text-muted border rounded-pill px-2 py-1">Standard</span>
                @endif
              </td>
              <td>
                <div class="fw-bold text-dark fs-6">{{ $notice->title }}</div>
              </td>
              <td>
                <span class="badge bg-light text-dark border px-2 py-1">
                  <i class="fa-regular fa-calendar me-1 text-muted"></i> {{ $notice->date }}
                </span>
              </td>
              <td>
                <small class="text-muted d-block" style="max-width: 380px;">{{ Str::limit($notice->description, 80) }}</small>
              </td>
              <td>
                @if($notice->status)
                  <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1">Active</span>
                @else
                  <span class="badge bg-secondary-subtle text-secondary border rounded-pill px-3 py-1">Inactive</span>
                @endif
              </td>
              <td class="text-end pe-4">
                <a href="{{ route('admin.notices.edit', $notice) }}" class="action-btn-circle text-primary me-1" title="Edit Notice">
                  <i class="fa-solid fa-pen small"></i>
                </a>
                <form action="{{ route('admin.notices.destroy', $notice) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="button" class="action-btn-circle text-danger confirm-delete" title="Delete Notice">
                    <i class="fa-solid fa-trash small"></i>
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="text-center py-5 text-muted">
                <i class="fa-solid fa-newspaper fs-1 d-block mb-2 text-secondary"></i>
                No notices published on board.
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
    initSortableTable('sortableNoticesBody', '{{ route('admin.notices.reorder') }}', 'Notices order updated successfully!');
  });
</script>
@endpush
