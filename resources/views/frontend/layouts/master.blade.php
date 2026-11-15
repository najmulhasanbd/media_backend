<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" type="image/x-icon" href="{{ \App\Models\Setting::get('site_favicon') ? asset(\App\Models\Setting::get('site_favicon')) : asset('favicon.ico') }}" />
  <title>@yield('title', 'Mind Blowing Media — মিডিয়া, প্রোডাকশন ও কাস্টিং পোর্টফোলিও')</title>
  <meta name="description" content="@yield('meta_description', 'নাটক, সিনেমা, ওয়েব সিরিজ ও বিজ্ঞাপনের প্রিমিয়ার মিডিয়া পোর্টফোলিও এবং কাস্টিং প্ল্যাটফর্ম।')" />

  <!-- Google Fonts: Hind Siliguri (Bengali) + Plus Jakarta Sans + Cinzel + Oswald -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800&family=Hind+Siliguri:wght@300;400;500;600;700&family=Oswald:wght@500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

  <!-- Swiper, Fancybox & Lenis CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lenis@1.1.14/dist/lenis.css" />

  <!-- HubSpot Odometer CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/odometer.js/0.4.8/themes/odometer-theme-default.min.css" />

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

  <!-- Custom Stylesheet -->
  <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}" />

  @stack('styles')
</head>
<body>

  <!-- Top Ambient Film Grain & Spotlight Glow -->
  <div class="ambient-glow ambient-glow-1" aria-hidden="true"></div>
  <div class="ambient-glow ambient-glow-2" aria-hidden="true"></div>

  <!-- Header -->
  @include('frontend.layouts.header')

  <!-- Main Content -->
  @yield('content')

  <!-- Footer -->
  @include('frontend.layouts.footer')

  <!-- ==================== SHOWREEL / VIDEO PLAYER MODAL ==================== -->
  <div class="modal-backdrop" id="reelModal" aria-hidden="true">
    <div class="modal-dialog modal-video">
      <div class="reel-modal-topbar">
        <span class="reel-title"><i class="fa-solid fa-film"></i> মাইন্ড ব্লোয়িং মিডিয়া — অফিশিয়াল শো-রিল ২০২৬</span>
        <button class="modal-close" data-close-modal="reelModal" type="button" aria-label="Close Showreel">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>
      <div class="video-embed-ratio">
        <iframe
          id="showreelIframe"
          src=""
          data-video-src="{{ \App\Models\Setting::get('showreel_url', 'https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1&enablejsapi=1') }}"
          title="Showreel Player"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
          allowfullscreen>
        </iframe>
      </div>
    </div>
  </div>

  <!-- ==================== TALENT PROFILE & AUDITION MODAL ==================== -->
  <div class="modal-backdrop" id="talentDetailModal" aria-hidden="true">
    <div class="modal-dialog modal-talent">
      <button class="modal-close" data-close-modal="talentDetailModal" type="button" aria-label="Close Modal">
        <i class="fa-solid fa-xmark"></i>
      </button>
      <div class="talent-modal-layout">
        <div class="talent-modal-photo">
          <img id="tmPhoto" src="{{ asset('frontend/assets/images/portfolio-casting.jpg') }}" alt="Artist Photo" />
          <span class="talent-verified" id="tmBadge"><i class="fa-solid fa-circle-check"></i> ভেরিফাইড</span>
        </div>
        <div class="talent-modal-body">
          <span class="eyebrow" id="tmCategory">অভিনেতা</span>
          <h3 id="tmName">আরিফুর রহমান</h3>
          <p class="tm-specialty" id="tmSpecialty">রোমান্টিক ও ড্রামা লিড রোল</p>

          <div class="tm-specs">
            <div><span>বয়স</span><strong id="tmAge">28 বছর</strong></div>
            <div><span>উচ্চতা</span><strong id="tmHeight">5' 10"</strong></div>
            <div><span>অভিজ্ঞতা</span><strong id="tmExperience">৪ বছর</strong></div>
          </div>

          <p class="tm-bio" id="tmBio">অভিজ্ঞতার বিস্তারিত বিবরণ এখানে দেখা যাবে।</p>

          <div class="tm-actions">
            <button class="btn-gold-pill" id="tmWatchAuditionBtn" type="button">
              <i class="fa-solid fa-circle-play"></i>
              <span>অডিশন রিল দেখুন</span>
            </button>
            <a class="btn-outline-gold" id="tmDriveLink" href="#registration-section" target="_blank" rel="noopener">
              <i class="fa-brands fa-google-drive"></i>
              <span>পোর্টফোলিও লিংক</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Laravel Custom Toastr Component -->
  <x-custom-toastr position="top-right" duration="5000" />

  <!-- SweetAlert2 CDN -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Reusable Frontend SweetAlert Helper -->
  <script>
    window.showAlert = function(type, title, message) {
      Swal.fire({
        icon: type,
        title: title,
        text: message
      });
    };
  </script>

  <!-- Scripts: GSAP 3.13 + ScrollTrigger + ScrambleText + Lenis + Swiper + Fancybox + Odometer + Main JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.13.0/gsap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.13.0/ScrollTrigger.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.13.0/ScrambleTextPlugin.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/lenis@1.1.14/dist/lenis.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/odometer.js/0.4.8/odometer.min.js"></script>
  <script src="{{ asset('frontend/assets/js/main.js') }}"></script>

  @stack('scripts')
</body>
</html>
