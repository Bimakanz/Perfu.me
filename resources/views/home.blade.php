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
<link rel="stylesheet" href="{{ asset('css/exchange-bottle.css') }}">
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

      {{-- Hamburger Button (Mobile Only) --}}
      <button id="nav-hamburger" class="nav-hamburger" aria-label="Buka Menu" aria-expanded="false">
        <span></span>
        <span></span>
        <span></span>
      </button>
    </div>
  </nav>

  @include('partials.navbar')


  {{-- Mobile Menu Drawer --}}
  <div id="nav-mobile-menu" class="nav-mobile-menu" role="dialog" aria-label="Menu Navigasi Mobile">
    <ul class="nav-mobile-links">
      <li><a href="/katalog">Katalog</a></li>
      <li><a href="/quiz">Quiz</a></li>
      <li><a href="#about-story-section">Tentang</a></li>
      <li><a href="#testimoni-section">Testimoni</a></li>
      <li><a href="#footer-section">Kontak</a></li>
    </ul>
    <div class="nav-mobile-actions">
      <span class="nav-mobile-actions-label">Cari &amp; Keranjang</span>
      <button id="btn-open-search-mobile" class="nav-icon-btn" aria-label="Cari Parfum" onclick="document.getElementById('btn-open-search').click(); window.closeMobileMenu && window.closeMobileMenu();">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="11" cy="11" r="8"></circle>
          <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
      </button>
      <button id="btn-open-cart-mobile" class="nav-icon-btn" aria-label="Keranjang Belanja" onclick="document.getElementById('btn-open-cart').click(); window.closeMobileMenu && window.closeMobileMenu();" style="position:relative;">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
          <line x1="3" y1="6" x2="21" y2="6"></line>
          <path d="M16 10a4 4 0 0 1-8 0"></path>
        </svg>
      </button>
    </div>
  </div>

  {{-- 3. HERO SECTION --}}
  <header id="hero">
    <img src="{{ asset('assets/images/herosectionbaru2parfumtanpawm.png') }}" alt="Hero Cinematic Background" class="hero-cinematic-bg">
    <div class="hero-overlay-dark"></div>

    <div class="hero-grid">
      <div class="hero-text-col">
        <h1 class="hero-heading">
          Perfu.me
        </h1>
        <p class="hero-desc">
          Lahir dari pengalaman panjang, kini hadir 2 racikan signature orisinal pertama kami. Diformulasikan dengan Perfume Oil Grade A untuk ketahanan lebih dari 8 jam.
        </p>
        <div class="hero-btn-group">
          <a href="/katalog" class="btn-hero-primary">Jelajahi Koleksi</a>
        </div>
      </div>
    </div>
  </header>

  {{-- 3.5. ABOUT US SECTION (Our Story & Mission) --}}
  <section id="about-story-section" class="about-us-section">
    <div class="about-us-container">

      <!-- Main About Grid (Visual Dominant Layout) -->
      <div class="about-us-grid">
        <!-- Left Column: Story & Mission text -->
        <div class="about-us-text-col">
          <h2 class="about-us-heading">Our Story & Mission</h2>
          <p class="about-us-paragraph">
            Perfu.me lahir dari sebuah keyakinan sederhana: setiap orang berhak tampil harum tanpa harus mengeluarkan biaya yang mahal. Kami menghadirkan racikan parfum berkarakter tinggi dengan kualitas premium yang tetap ramah di kantong.
          </p>
          <p class="about-us-paragraph">
            Kami percaya parfum bukan sekadar wangi, melainkan bentuk ekspresi diri dan pendorong kepercayaan diri utama. Setiap varian diformulasikan secara khusus agar memberikan kesan mewah yang autentik.
          </p>

          <a href="#produk-section" class="about-us-cta-btn">
            <span>Jelajahi Signatures</span>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
          </a>
        </div>

        <!-- Right Column: Dominant Visual Showcase (Image + Floating Slogan Card) -->
        <div class="about-us-visual-col">
          <img src="{{ asset('assets/images/abotus.png') }}" alt="Perfu.me Signature Fragrances" class="about-us-single-img">

          <!-- Floating Luxury Slogan Card (Sharp Edges) -->
          <div class="floating-slogan-card">
            <div class="slogan-badge">Brand Tagline</div>
            <div class="slogan-title">Smell Good. Feel Confident.</div>
            <div class="slogan-text">Wangi Mewah, Terjangkau untuk Semua.</div>
          </div>
        </div>
      </div>

      <!-- Values / Stats Row at the Bottom -->
      <div class="about-us-stats-row">
        <div class="stat-item">
          <div class="stat-number">2</div>
          <div class="stat-title">Signature Scents</div>
          <div class="stat-desc">Pilihan aroma orisinal berkarakter kuat</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">100%</div>
          <div class="stat-title">Local Pride</div>
          <div class="stat-desc">Brand parfum lokal berkualitas tinggi</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">8+ Jam</div>
          <div class="stat-title">Daya Tahan</div>
          <div class="stat-desc">Wangi tahan lama menemani aktivitas harian</div>
        </div>
      </div>

    </div>
  </section>

  {{-- 4. PRODUCTS ZIGZAG CATALOG SHOWCASE --}}
  <section class="products-showcase-section" id="produk-section">
    <div class="showcase-header">
      <h2>Perfu.me Signatures</h2>
    </div>

    @php
      $signatureProducts = \App\Models\Product::where('best_seller', true)
          ->where('type', 'Signature')
          ->orderBy('id')
          ->take(2)
          ->get();
    @endphp

    <div id="produk-section-list">
      @foreach($signatureProducts as $index => $product)
      <div class="product-zigzag-item {{ $index % 2 != 0 ? 'reversed' : '' }}">
        <div class="product-zigzag-image-col">
          <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="product-zigzag-img" onerror="this.src='{{ asset('assets/images/refill.webp') }}'">
        </div>
        <div class="product-zigzag-text-col">
          <span class="product-zigzag-tagline">{{ Str::replace([' — Perfu.me Edition', ' - PERFU.ME EDITION', ' — PERFU.ME EDITION'], '', $product->tagline) }}</span>
          <h3 class="product-zigzag-name">{{ $product->name }}</h3>
          <p class="product-zigzag-desc">{{ $product->description }}</p>
          <div class="product-zigzag-notes">
            <span>{{ $product->top_notes }}</span>
            <span>{{ $product->middle_notes }}</span>
            <span>{{ $product->base_notes }}</span>
          </div>
          <div class="product-zigzag-actions">
            <a href="{{ route('product.detail', $product->id) }}" class="btn-zigzag-primary">Lihat Detail & Beli</a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </section>



