@extends('frontend.layouts.master')

@section('title', 'Mind Blowing Media — মিডিয়া, প্রোডাকশন ও কাস্টিং পোর্টফোলিও')

@section('content')
  @if($heroSliders->isNotEmpty())
  <!-- ==================== HERO SECTION (SLIDER #1 + THUMBS) ==================== -->
  <section class="hero-section" id="hero">
    <div class="swiper hero-swiper" id="heroSlider">
      <div class="swiper-wrapper">
        @foreach($heroSliders as $index => $slider)
          <div class="swiper-slide hero-slide">
            <div class="hero-bg" style="background-image: url('{{ $slider->image ? asset($slider->image) : asset('frontend/assets/images/hero-cinema.jpg') }}');"></div>
            <div class="hero-overlay"></div>
            <div class="container hero-content">
              @if(!empty($slider->badge))
                <div class="hero-badge">
                  <i class="fa-solid fa-star"></i>
                  <span>{{ $slider->badge }}</span>
                </div>
              @endif

              <h1 class="hero-title">
                {!! $slider->title !!}
              </h1>

              @if(!empty($slider->subtitle))
                <p class="hero-desc">
                  {{ $slider->subtitle }}
                </p>
              @endif

              <div class="hero-cta-row">
                @if(!empty($slider->btn_text_1))
                  <a href="{{ $slider->btn_url_1 ?: '#portfolio-section' }}" class="btn-gold-pill btn-lg">
                    <i class="fa-solid fa-film"></i>
                    <span>{{ $slider->btn_text_1 }}</span>
                  </a>
                @endif

                @if(!empty($slider->btn_text_2))
                  @php
                    $isReel = empty($slider->btn_url_2) || $slider->btn_url_2 === '#openShowreelBtn' || str_contains($slider->btn_url_2, 'youtube.com') || str_contains($slider->btn_url_2, 'youtu.be') || str_contains($slider->btn_url_2, '.mp4');
                    $videoUrl = (str_contains($slider->btn_url_2 ?? '', 'youtube.com') || str_contains($slider->btn_url_2 ?? '', 'youtu.be') || str_contains($slider->btn_url_2 ?? '', '.mp4'))
                      ? $slider->btn_url_2
                      : ($settings['showreel_url'] ?? 'https://www.youtube.com/watch?v=aqz-KE-bpKQ');
                  @endphp

                  @if($isReel)
                    <button class="btn-outline-gold btn-lg js-play-reel" 
                            data-title="{{ strip_tags($slider->title) }}" 
                            data-category="অফিসিয়াল শো-রিল" 
                            data-poster="{{ $slider->image ? asset($slider->image) : asset('frontend/assets/images/hero-cinema.jpg') }}" 
                            data-video="{{ $videoUrl }}" 
                            type="button">
                      <i class="fa-solid fa-circle-play"></i>
                      <span>{{ $slider->btn_text_2 }}</span>
                    </button>
                  @else
                    <a href="{{ $slider->btn_url_2 }}" class="btn-outline-gold btn-lg">
                      <i class="fa-solid fa-circle-play"></i>
                      <span>{{ $slider->btn_text_2 }}</span>
                    </a>
                  @endif
                @endif
              </div>

              <div class="hero-meta-strip">
                <div class="meta-chip"><i class="fa-solid fa-video"></i> 4K HDR Cinema</div>
                @if(!empty($settings['stat_artists']))
                  <div class="meta-chip"><i class="fa-solid fa-users"></i> {{ $settings['stat_artists'] }} ট্যালেন্ট রোস্টার</div>
                @endif
                @if(!empty($settings['stat_projects']))
                  <div class="meta-chip"><i class="fa-solid fa-award"></i> {{ $settings['stat_projects'] }} সম্পন্ন প্রজেক্ট</div>
                @endif
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <!-- Hero Controls & Synced Thumbnail Strip -->
      <div class="hero-bottom-bar">
        <div class="container hero-bottom-inner">
          <div class="hero-controls">
            <button class="slider-circle-btn hero-prev" type="button" aria-label="Previous Slide">
              <i class="fa-solid fa-arrow-left"></i>
            </button>
            <button class="slider-circle-btn hero-next" type="button" aria-label="Next Slide">
              <i class="fa-solid fa-arrow-right"></i>
            </button>
          </div>

          <div class="swiper hero-thumbs-swiper" id="heroThumbSlider">
            <div class="swiper-wrapper">
              @php
                $bnDigits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
                $toBn = function($num) use ($bnDigits) {
                    $str = (string)$num;
                    $res = '';
                    for ($i = 0; $i < strlen($str); $i++) {
                        $char = $str[$i];
                        $res .= isset($bnDigits[$char]) ? $bnDigits[$char] : $char;
                    }
                    return strlen($res) === 1 ? '০' . $res : $res;
                };
              @endphp

              @foreach($heroSliders as $index => $slider)
                <div class="swiper-slide thumb-card">
                  <img src="{{ $slider->image ? asset($slider->image) : asset('frontend/assets/images/hero-cinema.jpg') }}" alt="{{ strip_tags($slider->title) }}" />
                  <div class="thumb-info">
                    <span class="thumb-num">{{ $toBn($index + 1) }}</span>
                    <span class="thumb-label">{{ Str::limit(strip_tags($slider->title), 22) }}</span>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  @endif

  @if(!empty($settings['stat_projects']) || !empty($settings['stat_artists']) || !empty($settings['stat_films']) || !empty($settings['stat_satisfaction']))
  <!-- ==================== ODOMETER IMPACT STATS BAR ==================== -->
  <section class="stats-section" id="stats-section">
    <div class="container">
      <div class="stats-odometer-card" id="statsStrip">
        @php
          $pNum = preg_replace('/[^0-9]/', '', $settings['stat_projects'] ?? '0') ?: '0';
          $pPlus = str_contains($settings['stat_projects'] ?? '', '+') ? '+' : '';

          $aNum = preg_replace('/[^0-9]/', '', $settings['stat_artists'] ?? '0') ?: '0';
          $aPlus = str_contains($settings['stat_artists'] ?? '', '+') ? '+' : '';

          $fNum = preg_replace('/[^0-9]/', '', $settings['stat_films'] ?? '0') ?: '0';
          $fPlus = str_contains($settings['stat_films'] ?? '', '+') ? '+' : '';

          $sNum = preg_replace('/[^0-9]/', '', $settings['stat_satisfaction'] ?? '0') ?: '0';
          $sSuffix = str_contains($settings['stat_satisfaction'] ?? '', '%') ? '%' : '+';
        @endphp

        <div class="stat-item">
          <div class="stat-icon"><i class="fa-solid fa-clapperboard"></i></div>
          <div class="stat-num-row">
            <span class="odometer stat-odo" data-target="{{ $pNum }}">0</span><span class="stat-plus">{{ $pPlus }}</span>
          </div>
          <p class="stat-label">সফল মিডিয়া প্রজেক্ট</p>
        </div>

        <div class="stat-item">
          <div class="stat-icon"><i class="fa-solid fa-users"></i></div>
          <div class="stat-num-row">
            <span class="odometer stat-odo" data-target="{{ $aNum }}">0</span><span class="stat-plus">{{ $aPlus }}</span>
          </div>
          <p class="stat-label">নিবন্ধিত মডেল ও শিল্পী</p>
        </div>

        <div class="stat-item">
          <div class="stat-icon"><i class="fa-solid fa-film"></i></div>
          <div class="stat-num-row">
            <span class="odometer stat-odo" data-target="{{ $fNum }}">0</span><span class="stat-plus">{{ $fPlus }}</span>
          </div>
          <p class="stat-label">সিনেমা ও ওটিটি সিরিজ</p>
        </div>

        <div class="stat-item">
          <div class="stat-icon"><i class="fa-solid fa-star"></i></div>
          <div class="stat-num-row">
            <span class="odometer stat-odo" data-target="{{ $sNum }}">0</span><span class="stat-plus">{{ $sSuffix }}</span>
          </div>
          <p class="stat-label">ক্লায়েন্ট সন্তুষ্টি ও অ্যাপ্রুভাল</p>
        </div>
      </div>
    </div>
  </section>
  @endif

  @if($videos->isNotEmpty())
  <!-- ==================== PORTFOLIO SECTION (SLIDER #2 — FILTERABLE MULTI-SLIDER) ==================== -->
  <section class="portfolio-section section-pad" id="portfolio-section">
    <div class="container">
      <div class="section-header-row">
        <div>
          <span class="eyebrow"><i class="fa-solid fa-film"></i> নির্বাচিত পোর্টফোলিও</span>
          <h2 class="section-title">আমাদের সাম্প্রতিক <span class="text-gold-gradient">মিডিয়া প্রোডাকশন</span></h2>
        </div>

        <div class="section-header-actions">
          <div class="filter-pills" id="portfolioFilters" role="tablist">
            <button class="filter-pill active" data-filter="all" type="button">সবগুলো</button>
            <button class="filter-pill" data-filter="cinema" type="button">সিনেমা</button>
            <button class="filter-pill" data-filter="drama" type="button">নাটক ও ওটিটি</button>
            <button class="filter-pill" data-filter="tvc" type="button">বিজ্ঞাপন (TVC)</button>
            <button class="filter-pill" data-filter="music" type="button">মিউজিক ভিডিও</button>
          </div>
          <div class="slider-arrows-top">
            <button class="slider-circle-btn port-prev" type="button" aria-label="Previous Portfolio">
              <i class="fa-solid fa-arrow-left"></i>
            </button>
            <button class="slider-circle-btn port-next" type="button" aria-label="Next Portfolio">
              <i class="fa-solid fa-arrow-right"></i>
            </button>
          </div>
        </div>
      </div>

      <div class="slider-wrapper">
        <div class="swiper portfolio-swiper" id="portfolioSlider">
          <div class="swiper-wrapper" id="portfolioWrapper">
            @foreach($videos as $video)
              <article class="swiper-slide portfolio-card" data-category="{{ strtolower($video->category) }}">
                <div class="card-media">
                  <img src="{{ asset($video->thumbnail ?? 'frontend/assets/images/portfolio-film.jpg') }}" alt="{{ $video->title }}" />
                  <span class="card-badge">{{ strtoupper($video->category) }}</span>
                  @if(!empty($video->duration))
                    <span class="card-duration"><i class="fa-regular fa-clock"></i> {{ $video->duration }}</span>
                  @endif
                  <button class="card-play-btn js-play-reel" 
                          data-title="{{ $video->title }}" 
                          data-category="{{ strtoupper($video->category) }} • {{ $video->duration ?? '' }}" 
                          data-poster="{{ asset($video->thumbnail ?? 'frontend/assets/images/portfolio-film.jpg') }}" 
                          data-video="{{ $video->youtube_url }}" 
                          type="button" 
                          aria-label="Play {{ $video->title }}">
                    <i class="fa-solid fa-play"></i>
                  </button>
                </div>
                <div class="card-body">
                  <div class="card-meta-top">
                    @if(!empty($video->director))
                      <span><i class="fa-solid fa-clapperboard"></i> {{ $video->director }}</span>
                    @endif
                    @if(!empty($video->client))
                      <span>{{ $video->client }}</span>
                    @endif
                  </div>
                  <h3 class="card-title">{{ $video->title }}</h3>
                  @if(!empty($video->description))
                    <p class="card-desc">{{ Str::limit($video->description, 90) }}</p>
                  @endif
                </div>
              </article>
            @endforeach
          </div>
        </div>

        <div class="section-view-all">
          <a href="{{ route('videos') }}" class="btn-outline-gold">
            <i class="fa-solid fa-circle-play"></i>
            <span>সকল ভিডিও পোর্টফোলিও দেখুন</span>
          </a>
        </div>
      </div>
    </div>
  </section>
  @endif

        <div class="section-view-all">
          <a href="{{ route('videos') }}" class="btn-outline-gold">
            <i class="fa-solid fa-circle-play"></i>
            <span>সকল ভিডিও পোর্টফোলিও দেখুন</span>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- ==================== PRODUCTION CRAFT & SERVICES (SLIDER #3 — 3D COVERFLOW) ==================== -->
  <section class="craft-section section-pad" id="craft-section">
    <div class="container">
      <div class="section-header-row">
        <div>
          <span class="eyebrow"><i class="fa-solid fa-sliders"></i> আমাদের দক্ষতা ও বিটিএস</span>
          <h2 class="section-title">ক্যামেরার পেছনের <span class="text-gold-gradient">ক্রাফট ও প্রোডাকশন সার্ভিস</span></h2>
          <p class="section-sub">স্ক্রিপ্ট থেকে বড় পর্দা—প্রতিটি ধাপে সর্বাধুনিক প্রযুক্তি ও অভিজ্ঞ ক্রিয়েটিভ ডিরেক্টরদের তত্ত্বাবধান</p>
        </div>
        <div class="slider-arrows-top">
          <button class="slider-circle-btn craft-prev" type="button" aria-label="Previous Craft Slide">
            <i class="fa-solid fa-arrow-left"></i>
          </button>
          <button class="slider-circle-btn craft-next" type="button" aria-label="Next Craft Slide">
            <i class="fa-solid fa-arrow-right"></i>
          </button>
        </div>
      </div>

      <div class="swiper craft-swiper" id="btsSlider">
        <div class="swiper-wrapper">
          <div class="swiper-slide craft-slide">
            <div class="craft-img-wrap">
              <img src="{{ asset('frontend/assets/images') }}/hero-cinema.jpg" alt="সিনেমাটোগ্রাফি ও ৪কে শুটিং" />
              <span class="craft-step">০১</span>
            </div>
            <div class="craft-content">
              <h3>সিনেমাটোগ্রাফি ও ৪কে/৮কে শুটিং</h3>
              <p>RED V-Raptor, ARRI Alexa Mini ও অ্যানামরফিক প্রাইম লেন্সের মাধ্যমে প্রিমিয়াম ভিজ্যুয়াল ক্যাপচার।</p>
            </div>
          </div>

          <div class="swiper-slide craft-slide">
            <div class="craft-img-wrap">
              <img src="{{ asset('frontend/assets/images') }}/portfolio-casting.jpg" alt="ট্যালেন্ট ও মডেল কাস্টিং" />
              <span class="craft-step">০২</span>
            </div>
            <div class="craft-content">
              <h3>ট্যালেন্ট ও মডেল কাস্টিং ডিরেকশন</h3>
              <p>নাটক, সিনেমা ও ব্র্যান্ডের চরিত্র অনুযায়ী ১৮৫০+ অডিশন-ভেরিফাইড শিল্পী থেকে নিখুঁত নির্বাচন।</p>
            </div>
          </div>

          <div class="swiper-slide craft-slide">
            <div class="craft-img-wrap">
              <img src="{{ asset('frontend/assets/images') }}/hero-studio.jpg" alt="স্টুডিও লাইটিং ও সেট ডিজাইন" />
              <span class="craft-step">০৩</span>
            </div>
            <div class="craft-content">
              <h3>প্রফেশনাল স্টুডিও ও সেট ডিজাইন</h3>
              <p>নিজস্ব সাইক্লোরামা স্টুডিও, ডলি ট্র্যাক, জিব আর্ম ও ডিএমএক্স মুভিং লাইটিং সেটআপ।</p>
            </div>
          </div>

          <div class="swiper-slide craft-slide">
            <div class="craft-img-wrap">
              <img src="{{ asset('frontend/assets/images') }}/portfolio-film.jpg" alt="কালার গ্রেডিং ও ভিএফএক্স" />
              <span class="craft-step">০৪</span>
            </div>
            <div class="craft-content">
              <h3>DaVinci কালার গ্রেডিং ও ভিএফএক্স</h3>
              <p>আন্তর্জাতিক সিনেমা স্ট্যান্ডার্ড ডিআই কালার গ্রেডিং, কম্পোজিটিং ও হাই-এন্ড মোশন গ্রাফিক্স।</p>
            </div>
          </div>

          <div class="swiper-slide craft-slide">
            <div class="craft-img-wrap">
              <img src="{{ asset('frontend/assets/images') }}/portfolio-music.jpg" alt="অডিও ডিজাইন ও মাস্টারিং" />
              <span class="craft-step">০৫</span>
            </div>
            <div class="craft-content">
              <h3>সাউন্ড ডিজাইন ও ডলবি মিক্সিং</h3>
              <p>অরিজিনাল ব্যাকগ্রাউন্ড স্কোর, ফলি সাউন্ড, ডাবিং ও সিনেমা হল স্ট্যান্ডার্ড অডিও মাস্টারিং।</p>
            </div>
          </div>
        </div>
      </div>

      <div class="section-view-all">
        <a href="gallery.html" class="btn-outline-gold">
          <i class="fa-regular fa-images"></i>
          <span>সম্পূর্ণ শুটিং ও ফটো গ্যালারি দেখুন</span>
        </a>
      </div>
    </div>
  </section>

  @if($castingCalls->isNotEmpty())
  <!-- ==================== OPEN CASTING CALLS SLIDER ==================== -->
  <section class="casting-calls-section section-pad" id="casting-calls">
    <div class="container">
      <div class="section-header-row">
        <div>
          <span class="eyebrow"><i class="fa-solid fa-bullhorn"></i> রানিং কাস্টিং কল</span>
          <h2 class="section-title">চলমান <span class="text-gold-gradient">ওপেন অডিশন ও চরিত্র</span></h2>
          <p class="section-sub">আমাদের আসন্ন নাটক, ওটিটি ও বিজ্ঞাপনের জন্য নির্ধারিত চরিত্রগুলোতে সরাসরি আবেদন করুন</p>
        </div>
        <div class="talent-nav-top">
          <button class="slider-circle-btn casting-prev" type="button" aria-label="Previous Casting Call">
            <i class="fa-solid fa-arrow-left"></i>
          </button>
          <button class="slider-circle-btn casting-next" type="button" aria-label="Next Casting Call">
            <i class="fa-solid fa-arrow-right"></i>
          </button>
        </div>
      </div>

      <div class="swiper casting-swiper" id="castingCallsSlider">
        <div class="swiper-wrapper">
          @foreach($castingCalls as $call)
            <article class="swiper-slide casting-card">
              <div class="casting-top">
                <span class="casting-status {{ $call->status === 'urgent' ? 'status-urgent' : 'status-open' }}">
                  <i class="fa-solid {{ $call->status === 'urgent' ? 'fa-fire' : 'fa-circle-dot' }}"></i> 
                  {{ $call->status === 'urgent' ? 'জরুরি কাস্টিং' : 'ওপেন অডিশন' }}
                </span>
                @if(!empty($call->deadline))
                  <span class="casting-deadline">ডেডলাইন: {{ \Carbon\Carbon::parse($call->deadline)->format('d M') }}</span>
                @endif
              </div>
              <h3>{{ $call->title }}</h3>
              @if(!empty($call->description))
                <p class="casting-desc">{{ Str::limit($call->description, 100) }}</p>
              @endif
              <ul class="casting-specs">
                @if(!empty($call->category))
                  <li><i class="fa-solid fa-user-tag"></i> ক্যাটাগরি: <strong>{{ $call->category }}</strong></li>
                @endif
                @if(!empty($call->age_range))
                  <li><i class="fa-solid fa-cake-candles"></i> বয়স: <strong>{{ $call->age_range }}</strong></li>
                @endif
                @if(!empty($call->location))
                  <li><i class="fa-solid fa-location-dot"></i> শ্যুট: <strong>{{ $call->location }}</strong></li>
                @endif
                @if(!empty($call->budget))
                  <li><i class="fa-solid fa-wallet"></i> সম্মানী: <strong>{{ $call->budget }}</strong></li>
                @endif
              </ul>
              <button class="btn-gold-pill btn-sm w-full js-apply-casting" 
                      data-category="{{ $call->category ?? 'অভিনেতা' }}" 
                      data-role="{{ $call->title }}" 
                      type="button">
                <i class="fa-solid fa-paper-plane"></i>
                <span>এই চরিত্রে আবেদন করুন</span>
              </button>
            </article>
          @endforeach
        </div>
      </div>
    </div>
  </section>
  @endif

  @if($talents->isNotEmpty())
  <!-- ==================== FILTERABLE TALENT DIRECTORY ==================== -->
  <section class="directory-section section-pad" id="talent-directory">
    <div class="container">
      <div class="section-header-row">
        <div>
          <span class="eyebrow"><i class="fa-solid fa-users-viewfinder"></i> কাস্টিং ও শিল্পী অনুসন্ধান</span>
          <h2 class="section-title">ট্যালেন্ট <span class="text-gold-gradient">ডিরেক্টরি</span></h2>
          <p class="section-sub">আপনার প্রজেক্টের বিভিন্ন চরিত্রের জন্য উপযুক্ত শিল্পী ফিল্টার করে খুঁজুন</p>
        </div>
        <div class="directory-count-pill" id="directoryCountPill">
          <i class="fa-solid fa-user-check"></i>
          <span><strong id="directoryCountNum">{{ $talents->count() }}</strong> টি প্রোফাইল দেখাচ্ছে</span>
        </div>
      </div>

      <!-- 4-Filter Search Toolbar -->
      <div class="directory-filter-bar">
        <div class="filter-field">
          <label for="dirSearch">নাম বা কি-ওয়ার্ড</label>
          <div class="input-icon-wrap">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" id="dirSearch" placeholder="শিল্পীর নাম খুঁজুন..." />
          </div>
        </div>

        <div class="filter-field">
          <label for="dirCategory">ক্যাটাগরি</label>
          <select id="dirCategory">
            <option value="all">সকল ক্যাটাগরি</option>
            <option value="অভিনেতা">অভিনেতা</option>
            <option value="অভিনেত্রী">অভিনেত্রী</option>
            <option value="মডেল">মডেল</option>
            <option value="শিশু শিল্পী">শিশু শিল্পী</option>
            <option value="ভয়েস আর্টিস্ট">ভয়েস আর্টিস্ট</option>
          </select>
        </div>

        <div class="filter-field">
          <label for="dirAge">বয়সসীমা</label>
          <select id="dirAge">
            <option value="all">সব বয়স</option>
            <option value="18-25">১৮-২৫ বছর</option>
            <option value="26-35">২৬-৩৫ বছর</option>
            <option value="35+">৩৫+ বছর</option>
          </select>
        </div>

        <div class="filter-field">
          <label for="dirExperience">অভিজ্ঞতা</label>
          <select id="dirExperience">
            <option value="all">সকল লেভেল</option>
            <option value="fresher">নতুন / ফ্রেশার (০-১ বছর)</option>
            <option value="mid">১-৩ বছর</option>
            <option value="senior">৪+ বছর</option>
          </select>
        </div>
      </div>

      <!-- Directory Cards Grid (Rendered / Managed by JS) -->
      <div class="directory-grid" id="directoryGrid">
        <!-- Populated by main.js so filters & new registrations sync live -->
      </div>

      <div class="directory-empty" id="directoryEmpty" hidden>
        <i class="fa-regular fa-face-meh"></i>
        <p>দুঃখিত! আপনার ফিল্টার অনুযায়ী কোনো শিল্পীর প্রোফাইল পাওয়া যায়নি।</p>
        <button class="btn-outline-gold btn-sm" id="resetDirFiltersBtn" type="button">সব ফিল্টার রিসেট করুন</button>
      </div>
    </div>
  </section>
  @endif

  <!-- ==================== NEW ARTIST REGISTRATION FORM ==================== -->
  <section class="registration-section section-pad" id="registration-section">
    <div class="container">
      <div class="registration-shell">
        <div class="registration-info">
          <span class="eyebrow"><i class="fa-solid fa-user-plus"></i> নতুন শিল্পীদের রেজিস্ট্রেশন</span>
          <h2 class="section-title">আপনার <span class="text-gold-gradient">প্রোফাইল জমা দিন</span></h2>
          <p class="section-sub">
            আপনি কি অভিনয় বা মডেলিংয়ে আগ্রহী? নিচের ফরমে সঠিক তথ্য দিয়ে আপনার পোর্টফোলিও আমাদের পাঠিয়ে দিন।
          </p>

          <div class="reg-highlights">
            <div class="reg-highlight-item">
              <span class="reg-icon"><i class="fa-brands fa-whatsapp"></i></span>
              <div>
                <h4>সরাসরি হোয়াটসঅ্যাপ কলব্যাক</h4>
                <p>প্রোজেক্টের সাথে চরিত্র মিলে গেলে আমাদের কাস্টিং টিম সরাসরি হোয়াটসঅ্যাপে যোগাযোগ করবে।</p>
              </div>
            </div>
            <div class="reg-highlight-item">
              <span class="reg-icon"><i class="fa-solid fa-shield-halved"></i></span>
              <div>
                <h4>১০০% ভেরিফাইড মিডিয়া প্রজেক্ট</h4>
                <p>নাটক, সিনেমা, ওটিটি এবং শীর্ষস্থানীয় ব্র্যান্ড টিভিসি প্রোডাকশনে কাজের সুযোগ।</p>
              </div>
            </div>
            <div class="reg-highlight-item">
              <span class="reg-icon"><i class="fa-solid fa-bolt"></i></span>
              <div>
                <h4>তাৎক্ষণিক ডিরেক্টরি প্রিভিউ</h4>
                <p>ফর্ম সাবমিট করার সাথে সাথেই উপরের ট্যালেন্ট ডিরেক্টরিতে আপনার প্রোফাইল যুক্ত হয়ে যাবে (লাইভ ডেমো)।</p>
              </div>
            </div>
          </div>
        </div>

        <form class="registration-form-card" id="artistRegistrationForm" action="{{ route('apply') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="reg-form-grid">
            <div class="form-row">
              <label for="regName">পূর্ণ নাম <span class="req">*</span></label>
              <input type="text" id="regName" name="name" placeholder="আপনার নাম লিখুন" required />
            </div>

            <div class="form-row">
              <label for="regPhone">ফোন / হোয়াটসঅ্যাপ নম্বর <span class="req">*</span></label>
              <input type="tel" id="regPhone" name="phone" placeholder="০1XXXXXXXXX" required />
              <small class="field-hint">আমরা মূলত হোয়াটসঅ্যাপের মাধ্যমে যোগাযোগের জন্য মেসেজ পাঠাবো।</small>
            </div>

            <div class="form-row">
              <label for="regCategory">ক্যাটাগরি <span class="req">*</span></label>
              <select id="regCategory" name="category" required>
                <option value="">নির্বাচন করুন</option>
                <option value="অভিনেতা">অভিনেতা</option>
                <option value="অভিনেত্রী">অভিনেত্রী</option>
                <option value="মডেল">মডেল</option>
                <option value="শিশু শিল্পী">শিশু শিল্পী</option>
                <option value="ভয়েস আর্টিস্ট">ভয়েস আর্টিস্ট</option>
              </select>
            </div>

            <div class="form-row-2">
              <div class="form-row">
                <label for="regAge">বয়স <span class="req">*</span></label>
                <input type="number" id="regAge" name="age" min="5" max="85" placeholder="বয়স" required />
              </div>
              <div class="form-row">
                <label for="regHeight">উচ্চতা (ফুট/ইঞ্চি)</label>
                <input type="text" id="regHeight" name="height" placeholder="যেমন: 5' 8&quot;" />
              </div>
            </div>

            <div class="form-row">
              <label for="regDriveLink">ছবি / পোর্টফোলিও লিংক (Google Drive)</label>
              <input type="url" id="regDriveLink" name="portfolio_url" placeholder="https://drive.google.com/..." />
            </div>

            <div class="form-row">
              <label for="regVideoLink">অডিশন ভিডিও / শো-রিল লিংক (YouTube/Facebook)</label>
              <input type="url" id="regVideoLink" placeholder="https://youtube.com/watch?v=..." />
            </div>

            <div class="form-row">
              <label for="regPhoto">প্রোফাইল ছবি (WebP তে কনভার্ট হবে)</label>
              <input type="file" id="regPhoto" name="photo" accept="image/*" />
            </div>
            <div class="form-row">
              <label for="regExperience">পূর্বের কাজের অভিজ্ঞতা (যদি থাকে)</label>
              <textarea id="regExperience" name="bio" rows="3" placeholder="নাটক, শর্ট ফিল্ম বা বিজ্ঞাপনে কাজের সংক্ষিপ্ত বিবরণ লিখুন..."></textarea>
            </div>
          </div>

          <button class="btn-gold-pill btn-lg w-full mt-4" type="submit">
            <i class="fa-solid fa-paper-plane"></i>
            <span>সাবমিট করুন</span>
          </button>
        </form>
      </div>
    </div>
  </section>

  @if($reviews->isNotEmpty())
  <!-- ==================== BRAND MARQUEE & TESTIMONIALS (SLIDER #5 & #6) ==================== -->
  <section class="testimonials-section section-pad" id="testimonials-section">
    <div class="container">
      <div class="section-header-row">
        <div>
          <span class="eyebrow"><i class="fa-solid fa-handshake"></i> পার্টনার ও ক্লায়েন্ট অভিজ্ঞতা</span>
          <h2 class="section-title">যাদের আস্থায় <span class="text-gold-gradient">আমাদের পথচলা</span></h2>
        </div>
        <div class="slider-arrows-top">
          <button class="slider-circle-btn testi-prev" type="button" aria-label="Previous Testimonial">
            <i class="fa-solid fa-arrow-left"></i>
          </button>
          <button class="slider-circle-btn testi-next" type="button" aria-label="Next Testimonial">
            <i class="fa-solid fa-arrow-right"></i>
          </button>
        </div>
      </div>

      <!-- Client Testimonials Slider -->
      <div class="swiper testimonial-swiper mt-8" id="testimonialSlider">
        <div class="swiper-wrapper">
          @foreach($reviews as $review)
            <div class="swiper-slide testimonial-card">
              <div class="quote-stars">
                @for($i = 1; $i <= ($review->rating ?? 5); $i++)
                  <i class="fa-solid fa-star"></i>
                @endfor
              </div>
              <p class="quote-text">
                “{{ $review->review }}”
              </p>
              <div class="quote-author">
                @if(!empty($review->photo))
                  <img src="{{ asset($review->photo) }}" alt="{{ $review->name }}" class="rounded-circle" style="width: 44px; height: 44px; object-fit: cover;">
                @else
                  <div class="author-avatar">{{ mb_substr($review->name, 0, 1) }}</div>
                @endif
                <div>
                  <h4>{{ $review->name }}</h4>
                  <span>{{ $review->designation }}</span>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>

      <div class="section-view-all">
        <a href="{{ route('reviews') }}" class="btn-outline-gold">
          <i class="fa-solid fa-star"></i>
          <span>সকল ক্লায়েন্ট ও শিল্পী রিভিউ দেখুন</span>
        </a>
      </div>
    </div>
  </section>
  @endif

  <!-- ==================== PORTAL EXPLORER HUB ==================== -->
  <section class="section-pad" id="portal-hub">
    <div class="container">
      <div class="section-header-center">
        <span class="eyebrow"><i class="fa-solid fa-compass"></i> Mind Blowing Media সম্পূর্ণ পোর্টাল</span>
        <h2 class="section-title">এক ক্লিকে ঘুরে দেখুন <span class="text-gold-gradient">আমাদের সব বিভাগ</span></h2>
        <p class="section-sub">অভিনয়শিল্পী ও বিদেশি আর্টিস্ট প্রোফাইল, শুটিং হাউজ ক্যাটালগ, জরুরি নোটিশ ও ডায়েরিসহ প্রোডাকশনের পূর্ণাঙ্গ জগত।</p>
      </div>

      <div class="portal-hub-grid">
        <a href="{{ route('profiles') }}" class="portal-hub-card">
          <span class="portal-hub-icon"><i class="fa-solid fa-users"></i></span>
          <h3>অভিনয়শিল্পী ও মডেল প্রোফাইল</h3>
          <p>ভেরিফাইড অভিনেতা, অভিনেত্রী, ফ্যাশন মডেল ও চরিত্রাভিনেতাদের সম্পূর্ণ পোর্টফোলিও।</p>
          <span class="portal-hub-link">প্রোফাইল দেখুন <i class="fa-solid fa-arrow-right"></i></span>
        </a>

        <a href="{{ route('international.artists') }}" class="portal-hub-card">
          <span class="portal-hub-icon"><i class="fa-solid fa-globe"></i></span>
          <h3>বিদেশি অভিনয়শিল্পী</h3>
          <p>যৌথ প্রযোজনা ও আন্তর্জাতিক ব্র্যান্ড শুটের জন্য ওয়ার্ক-পারমিট রেডি বিদেশি শিল্পীরা।</p>
          <span class="portal-hub-link">গ্লোবাল রোস্টার <i class="fa-solid fa-arrow-right"></i></span>
        </a>

        <a href="{{ route('shooting.houses') }}" class="portal-hub-card">
          <span class="portal-hub-icon"><i class="fa-solid fa-building"></i></span>
          <h3>শুটিং হাউজ</h3>
          <p>সাউন্ডস্টেজ, ডুপ্লেক্স ভিলা, হেরিটেজ বাড়ি ও কর্পোরেট সেট বুকিং ক্যাটালগ।</p>
          <span class="portal-hub-link">লোকেশন খুঁজুন <i class="fa-solid fa-arrow-right"></i></span>
        </a>

        <a href="{{ route('notices') }}" class="portal-hub-card">
          <span class="portal-hub-icon"><i class="fa-solid fa-bullhorn"></i></span>
          <h3>নোটিশ বোর্ড</h3>
          <p>চলমান অডিশন কল, নতুন ওটিটি প্রজেক্ট সার্কুলার ও অফিসিয়াল নীতিমালা।</p>
          <span class="portal-hub-link">নোটিশ দেখুন <i class="fa-solid fa-arrow-right"></i></span>
        </a>

        <a href="{{ route('directors.diary') }}" class="portal-hub-card">
          <span class="portal-hub-icon"><i class="fa-solid fa-film"></i></span>
          <h3>পরিচালক ও প্রযোজক ডায়েরি</h3>
          <p>অন-সেট শুটিং লগ, বাজেট প্ল্যানিং ও নির্মাতাদের সৃজনশীল অভিজ্ঞতার জার্নাল।</p>
          <span class="portal-hub-link">ডায়েরি পড়ুন <i class="fa-solid fa-arrow-right"></i></span>
        </a>

        <a href="{{ route('artists.diary') }}" class="portal-hub-card">
          <span class="portal-hub-icon"><i class="fa-solid fa-book-open"></i></span>
          <h3>অভিনয়শিল্পী ডাইরি</h3>
          <p>প্রথম অডিশন, চরিত্র প্রস্তুতি ও রাতের শুটিং নিয়ে শিল্পীদের ব্যক্তিগত গল্প।</p>
          <span class="portal-hub-link">গল্প পড়ুন <i class="fa-solid fa-arrow-right"></i></span>
        </a>

        <a href="{{ route('opinions') }}" class="portal-hub-card">
          <span class="portal-hub-icon"><i class="fa-solid fa-pen-nib"></i></span>
          <h3>আমাদের মতামত</h3>
          <p>স্বচ্ছ কাস্টিং সংস্কৃতি, ওটিটি অভিনয় ও নতুন শিল্পীদের গাইডলাইন নিয়ে সম্পাদকীয়।</p>
          <span class="portal-hub-link">মতামত পড়ুন <i class="fa-solid fa-arrow-right"></i></span>
        </a>

        <a href="gallery.html" class="portal-hub-card">
          <span class="portal-hub-icon"><i class="fa-solid fa-images"></i></span>
          <h3>ফটো ও ভিডিও আর্কাইভ</h3>
          <p>অটো-স্ক্রল শুটিং স্টিল গ্যালারি, শো-রিল ভিডিও ও ক্লায়েন্ট রিভিউ আর্কাইভ।</p>
          <span class="portal-hub-link">গ্যালারি দেখুন <i class="fa-solid fa-arrow-right"></i></span>
        </a>
      </div>
    </div>
  </section>

  <!-- ==================== FAQ ACCORDION SECTION ==================== -->
  <section class="faq-section section-pad" id="faq-section">
    <div class="container">
      <div class="section-header-center">
        <span class="eyebrow"><i class="fa-regular fa-circle-question"></i> সাধারণ জিজ্ঞাসা</span>
        <h2 class="section-title">সচরাচর <span class="text-gold-gradient">জিজ্ঞাসিত প্রশ্ন (FAQ)</span></h2>
        <p class="section-sub">অডিশন, রেজিস্ট্রেশন ও প্রোডাকশন বুকিং সম্পর্কে শিল্পী এবং ক্লায়েন্টদের সবচেয়ে সাধারণ প্রশ্নগুলোর উত্তর</p>
      </div>

      <div class="faq-list" id="faqList">
        <div class="faq-item active">
          <button class="faq-trigger" type="button" aria-expanded="true">
            <span>নতুন শিল্পী হিসেবে প্রোফাইল জমা দিতে কি কোনো রেজিস্ট্রেশন ফি লাগে?</span>
            <i class="fa-solid fa-plus"></i>
          </button>
          <div class="faq-panel">
            <p>না, Mind Blowing Media-এ নতুন শিল্পীদের প্রোফাইল জমা দেওয়া ও কাস্টিং অডিশনে অংশগ্রহণ করা সম্পূর্ণ বিনামূল্যে। আমরা কোনো ধরনের অগ্রিম রেজিস্ট্রেশন ফি গ্রহণ করি না।</p>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-trigger" type="button" aria-expanded="false">
            <span>আগে অভিনয়ের কোনো অভিজ্ঞতা না থাকলে কি আবেদন করা যাবে?</span>
            <i class="fa-solid fa-plus"></i>
          </button>
          <div class="faq-panel">
            <p>অবশ্যই! আমাদের অনেক টিভিসি, ক্যাম্পাস ড্রামা ও নতুন ওটিটি প্রজেক্টে ফ্রেশ মুখ খোঁজা হয়। আপনি মোবাইল ক্যামেরায় তোলা ১ মিনিটের একটি ইন্ট্রো বা অভিনয়ের সেলফ-টেপ ভিডিও লিংক দিয়েই আবেদন করতে পারবেন।</p>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-trigger" type="button" aria-expanded="false">
            <span>ফর্ম সাবমিট করার পর কীভাবে ও কতদিনের মধ্যে যোগাযোগ করা হয়?</span>
            <i class="fa-solid fa-plus"></i>
          </button>
          <div class="faq-panel">
            <p>আমাদের কাস্টিং টিম প্রতিটি প্রোফাইল যাচাই করে ডেটাবেজে সংরক্ষণ করে। চলমান কোনো চরিত্রের সাথে আপনার প্রোফাইল মিলে গেলে ৩-৭ কার্যদিবসের মধ্যে আপনার দেওয়া হোয়াটসঅ্যাপ নম্বরে অডিশন কলব্যাক পাঠানো হয়।</p>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-trigger" type="button" aria-expanded="false">
            <span>ব্র্যান্ড টিভিসি, মিউজিক ভিডিও বা কর্পোরেট প্রোডাকশন বুকিং কীভাবে করবো?</span>
            <i class="fa-solid fa-plus"></i>
          </button>
          <div class="faq-panel">
            <p>উপরের “প্রোফাইল জমা দিন” বাটনে ক্লিক করে অথবা স্টুডিওর ফোন/ইমেইলে প্রজেক্টের সংক্ষিপ্ত বিবরণ দিলে ২৪ ঘণ্টার মধ্যে আমাদের প্রোডাকশন ডিরেক্টর বাজেট ও শুটিং শিডিউলসহ যোগাযোগ করবেন।</p>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-trigger" type="button" aria-expanded="false">
            <span>Google Drive ছবি ও YouTube শো-রিল লিংক কীভাবে তৈরি করবো?</span>
            <i class="fa-solid fa-plus"></i>
          </button>
          <div class="faq-panel">
            <p>আপনার ৩-৫টি স্পষ্ট ক্লোজ-আপ ও ফুল-লেন্থ ছবি Google Drive ফোল্ডারে আপলোড করে “Anyone with the link” ভিউ পারমিশন দিন এবং ১-২ মিনিটের অভিনয়ের ভিডিও YouTube-এ Unlisted/Public হিসেবে আপলোড করে লিংকটি ফর্মে দিন।</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ==================== CTA BANNER ==================== -->
  <section class="cta-section section-pad">
    <div class="container">
      <div class="cta-banner">
        <div class="cta-content">
          <span class="eyebrow"><i class="fa-solid fa-rocket"></i> চলুন একসাথে তৈরি করি</span>
          <h2>আপনার পরবর্তী <span class="text-gold-gradient">সিনেমা, নাটক বা ব্র্যান্ড টিভিসি</span> শুরু করতে প্রস্তুত?</h2>
          <p>শিল্পী হিসেবে প্রোফাইল জমা দিন অথবা প্রোডাকশন বুকিংয়ের জন্য সরাসরি আমাদের ক্রিয়েটিভ টিমের সাথে যুক্ত হোন।</p>
        </div>
        <div class="cta-actions">
          <a href="#registration-section" class="btn-gold-pill btn-lg">
            <i class="fa-solid fa-circle-plus"></i>
            <span>প্রোফাইল / প্রজেক্ট জমা দিন</span>
          </a>
          <a href="#talent-directory" class="btn-outline-gold btn-lg">
            <i class="fa-solid fa-users"></i>
            <span>ট্যালেন্ট ডিরেক্টরি</span>
          </a>
        </div>
      </div>
    </div>
  </section>

@push('scripts')
<script>
  window.DYNAMIC_TALENTS = [
    @foreach($talents as $t)
    {
      id: {{ $t->id }},
      name: "{{ addslashes($t->name) }}",
      category: "{{ addslashes($t->category->name ?? 'অভিনেতা') }}",
      age: {{ (int) preg_replace('/[^0-9]/', '', $t->age) ?: 25 }},
      height: "{{ addslashes($t->height ?? "5' 8\"") }}",
      expYears: {{ (int) preg_replace('/[^0-9]/', '', $t->experience) ?: 2 }},
      expLevel: '{{ (int) preg_replace('/[^0-9]/', '', $t->experience) > 3 ? 'senior' : ((int) preg_replace('/[^0-9]/', '', $t->experience) > 1 ? 'mid' : 'fresher') }}',
      expLabel: '{{ addslashes($t->experience ?? "২ বছর") }}',
      specialty: "{{ addslashes($t->specialty ?? '') }}",
      photo: "{{ asset($t->photo ?? 'frontend/assets/images/portfolio-casting.jpg') }}",
      bio: "{{ addslashes($t->bio ?? '') }}",
      driveLink: "{{ $t->portfolio_url ?? '#registration-section' }}",
      videoLink: "{{ $t->audition_url ?? 'https://www.youtube.com/watch?v=dQw4w9WgXcQ' }}",
      isNew: false
    },
    @endforeach
  ];
</script>
@endpush
@endsection