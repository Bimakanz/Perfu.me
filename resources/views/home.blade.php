@extends('layouts.app')

@section('title', 'Perfu.me — Luxury & Nusantara Fragrance Series')
@section('description', 'Perfu.me menghadirkan koleksi parfum premium vanessence, dynamyst, dan seri nusantara dengan konsentrat parfum grade A dan ketahanan aromatis hingga 10 jam.')

@section('meta')
<meta name="keywords" content="perfu.me, perfu.me, parfum nusantara, vanessence, dynamyst, eau de parfum, parfum lokal">
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/splash.css') }}">
<link rel="stylesheet" href="{{ asset('css/hero.css') }}">
<link rel="stylesheet" href="{{ asset('css/about-us.css') }}">
<link rel="stylesheet" href="{{ asset('css/testimonials.css') }}">
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
      <a href="/" style="text-decoration:none; color:inherit;"><span class="nav-brand-name">Perfu.me</span></a>
    </div>

    <ul class="nav-links">
      <li><a href="/katalog">Katalog</a></li>
      <li><a href="/quiz">Quiz</a></li>
      <li><a href="#about-story-section" data-nav="about-story-section">Tentang</a></li>
      <li><a href="#testimoni-section" data-nav="testimoni-section">Testimoni</a></li>
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
    <img src="{{ asset('assets/images/newhero.webp') }}" alt="Hero Cinematic Background" class="hero-cinematic-bg">
    <div class="hero-overlay-dark"></div>

    <div class="hero-grid">
      <div class="hero-text-col">
        <h1 class="hero-heading">
          Perfu.me
        </h1>
        <p class="hero-desc">
          Lahir dari pengalaman panjang, kini hadir 2 racikan signature orisinal pertama kami. Diformulasikan dengan Perfume Oil Grade A untuk ketahanan lebih dari jam.
        </p>
        <div class="hero-btn-group">
          <a href="#produk-section" class="btn-hero-primary">Jelajahi Koleksi</a>
        </div>
      </div>
    </div>
  </header>

  {{-- 3.5. ABOUT US SECTION (Our Story & Mission) --}}
  <section id="about-story-section" class="about-us-section">
    <div class="about-us-container">

    <div class="about-us-stats-row">
        <div class="stat-item">
          <div class="stat-number">2</div>
          <div class="stat-title">Signature Scents</div>
          <div class="stat-desc">Pilihan aroma awal yang berkarakter kuat</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">100%</div>
          <div class="stat-title">Local Pride</div>
          <div class="stat-desc">Brand parfum lokal berkualitas premium</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">Harga</div>
          <div class="stat-title">Terjangkau</div>
          <div class="stat-desc">Wangi mewah tanpa bikin kantong bolong</div>
        </div>
      </div>
      <div class="about-us-grid">
        <!-- Left Column: Story & Mission text -->
        <div class="about-us-text-col">
          <span class="about-us-tagline">Cerita & Misi Kami</span>
          <h2 class="about-us-heading">Our Story & Mission</h2>
          <p class="about-us-paragraph">
            Perfu.me lahir dari sebuah keyakinan sederhana: setiap orang berhak tampil harum tanpa harus mengeluarkan biaya yang mahal. Kami adalah brand parfum lokal yang menghadirkan aroma berkarakter dengan kualitas premium dan harga yang tetap ramah di kantong.
          </p>
          <p class="about-us-paragraph">
            Di Perfu.me, kami tidak ingin menghadirkan puluhan aroma tanpa karakter. Kami ingin setiap parfum memiliki identitas kuat yang menjadi bagian dari kepercayaan diri penggunanya—karena parfum bukan sekadar wangi, tapi cara seseorang mengekspresikan dirinya.
          </p>
        </div>

        <!-- Right Column: Interactive Visuals & Slogan Card -->
        <div class="about-us-visual-col">
          <div class="about-us-image-container">
            <img src="{{ asset('assets/images/aboutus.png') }}" alt="Perfu.me Signature Fragrances" class="about-us-single-img">
          </div>
          <!-- Floating Slogan Card -->
          <div class="floating-slogan-card">
            <div class="slogan-badge">Brand Tagline</div>
            <div class="slogan-title">Smell Good. Feel Confident</div>
            <div class="slogan-text">Wangi Gak Harus Mahal.</div>
          </div>
        </div>
      </div>

      <!-- Stats Row at the bottom -->
      
    </div>
  </section>

  {{-- 4. PRODUCTS ZIGZAG CATALOG SHOWCASE --}}
  <section class="products-showcase-section" id="produk-section">
    <div class="showcase-header">
      <div class="catalog-tag" style="font-size: 0.7rem; font-weight: 700; letter-spacing: 0.22em; text-transform: uppercase; color: #8A8A8A; margin-bottom: 0.75rem;">KATALOG PRODUK</div>
      <h2>Perfu.me Signatures</h2>
    </div>

    <div id="produk-section-list">
      {{-- Best-seller products rendered dynamically by catalog.js --}}
    </div>
  </section>

  {{-- 4.5. TESTIMONIALS SECTION --}}
  <section id="testimoni-section" class="testimonials-section">
    <div class="testimonials-container">
      <div class="testimonials-grid">
        <!-- Left Side: Section Info -->
        <div class="testimonials-info-col">
          <span class="testimonials-tag">ULASAN &amp; TESTIMONI</span>
          <h3 class="testimonials-side-heading">Apa kata pelanggan kami</h3>
        </div>

        <!-- Right Side: Review Cards -->
        <div class="testimonials-cards">
          <!-- Review 1 -->
          <div class="testimonial-card">
            <p class="testimonial-text">
              Parfumnya recommended banget! Wanginya tahan seharian, dari pagi dipakai sampai malam pun masih wangi.
            </p>
            <div class="testimonial-stars">
              <span class="testimonial-star">★</span>
              <span class="testimonial-star">★</span>
              <span class="testimonial-star">★</span>
              <span class="testimonial-star">★</span>
              <span class="testimonial-star">★</span>
            </div>
            <div class="testimonial-profile">
              <img src="{{ asset('assets/images/radit.jpeg') }}" alt="Raditya Ghani" class="testimonial-avatar">
              <div class="testimonial-reviewer-info">
                <span class="testimonial-name">Raditya Ghani</span>
                <span class="testimonial-role">Pelanggan Setia</span>
              </div>
            </div>
          </div>

          <!-- Review 2 -->
          <div class="testimonial-card">
            <p class="testimonial-text">
              Wanginya masih menempel di kerudung meskipun sudah 3 hari tidak semprot parfum lagi. Kualitasnya juara, fix bakal order dan borong varian lainnya lagi!
            </p>
            <div class="testimonial-stars">
              <span class="testimonial-star">★</span>
              <span class="testimonial-star">★</span>
              <span class="testimonial-star">★</span>
              <span class="testimonial-star">★</span>
              <span class="testimonial-star">★</span>
            </div>
            <div class="testimonial-profile">
              <img src="{{ asset('assets/images/agus.jpeg') }}" alt="Agustin Putri" class="testimonial-avatar">
              <div class="testimonial-reviewer-info">
                <span class="testimonial-name">Agustin Putri</span>
                <span class="testimonial-role">Pelanggan Setia</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- 5. QUIZ PROMOTION BANNER SECTION --}}
  <section class="quiz-banner-section" id="quiz-banner-section" style="background:#F5F5F7; padding:6rem 2rem; text-align:center;">
    <div style="max-width:760px; margin:0 auto;">
      <span style="font-size:0.72rem; font-weight:700; letter-spacing:0.2em; text-transform:uppercase; color:#8A8A8A; display:inline-block; margin-bottom:1rem;">FIND YOUR SIGNATURE SCENT</span>
      <h2 style="font-family:var(--font-serif); font-size:clamp(2.4rem, 4vw, 3.4rem); font-weight:300; color:#0D0D0D; line-height:1.2; margin-bottom:1.25rem;">
        Masih Bingung Memilih Aroma Parfum Yang Pas?
      </h2>
      <p style="font-size:1.02rem; color:#555555; line-height:1.75; margin-bottom:2.5rem; max-width:620px; margin-left:auto; margin-right:auto;">
        Jawab 5 pertanyaan simpel untuk menemukan varian parfum Perfu.me yang paling cocok dengan kepribadian & aktivitas harian Anda.
      </p>
      <a href="/quiz" style="display:inline-flex; align-items:center; gap:0.6rem; padding:1.05rem 2.4rem; background:#0D0D0D; color:#FFFFFF; border-radius:999px; font-size:0.88rem; font-weight:700; letter-spacing:0.06em; text-decoration:none; transition:all 0.25s ease; box-shadow:0 6px 20px rgba(0,0,0,0.12);" onmouseover="this.style.background='#252525'; this.style.transform='translateY(-2px)';" onmouseout="this.style.background='#0D0D0D'; this.style.transform='translateY(0)';">
        Ikuti Quiz 
      </a>
    </div>
  </section>

  {{-- 6. FOOTER --}}
  <footer id="footer-section" style="background:#0D0D0D; color:#FFF; padding:5rem 4rem 2.5rem 4rem;">
    <div style="max-width:1200px; margin:0 auto; display:grid; grid-template-columns:2fr 1fr 1fr; gap:4rem; margin-bottom:4rem;">
      <div>
        <div style="font-family:var(--font-serif); font-size:2rem; font-weight:300; letter-spacing:0.05em; margin-bottom:0.75rem;">Perfu.me</div>
        <p style="font-size:0.85rem; color:#8A8A8A; line-height:1.7; max-width:380px;">
          Perfu.me lahir dari sebuah keyakinan sederhana: setiap orang berhak tampil harum tanpa harus mengeluarkan biaya yang mahal. Karena itu, kami menghadirkan parfum dengan kualitas aroma premium, karakter yang khas, dan harga yang tetap ramah di kantong.
        </p>
      </div>
      <div>
        <h4 style="color:#C0C0C0; margin-bottom:1.25rem; font-size:0.75rem; letter-spacing:0.15em; text-transform:uppercase;">Best Seller</h4>
        <ul style="list-style:none; display:flex; flex-direction:column; gap:0.75rem; font-size:0.85rem; color:#8A8A8A; padding:0; margin:0;">
          @php
            $bestSellers = \App\Models\Product::where('best_seller', true)->take(6)->get();
          @endphp
          @foreach($bestSellers as $bs)
            <li><a href="/produk/{{ $bs->id }}" class="footer-collection-link">{{ $bs->name }}</a></li>
          @endforeach
        </ul>
      </div>
      <div>
        <h4 style="color:#C0C0C0; margin-bottom:1.25rem; font-size:0.75rem; letter-spacing:0.15em; text-transform:uppercase;">Kontak</h4>
        <p style="font-size:0.85rem; color:#8A8A8A; line-height:1.7;">
          WhatsApp: +62 813-8341-5432<br>
          Email: perfumeofficial30@gmail.com<br>
          Instagram: <a href="https://www.instagram.com/perfu.mefragrance/" target="_blank" rel="noopener" class="footer-collection-link" style="color:#8A8A8A; text-decoration:none;">@perfu.mefragrance</a><br>
          <a href="https://maps.app.goo.gl/xui1fMK73WXR1DD29" target="_blank" rel="noopener" class="footer-collection-link" style="color:#8A8A8A; text-decoration:none; display:inline-block; margin-top:0.2rem;">Jl. Lingkar Dramaga RT 03/04 Desa Dramaga</a>
        </p>
      </div>
    </div>
    <div style="max-width:1200px; margin:0 auto; padding-top:2rem; border-top:1px solid rgba(192,192,192,0.1); display:flex; justify-content: space-between; align-items:center; font-size:0.75rem; color:#8A8A8A;">
      <div>&copy; 2026 Perfu.me. All rights reserved.</div>
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