<section id="testimoni-section" class="testimonials-section">
    @php
      use Illuminate\Support\Str;

      // Ambil data testimoni dari database (beserta relasi produknya)
      // Mengambil misalnya 8 data terbaru
      $dbTestimonials = \App\Models\Testimonial::with('product')->latest()->take(8)->get();

      // Jika data di database kurang dari 8, kita sediakan fallback data statis agar slider tetap penuh/tidak error
      $fallbackData = [
          ['name' => 'Raditya Ghani', 'text' => 'Parfumnya recommended banget! Wanginya tahan seharian, dari pagi dipakai sampai malam pun masih wangi.', 'rating' => 5, 'product' => null],
          ['name' => 'Agustin Putri', 'text' => 'Wanginya masih menempel di kerudung meskipun sudah 3 hari. Kualitasnya juara, fix bakal borong lagi!', 'rating' => 5, 'product' => null],
          ['name' => 'Victoria Thompson', 'text' => 'Wangi manisnya lembut dan tidak terlalu menyengat — banyak yang tanya parfum apa ini!', 'rating' => 5, 'product' => null],
          ['name' => 'John Peter', 'text' => 'Tidak lengket di kulit, elegan — cocok dipakai ke acara formal maupun santai.', 'rating' => 5, 'product' => null],
          ['name' => 'Natalie Martinez', 'text' => 'Pengiriman cepat dan kemasannya rapi. Wanginya tahan lama, recommended!', 'rating' => 5, 'product' => null],
          ['name' => 'Gabrielle Williams', 'text' => 'Aromanya sophisticated, enak dipakai seharian. Banyak yang tanya mereknya.', 'rating' => 5, 'product' => null],
          ['name' => 'Isabella Rodriguez', 'text' => 'Wajib punya! Aroma manisnya pas, banyak yang bilang wangi saya enak.', 'rating' => 5, 'product' => null],
          ['name' => 'Samantha Johnson', 'text' => 'Pas dipakai hangout, banyak yang tanya parfum apa — suka banget!', 'rating' => 5, 'product' => null],
      ];

      // Jika database sudah ada isinya, kita mapping ke format yang sama
      if ($dbTestimonials->isNotEmpty()) {
          $testimonialsList = $dbTestimonials->map(function($item) {
              return [
                  'name' => $item->name,
                  'text' => $item->text,
                  'rating' => $item->rating,
                  'product' => $item->product // Relasi produk dari database
              ];
          });
      } else {
          // Jika kosong, pakai fallback
          $testimonialsList = collect($fallbackData);
      }

      // Bagi dua untuk baris atas dan baris bawah
      $half = ceil($testimonialsList->count() / 2);
      $rowTopData = $testimonialsList->slice(0, $half);
      $rowBottomData = $testimonialsList->slice($half);
    @endphp

    <div class="testimonials-container">
      
      <!-- HEADER CENTERED -->
      <div class="testimonials-header">
        <span class="testimonials-tag">ULASAN &amp; TESTIMONI</span>
        <h3 class="testimonials-heading">Apa Kata Pelanggan Kami</h3>
      </div>

      <!-- MARQUEE SLIDER -->
      <div class="testimonials-slider">
        <div class="testimonials-cards">
          
          <!-- ROW TOP (Baris Atas: Geser Kanan ke Kiri) -->
          <div class="testimonial-row testimonial-row--top">
            <div class="testimonial-row-track">
              
              <!-- Set Utama + Set Duplikasi (Supaya Seamless Loop) -->
              @foreach($rowTopData->concat($rowTopData) as $item)
                @php
                  $rating = $item['rating'] ?? 5;
                  $tProd = $item['product'] ?? null;
                  $imgPath = $tProd->image ?? '';
                  $imgUrl = filter_var($imgPath, FILTER_VALIDATE_URL) ? $imgPath : (Str::startsWith($imgPath, ['/','assets/']) ? asset($imgPath) : asset('assets/images/'.($imgPath ?: 'refill.webp')));
                @endphp
                <div class="testimonial-card">
                  <div class="testimonial-stars">
                    {!! str_repeat('<span class="testimonial-star">★</span>', $rating) !!}{!! str_repeat('<span class="testimonial-star" style="opacity: 0.3;">☆</span>', 5 - $rating) !!}
                  </div>
                  <p class="testimonial-text">"{{ $item['text'] }}"</p>
                  <div class="testimonial-profile">
                    <div class="testimonial-reviewer-info"><span class="testimonial-name">{{ $item['name'] }}</span></div>
                  </div>
                  <div class="testimonial-purchase">
                    <img loading="lazy" src="{{ $imgUrl }}" alt="{{ $tProd->name ?? 'Refill' }}" class="testimonial-product-img" onerror="this.src='{{ asset('assets/images/refill.webp') }}'">
                    <div class="testimonial-product-info">
                      <span class="testimonial-scent-tag">Chosen Scent</span>
                      <span class="testimonial-product-name">{{ $tProd->name ?? 'Produk Umum' }}</span>
                    </div>
                    <a href="{{ isset($tProd->id) ? route('product.detail', $tProd->id) : '#' }}" class="testimonial-buy">
                      <span class="buy-text-desktop">Beli Varian Ini →</span>
                      <span class="buy-text-mobile">Beli →</span>
                    </a>
                  </div>
                </div>
              @endforeach

            </div>
          </div>

          <!-- ROW BOTTOM (Baris Bawah: Geser Kiri ke Kanan) -->
          <div class="testimonial-row testimonial-row--bottom">
            <div class="testimonial-row-track">
              
              <!-- Set Utama + Set Duplikasi (Supaya Seamless Loop) -->
              @foreach($rowBottomData->concat($rowBottomData) as $item)
                @php
                  $rating = $item['rating'] ?? 5;
                  $tProd = $item['product'] ?? null;
                  $imgPath = $tProd->image ?? '';
                  $imgUrl = filter_var($imgPath, FILTER_VALIDATE_URL) ? $imgPath : (Str::startsWith($imgPath, ['/','assets/']) ? asset($imgPath) : asset('assets/images/'.($imgPath ?: 'refill.webp')));
                @endphp
                <div class="testimonial-card">
                  <div class="testimonial-stars">
                    {!! str_repeat('<span class="testimonial-star">★</span>', $rating) !!}{!! str_repeat('<span class="testimonial-star" style="opacity: 0.3;">☆</span>', 5 - $rating) !!}
                  </div>
                  <p class="testimonial-text">"{{ $item['text'] }}"</p>
                  <div class="testimonial-profile">
                    <div class="testimonial-reviewer-info"><span class="testimonial-name">{{ $item['name'] }}</span></div>
                  </div>
                  <div class="testimonial-purchase">
                    <img loading="lazy" src="{{ $imgUrl }}" alt="{{ $tProd->name ?? 'Refill' }}" class="testimonial-product-img" onerror="this.src='{{ asset('assets/images/refill.webp') }}'">
                    <div class="testimonial-product-info">
                      <span class="testimonial-scent-tag">Chosen Scent</span>
                      <span class="testimonial-product-name">{{ $tProd->name ?? 'Produk Umum' }}</span>
                    </div>
                    <a href="{{ isset($tProd->id) ? route('product.detail', $tProd->id) : '#' }}" class="testimonial-buy">
                      <span class="buy-text-desktop">Beli Varian Ini →</span>
                      <span class="buy-text-mobile">Beli →</span>
                    </a>
                  </div>
                </div>
              @endforeach

            </div>
          </div>

        </div>
      </div>

    </div>
  </section>

  {{-- 4.8. EXCHANGE BOTTLE SECTION (Recycle & Reward Program) --}}
  <section id="exchange-bottle-section" class="exchange-bottle-section">
    <!-- Editorial Watermarks -->
    <div class="exchange-watermark exchange-watermark--top-left" aria-hidden="true">EXCHANGE</div>
    <div class="exchange-watermark exchange-watermark--bottom-right" aria-hidden="true">PERFU.ME</div>

    <div class="exchange-container">
      <!-- Section Header -->
      <div class="exchange-header">
        <h2 class="exchange-main-title">Exchange Your Empty Bottles</h2>
        <p class="exchange-subtitle">
          Kembalikan 10 botol kosong Perfu.me dan dapatkan 1 botol parfum baru (berisi penuh) sebagai bentuk komitmen dan apresiasi kami.
        </p>
      </div>

      <!-- 3-Column Showcase Grid (Left Rules · Center Image · Right Rules) -->
      <div class="exchange-grid">
        
        <!-- Left Column (Points 01 & 02) -->
        <div class="exchange-col exchange-col--left">
          <div class="exchange-item">
            <span class="exchange-item-num">01 / REWARD</span>
            <h3 class="exchange-item-title">10X Botol Kosong = 1 Botol Baru</h3>
            <p class="exchange-item-desc">
              Kumpulkan 10 botol kosong Perfu.me milik Anda dan tukarkan langsung dengan 1 botol parfum baru yang siap pakai dengan varian aroma pilihan Anda.
            </p>
          </div>

          <div class="exchange-item">
            <span class="exchange-item-num">02 / UNIFORMITY</span>
            <h3 class="exchange-item-title">Ukuran Botol Harus Sama</h3>
            <p class="exchange-item-desc">
              Seluruh 10 botol yang dikembalikan wajib memiliki ukuran atau kapasitas yang sama persis (misalnya seluruhnya ukuran 30ml atau 50ml).
            </p>
          </div>
        </div>

        <!-- Center Column (Bottle Showcase with aboutus2.png) -->
        <div class="exchange-center-visual">
          <div class="exchange-img-wrap">
            <img src="{{ asset('assets/images/aboutus2.png') }}" alt="Perfu.me Bottle Exchange Program" class="exchange-center-img" loading="lazy">
          </div>
        </div>

        <!-- Right Column (Points 03 & 04) -->
        <div class="exchange-col exchange-col--right">
          <div class="exchange-item">
            <span class="exchange-item-num">03 / CONDITION</span>
            <h3 class="exchange-item-title">Kondisi Botol Masih Bagus</h3>
            <p class="exchange-item-desc">
              Botol harus dalam keadaan baik, tidak pecah atau retak, serta komponen tutup dan nozzle sprayer masih lengkap dan berfungsi dengan baik.
            </p>
          </div>

          <div class="exchange-item">
            <span class="exchange-item-num">04 / AUTHENTICITY</span>
            <h3 class="exchange-item-title">Botol Original Perfu.me</h3>
            <p class="exchange-item-desc">
              Program penukaran ini khusus berlaku untuk botol original rilisan resmi dari Perfu.me dengan identitas atau label yang masih jelas.
            </p>
          </div>
        </div>

      </div>

      <!-- Bottom WhatsApp CTA Action -->
      <div class="exchange-cta-wrap">
        <a href="https://wa.me/6281383415432?text=Halo%20Perfu.me,%20saya%20ingin%20menukarkan%2010%20botol%20kosong%20Perfu.me%20saya%20dengan%201%20botol%20baru." target="_blank" rel="noopener" class="btn-exchange-wa">
          <i class="fa-brands fa-whatsapp" style="font-size:1.15rem;"></i>
          <span>Tukar Botol via WhatsApp</span>
        </a>
        <span class="exchange-cta-note">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
          Proses penukaran cepat &amp; dapat langsung dikirimkan ke alamat workshop kami
        </span>
      </div>

    </div>
  </section>

  {{-- 5. QUIZ PROMOTION BANNER SECTION --}}

  <section class="quiz-banner-section" id="quiz-banner-section" style="background:#F5F5F7; padding:clamp(3rem, 6vw, 6rem) clamp(1.25rem, 4vw, 2rem); text-align:center;">
    <div style="max-width:760px; margin:0 auto;">
      <span style="font-size:0.72rem; font-weight:700; letter-spacing:0.2em; text-transform:uppercase; color:#8A8A8A; display:inline-block; margin-bottom:1rem;">FIND YOUR SIGNATURE SCENT</span>
      <h2 style="font-family:var(--font-serif); font-size:clamp(1.8rem, 5vw, 3.4rem); font-weight:300; color:#0D0D0D; line-height:1.2; margin-bottom:1.25rem;">
        Masih Bingung Memilih Aroma Parfum Yang Pas?
      </h2>
      <p style="font-size:clamp(0.9rem, 2.5vw, 1.02rem); color:#555555; line-height:1.75; margin-bottom:2.5rem; max-width:620px; margin-left:auto; margin-right:auto;">
        Jawab 5 pertanyaan simpel untuk menemukan varian parfum Perfu.me yang paling cocok dengan kepribadian &amp; aktivitas harian Anda.
      </p>
      <a href="/quiz" style="display:inline-flex; align-items:center; gap:0.6rem; padding:1.05rem 2.4rem; background:#0D0D0D; color:#FFFFFF; border-radius:999px; font-size:0.88rem; font-weight:700; letter-spacing:0.06em; text-decoration:none; transition:all 0.25s ease; box-shadow:0 6px 20px rgba(0,0,0,0.12);" onmouseover="this.style.background='#252525'; this.style.transform='translateY(-2px)';" onmouseout="this.style.background='#0D0D0D'; this.style.transform='translateY(0)';">
        Ikuti Quiz
      </a>
      </section>

  {{-- 6. FOOTER --}}
  @include('partials.footer')

@endsection

@section('scripts')
<script src="{{ asset('js/splash.js') }}"></script>
<script src="{{ asset('js/hero.js') }}"></script>
<script src="{{ asset('js/navbar.js') }}"></script>
<script src="{{ asset('js/catalog.js') }}"></script>
@endsection