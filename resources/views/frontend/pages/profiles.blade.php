@extends('frontend.layouts.master')

@section('title', 'অভিনয়শিল্পী ও মডেল প্রোফাইল — Mind Blowing Media')

@section('content')
<!-- ==================== SUBPAGE HERO ==================== -->
<section class="page-hero">
  <div class="page-hero-bg" style="background-image: url('{{ asset('frontend/assets/images/portfolio-casting.jpg') }}');"></div>
  <div class="container page-hero-inner">
    <div class="breadcrumb-row">
      <a href="{{ route('home') }}">হোম</a>
      <i class="fa-solid fa-chevron-right"></i>
      <span>অভিনয়শিল্পী ও মডেল প্রোফাইল</span>
    </div>
    <h1 class="page-title">অভিনয়শিল্পী ও <span class="text-gold-gradient">মডেল ডিরেক্টরি</span></h1>
    <p class="page-sub">নাটক, সিনেমা, ওটিটি সিরিজ এবং শীর্ষস্থানীয় ব্র্যান্ডের বিজ্ঞাপনের জন্য উপযুক্ত পেশাদার ও প্রতিভাবান শিল্পীদের সম্পূর্ণ তালিকা।</p>
  </div>
</section>

<!-- ==================== PROFILES DIRECTORY ==================== -->
<section class="section-pad">
  <div class="container">
    <!-- Filter bar -->
    <div class="directory-filter-bar mb-5">
      <form action="{{ route('profiles') }}" method="GET" class="w-full d-flex flex-wrap gap-3 align-items-end">
        <div class="filter-field flex-grow-1">
          <label for="search">শিল্পীর নাম বা কি-ওয়ার্ড</label>
          <div class="input-icon-wrap">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" name="search" id="search" placeholder="নাম খুঁজুন..." value="{{ request('search') }}">
          </div>
        </div>

        <div class="filter-field">
          <label for="category">ক্যাটাগরি</label>
          <select name="category" id="category" onchange="this.form.submit()">
            <option value="">সকল ক্যাটাগরি</option>
            @foreach($categories as $cat)
              <option value="{{ $cat->slug }}" {{ request('category') === $cat->slug ? 'selected' : '' }}>{{ $cat->name }}</option>
            @endforeach
          </select>
        </div>

        <button type="submit" class="btn-gold-pill btn-sm" style="height: 48px; padding: 0 24px;">
          <i class="fa-solid fa-filter"></i> ফিল্টার
        </button>
      </form>
    </div>

    <!-- Profiles Grid -->
    <div class="directory-grid">
      @forelse($talents as $talent)
        <article class="dir-card">
          <div class="dir-card-photo">
            <img src="{{ asset($talent->photo ?? 'frontend/assets/images/portfolio-casting.jpg') }}" alt="{{ $talent->name }}">
            <span class="dir-badge"><i class="fa-solid fa-circle-check"></i> {{ $talent->category->name ?? 'শিল্পী' }}</span>
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
              data-category="{{ $talent->category->name ?? 'অভিনয়শিল্পী' }}"
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
          <i class="fa-regular fa-face-meh fs-1 text-muted d-block mb-3"></i>
          <p>আপনার ফিল্টার অনুযায়ী কোনো শিল্পী খুঁজে পাওয়া যায়নি।</p>
          <a href="{{ route('profiles') }}" class="btn-outline-gold btn-sm mt-3">সকল প্রোফাইল দেখুন</a>
        </div>
      @endforelse
    </div>

    @if($talents->hasPages())
      <div class="pagination-wrap mt-5 d-flex justify-content-center">
        {{ $talents->withQueryString()->links() }}
      </div>
    @endif
  </div>
</section>
@endsection
