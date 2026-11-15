<!-- ==================== NAVBAR ==================== -->
<header class="navbar" id="navbar">
  <div class="container nav-inner">
    <a href="{{ route('home') }}" class="brand" aria-label="Mind Blowing Media Home">
      <span class="brand-logo-badge"><img src="{{ \App\Models\Setting::get('site_logo') ? asset(\App\Models\Setting::get('site_logo')) : asset('frontend/assets/images/logo.jpg') }}" alt="Mind Blowing Media Logo" /></span>
      <span class="brand-text">
        <span class="brand-title"><span class="brand-word-blue">Mind</span> <span class="brand-word-orange">Blowing</span> <span class="brand-word-media">MEDIA</span></span>
        <span class="brand-sub">CASTING &amp; MEDIA HOUSE</span>
      </span>
    </a>

    <nav class="nav-links" id="navLinks" aria-label="Primary Navigation">
      <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">হোম</a>

      <div class="nav-dropdown">
        <button class="nav-link nav-dropdown-toggle {{ request()->routeIs('profiles', 'international.artists') ? 'active' : '' }}" type="button" aria-expanded="false">
          <span>প্রোফাইল</span><i class="fa-solid fa-chevron-down"></i>
        </button>
        <div class="nav-dropdown-menu">
          <a href="{{ route('profiles') }}" class="nav-dropdown-item"><i class="fa-solid fa-users"></i> অভিনয়শিল্পী ও মডেল প্রোফাইল</a>
          <a href="{{ route('international.artists') }}" class="nav-dropdown-item"><i class="fa-solid fa-globe"></i> বিদেশি অভিনয়শিল্পী</a>
        </div>
      </div>

      <div class="nav-dropdown">
        <button class="nav-link nav-dropdown-toggle {{ request()->routeIs('videos', 'shooting.houses') ? 'active' : '' }}" type="button" aria-expanded="false">
          <span>মিডিয়া ও স্টুডিও</span><i class="fa-solid fa-chevron-down"></i>
        </button>
        <div class="nav-dropdown-menu">
          <a href="{{ route('videos') }}" class="nav-dropdown-item"><i class="fa-solid fa-clapperboard"></i> ভিডিও পোর্টফোলিও</a>
          <a href="{{ route('shooting.houses') }}" class="nav-dropdown-item"><i class="fa-solid fa-building"></i> শুটিং হাউজ</a>
        </div>
      </div>

      <div class="nav-dropdown">
        <button class="nav-link nav-dropdown-toggle {{ request()->routeIs('notices', 'directors.diary', 'artists.diary') ? 'active' : '' }}" type="button" aria-expanded="false">
          <span>ডায়েরি ও নোটিশ</span><i class="fa-solid fa-chevron-down"></i>
        </button>
        <div class="nav-dropdown-menu">
          <a href="{{ route('notices') }}" class="nav-dropdown-item"><i class="fa-solid fa-bullhorn"></i> নোটিশ বোর্ড</a>
          <a href="{{ route('directors.diary') }}" class="nav-dropdown-item"><i class="fa-solid fa-film"></i> পরিচালক ও প্রযোজক ডায়েরি</a>
          <a href="{{ route('artists.diary') }}" class="nav-dropdown-item"><i class="fa-solid fa-book-open"></i> অভিনয়শিল্পী ডাইরি</a>
        </div>
      </div>

      <div class="nav-dropdown">
        <button class="nav-link nav-dropdown-toggle {{ request()->routeIs('opinions', 'reviews') ? 'active' : '' }}" type="button" aria-expanded="false">
          <span>মতামত</span><i class="fa-solid fa-chevron-down"></i>
        </button>
        <div class="nav-dropdown-menu">
          <a href="{{ route('opinions') }}" class="nav-dropdown-item"><i class="fa-solid fa-pen-nib"></i> আমাদের মতামত</a>
          <a href="{{ route('reviews') }}" class="nav-dropdown-item"><i class="fa-solid fa-star"></i> ক্লায়েন্ট ও শিল্পী রিভিউ</a>
        </div>
      </div>

      <a href="{{ route('home') }}#registration-section" class="nav-link">আবেদন করুন</a>
    </nav>

    <div class="nav-actions">
      <button class="btn-outline-gold hidden-sm" id="openShowreelBtn" type="button">
        <i class="fa-solid fa-play"></i>
        <span>শো-রিল</span>
      </button>
      <a href="{{ route('home') }}#registration-section" class="btn-gold-pill">
        <i class="fa-solid fa-circle-plus"></i>
        <span>প্রোফাইল জমা দিন</span>
      </a>
      <button class="mobile-toggle" id="mobileToggle" type="button" aria-label="Toggle Menu">
        <i class="fa-solid fa-bars"></i>
      </button>
    </div>
  </div>
</header>
