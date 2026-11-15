<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Sign In &bull; Mind Blowing Media Studio Portal</title>

  <!-- Google Fonts: Plus Jakarta Sans -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

  <!-- Bootstrap 5 & FontAwesome 6 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

  <style>
    body, button, input, select, textarea, p, h1, h2, h3, h4, h5, h6, span {
      font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    }

    * {
      box-sizing: border-box;
    }

    .fa, .fas, .fa-solid, .far, .fa-regular, .fab, .fa-brands, [class^="fa-"], [class*=" fa-"] {
      font-family: "Font Awesome 6 Free", "Font Awesome 6 Brands" !important;
      display: inline-block;
      font-style: normal;
      font-variant: normal;
      text-rendering: auto;
      line-height: 1;
    }
    .fa, .fas, .fa-solid {
      font-family: "Font Awesome 6 Free" !important;
      font-weight: 900 !important;
    }
    .far, .fa-regular {
      font-family: "Font Awesome 6 Free" !important;
      font-weight: 400 !important;
    }
    .fab, .fa-brands {
      font-family: "Font Awesome 6 Brands" !important;
      font-weight: 400 !important;
    }

    body {
      background: #08090f;
      color: #f8fafc;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      overflow-x: hidden;
      padding: 24px 16px;
    }

    /* Cinematic Film Backdrop */
    .cinema-backdrop {
      position: fixed;
      top: 0; left: 0; width: 100%; height: 100%;
      background: linear-gradient(180deg, rgba(8, 9, 15, 0.80) 0%, rgba(8, 9, 15, 0.94) 100%),
                  radial-gradient(circle at 50% 20%, rgba(245, 158, 11, 0.12) 0%, transparent 60%),
                  url('{{ asset('frontend/assets/images/hero-cinema.jpg') }}') center/cover no-repeat;
      filter: saturate(1.1);
      z-index: 1;
      pointer-events: none;
    }

    /* Ambient Spotlight Orbs */
    .spotlight-top {
      position: fixed;
      top: -200px;
      left: 50%;
      transform: translateX(-50%);
      width: 650px;
      height: 450px;
      background: radial-gradient(ellipse, rgba(245, 158, 11, 0.22) 0%, transparent 70%);
      filter: blur(90px);
      z-index: 2;
      pointer-events: none;
    }

    /* Luxury Glassmorphism Card */
    .studio-login-card {
      position: relative;
      z-index: 10;
      width: 100%;
      max-width: 480px;
      background: rgba(14, 18, 30, 0.88);
      backdrop-filter: blur(28px);
      -webkit-backdrop-filter: blur(28px);
      border: 1px solid rgba(245, 158, 11, 0.22);
      border-radius: 26px;
      box-shadow: 0 30px 70px rgba(0, 0, 0, 0.75), 0 0 45px rgba(245, 158, 11, 0.12);
      padding: 46px 40px;
      transition: all 0.3s ease;
    }

    @media (max-width: 480px) {
      .studio-login-card {
        padding: 32px 22px;
        border-radius: 20px;
      }
    }

    /* Brand Header Emblem */
    .brand-emblem {
      width: 68px;
      height: 68px;
      margin: 0 auto 16px auto;
      border-radius: 20px;
      background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 50%, #d97706 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      color: #08090f;
      font-size: 1.85rem;
      box-shadow: 0 10px 25px rgba(245, 158, 11, 0.4), inset 0 2px 4px rgba(255, 255, 255, 0.3);
      position: relative;
    }

    .brand-title {
      font-size: 1.65rem;
      font-weight: 800;
      letter-spacing: -0.5px;
      color: #ffffff;
      margin-bottom: 4px;
      text-align: center;
    }

    .brand-subtitle-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      font-size: 0.72rem;
      letter-spacing: 1px;
      text-transform: uppercase;
      font-weight: 700;
      color: #fbbf24;
      background: rgba(245, 158, 11, 0.1);
      border: 1px solid rgba(245, 158, 11, 0.28);
      border-radius: 50rem;
      padding: 4px 14px;
      margin-bottom: 24px;
    }

    /* Input Styling */
    .form-group-custom {
      margin-bottom: 20px;
    }

    .label-custom {
      display: block;
      font-size: 0.78rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.6px;
      color: #cbd5e1;
      margin-bottom: 8px;
    }

    .input-box-wrapper {
      display: flex;
      align-items: stretch;
      background: rgba(8, 11, 20, 0.85);
      border: 1.5px solid rgba(255, 255, 255, 0.12);
      border-radius: 14px;
      overflow: hidden;
      transition: all 0.25s ease;
    }

    .input-box-wrapper:focus-within {
      border-color: #f59e0b;
      background: rgba(10, 14, 26, 0.98);
      box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.18);
    }

    .input-icon-cell {
      width: 48px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #f59e0b;
      font-size: 0.95rem;
      border-right: 1px solid rgba(255, 255, 255, 0.06);
    }

    .input-box-wrapper input {
      flex: 1;
      background: transparent !important;
      border: none !important;
      color: #ffffff !important;
      padding: 13px 16px;
      font-size: 0.925rem;
      outline: none !important;
      box-shadow: none !important;
    }

    .input-box-wrapper input::placeholder {
      color: #475569;
    }

    .password-toggle-btn {
      background: transparent;
      border: none;
      color: #64748b;
      padding: 0 16px;
      cursor: pointer;
      display: flex;
      align-items: center;
      transition: color 0.2s ease;
    }

    .password-toggle-btn:hover {
      color: #f59e0b;
    }

    /* Gold CTA Button */
    .btn-gold-portal {
      width: 100%;
      background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 50%, #d97706 100%);
      color: #08090f !important;
      font-weight: 800;
      font-size: 0.98rem;
      border: none;
      border-radius: 14px;
      padding: 14px 24px;
      letter-spacing: 0.4px;
      box-shadow: 0 6px 25px rgba(245, 158, 11, 0.38);
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      cursor: pointer;
    }

    .btn-gold-portal:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 30px rgba(245, 158, 11, 0.55);
      color: #000000 !important;
    }

    /* Quick Demo Login Bar */
    .quick-demo-box {
      background: rgba(245, 158, 11, 0.08);
      border: 1px dashed rgba(245, 158, 11, 0.3);
      border-radius: 12px;
      padding: 9px 14px;
      margin-bottom: 22px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .quick-demo-box:hover {
      background: rgba(245, 158, 11, 0.15);
      border-color: #f59e0b;
      transform: scale(1.01);
    }

    .quick-demo-box span {
      font-size: 0.8rem;
      color: #fbbf24;
      font-weight: 600;
    }

    .quick-demo-box .badge-autofill {
      background: #f59e0b;
      color: #08090f;
      font-size: 0.72rem;
      font-weight: 800;
      padding: 4px 10px;
      border-radius: 50rem;
    }

    /* Back Link */
    .return-home-link {
      color: #94a3b8;
      font-size: 0.85rem;
      font-weight: 600;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      transition: all 0.2s ease;
    }

    .return-home-link:hover {
      color: #fbbf24;
      transform: translateX(-3px);
    }
  </style>
</head>

<body>
  <!-- Cinematic Backdrop & Spotlight -->
  <div class="cinema-backdrop"></div>
  <div class="spotlight-top"></div>

  <!-- Studio Card -->
  <div class="studio-login-card">
    <!-- Brand Header -->
    <div class="text-center">
      <div class="brand-emblem">
        <i class="fa-solid fa-clapperboard"></i>
      </div>
      <h1 class="brand-title">Mind Blowing Media</h1>
      <div class="brand-subtitle-badge">
        <i class="fa-solid fa-film"></i>
        <span>Studio &amp; Casting Suite</span>
      </div>
    </div>

    <!-- Session Status / Errors -->
    @if (session('status'))
      <div class="alert alert-success bg-success bg-opacity-25 text-white border-0 py-2 small mb-3 rounded-3">
        {{ session('status') }}
      </div>
    @endif

    @if ($errors->any())
      <div class="alert alert-danger bg-danger bg-opacity-25 text-white border-0 py-2 small mb-3 rounded-3">
        <ul class="mb-0 ps-3">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <!-- Login Form -->
    <form method="POST" action="{{ route('login') }}" id="studioLoginForm">
      @csrf

      <!-- Email Field -->
      <div class="form-group-custom">
        <label class="label-custom" for="email">Director / Admin Email</label>
        <div class="input-box-wrapper">
          <div class="input-icon-cell">
            <i class="fa-solid fa-envelope"></i>
          </div>
          <input id="email" type="email" name="email" value="{{ old('email', 'admin@admin.com') }}" required autofocus autocomplete="username" placeholder="admin@admin.com">
        </div>
      </div>

      <!-- Password Field -->
      <div class="form-group-custom">
        <label class="label-custom" for="password">Security Password</label>
        <div class="input-box-wrapper">
          <div class="input-icon-cell">
            <i class="fa-solid fa-lock"></i>
          </div>
          <input id="password" type="password" name="password" value="password" required autocomplete="current-password" placeholder="Enter password">
          <button type="button" class="password-toggle-btn" onclick="togglePasswordVisibility()" title="Show/Hide Password">
            <i class="fa-solid fa-eye" id="pwdToggleIcon"></i>
          </button>
        </div>
      </div>

      <!-- Quick Fill Helper -->
      <div class="quick-demo-box" onclick="fillAdminCredentials()" title="Click to fill default admin credentials">
        <span><i class="fa-solid fa-key me-1"></i> Admin Demo: admin@admin.com / password</span>
        <span class="badge-autofill">Auto Fill</span>
      </div>

      <!-- Remember Me & Forgot Password -->
      <div class="d-flex align-items-center justify-content-between mb-4">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="remember" id="rememberMe" checked style="background-color: #1e293b; border-color: #475569;">
          <label class="form-check-label text-white-50 small" for="rememberMe">
            Keep session active
          </label>
        </div>

        @if (Route::has('password.request'))
          <a href="{{ route('password.request') }}" class="text-white-50 small text-decoration-none">
            Forgot password?
          </a>
        @endif
      </div>

      <!-- Submit Action -->
      <button type="submit" class="btn-gold-portal" id="submitPortalBtn">
        <span>Sign In to Studio Portal</span>
        <i class="fa-solid fa-arrow-right"></i>
      </button>
    </form>

    <!-- Return to Website Footer -->
    <div class="text-center pt-4 mt-3 border-top border-white border-opacity-10">
      <a href="{{ route('home') }}" class="return-home-link">
        <i class="fa-solid fa-arrow-left"></i>
        <span>Return to Live Public Website</span>
      </a>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script>
    function togglePasswordVisibility() {
      var passInput = document.getElementById('password');
      var icon = document.getElementById('pwdToggleIcon');
      if (passInput.type === 'password') {
        passInput.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      } else {
        passInput.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      }
    }

    function fillAdminCredentials() {
      document.getElementById('email').value = 'admin@admin.com';
      document.getElementById('password').value = 'password';
    }

    $('#studioLoginForm').on('submit', function() {
      var btn = $('#submitPortalBtn');
      btn.prop('disabled', true);
      btn.html('<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Authenticating...');
    });
  </script>
</body>
</html>
