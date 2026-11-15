@extends('frontend.layouts.master')

@section('title', 'ক্লায়েন্ট ও শিল্পী রিভিউ — Mind Blowing Media')

@section('content')
<!-- ==================== SUBPAGE HERO ==================== -->
<section class="page-hero">
  <div class="page-hero-bg" style="background-image: url('{{ asset('frontend/assets/images/portfolio-film.jpg') }}');"></div>
  <div class="container page-hero-inner">
    <div class="breadcrumb-row">
      <a href="{{ route('home') }}">হোম</a>
      <i class="fa-solid fa-chevron-right"></i>
      <span>ক্লায়েন্ট ও শিল্পী রিভিউ</span>
    </div>
    <h1 class="page-title">যাদের আস্থায় <span class="text-gold-gradient">আমাদের পথচলা</span></h1>
    <p class="page-sub">আমাদের সেবা, কাস্টিং সহযোগিতা ও মিডিয়া প্রোডাকশন নিয়ে নির্মাতা, ক্লায়েন্ট ও শিল্পীদের অভিজ্ঞতা।</p>
  </div>
</section>

<!-- ==================== REVIEWS GRID ==================== -->
<section class="section-pad">
  <div class="container">
    <div class="row g-4">
      @forelse($reviews as $review)
        <div class="col-lg-4 col-md-6">
          <div class="h-100 p-4 rounded-4" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(212,175,55,0.2);">
            <div class="text-warning mb-3">
              @for($i = 1; $i <= $review->rating; $i++)
                <i class="fa-solid fa-star"></i>
              @endfor
            </div>
            <p class="text-white mb-4" style="line-height: 1.8; font-style: italic;">
              “{{ $review->review }}”
            </p>
            <div class="d-flex align-items-center gap-3">
              <img src="{{ asset($review->photo ?? 'frontend/assets/images/portfolio-casting.jpg') }}" class="rounded-circle" width="50" height="50" style="object-fit: cover;">
              <div>
                <h5 class="mb-0 fw-bold text-white fs-6">{{ $review->name }}</h5>
                <small class="text-warning">{{ $review->designation }}</small>
              </div>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12 py-5 text-center text-muted">
          <p>কোনো রিভিউ পাওয়া যায়নি।</p>
        </div>
      @endforelse
    </div>

    @if($reviews->hasPages())
      <div class="pagination-wrap mt-5 d-flex justify-content-center">
        {{ $reviews->links() }}
      </div>
    @endif
  </div>
</section>
@endsection
