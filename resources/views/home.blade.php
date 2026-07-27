@extends('layouts.app')

@section('title', 'Parfu.me — Luxury & Nusantara Fragrance Series')
@section('description', 'Parfu.me menghadirkan koleksi parfum premium vanessence, dynamyst, dan seri nusantara dengan konsentrat parfum grade A dan ketahanan aromatis hingga 10 jam.')

@section('meta')
<meta name="keywords" content="parfu.me, perfu.me, parfum nusantara, vanessence, dynamyst, eau de parfum, parfum lokal">
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/splash.css') }}">
<link rel="stylesheet" href="{{ asset('css/hero.css') }}">
<link rel="stylesheet" href="{{ asset('css/catalog.css') }}">
<link rel="stylesheet" href="{{ asset('css/pdp.css') }}">
<link rel="stylesheet" href="{{ asset('css/product-zigzag.css') }}">
@endsection

@section('content')

  {{-- 1. TYPEWRITER INTRO SPLASH SCREEN --}}
  <div id="splash" role="dialog" aria-modal="true" aria-label="Welcome screen">
    <div class="splash-content">
      <div class="splash-title">
        <span id="splash-typing"></span><span class="typing-cursor">|</span>
      </div>
      <div class="splash-slogan" id="splash-slogan">smell good, feel confident</div>
    </div>
  </div>

  {{-- 2. NAVBAR --}}
  <nav id="navbar" aria-label="Main Navigation">
    <div class="nav-brand" data-nav="home">
      <a href="/" style="text-decoration:none; color:inherit;"><span class="nav-brand-name">Parfu.me</span></a>
    </div>

    <ul class="nav-links">
      <li><a href="/katalog">Produk</a></li>
      <li><a href="#keunggulan-section" data-nav="keunggulan-section">Keunggulan</a></li>
      <li><a href="#about-section" data-nav="about-section">Tentang</a></li>
      <li><a href="#footer-section" data-nav="footer-section">Kontak</a></li>
    </ul>

    <div class="nav-actions">
      <button id="btn-open-search" class="nav-icon-btn" aria-label="Cari Parfum" title="Cari Parfum">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="11" cy="11" r="8"></circle>
          <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
      </button>
      <button id="btn-open-cart" class="nav-icon-btn" aria-label="Keranjang Belanja" title="Keranjang Belanja">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
          <line x1="3" y1="6" x2="21" y2="6"></line>
          <path d="M16 10a4 4 0 0 1-8 0"></path>
        </svg>
        <span class="cart-badge-count" id="cart-badge-count">0</span>
      </button>
    </div>
  </nav>

  {{-- 3. HERO SECTION --}}
  <header id="hero">
    <img src="{{ asset('assets/images/hero_cinematic_bg.png') }}" alt="Hero Cinematic Background" class="hero-cinematic-bg">
    <div class="hero-overlay-dark"></div>

    <div class="hero-grid">
      <div class="hero-text-col">
        <div class="hero-badge">
          <span class="hero-badge-star"></span> KOLEKSI EKSKLUSIF
        </div>
        <h1 class="hero-heading">
          Wewangian<br>Signature
        </h1>
        <p class="hero-desc">
          Dua varian parfum premium yang dirancang untuk mengekspresikan kepribadian unik Anda. Diracik dengan parfum oil grade A dan ketahanan hingga 10 jam.
        </p>
        <div class="hero-btn-group">
          <a href="#produk-section" class="btn-hero-primary">Jelajahi Koleksi</a>
          <a href="#about-section" class="btn-hero-secondary">Cerita Kami</a>
        </div>
      </div>

      <div class="hero-bottles-col">
        <img src="{{ asset('assets/images/truehero.png') }}" alt="3 Perfume Bottles Showcase" class="truehero-img">
      </div>
    </div>
  </header>

  {{-- 4. PRODUCTS ZIGZAG CATALOG SHOWCASE --}}
  <section class="products-showcase-section" id="produk-section">
    <div class="showcase-header">
      <div class="catalog-tag" style="font-size: 0.7rem; font-weight: 700; letter-spacing: 0.22em; text-transform: uppercase; color: #8A8A8A; margin-bottom: 0.75rem;">KATALOG PRODUK</div>
      <h2>Koleksi Wewangian Spesial</h2>
    </div>

    <div id="produk-section-list">
      {{-- Best-seller products rendered dynamically by catalog.js --}}
    </div>
  </section>

  {{-- 5. KEUNGGULAN & ABOUT SECTIONS --}}
  <section class="features-section" id="keunggulan-section">
    <div style="max-width:1100px; margin:0 auto; text-align:center;">
      <h2 style="font-family:var(--font-serif); font-size:2.8rem; font-weight:300; margin-bottom:3rem;">Keunggulan Parfu.me</h2>
      <div class="features-grid">
        <div class="feature-card">
          <div class="feature-icon">🌿</div>
          <h3 class="feature-title">Grade A Concentrate</h3>
          <p class="feature-desc">Dibuat dari minyak wangi konsentrat grade A Eropa berkualitas tinggi tanpa bahan sintetis berbahaya.</p>
        </div>
        <div class="feature-card">
          <div class="feature-icon">⏱️</div>
          <h3 class="feature-title">Ketahanan 10 Jam</h3>
          <p class="feature-desc">Formulasi khusus Eau de Parfum yang melekat secara alami dan tahan lama hingga seharian.</p>
        </div>
        <div class="feature-card">
          <div class="feature-icon">🎁</div>
          <h3 class="feature-title">Kemasan Mewah</h3>
          <p class="feature-desc">Dikemas menggunakan botol kaca spray elegan dan box eksklusif yang cocok untuk hadiah.</p>
        </div>
      </div>
    </div>
  </section>

  <section id="about-section" style="padding:6rem 4rem; max-width:1000px; margin:0 auto; text-align:center;">
    <span style="font-size:0.7rem; font-weight:700; letter-spacing:0.2em; text-transform:uppercase; color:#8A8A8A;">ABOUT PARFU.ME</span>
    <h2 style="font-family:var(--font-serif); font-size:3rem; font-weight:300; margin:0.75rem 0 1.5rem;">Wewangian yang Berbicara</h2>
    <p style="font-size:1rem; line-height:1.8; color:#555; max-width:720px; margin:0 auto;">
      Parfu.me lahir dari semangat menciptakan wewangian berkelas dunia dengan sentuhan jiwa Nusantara. Setiap racikan cerita di dalam botol kami adalah dedikasi untuk menemani Anda tampil lebih percaya diri di setiap momen istimewa.
    </p>
  </section>

  {{-- 6. FOOTER --}}
  <footer id="footer-section" style="background:#0D0D0D; color:#FFF; padding:5rem 4rem 2.5rem 4rem;">
    <div style="max-width:1200px; margin:0 auto; display:grid; grid-template-columns:2fr 1fr 1fr; gap:4rem; margin-bottom:4rem;">
      <div>
        <div style="font-family:var(--font-serif); font-size:2rem; font-weight:300; letter-spacing:0.05em; margin-bottom:0.75rem;">Parfu.me</div>
        <p style="font-size:0.85rem; color:#8A8A8A; line-height:1.7; max-width:340px;">
          Nusantara &amp; Luxury Fragrance Series.<br>
          Menghadirkan keharuman mewah tahan lama untuk setiap momen berharga Anda.
        </p>
      </div>
      <div>
        <h4 style="color:#C0C0C0; margin-bottom:1.25rem; font-size:0.75rem; letter-spacing:0.15em; text-transform:uppercase;">Koleksi</h4>
        <ul style="list-style:none; display:flex; flex-direction:column; gap:0.75rem; font-size:0.85rem; color:#8A8A8A;">
          <li>Vanessence EDP</li>
          <li>Dynamyst EDP</li>
          <li>Nusantara No.1</li>
          <li>Nusantara No.2 Rempah</li>
          <li>Roll-On Mini</li>
        </ul>
      </div>
      <div>
        <h4 style="color:#C0C0C0; margin-bottom:1.25rem; font-size:0.75rem; letter-spacing:0.15em; text-transform:uppercase;">Kontak</h4>
        <p style="font-size:0.85rem; color:#8A8A8A; line-height:1.7;">
          WhatsApp: +62 812-3456-7890<br>
          Email: concierge@perfu.me<br>
          Jakarta, Indonesia
        </p>
      </div>
    </div>
    <div style="max-width:1200px; margin:0 auto; padding-top:2rem; border-top:1px solid rgba(192,192,192,0.1); display:flex; justify-content: space-between; align-items:center; font-size:0.75rem; color:#8A8A8A;">
      <div>&copy; 2026 Parfu.me. All rights reserved.</div>
      <div>Monochrome Luxury Aesthetic System</div>
    </div>
  </footer>

@endsection

@section('scripts')
<script src="{{ asset('js/splash.js') }}"></script>
<script src="{{ asset('js/hero.js') }}"></script>
<script src="{{ asset('js/navbar.js') }}"></script>
<script src="{{ asset('js/catalog.js') }}"></script>
@endsection
