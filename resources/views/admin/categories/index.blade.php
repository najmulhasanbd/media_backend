@extends('admin.layouts.master')

@section('title', 'Categories - Media Admin')

@section('content')
<div class="container-fluid p-4">
  <div class="admin-page-header">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
      <div>
        <div class="header-badge">
          <i class="fa-solid fa-layer-group"></i> Talent Divisions
        </div>
        <h3 class="fw-bold mb-1 text-white">Categories Management</h3>
        <p class="text-white-50 mb-0 small">Manage artist &amp; talent categories displayed in the registration form and directory</p>
      </div>
      <a href="{{ route('admin.categories.create') }}" class="btn btn-gold-action d-inline-flex align-items-center gap-2">
        <i class="fa-solid fa-plus"></i>
        <span>Add Category</span>
      </a>
    </div>
  </div>

  <div class="card card-modern">
    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead>
          <tr>
            <th class="ps-4">#</th>
            <th>Category Name</th>
            <th>Slug Identifier</th>
            <th>Division Type</th>
            <th>Total Talents</th>
            <th>Status</th>
            <th class="text-end pe-4">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($categories as $category)
            <tr>
              <td class="ps-4 text-muted fw-semibold">{{ $loop->iteration }}</td>
              <td>
                <div class="fw-bold text-dark fs-6">{{ $category->name }}</div>
              </td>
              <td>
                <code>{{ $category->slug }}</code>
              </td>
              <td>
                <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-1">
                  {{ ucfirst($category->type ?? 'Talent') }}
                </span>
              </td>
              <td>
                <span class="badge bg-light text-dark border px-3 py-1">
                  <i class="fa-solid fa-users me-1 text-warning"></i> {{ $category->talents_count }} Artists
                </span>
              </td>
              <td>
                @if($category->status)
                  <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1">Active</span>
                @else
                  <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-3 py-1">Inactive</span>
                @endif
              </td>
              <td class="text-end pe-4">
                <div class="d-inline-flex align-items-center gap-2">
                  <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-action-edit" title="Edit Category">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </a>
                  <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-action-delete" title="Delete Category">
                      <i class="fa-solid fa-trash-can"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="py-5 text-center text-muted">
                <div class="py-4">
                  <i class="fa-solid fa-layer-group fs-1 text-muted opacity-50 mb-3 d-block"></i>
                  <h5 class="fw-bold">No categories created yet</h5>
                  <p class="small text-muted mb-3">Add categories (e.g. অভিনেতা, অভিনেত্রী, মডেল, শিশুশিল্পী) to populate forms dynamically.</p>
                  <a href="{{ route('admin.categories.create') }}" class="btn btn-gold-action btn-sm">
                    <i class="fa-solid fa-plus me-1"></i> Add First Category
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
