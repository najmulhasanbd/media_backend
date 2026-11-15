@extends('frontend.layouts.master')

@section('title', 'পরিচালক ও প্রযোজক ডায়েরি — Mind Blowing Media')

@section('content')
<!-- ==================== SUBPAGE HERO ==================== -->
<section class="page-hero">
  <div class="page-hero-bg" style="background-image: url('{{ asset('frontend/assets/images/portfolio-film.jpg') }}');"></div>
  <div class="container page-hero-inner">
    <div class="breadcrumb-row">
      <a href="{{ route('home') }}">হোম</a>
      <i class="fa-solid fa-chevron-right"></i>
      <span>পরিচালক ও প্রযোজক ডায়েরি</span>
    </div>
    <h1 class="page-title">পরিচালক ও <span class="text-gold-gradient">প্রযোজকদের ডায়েরি</span></h1>
    <p class="page-sub">চলচ্চিত্র ও নাটক পরিচালনার নেপথ্যের গল্প, কাস্টিং অভিজ্ঞতা ও কারিগরি ভাবনা।</p>
  </div>
</section>

<!-- ==================== ARTICLES GRID ==================== -->
<section class="section-pad">
  <div class="container">
    <div class="row g-4">
      @forelse($articles as $article)
        <div class="col-lg-4 col-md-6">
          <article class="h-100 rounded-4 overflow-hidden" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(212,175,55,0.2);">
            <div style="height: 200px; overflow: hidden;">
              <img src="{{ asset($article->image ?? 'frontend/assets/images/portfolio-film.jpg') }}" alt="{{ $article->title }}" style="width: 100%; height: 100%; object-fit: cover;">
            </div>
            <div class="p-4 text-white">
              <span class="badge bg-warning text-dark px-2 py-1 mb-2">পরিচালক ডায়েরি</span>
              <h4 class="fw-bold fs-5 mb-2">{{ $article->title }}</h4>
              <p class="text-white-50 small mb-3" style="line-height: 1.6;">{{ Str::limit($article->content, 120) }}</p>
              <hr style="border-color: rgba(255,255,255,0.1);">
              <div class="d-flex align-items-center gap-2">
                <div>
                  <h6 class="mb-0 fw-bold fs-6">{{ $article->author_name }}</h6>
                  <small class="text-warning">{{ $article->author_role }}</small>
                </div>
              </div>
            </div>
          </article>
        </div>
      @empty
        <div class="col-12 py-5 text-center text-muted">
          <p>কোনো ডায়েরি পাওয়া যায়নি।</p>
        </div>
      @endforelse
    </div>

    @if($articles->hasPages())
      <div class="pagination-wrap mt-5 d-flex justify-content-center">
        {{ $articles->links() }}
      </div>
    @endif
  </div>
</section>
@endsection
