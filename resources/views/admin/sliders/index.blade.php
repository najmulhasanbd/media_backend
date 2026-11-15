@extends('admin.layouts.master')

@section('title', 'Hero Sliders - Media Admin')

@section('content')
<div class="container-fluid p-4">
  <!-- Page Header Banner -->
  <div class="admin-page-header">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
      <div>
        <div class="header-badge">
          <i class="fa-solid fa-images"></i> Homepage Hero
        </div>
        <h3 class="fw-bold mb-1 text-white">Hero Slider Management</h3>
        <p class="text-white-50 mb-0 small">Drag &amp; drop rows to reorder hero slides on the homepage in real-time</p>
      </div>
      <a href="{{ route('admin.sliders.create') }}" class="btn btn-gold-action d-inline-flex align-items-center gap-2">
        <i class="fa-solid fa-plus"></i>
        <span>Add New Slide</span>
      </a>
    </div>
  </div>

  <!-- Sliders Table Card with Drag and Drop -->
  <div class="card card-modern">
    <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center border-bottom">
      <div class="d-flex align-items-center gap-2 text-muted small">
        <i class="fa-solid fa-arrows-up-down text-warning"></i>
        <span>Drag any row using the handle <i class="fa-solid fa-grip-vertical"></i> to reorder. Changes save automatically.</span>
      </div>
      <span class="badge bg-light text-dark border px-3 py-1 rounded-pill">Total: {{ $sliders->count() }} Slides</span>
    </div>

    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0" id="sortableSliderTable">
        <thead>
          <tr>
            <th class="ps-4" style="width: 50px;">Order</th>
            <th>Backdrop Image</th>
            <th>Badge &amp; Headline</th>
            <th>CTA Buttons</th>
            <th>Status</th>
            <th class="col-actions text-end pe-4">Actions</th>
          </tr>
        </thead>
        <tbody id="sortableSliderBody">
          @forelse($sliders as $slider)
            <tr data-id="{{ $slider->id }}" class="sortable-row">
              <td class="ps-4 text-center">
                <div class="cursor-grab p-2 rounded bg-light border text-muted d-inline-flex align-items-center justify-content-center" title="Drag to reorder" style="width: 32px; height: 32px;">
                  <i class="fa-solid fa-grip-vertical text-secondary"></i>
                </div>
              </td>
              <td>
                <div class="rounded-3 overflow-hidden shadow-xs position-relative" style="width: 100px; height: 55px; background: #000;">
                  <img src="{{ asset($slider->image ?? 'frontend/assets/images/hero-cinema.jpg') }}" class="w-100 h-100" style="object-fit: cover;">
                </div>
              </td>
              <td>
                <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-2 py-1 rounded-pill mb-1">
                  {{ $slider->badge }}
                </span>
                <div class="fw-bold text-dark fs-6">{{ $slider->title }}</div>
                <small class="text-muted d-block" style="max-width: 320px;">{{ Str::limit($slider->subtitle, 65) }}</small>
              </td>
              <td>
                <div class="small fw-semibold text-dark"><i class="fa-solid fa-arrow-right text-primary me-1"></i> {{ $slider->btn_text_1 }}</div>
                @if($slider->btn_text_2)
                  <small class="text-muted"><i class="fa-solid fa-circle-play text-danger me-1"></i> {{ $slider->btn_text_2 }}</small>
                @endif
              </td>
              <td>
                @if($slider->status)
                  <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1">Active</span>
                @else
                  <span class="badge bg-secondary-subtle text-secondary border rounded-pill px-3 py-1">Inactive</span>
                @endif
              </td>
              <td class="col-actions text-end pe-4">
                <div class="table-actions-group">
                  <a href="{{ route('admin.sliders.edit', $slider) }}" class="action-btn-circle text-primary" title="Edit Slide">
                    <i class="fa-solid fa-pen small"></i>
                  </a>
                  <form action="{{ route('admin.sliders.destroy', $slider) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="action-btn-circle text-danger confirm-delete" title="Delete Slide">
                      <i class="fa-solid fa-trash small"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center py-5 text-muted">
                <i class="fa-solid fa-images fs-1 d-block mb-2 text-secondary"></i>
                No hero slides created yet.
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
    const el = document.getElementById('sortableSliderBody');
    if (el) {
      new Sortable(el, {
        handle: '.cursor-grab',
        animation: 250,
        ghostClass: 'sortable-ghost',
        onEnd: function () {
          const order = [];
          document.querySelectorAll('#sortableSliderBody tr').forEach((row) => {
            order.push(row.getAttribute('data-id'));
          });

          fetch("{{ route('admin.sliders.reorder') }}", {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ order: order })
          })
          .then(res => res.json())
          .then(data => {
            if (data.success) {
              if (window.toastr) {
                toastr.success(data.message);
              }
            }
          })
          .catch(err => console.error(err));
        }
      });
    }
  });
</script>
@endpush
