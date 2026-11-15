<!-- ==================== FOOTER ==================== -->
<footer class="footer">
  <div class="container footer-grid">
    <div class="footer-brand">
      <a href="{{ route('home') }}" class="brand">
        <span class="brand-logo-badge"><img src="{{ asset('frontend/assets/images/logo.jpg') }}" alt="Mind Blowing Media Logo" /></span>
        <span class="brand-text">
          <span class="brand-title"><span class="brand-word-blue">Mind</span> <span class="brand-word-orange">Blowing</span> <span class="brand-word-media">MEDIA</span></span>
          <span class="brand-sub">CASTING &amp; MEDIA HOUSE</span>
        </span>
      </a>
      <p class="footer-desc">
        বাংলাদেশের অন্যতম আধুনিক কাস্টিং এজেন্সি ও প্রোডাকশন পোর্টফোলিও হাউস। নাটক, সিনেমা, ওটিটি ও বিজ্ঞাপনের পূর্ণাঙ্গ সৃজনশীল অংশীদার।
      </p>
      <div class="social-row">
        <a href="#hero" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
        <a href="#hero" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
        <a href="#hero" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
        <a href="#hero" aria-label="Vimeo"><i class="fa-brands fa-vimeo-v"></i></a>
      </div>
    </div>

    <div class="footer-col">
      <h4>ট্যালেন্ট ও মিডিয়া</h4>
      <ul>
        <li><a href="{{ route('profiles') }}">অভিনয়শিল্পী ও মডেল প্রোফাইল</a></li>
        <li><a href="{{ route('international.artists') }}">বিদেশি অভিনয়শিল্পী</a></li>
        <li><a href="{{ route('shooting.houses') }}">শুটিং হাউজ</a></li>
        <li><a href="{{ route('videos') }}">ভিডিও পোর্টফোলিও</a></li>
      </ul>
    </div>

    <div class="footer-col">
      <h4>ডায়েরি, নোটিশ ও মতামত</h4>
      <ul>
        <li><a href="{{ route('notices') }}">অফিসিয়াল নোটিশ</a></li>
        <li><a href="{{ route('directors.diary') }}">পরিচালক ও প্রযোজক ডায়েরি</a></li>
        <li><a href="{{ route('artists.diary') }}">অভিনয়শিল্পী ডাইরি</a></li>
        <li><a href="{{ route('opinions') }}">আমাদের মতামত</a></li>
        <li><a href="{{ route('reviews') }}">রিভিউ ও ফিডব্যাক</a></li>
      </ul>
    </div>

    <div class="footer-col">
      <h4>স্টুডিও যোগাযোগ</h4>
      <ul class="contact-list">
        <li><i class="fa-solid fa-location-dot"></i> {{ \App\Models\Setting::get('site_address', 'রোড ১১, বনানী, ঢাকা-১২১৩') }}</li>
        <li><i class="fa-solid fa-phone"></i> {{ \App\Models\Setting::get('site_phone', '+৮৮০ ১৭০০-০০০১২৩') }}</li>
        <li><i class="fa-solid fa-envelope"></i> {{ \App\Models\Setting::get('site_email', 'casting@mindblowingmedia.bd') }}</li>
      </ul>
    </div>
  </div>

  <div class="footer-bottom">
    <div class="container footer-bottom-inner">
      <span>© ২০২৬ Mind Blowing Media — Casting &amp; Media House. সর্বস্বত্ব সংরক্ষিত।</span>
      <span>Designed with Classic IT</span>
    </div>
  </div>
</footer>
