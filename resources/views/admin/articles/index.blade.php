@extends('admin.layouts.master')

@section('title', 'Diaries & Opinions - Media Admin')

@section('content')
<div class="container-fluid p-4">
  <!-- Page Header Banner -->
  <div class="admin-page-header">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
      <div>
        <div class="header-badge">
          <i class="fa-solid fa-book-open"></i> Editorial Stories
        </div>
        <h3 class="fw-bold mb-1 text-white">Diaries &amp; Editorial Opinions</h3>
        <p class="text-white-50 mb-0 small">Publish insights from film directors, celebrity actors, and official editorial opinion pieces (Drag rows to reorder)</p>
      </div>
      <div class="d-flex flex-wrap gap-2">
        <div class="btn-group bg-white bg-opacity-10 p-1 rounded-pill">
          <a href="{{ route('admin.articles.index') }}" class="btn btn-sm rounded-pill {{ !request()->filled('type') ? 'btn-light fw-bold text-dark' : 'text-white' }}">All</a>
          <a href="{{ route('admin.articles.index', ['type' => 'director']) }}" class="btn btn-sm rounded-pill {{ request()->input('type') === 'director' ? 'btn-warning text-dark fw-bold' : 'text-white' }}">Director's Diary</a>
          <a href="{{ route('admin.articles.index', ['type' => 'artist']) }}" class="btn btn-sm rounded-pill {{ request()->input('type') === 'artist' ? 'btn-warning text-dark fw-bold' : 'text-white' }}">Artist's Diary</a>
          <a href="{{ route('admin.articles.index', ['type' => 'opinion']) }}" class="btn btn-sm rounded-pill {{ request()->input('type') === 'opinion' ? 'btn-warning text-dark fw-bold' : 'text-white' }}">Opinions</a>
        </div>
        <a href="{{ route('admin.articles.create', ['type' => request()->type ?? 'director']) }}" class="btn btn-gold-action d-inline-flex align-items-center gap-2">
          <i class="fa-solid fa-plus"></i>
          <span>Write New Article</span>
        </a>
      </div>
    </div>
  </div>

  <!-- Articles Table Card -->
  <div class="card card-modern">
    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead>
          <tr>
            <th style="width: 50px;" class="ps-4 text-center">Move</th>
            <th>Article Story</th>
            <th>Category</th>
            <th>Author &amp; Role</th>
            <th>Publication Date</th>
            <th>Featured</th>
            <th>Status</th>
            <th class="text-end pe-4">Actions</th>
          </tr>
        </thead>
        <tbody id="sortableArticlesBody">
          @forelse($articles as $article)
            <tr data-id="{{ $article->id }}">
              <td class="ps-4 text-center">
                <i class="fa-solid fa-grip-vertical text-muted cursor-grab" title="Drag to reorder story position"></i>
              </td>
              <td>
                <div class="d-flex align-items-center gap-3">
                  <div class="rounded-3 overflow-hidden shadow-xs" style="width: 75px; height: 50px; background: #000;">
                    <img src="{{ asset($article->image ?? 'frontend/assets/images/portfolio-film.jpg') }}" class="w-100 h-100" style="object-fit: cover;">
                  </div>
                  <div>
                    <div class="fw-bold text-dark fs-6">{{ $article->title }}</div>
                    <small class="text-muted d-block" style="max-width: 300px;">{{ Str::limit($article->content, 60) }}</small>
                  </div>
                </div>
              </td>
              <td>
                @if($article->type === 'director')
                  <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-1 rounded-pill fw-semibold">
                    Director's Diary
                  </span>
                @elseif($article->type === 'artist')
                  <span class="badge bg-info-subtle text-info-emphasis border border-info-subtle px-3 py-1 rounded-pill fw-semibold">
                    Artist's Diary
                  </span>
                @else
                  <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-3 py-1 rounded-pill fw-semibold">
                    Editorial Opinion
                  </span>
                @endif
              </td>
              <td>
                <div class="fw-semibold text-dark">{{ $article->author_name }}</div>
                <small class="text-muted">{{ $article->author_role ?? 'Writer' }}</small>
              </td>
              <td>
                <small class="text-muted"><i class="fa-regular fa-calendar me-1"></i> {{ $article->created_at->format('d M, Y') }}</small>
              </td>
              <td>
                @if($article->is_featured)
                  <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle rounded-pill px-2 py-1">
                    <i class="fa-solid fa-star me-1"></i> Featured
                  </span>
                @else
                  <span class="text-muted small">Standard</span>
                @endif
              </td>
              <td>
                @if($article->status)
                  <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1">Published</span>
                @else
                  <span class="badge bg-secondary-subtle text-secondary border rounded-pill px-3 py-1">Draft</span>
                @endif
              </td>
              <td class="text-end pe-4">
                <a href="{{ route('admin.articles.edit', $article) }}" class="action-btn-circle text-primary me-1" title="Edit Article">
                  <i class="fa-solid fa-pen small"></i>
                </a>
                <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="button" class="action-btn-circle text-danger confirm-delete" title="Delete Article">
                    <i class="fa-solid fa-trash small"></i>
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8" class="text-center py-5 text-muted">
                <i class="fa-solid fa-book-open fs-1 d-block mb-2 text-secondary"></i>
                No editorial articles found in this category.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($articles->hasPages())
      <div class="card-footer bg-white border-0 py-3 px-4">
        {{ $articles->links() }}
      </div>
    @endif
  </div>
</div>
@endsection

@push('scripts')
<script>
  $(document).ready(function() {
    initSortableTable('sortableArticlesBody', '{{ route('admin.articles.reorder') }}', 'Articles order updated successfully!');
  });
</script>
@endpush
