<?php $__env->startSection('title', 'Perfu.me — Luxury & Nusantara Fragrance Series'); ?>
<?php $__env->startSection('description', 'Perfu.me menghadirkan koleksi parfum premium vanessence, dynamyst, dan seri nusantara dengan konsentrat parfum grade A dan ketahanan aromatis hingga 10 jam.'); ?>

<?php $__env->startSection('meta'); ?>
<meta name="keywords" content="perfu.me, perfu.me, parfum nusantara, vanessence, dynamyst, eau de parfum, parfum lokal">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/splash.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('css/hero.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('css/about-us.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('css/testimonials.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('css/catalog.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('css/pdp.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('css/product-zigzag.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

  
  <div id="splash" role="dialog" aria-modal="true" aria-label="Welcome screen">
    <div class="splash-content">
      <div class="splash-title">
        <span id="splash-typing"></span><span class="typing-cursor">|</span>
      </div>
      <div class="splash-slogan" id="splash-slogan">smell good, feel confident</div>
    </div>
  </div>

  
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

  
  <header id="hero">
    <img src="<?php echo e(asset('assets/images/herosectionbaru2parfum.png')); ?>" alt="Hero Cinematic Background" class="hero-cinematic-bg">
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
          <img src="<?php echo e(asset('assets/images/abotus.png')); ?>" alt="Perfu.me Signature Fragrances" class="about-us-single-img">
          
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

  
  <section class="products-showcase-section" id="produk-section">
    <div class="showcase-header">
      <h2>Perfu.me Signatures</h2>
    </div>

    <div id="produk-section-list">
      
    </div>
  </section>

  
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
              <img src="<?php echo e(asset('assets/images/radit.jpeg')); ?>" alt="Raditya Ghani" class="testimonial-avatar">
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
              <img src="<?php echo e(asset('assets/images/agus.jpeg')); ?>" alt="Agustin Putri" class="testimonial-avatar">
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

  
  <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('js/splash.js')); ?>"></script>
<script src="<?php echo e(asset('js/hero.js')); ?>"></script>
<script src="<?php echo e(asset('js/navbar.js')); ?>"></script>
<script src="<?php echo e(asset('js/catalog.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Perfu.me\resources\views/home.blade.php ENDPATH**/ ?>