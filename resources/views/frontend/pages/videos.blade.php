@extends('frontend.layouts.master')

@section('title', 'ভিডিও পোর্টফোলিও — Mind Blowing Media')

@section('content')
<!-- ==================== SUBPAGE HERO ==================== -->
<section class="page-hero">
  <div class="page-hero-bg" style="background-image: url('{{ asset('frontend/assets/images/hero-cinema.jpg') }}');"></div>
  <div class="container page-hero-inner">
    <div class="breadcrumb-row">
      <a href="{{ route('home') }}">হোম</a>
      <i class="fa-solid fa-chevron-right"></i>
      <span>ভিডিও পোর্টফোলিও</span>
    </div>
    <h1 class="page-title">আমাদের <span class="text-gold-gradient">ভিডিও প্রযোজনা ও পোর্টফোলিও</span></h1>
    <p class="page-sub">পূর্ণদৈর্ঘ্য সিনেমা, টিভি নাটক, মেগা টিভিসি বিজ্ঞাপন এবং ট্রেন্ডিং মিউজিক ভিডিওর সম্পূর্ণ ভিডিও কালেকশন।</p>
  </div>
</section>

<!-- ==================== VIDEOS GRID ==================== -->
<section class="section-pad">
  <div class="container">
    <div class="filter-pills justify-content-center mb-5" role="tablist">
      <a href="{{ route('videos') }}" class="filter-pill {{ !request()->filled('category') ? 'active' : '' }}">সবগুলো</a>
      <a href="{{ route('videos', ['category' => 'cinema']) }}" class="filter-pill {{ request('category') === 'cinema' ? 'active' : '' }}">সিনেমা</a>
      <a href="{{ route('videos', ['category' => 'drama']) }}" class="filter-pill {{ request('category') === 'drama' ? 'active' : '' }}">নাটক ও ওটিটি</a>
      <a href="{{ route('videos', ['category' => 'tvc']) }}" class="filter-pill {{ request('category') === 'tvc' ? 'active' : '' }}">বিজ্ঞাপন (TVC)</a>
      <a href="{{ route('videos', ['category' => 'music']) }}" class="filter-pill {{ request('category') === 'music' ? 'active' : '' }}">মিউজিক ভিডিও</a>
    </div>

    <div class="row g-4">
      @forelse($videos as $video)
        <div class="col-lg-4 col-md-6">
          <div class="portfolio-item-card h-100" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(212,175,55,0.2); border-radius: 16px; overflow: hidden;">
            <div class="portfolio-thumb position-relative" style="height: 220px; overflow: hidden;">
              <img src="{{ asset($video->thumbnail ?? 'frontend/assets/images/portfolio-film.jpg') }}" alt="{{ $video->title }}" style="width: 100%; height: 100%; object-fit: cover;">
              <button class="portfolio-play-btn js-play-reel position-absolute top-50 start-50 translate-middle" 
                data-title="{{ $video->title }}" 
                data-category="{{ strtoupper($video->category) }} • {{ $video->duration }}" 
                data-video="{{ $video->youtube_url }}" 
                data-poster="{{ asset($video->thumbnail) }}" 
                type="button" 
                style="background: #d4af37; color: #000; border: none; width: 55px; height: 55px; border-radius: 50%; font-size: 1.2rem; cursor: pointer;">
                <i class="fa-solid fa-play"></i>
              </button>
            </div>
            <div class="p-4">
              <span class="badge text-warning border border-warning px-2 py-1 mb-2">{{ strtoupper($video->category) }}</span>
              <h4 class="text-white fw-bold mb-2 fs-5">{{ $video->title }}</h4>
              <p class="text-muted small mb-0">
                <span>পরিচালক: <strong>{{ $video->director ?? 'মিডিয়া টিম' }}</strong></span>
                @if($video->client)
                  &bull; <span>{{ $video->client }}</span>
                @endif
              </p>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12 py-5 text-center text-muted">
          <p>এই ক্যাটাগরিতে কোনো ভিডিও পাওয়া যায়নি।</p>
        </div>
      @endforelse
    </div>

    @if($videos->hasPages())
      <div class="pagination-wrap mt-5 d-flex justify-content-center">
        {{ $videos->withQueryString()->links() }}
      </div>
    @endif
  </div>
</section>
@endsection
