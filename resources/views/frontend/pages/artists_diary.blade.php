@extends('frontend.layouts.master')

@section('title', 'অভিনয়শিল্পী ডায়েরি — Mind Blowing Media')

@section('content')
<!-- ==================== SUBPAGE HERO ==================== -->
<section class="page-hero">
  <div class="page-hero-bg" style="background-image: url('{{ asset('frontend/assets/images/portfolio-casting.jpg') }}');"></div>
  <div class="container page-hero-inner">
    <div class="breadcrumb-row">
      <a href="{{ route('home') }}">হোম</a>
      <i class="fa-solid fa-chevron-right"></i>
      <span>অভিনয়শিল্পী ডাইরি</span>
    </div>
    <h1 class="page-title">অভিনয়শিল্পীদের <span class="text-gold-gradient">ব্যক্তিগত ডায়েরি ও গল্প</span></h1>
    <p class="page-sub">প্রথম অডিশনের রোমাঞ্চ, চরিত্রের প্রস্তুতি এবং শুটিং সেটের স্মৃতির পাতা।</p>
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
              <img src="{{ asset($article->image ?? 'frontend/assets/images/portfolio-casting.jpg') }}" alt="{{ $article->title }}" style="width: 100%; height: 100%; object-fit: cover;">
            </div>
            <div class="p-4 text-white">
              <span class="badge bg-info text-dark px-2 py-1 mb-2">শিল্পী ডায়েরি</span>
              <h4 class="fw-bold fs-5 mb-2">{{ $article->title }}</h4>
              <p class="text-white-50 small mb-3" style="line-height: 1.6;">{{ Str::limit($article->content, 120) }}</p>
              <hr style="border-color: rgba(255,255,255,0.1);">
              <div>
                <h6 class="mb-0 fw-bold fs-6">{{ $article->author_name }}</h6>
                <small class="text-warning">{{ $article->author_role }}</small>
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
