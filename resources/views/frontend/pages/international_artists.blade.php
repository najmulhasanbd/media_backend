@extends('frontend.layouts.master')

@section('title', 'বিদেশি অভিনয়শিল্পী — Mind Blowing Media')

@section('content')
<!-- ==================== SUBPAGE HERO ==================== -->
<section class="page-hero">
  <div class="page-hero-bg" style="background-image: url('{{ asset('frontend/assets/images/portfolio-film.jpg') }}');"></div>
  <div class="container page-hero-inner">
    <div class="breadcrumb-row">
      <a href="{{ route('home') }}">হোম</a>
      <i class="fa-solid fa-chevron-right"></i>
      <span>বিদেশি অভিনয়শিল্পী</span>
    </div>
    <h1 class="page-title">আন্তর্জাতিক <span class="text-gold-gradient">ট্যালেন্ট ও বিদেশি শিল্পী</span></h1>
    <p class="page-sub">যৌথ প্রযোজনা, আন্তর্জাতিক বিজ্ঞাপন ক্যাম্পেইন ও রানওয়ে মডেলিংয়ের জন্য নির্ভরযোগ্য গ্লোবাল আর্টিস্ট রোস্টার।</p>
  </div>
</section>

<!-- ==================== PROFILES DIRECTORY ==================== -->
<section class="section-pad">
  <div class="container">
    <div class="directory-grid">
      @forelse($talents as $talent)
        <article class="dir-card">
          <div class="dir-card-photo">
            <img src="{{ asset($talent->photo ?? 'frontend/assets/images/portfolio-casting.jpg') }}" alt="{{ $talent->name }}">
            <span class="dir-badge"><i class="fa-solid fa-globe"></i> আন্তর্জাতিক শিল্পী</span>
          </div>
          <div class="dir-card-body">
            <h3 class="dir-name">{{ $talent->name }}</h3>
            <p class="dir-specialty">{{ $talent->specialty }}</p>
            <div class="dir-meta-row">
              <span>বয়স: <strong>{{ $talent->age }}</strong></span>
              <span>উচ্চতা: <strong>{{ $talent->height }}</strong></span>
              <span>অভিজ্ঞতা: <strong>{{ $talent->experience }}</strong></span>
            </div>
            <button class="btn-outline-gold btn-sm w-full js-open-talent-modal" 
              data-name="{{ $talent->name }}"
              data-category="আন্তর্জাতিক শিল্পী"
              data-specialty="{{ $talent->specialty }}"
              data-age="{{ $talent->age }}"
              data-height="{{ $talent->height }}"
              data-experience="{{ $talent->experience }}"
              data-photo="{{ asset($talent->photo ?? 'frontend/assets/images/portfolio-casting.jpg') }}"
              data-bio="{{ $talent->bio }}"
              data-audition="{{ $talent->audition_url }}"
              data-drive="{{ $talent->portfolio_url }}"
              type="button">
              <i class="fa-solid fa-circle-play"></i> <span>প্রোফাইল ও অডিশন দেখুন</span>
            </button>
          </div>
        </article>
      @empty
        <div class="directory-empty w-full py-5 text-center">
          <p>বর্তমানে কোনো বিদেশি শিল্পী তালিকাভুক্ত নেই।</p>
        </div>
      @endforelse
    </div>

    @if($talents->hasPages())
      <div class="pagination-wrap mt-5 d-flex justify-content-center">
        {{ $talents->links() }}
      </div>
    @endif
  </div>
</section>
@endsection
