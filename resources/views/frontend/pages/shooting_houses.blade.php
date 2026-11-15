@extends('frontend.layouts.master')

@section('title', 'শুটিং হাউজ ও লোকেশন — Mind Blowing Media')

@section('content')
<!-- ==================== SUBPAGE HERO ==================== -->
<section class="page-hero">
  <div class="page-hero-bg" style="background-image: url('{{ asset('frontend/assets/images/hero-studio.jpg') }}');"></div>
  <div class="container page-hero-inner">
    <div class="breadcrumb-row">
      <a href="{{ route('home') }}">হোম</a>
      <i class="fa-solid fa-chevron-right"></i>
      <span>শুটিং হাউজ</span>
    </div>
    <h1 class="page-title">প্রিমিয়াম <span class="text-gold-gradient">শুটিং হাউজ ও লোকেশন</span></h1>
    <p class="page-sub">নাটক, সিনেমা ও বিজ্ঞাপনের শুটিংয়ের জন্য এসি মেকআপ রুম, জেনারেটর ব্যাকআপ ও রাজকীয় পরিবেশ সম্পন্ন শুটিং স্পট।</p>
  </div>
</section>

<!-- ==================== SHOOTING HOUSES GRID ==================== -->
<section class="section-pad">
  <div class="container">
    <div class="row g-4">
      @forelse($houses as $house)
        <div class="col-lg-4 col-md-6">
          <div class="card border-0 h-100" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(212,175,55,0.2) !important; border-radius: 16px; overflow: hidden;">
            <div style="height: 230px; overflow: hidden;">
              <img src="{{ asset($house->image ?? 'frontend/assets/images/hero-studio.jpg') }}" alt="{{ $house->name }}" style="width: 100%; height: 100%; object-fit: cover;">
            </div>
            <div class="card-body p-4 text-white">
              <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="badge bg-warning text-dark px-3 py-1 fw-bold">{{ $house->rent ?? 'ভাড়া জানতে কল করুন' }}</span>
                <small class="text-white-50"><i class="fa-solid fa-phone me-1 text-warning"></i> {{ $house->contact }}</small>
              </div>
              <h4 class="fw-bold fs-5 mb-1 text-white">{{ $house->name }}</h4>
              <p class="text-warning small mb-3"><i class="fa-solid fa-location-dot me-1"></i> {{ $house->location }}</p>
              
              <div class="p-3 rounded-3 mb-3" style="background: rgba(255,255,255,0.05); font-size: 0.85rem;">
                <strong class="d-block text-gold-gradient mb-1">সুযোগ-সুবিধাসমূহ:</strong>
                {{ $house->facilities }}
              </div>

              <p class="text-white-50 small mb-0">{{ Str::limit($house->description, 100) }}</p>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12 py-5 text-center text-muted">
          <p>কোনো শুটিং হাউজ পাওয়া যায়নি।</p>
        </div>
      @endforelse
    </div>

    @if($houses->hasPages())
      <div class="pagination-wrap mt-5 d-flex justify-content-center">
        {{ $houses->links() }}
      </div>
    @endif
  </div>
</section>
@endsection
