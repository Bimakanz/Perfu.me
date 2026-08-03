@extends('layouts.app')

@section('title', 'Katalog Parfum — Parfu.me')
@section('description', 'Temukan seluruh koleksi parfum premium Parfu.me — Vanessence, Dynamyst, Nusantara Series, dan Roll-On Mini. Tersedia dalam berbagai varian aroma eksklusif.')

@section('styles')
<style>
  /* ── Katalog Page Specific Styles ──────────────────── */
  body {
    background: #FAFAFA;
    color: #0D0D0D;
    font-family: 'Inter', system-ui, sans-serif;
    margin: 0;
  }

  .katalog-header {
    background: #FFFFFF;
    border-bottom: 1px solid #E5E5E5;
    padding: 5.5rem 4rem 2.5rem;
  }

  .katalog-breadcrumb {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.72rem;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: #8A8A8A;
    margin-bottom: 2rem;
  }

  .katalog-breadcrumb a { color: #8A8A8A; text-decoration: none; transition: color 0.2s; }
  .katalog-breadcrumb a:hover { color: #0D0D0D; }
  .katalog-breadcrumb span { color: #C0C0C0; }

  .katalog-page-title {
    font-family: 'Cormorant Garamond', Georgia, serif;
    font-size: clamp(2rem, 4vw, 3rem);
    font-weight: 300;
    letter-spacing: 0.02em;
    color: #0D0D0D;
    margin: 0 0 0.5rem;
  }

  .katalog-page-sub { font-size: 0.9rem; color: #8A8A8A; margin: 0; }

  .katalog-hook {
    margin-top: 1rem;
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.95rem 1.2rem;
    background: #0D0D0D;
    color: #FFFFFF;
    border-radius: 999px;
    font-size: 0.92rem;
    font-weight: 600;
    text-decoration: none;
  }

  .katalog-hook small {
    font-size: 0.78rem;
    font-weight: 400;
    opacity: 0.86;
  }

  .katalog-body {
    display: grid;
    grid-template-columns: 260px 1fr;
    gap: 0;
    max-width: 1400px;
    margin: 0 auto;
    padding: 2.5rem 4rem 5rem;
    align-items: flex-start;
  }

  .katalog-sidebar {
    padding-right: 2.5rem;
    border-right: 1px solid #E5E5E5;
    position: sticky;
    top: 90px;
  }

  .filter-section { margin-bottom: 2rem; padding-bottom: 2rem; border-bottom: 1px solid #E5E5E5; }
  .filter-section:last-child { border-bottom: none; }

  .filter-section-title {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 0.72rem;
    font-weight: 700;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: #0D0D0D;
    margin-bottom: 1.25rem;
    cursor: pointer;
  }

  .filter-section-title span { font-size: 1rem; color: #8A8A8A; }

  .filter-chips { display: flex; flex-direction: column; gap: 0.5rem; }

  .filter-chip-label {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 0.85rem;
    color: #555;
    cursor: pointer;
    padding: 0.4rem 0;
    transition: color 0.2s;
  }

  .filter-chip-label:hover { color: #0D0D0D; }
  .filter-chip-label input { width: 16px; height: 16px; accent-color: #0D0D0D; cursor: pointer; }

  .price-range-wrap { display: flex; flex-direction: column; gap: 0.75rem; }
  .price-inputs { display: flex; gap: 0.75rem; align-items: center; }

  .price-input-box {
    display: flex;
    align-items: center;
    gap: 0.4rem;
    border: 1px solid #E5E5E5;
    border-radius: 4px;
    padding: 0.45rem 0.75rem;
    font-size: 0.8rem;
    color: #555;
    flex: 1;
  }

  .price-input-box input { border: none; outline: none; font-size: 0.8rem; width: 100%; color: #0D0D0D; font-family: inherit; background: transparent; }

  .price-range-slider { -webkit-appearance: none; width: 100%; height: 2px; background: #E5E5E5; outline: none; border-radius: 2px; }
  .price-range-slider::-webkit-slider-thumb { -webkit-appearance: none; width: 16px; height: 16px; background: #0D0D0D; border-radius: 50%; cursor: pointer; }

  .katalog-main { padding-left: 2.5rem; }

  .sort-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    padding-bottom: 1.25rem;
    border-bottom: 1px solid #E5E5E5;
  }

  .sort-results-count { font-size: 0.82rem; color: #8A8A8A; }
  .sort-results-count strong { color: #0D0D0D; font-weight: 600; }
  .sort-select-wrap { display: flex; align-items: center; gap: 0.75rem; font-size: 0.8rem; color: #555; }

  .sort-select {
    border: 1px solid #E5E5E5;
    border-radius: 4px;
    padding: 0.5rem 1rem;
    font-family: inherit;
    font-size: 0.8rem;
    color: #0D0D0D;
    background: #FFFFFF;
    cursor: pointer;
    outline: none;
    transition: border-color 0.2s;
  }

  .sort-select:hover { border-color: #0D0D0D; }

  .product-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; }

  .product-card {
    background: #FFFFFF;
    border: 1px solid #E5E5E5;
    border-radius: 8px;
    overflow: hidden;
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    cursor: pointer;
  }

  .product-card:hover { border-color: #C0C0C0; box-shadow: 0 12px 32px rgba(0,0,0,0.08); transform: translateY(-3px); }

  .product-card-img-wrap { position: relative; width: 100%; padding-top: 100%; background: #F9F9F9; overflow: hidden; }
  .product-card-img-wrap img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: contain; padding: 1.5rem; transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1); }
  .product-card:hover .product-card-img-wrap img { transform: scale(1.06); }

  .best-seller-badge {
    position: absolute;
    top: 0.75rem;
    left: 0.75rem;
    background: #0D0D0D;
    color: #FFFFFF;
    font-size: 0.6rem;
    font-weight: 700;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    padding: 0.3rem 0.65rem;
    border-radius: 2px;
  }

  .product-card-body { padding: 1.25rem; }
  .product-card-meta { font-size: 0.65rem; font-weight: 600; letter-spacing: 0.18em; text-transform: uppercase; color: #8A8A8A; margin-bottom: 0.4rem; }
  .product-card-name { font-family: 'Cormorant Garamond', Georgia, serif; font-size: 1.2rem; font-weight: 400; color: #0D0D0D; margin-bottom: 0.4rem; line-height: 1.2; }
  .product-card-tagline { font-size: 0.78rem; color: #8A8A8A; margin-bottom: 1rem; font-style: italic; }
  .product-card-price-row { display: flex; align-items: baseline; gap: 0.5rem; margin-bottom: 1rem; }
  .product-card-price { font-family: 'Cormorant Garamond', Georgia, serif; font-size: 1.3rem; font-weight: 500; color: #0D0D0D; }
  .product-card-price-slash { font-size: 0.8rem; color: #C0C0C0; text-decoration: line-through; }
  .product-card-actions { display: flex; gap: 0.5rem; }

  .btn-card-wa {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.4rem;
    padding: 0.7rem;
    background: #0D0D0D;
    color: #FFFFFF;
    border: 1px solid #0D0D0D;
    border-radius: 4px;
    font-size: 0.72rem;
    font-weight: 600;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    text-decoration: none;
    transition: all 0.25s;
  }

  .btn-card-wa:hover { background: #1A1A1A; }


  .btn-card-cart {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0.7rem;
    width: 42px;
    background: #FFFFFF;
    color: #0D0D0D;
    border: 1px solid #E5E5E5;
    border-radius: 4px;
    cursor: pointer;
    transition: all 0.25s;
    flex-shrink: 0;
  }

  .btn-card-cart:hover { border-color: #0D0D0D; background: #F9F9F9; }

  .quiz-card {
    background: #FFFFFF;
    border: 1px solid #E5E5E5;
    border-radius: 16px;
    padding: 1.5rem;
    margin-top: 1.5rem;
  }

  .quiz-card h3 {
    margin: 0 0 1rem;
    font-size: 0.95rem;
    color: #0D0D0D;
  }

  .quiz-option-group {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 0.65rem;
    margin-bottom: 1rem;
  }

  .quiz-option {
    border: 1px solid #D6D6D6;
    border-radius: 999px;
    padding: 0.8rem 0.9rem;
    font-size: 0.82rem;
    color: #0D0D0D;
    background: #FFFFFF;
    cursor: pointer;
    transition: all 0.2s ease;
    text-align: center;
  }

  .quiz-option:hover {
    border-color: #0D0D0D;
    color: #0D0D0D;
  }

  .quiz-option.active {
    border-color: #0D0D0D;
    background: #0D0D0D;
    color: #FFFFFF;
  }

  .quiz-result-card {
    background: #F9F9F9;
    border: 1px solid #E5E5E5;
    border-radius: 12px;
    padding: 1rem 1.25rem;
    color: #333;
  }

  .quiz-result-card strong {
    display: block;
    margin-bottom: 0.65rem;
    font-size: 0.95rem;
  }

  .quiz-result-link {
    display: inline-block;
    margin-top: 0.75rem;
    color: #0D0D0D;
    font-weight: 700;
    text-decoration: underline;
  }

  .product-detail-modal {
    position: fixed;
    inset: 0;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 1.5rem;
    z-index: 9999;
  }

  .product-detail-modal.active {
    display: flex;
  }

  .product-detail-backdrop {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.45);
    backdrop-filter: blur(1px);
  }

  .product-detail-card {
    position: relative;
    width: min(100%, 980px);
    max-height: calc(100vh - 3rem);
    overflow: auto;
    background: #FFFFFF;
    border-radius: 20px;
    box-shadow: 0 40px 90px rgba(0, 0, 0, 0.18);
    z-index: 1;
  }

  .product-detail-close {
    position: absolute;
    top: 1rem;
    right: 1rem;
    width: 38px;
    height: 38px;
    border: none;
    border-radius: 50%;
    background: rgba(0, 0, 0, 0.05);
    color: #0D0D0D;
    font-size: 1.6rem;
    cursor: pointer;
  }

  .product-detail-content {
    padding: 2rem;
  }

  .product-detail-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
  }

  .product-detail-grid img {
    width: 100%;
    border-radius: 18px;
    object-fit: contain;
  }

  .product-detail-meta {
    font-size: 0.72rem;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: #8A8A8A;
    margin-bottom: 0.85rem;
  }

  .product-detail-name {
    margin: 0 0 0.75rem;
    font-family: 'Cormorant Garamond', Georgia, serif;
    font-size: clamp(2rem, 3vw, 2.7rem);
    font-weight: 400;
    color: #0D0D0D;
  }

  .product-detail-tagline {
    margin: 0 0 1rem;
    font-size: 0.95rem;
    color: #555;
  }

  .product-detail-desc {
    margin: 0 0 1.5rem;
    color: #4A4A4A;
    line-height: 1.8;
  }

  .product-detail-notes {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 0.85rem;
    margin-bottom: 1.5rem;
  }

  .product-detail-note {
    background: #F9F9F9;
    border-radius: 12px;
    padding: 1rem 1.1rem;
  }

  .product-detail-note strong {
    display: block;
    margin-bottom: 0.45rem;
    font-size: 0.72rem;
    letter-spacing: 0.16em;
    text-transform: uppercase;
    color: #8A8A8A;
  }

  .product-detail-note span {
    color: #333;
    font-size: 0.9rem;
    line-height: 1.6;
  }

  .product-detail-price-wrap {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    align-items: center;
    margin-bottom: 1rem;
  }

  .product-detail-price {
    font-family: 'Cormorant Garamond', Georgia, serif;
    font-size: 2rem;
    color: #0D0D0D;
  }

  .product-detail-size {
    color: #8A8A8A;
    font-size: 0.95rem;
  }

  .product-detail-stock {
    margin-bottom: 1.5rem;
    font-size: 0.95rem;
    color: #0D0D0D;
  }

  .product-detail-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
  }

  .btn-detail-whatsapp,
  .btn-detail-cart {
    padding: 0.95rem 1.25rem;
    border-radius: 12px;
    font-weight: 700;
    border: none;
    cursor: pointer;
    transition: background 0.2s ease;
  }

  .btn-detail-whatsapp {
    background: #0D0D0D;
    color: #FFFFFF;
  }

  .btn-detail-whatsapp:hover {
    background: #1A1A1A;
  }

  .btn-detail-cart {
    background: #FFFFFF;
    color: #0D0D0D;
    border: 1px solid #E5E5E5;
  }

  .btn-detail-cart:hover {
    background: #F8F8F8;
  }

  @media (max-width: 900px) {
    .product-detail-grid { grid-template-columns: 1fr; }
    .product-detail-notes { grid-template-columns: 1fr; }
  }

  @media (max-width: 1100px) {
    .katalog-body { grid-template-columns: 220px 1fr; padding: 2rem 2rem 4rem; }
    .product-grid { grid-template-columns: repeat(2, 1fr); }
  }

  @media (max-width: 768px) {
    .katalog-body { grid-template-columns: 1fr; }
    .katalog-sidebar { position: static; border-right: none; border-bottom: 1px solid #E5E5E5; padding-right: 0; padding-bottom: 1.5rem; margin-bottom: 1.5rem; }
    .katalog-main { padding-left: 0; }
    .katalog-header { padding: 5rem 1.5rem 2rem; }
    .product-grid { grid-template-columns: repeat(2, 1fr); gap: 1rem; }
  }

  @media (max-width: 480px) {
    .product-grid { grid-template-columns: 1fr; }
  }
</style>
@endsection

@section('content')

  {{-- NAVBAR --}}
  <nav id="navbar" aria-label="Main Navigation">
    <div class="nav-brand">
      <a href="/" class="nav-brand-name" style="text-decoration:none; color:inherit;">Parfu.me</a>
    </div>

    <ul class="nav-links">
      <li><a href="/katalog" style="color:#0D0D0D; font-weight:700; text-decoration:underline; text-underline-offset:4px;">Produk</a></li>
      <li><a href="/quiz">Quiz</a></li>
      <li><a href="/#keunggulan-section">Keunggulan</a></li>
      <li><a href="/#about-section">Tentang</a></li>
      <li><a href="/#footer-section">Kontak</a></li>
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

  {{-- PAGE HEADER --}}
  <div class="katalog-header">
    <div class="katalog-breadcrumb">
      <a href="/">Home</a>
      <span>›</span>
      <span style="color:#0D0D0D;">Produk</span>
    </div>
    <h1 class="katalog-page-title">Koleksi Parfum</h1>
    <p class="katalog-page-sub">Semua koleksi wewangian eksklusif Parfu.me</p>
    <a href="/quiz" class="katalog-hook">Masih bingung pilih parfum? <small>Mulai quiz untuk rekomendasi parfum keseharian Anda.</small></a>
  </div>

  {{-- BODY: SIDEBAR + GRID --}}
  <div class="katalog-body">

    <aside class="katalog-sidebar">
      <div class="filter-section">
        <div class="filter-section-title">Gender <span>—</span></div>
        <div class="filter-chips">
          <label class="filter-chip-label"><input type="checkbox" name="gender" value="Wanita" id="filter-wanita"> Wanita</label>
          <label class="filter-chip-label"><input type="checkbox" name="gender" value="Pria" id="filter-pria"> Pria</label>
          <label class="filter-chip-label"><input type="checkbox" name="gender" value="Unisex" id="filter-unisex"> Unisex</label>
        </div>
      </div>

      <div class="filter-section">
        <div class="filter-section-title">Varian Aroma <span>—</span></div>
        <div class="filter-chips">
          <label class="filter-chip-label"><input type="checkbox" name="variant" value="Woody Floral" id="filter-woody"> Woody Floral</label>
          <label class="filter-chip-label"><input type="checkbox" name="variant" value="Spicy" id="filter-spicy"> Spicy</label>
          <label class="filter-chip-label"><input type="checkbox" name="variant" value="Sweet Floral" id="filter-sweet"> Sweet Floral</label>
          <label class="filter-chip-label"><input type="checkbox" name="variant" value="Gourmand" id="filter-gourmand"> Gourmand</label>
        </div>
      </div>

      <div class="filter-section">
        <div class="filter-section-title">Harga <span>—</span></div>
        <div class="price-range-wrap">
          <input type="range" min="0" max="300000" step="5000" value="300000" class="price-range-slider" id="price-range-slider">
          <div class="price-inputs">
            <div class="price-input-box"><span>Rp</span><input type="number" value="0" min="0" max="300000" id="price-min" readonly></div>
            <span style="color:#8A8A8A; font-size:0.8rem;">—</span>
            <div class="price-input-box"><span>Rp</span><input type="number" value="300000" min="0" max="300000" id="price-max" readonly></div>
          </div>
        </div>
      </div>

      <div class="filter-section" style="border-bottom:none;">
        <div class="filter-section-title">Best Seller <span>—</span></div>
        <div class="filter-chips">
          <label class="filter-chip-label"><input type="checkbox" name="bestseller" value="true" id="filter-bestseller"> Hanya Best Seller</label>
        </div>
      </div>

    </aside>

    <main class="katalog-main">
      <div class="sort-bar">
        <p class="sort-results-count" id="results-count"><strong>0</strong> produk</p>
        <div class="sort-select-wrap">
          Sort by:
          <select class="sort-select" id="sort-select">
            <option value="default">Default</option>
            <option value="price-asc">Harga: Rendah ke Tinggi</option>
            <option value="price-desc">Harga: Tinggi ke Rendah</option>
            <option value="name-asc">Nama: A–Z</option>
          </select>
        </div>
      </div>
      <div class="product-grid" id="katalog-grid"></div>
    </main>

  </div>

  <div id="product-detail-modal" class="product-detail-modal" aria-hidden="true">
    <div class="product-detail-backdrop" onclick="closeProductDetail()"></div>
    <div class="product-detail-card" role="dialog" aria-modal="true" aria-labelledby="product-detail-title">
      <button type="button" class="product-detail-close" aria-label="Tutup detail produk" onclick="closeProductDetail()">×</button>
      <div class="product-detail-content" id="product-detail-content"></div>
    </div>
  </div>

@endsection

@section('scripts')
<script>
  const ALL_PRODUCTS = [
    { id: 1, name: 'Vanessence', type: 'Eau de Parfum', gender: 'Wanita', variant: 'Gourmand Vanilla', size: '30ML', price: 150000, stock: 30, best_seller: true, image: '{{ asset("assets/images/penisence.webp") }}', tagline: 'Feminin, manis, dan memikat' },
    { id: 2, name: 'Dynamyst', type: 'Eau de Parfum', gender: 'Pria', variant: 'Spicy Woody', size: '30ML', price: 150000, stock: 25, best_seller: false, image: '{{ asset("assets/images/dynamyst.png") }}', tagline: 'Maskulin, tegas, penuh energi' },
    { id: 3, name: 'Nusantara No.1', type: 'Eau de Parfum', gender: 'Unisex', variant: 'Woody Floral', size: '30ML', price: 85000, stock: 42, best_seller: true, image: '{{ asset("assets/images/Nusantara1nobg.png") }}', tagline: 'Elegan, segar, dan abadi' },
    { id: 4, name: 'Nusantara No.2 \u2013 Rempah', type: 'Eau de Parfum', gender: 'Pria', variant: 'Spicy Oriental', size: '30ML', price: 95000, stock: 18, best_seller: false, image: '{{ asset("assets/images/nusantara_no2.png") }}', tagline: 'Berani, hangat, dan penuh karakter' },
    { id: 5, name: 'Nusantara Roll-On Mini', type: 'Roll-on', gender: 'Wanita', variant: 'Sweet Floral', size: '10ML', price: 35000, stock: 76, best_seller: true, image: '{{ asset("assets/images/nusantara_rollon.png") }}', tagline: 'Manis, segar, dan memikat' }
  ];

  const FALLBACK_IMG = '{{ asset("assets/images/Nusantara1nobg.png") }}';

  function formatPrice(n) { return 'Rp ' + Number(n).toLocaleString('id-ID'); }

  function renderGrid(products) {
    const grid = document.getElementById('katalog-grid');
    const countEl = document.getElementById('results-count');
    if (countEl) countEl.innerHTML = `<strong>${products.length}</strong> produk`;
    if (!products.length) {
      grid.innerHTML = `<div style="grid-column:1/-1;text-align:center;padding:4rem 0;color:#8A8A8A;font-size:0.9rem;">Tidak ada produk yang sesuai filter.</div>`;
      return;
    }
    grid.innerHTML = products.map(p => `
      <div class="product-card" onclick="openProductDetail(${p.id})" role="button" tabindex="0">
        <div class="product-card-img-wrap">
          <img src="${p.image}" alt="${p.name}" loading="lazy" onerror="this.src='${FALLBACK_IMG}'">
          ${p.best_seller ? '<span class="best-seller-badge">Best Seller</span>' : ''}
        </div>
        <div class="product-card-body">
          <div class="product-card-meta">${p.type.toUpperCase()} • ${p.gender.toUpperCase()} • ${p.variant.toUpperCase()}</div>
          <div class="product-card-name">${p.name}</div>
          <div class="product-card-tagline">${p.tagline}</div>
          <div class="product-card-price-row">
            <span class="product-card-price">${formatPrice(p.price)}</span>
            <span class="product-card-price-slash">Rp 220.000</span>
          </div>
          <div class="product-card-actions">
            <a href="https://wa.me/6281234567890?text=Halo%2C%20saya%20ingin%20memesan%20${encodeURIComponent(p.name)}%20(${p.size})%20seharga%20${encodeURIComponent(formatPrice(p.price))}" target="_blank" rel="noopener" class="btn-card-wa" onclick="event.stopPropagation()">Pesan WhatsApp</a>
            <button class="btn-card-cart" onclick="event.stopPropagation(); window.addToCart(${p.id})" title="Masukkan ke Keranjang">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
            </button>
          </div>
        </div>
      </div>
    `).join('');
  }

  function applyFilters() {
    let products = [...ALL_PRODUCTS];
    const genderChecks = [...document.querySelectorAll('input[name="gender"]:checked')].map(i => i.value.toLowerCase());
    if (genderChecks.length > 0) products = products.filter(p => genderChecks.includes(p.gender.toLowerCase()));
    const variantChecks = [...document.querySelectorAll('input[name="variant"]:checked')].map(i => i.value.toLowerCase());
    if (variantChecks.length > 0) products = products.filter(p => variantChecks.some(v => p.variant.toLowerCase().includes(v)));
    const priceMax = Number(document.getElementById('price-range-slider').value);
    products = products.filter(p => p.price <= priceMax);
    if (document.getElementById('filter-bestseller').checked) products = products.filter(p => p.best_seller);
    const sortVal = document.getElementById('sort-select').value;
    if (sortVal === 'price-asc') products.sort((a,b) => a.price - b.price);
    else if (sortVal === 'price-desc') products.sort((a,b) => b.price - a.price);
    else if (sortVal === 'name-asc') products.sort((a,b) => a.name.localeCompare(b.name));
    renderGrid(products);
  }

  function openProductDetail(id) {
    const product = ALL_PRODUCTS.find(p => Number(p.id) === Number(id));
    if (!product) return;
    const modal = document.getElementById('product-detail-modal');
    const content = document.getElementById('product-detail-content');
    if (!modal || !content) return;

    const whatsappUrl = `https://wa.me/6281234567890?text=Halo%2C%20saya%20ingin%20memesan%20${encodeURIComponent(product.name)}%20(${product.size})%20seharga%20${encodeURIComponent(formatPrice(product.price))}`;

    content.innerHTML = `
      <div class="product-detail-grid">
        <div>
          <img src="${product.image}" alt="${product.name}" onerror="this.src='${FALLBACK_IMG}'">
        </div>
        <div>
          <div class="product-detail-meta">${product.type.toUpperCase()} • ${product.gender.toUpperCase()} • ${product.variant.toUpperCase()}</div>
          <h2 class="product-detail-name" id="product-detail-title">${product.name}</h2>
          <p class="product-detail-tagline">${product.tagline}</p>
          <p class="product-detail-desc">${product.description || 'Detail parfum resmi Parfu.me dengan aroma pilihan.'}</p>

          <div class="product-detail-notes">
            <div class="product-detail-note"><strong>Top Notes</strong><span>${product.top_notes || '–'}</span></div>
            <div class="product-detail-note"><strong>Heart Notes</strong><span>${product.middle_notes || '–'}</span></div>
            <div class="product-detail-note"><strong>Base Notes</strong><span>${product.base_notes || '–'}</span></div>
          </div>

          <div class="product-detail-price-wrap">
            <span class="product-detail-price">${formatPrice(product.price)}</span>
            <span class="product-detail-size">${product.size}</span>
          </div>
          <div class="product-detail-stock">${product.stock > 0 ? `Stok tersedia: ${product.stock} pcs` : 'Stok habis'}</div>
          <div class="product-detail-actions">
            <a href="${whatsappUrl}" target="_blank" rel="noopener" class="btn-detail-whatsapp">Pesan via WhatsApp</a>
            <button type="button" class="btn-detail-cart" onclick="window.addToCart(${product.id})">Tambahkan ke Keranjang</button>
          </div>
        </div>
      </div>
    `;

    modal.classList.add('active');
    modal.setAttribute('aria-hidden', 'false');
  }

  function closeProductDetail() {
    const modal = document.getElementById('product-detail-modal');
    if (!modal) return;
    modal.classList.remove('active');
    modal.setAttribute('aria-hidden', 'true');
  }

  async function initKatalog() {
    try {
      if (window.API && typeof window.API.getAll === 'function') {
        const apiProducts = await window.API.getAll();
        if (apiProducts && apiProducts.length > 0) {
          ALL_PRODUCTS.length = 0;
          apiProducts.forEach(p => ALL_PRODUCTS.push(p));
        }
      }
    } catch(e) {}
    applyFilters();
  }

  document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('input[name="gender"], input[name="variant"], #filter-bestseller').forEach(el => el.addEventListener('change', applyFilters));
    const slider = document.getElementById('price-range-slider');
    slider.addEventListener('input', () => { document.getElementById('price-max').value = slider.value; applyFilters(); });
    document.getElementById('sort-select').addEventListener('change', applyFilters);

    initKatalog();
  });
</script>
<script src="{{ asset('js/navbar.js') }}"></script>
@endsection
