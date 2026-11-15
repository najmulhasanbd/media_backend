@extends('frontend.layouts.master')

@section('title', 'নোটিশ বোর্ড — Mind Blowing Media')

@section('content')
<!-- ==================== SUBPAGE HERO ==================== -->
<section class="page-hero">
  <div class="page-hero-bg" style="background-image: url('{{ asset('frontend/assets/images/portfolio-music.jpg') }}');"></div>
  <div class="container page-hero-inner">
    <div class="breadcrumb-row">
      <a href="{{ route('home') }}">হোম</a>
      <i class="fa-solid fa-chevron-right"></i>
      <span>নোটিশ বোর্ড</span>
    </div>
    <h1 class="page-title">অফিসিয়াল <span class="text-gold-gradient">নোটিশ ও বিজ্ঞপ্তি বোর্ড</span></h1>
    <p class="page-sub">কাস্টিং আপডেট, অডিশন শিডিউল পরিবর্তন এবং জরুরি অফিশিয়াল নোটিশসমূহ।</p>
  </div>
</section>

<!-- ==================== NOTICES LIST ==================== -->
<section class="section-pad">
  <div class="container" style="max-width: 900px;">
    <div class="d-flex flex-column gap-4">
      @forelse($notices as $notice)
        <article class="p-4 rounded-4" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(212,175,55,{{ $notice->is_pinned ? '0.6' : '0.2' }}); position: relative;">
          @if($notice->is_pinned)
            <span class="badge bg-danger position-absolute top-0 end-0 m-3 px-3 py-2"><i class="fa-solid fa-thumbtack me-1"></i> জরুরি পিন নোটিশ</span>
          @endif
          <div class="text-warning small mb-2"><i class="fa-regular fa-calendar-days me-1"></i> {{ $notice->date }}</div>
          <h3 class="text-white fw-bold mb-3 fs-5">{{ $notice->title }}</h3>
          <p class="text-white-50 mb-0" style="line-height: 1.8;">{{ $notice->description }}</p>
        </article>
      @empty
        <div class="py-5 text-center text-muted">
          <p>বর্তমানে কোনো নোটিশ নেই।</p>
        </div>
      @endforelse
    </div>

    @if($notices->hasPages())
      <div class="pagination-wrap mt-5 d-flex justify-content-center">
        {{ $notices->links() }}
      </div>
    @endif
  </div>
</section>
@endsection
