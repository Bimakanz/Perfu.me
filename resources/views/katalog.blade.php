@extends('layouts.app')

@section('title', 'Katalog Parfum — Perfu.me')
@section('description', 'Temukan seluruh koleksi parfum premium Perfu.me — Vanessence, Dynamyst, Nusantara Series, dan Roll-On Mini. Tersedia dalam berbagai varian aroma eksklusif.')

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
    margin-bottom: 0.6rem;
  }

  .katalog-breadcrumb a { color: #8A8A8A; text-decoration: none; transition: color 0.2s; }
  .katalog-breadcrumb a:hover { color: #0D0D0D; }
  .katalog-breadcrumb span { color: #C0C0C0; }

  .katalog-page-title {
    font-family: 'Zaloga', Georgia, serif;
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
    top: 135px;
    padding-top: 0.5rem;
  }

  .filter-section { margin-bottom: 2rem; padding-bottom: 2rem; border-bottom: 1px solid #E5E5E5; }
  .filter-section:last-child { border-bottom: none; }

  .filter-section-title {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 0.92rem;
    font-weight: 700;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: #0D0D0D;
    margin-bottom: 1.25rem;
    cursor: pointer;
    user-select: none;
  }

  .filter-section-title span { 
    font-size: 1.4rem; 
    font-weight: 400;
    line-height: 1;
    color: #0D0D0D; 
    transition: transform 0.2s ease, color 0.2s ease;
  }

  .filter-section-title:hover span {
    color: #555555;
  }

  .filter-section-body {
    display: none;
    padding-top: 0.25rem;
  }

  .filter-section.open .filter-section-body {
    display: block;
  }

  .filter-chips { display: flex; flex-direction: column; gap: 0.6rem; }

  .filter-chip-label {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 0.92rem;
    color: #4A4A4A;
    cursor: pointer;
    padding: 0.35rem 0;
    transition: color 0.2s;
  }

  .filter-chip-label:hover { color: #0D0D0D; }
  .filter-chip-label input { width: 17px; height: 17px; accent-color: #0D0D0D; cursor: pointer; }

  .price-range-wrap { display: flex; flex-direction: column; gap: 0.85rem; }
  .price-inputs { display: flex; gap: 0.35rem; align-items: center; justify-content: space-between; }

  .price-input-box {
    display: flex;
    align-items: center;
    gap: 0.25rem;
    background: #FFFFFF;
    border: 1px solid #E5E5E5;
    border-radius: 6px;
    padding: 0.45rem 0.5rem;
    color: #0D0D0D;
    flex: 1;
    min-width: 0;
    overflow: hidden;
  }

  .price-input-box span.currency {
    color: #8A8A8A;
    font-size: 0.75rem;
    font-weight: 500;
    flex-shrink: 0;
  }

  .price-input-box input { 
    border: none; 
    outline: none; 
    font-size: 0.78rem; 
    font-weight: 600;
    letter-spacing: -0.01em;
    width: 100%; 
    color: #0D0D0D; 
    font-family: inherit; 
    background: transparent; 
    padding: 0;
    box-sizing: border-box;
  }

  .price-range-slider { 
    -webkit-appearance: none; 
    width: 100%; 
    height: 4px; 
    background: #E5E5E5; 
    outline: none; 
    border-radius: 4px; 
    cursor: pointer;
  }
  
  .price-range-slider::-webkit-slider-thumb { 
    -webkit-appearance: none; 
    width: 18px; 
    height: 18px; 
    background: #0D0D0D; 
    border-radius: 50%; 
    cursor: pointer; 
    box-shadow: 0 2px 6px rgba(0,0,0,0.15);
    transition: transform 0.15s ease;
  }

  .price-range-slider::-webkit-slider-thumb:hover {
    transform: scale(1.15);
  }

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
  .sort-select-wrap { 
    display: flex; 
    align-items: center; 
    gap: 0.75rem; 
    font-size: 0.82rem; 
    font-weight: 600;
    letter-spacing: 0.04em;
    color: #71717A; 
  }

  .custom-sort-dropdown {
    position: relative;
    user-select: none;
  }

  .custom-sort-btn {
    display: inline-flex;
    align-items: center;
    justify-content: space-between;
    gap: 0.75rem;
    background: #FFFFFF;
    border: 1px solid #E4E4E7;
    border-radius: 8px;
    padding: 0.6rem 1.1rem;
    font-family: inherit;
    font-size: 0.82rem;
    font-weight: 600;
    color: #0D0D0D;
    cursor: pointer;
    transition: all 0.25s var(--ease-luxury);
    box-shadow: 0 1px 3px rgba(0,0,0,0.03);
  }

  .custom-sort-btn:hover, .custom-sort-dropdown.open .custom-sort-btn {
    border-color: #0D0D0D;
    box-shadow: 0 4px 14px rgba(0,0,0,0.06);
  }

  .custom-sort-btn svg {
    transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
  }

  .custom-sort-dropdown.open .custom-sort-btn svg {
    transform: rotate(180deg);
  }

  .custom-sort-menu {
    position: absolute;
    top: calc(100% + 6px);
    right: 0;
    min-width: 210px;
    background: #FFFFFF;
    border: 1px solid #E4E4E7;
    border-radius: 10px;
    box-shadow: 0 12px 36px rgba(0,0,0,0.12);
    padding: 0.4rem;
    z-index: 500;
    display: none;
    flex-direction: column;
    gap: 2px;
    animation: sortMenuPop 0.2s cubic-bezier(0.16, 1, 0.3, 1) forwards;
  }

  @keyframes sortMenuPop {
    from { opacity: 0; transform: translateY(-6px); }
    to { opacity: 1; transform: translateY(0); }
  }

  .custom-sort-dropdown.open .custom-sort-menu {
    display: flex;
  }

  .custom-sort-opt {
    padding: 0.65rem 0.9rem;
    font-size: 0.82rem;
    font-weight: 500;
    color: #52525B;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .custom-sort-opt:hover {
    background: #F4F4F5;
    color: #0D0D0D;
  }

  .custom-sort-opt.active {
    background: #0D0D0D;
    color: #FFFFFF;
    font-weight: 600;
  }

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

  .product-card-img-wrap { 
    position: relative; 
    width: 100%; 
    padding-top: 100%; 
    background: #F4F4F5; 
    overflow: hidden; 
  }
  
  .product-card-img-wrap img { 
    position: absolute; 
    inset: 0; 
    width: 100%; 
    height: 100%; 
    object-fit: cover; 
    padding: 0 !important; 
    transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1); 
  }
  
  .product-card:hover .product-card-img-wrap img { transform: scale(1.06); }

  .best-seller-badge {
    position: absolute;
    top: 0.75rem;
    left: 0.75rem;
    background: rgba(13, 13, 13, 0.9);
    backdrop-filter: blur(4px);
    color: #FFFFFF;
    font-size: 0.6rem;
    font-weight: 700;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    padding: 0.35rem 0.75rem;
    border-radius: 4px;
    z-index: 2;
  }

  .product-card-body { padding: 1.25rem; }
  .product-card-meta { font-size: 0.65rem; font-weight: 600; letter-spacing: 0.18em; text-transform: uppercase; color: #8A8A8A; margin-bottom: 0.4rem; }
  .product-card-name { font-family: 'Zaloga', Georgia, serif; font-size: 1.2rem; font-weight: 400; color: #0D0D0D; margin-bottom: 0.4rem; line-height: 1.2; }
  .product-card-tagline { font-size: 0.78rem; color: #8A8A8A; margin-bottom: 1rem; font-style: italic; }
  .product-card-price-row { display: flex; align-items: baseline; gap: 0.5rem; margin-bottom: 1rem; }
  .product-card-price { font-family: 'Inter', system-ui, sans-serif; font-size: 1.12rem; font-weight: 700; color: #0D0D0D; }
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

  /* ── Skeleton Loading Shimmer ──────────────────────────────── */
  .skeleton-card {
    background: #FFFFFF;
    border: 1px solid #E5E5E5;
    border-radius: 8px;
    overflow: hidden;
    pointer-events: none;
  }

  .skeleton-img {
    width: 100%;
    padding-top: 100%;
    background: #EAEAEA;
    position: relative;
    overflow: hidden;
  }

  .skeleton-body {
    padding: 1.25rem;
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
  }

  .skeleton-line {
    height: 14px;
    background: #EAEAEA;
    border-radius: 4px;
    position: relative;
    overflow: hidden;
  }

  .skeleton-line.w-40 { width: 40%; height: 10px; }
  .skeleton-line.w-70 { width: 70%; height: 18px; }
  .skeleton-line.w-50 { width: 50%; height: 12px; }
  .skeleton-line.w-30 { width: 30%; height: 20px; }
  .skeleton-line.w-100 { width: 100%; height: 38px; border-radius: 4px; }

  .skeleton-shimmer::after {
    content: "";
    position: absolute;
    inset: 0;
    transform: translateX(-100%);
    background: linear-gradient(
      90deg,
      rgba(255, 255, 255, 0) 0%,
      rgba(255, 255, 255, 0.6) 50%,
      rgba(255, 255, 255, 0) 100%
    );
    animation: shimmer 1.5s infinite;
  }

  @keyframes shimmer {
    100% { transform: translateX(100%); }
  }

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
    font-family: 'Zaloga', Georgia, serif;
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
    font-family: 'Zaloga', Georgia, serif;
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

  /* ── Pagination Styling (Clean Text Luxury) ───────────────── */
  .katalog-pagination {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1.5rem;
    margin-top: 3.5rem;
    padding-top: 2rem;
    border-top: 1px solid #E5E5E5;
    grid-column: 1 / -1;
  }

  .page-btn {
    background: transparent;
    border: none;
    padding: 0.4rem 0.6rem;
    font-family: inherit;
    font-size: 0.88rem;
    font-weight: 500;
    color: #8A8A8A;
    cursor: pointer;
    transition: all 0.2s ease;
    user-select: none;
    text-decoration: none;
  }

  .page-btn.page-nav {
    font-size: 0.85rem;
    font-weight: 700;
    letter-spacing: 0.16em;
    text-transform: uppercase;
    color: #0D0D0D;
  }

  .page-btn:hover:not(.disabled) {
    color: #0D0D0D;
  }

  .page-btn.active {
    color: #0D0D0D;
    font-weight: 700;
    text-decoration: underline;
    text-underline-offset: 6px;
  }

  .page-btn.disabled {
    opacity: 0.25;
    cursor: not-allowed;
  }
</style>
@endsection

@section('content')

  {{-- NAVBAR --}}
  <nav id="navbar" aria-label="Main Navigation">
    <div class="nav-brand">
      <a href="/" class="nav-brand-name" style="text-decoration:none; color:inherit;">Perfu.me</a>
    </div>

    <ul class="nav-links">
      <li><a href="/katalog" style="color:#0D0D0D; font-weight:700; text-decoration:underline; text-underline-offset:4px;">Katalog</a></li>
      <li><a href="/quiz">Quiz</a></li>
      <li><a href="/#about-story-section">Tentang</a></li>
      <li><a href="/#testimoni-section">Testimoni</a></li>
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
    <p class="katalog-page-sub">Semua koleksi wewangian eksklusif Perfu.me</p>
    <a href="/quiz" class="katalog-hook">Masih bingung pilih parfum? <small>Mulai quiz untuk rekomendasi parfum keseharian Anda.</small></a>
  </div>

  {{-- BODY: SIDEBAR + GRID --}}
  <div class="katalog-body">

    <aside class="katalog-sidebar">
      <div class="filter-section">
        <div class="filter-section-title" onclick="toggleFilterSection(this)">Gender <span>+</span></div>
        <div class="filter-section-body">
          <div class="filter-chips">
            <label class="filter-chip-label"><input type="checkbox" name="gender" value="Wanita" id="filter-wanita"> Wanita</label>
            <label class="filter-chip-label"><input type="checkbox" name="gender" value="Pria" id="filter-pria"> Pria</label>
            <label class="filter-chip-label"><input type="checkbox" name="gender" value="Unisex" id="filter-unisex"> Unisex</label>
          </div>
        </div>
      </div>

      <div class="filter-section">
        <div class="filter-section-title" onclick="toggleFilterSection(this)">Varian Aroma <span>+</span></div>
        <div class="filter-section-body">
          <div class="filter-chips">
            <label class="filter-chip-label"><input type="checkbox" name="variant" value="Citrus" id="filter-citrus"> Citrus &amp; Fresh</label>
            <label class="filter-chip-label"><input type="checkbox" name="variant" value="Vanilla" id="filter-vanilla"> Vanilla &amp; Gourmand</label>
            <label class="filter-chip-label"><input type="checkbox" name="variant" value="Fruity" id="filter-fruity"> Fruity &amp; Berry</label>
            <label class="filter-chip-label"><input type="checkbox" name="variant" value="Woody" id="filter-woody"> Woody &amp; Spicy</label>
            <label class="filter-chip-label"><input type="checkbox" name="variant" value="Floral" id="filter-floral"> Floral &amp; Musk</label>
          </div>
        </div>
      </div>

      <div class="filter-section" style="border-bottom:none;">
        <div class="filter-section-title" onclick="toggleFilterSection(this)">Harga <span>+</span></div>
        <div class="filter-section-body">
          <div class="price-range-wrap">
            <input type="range" min="0" max="300000" step="5000" value="300000" class="price-range-slider" id="price-range-slider">
            <div class="price-inputs">
              <div class="price-input-box">
                <span class="currency">Rp</span>
                <input type="text" value="0" id="price-min" readonly>
              </div>
              <span style="color:#8A8A8A; font-size:0.8rem; flex-shrink:0;">—</span>
              <div class="price-input-box">
                <span class="currency">Rp</span>
                <input type="text" value="300.000" id="price-max" readonly>
              </div>
            </div>
          </div>
        </div>
      </div>

    </aside>

    <main class="katalog-main">
      <div class="sort-bar">
        <p class="sort-results-count" id="results-count"><strong>0</strong> produk</p>
        <div class="sort-select-wrap">
          <span>Sort by:</span>
          <div class="custom-sort-dropdown" id="custom-sort-dropdown">
            <button type="button" class="custom-sort-btn" id="custom-sort-btn">
              <span id="custom-sort-label">Default</span>
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </button>
            <div class="custom-sort-menu" id="custom-sort-menu">
              <div class="custom-sort-opt active" data-value="default">Default</div>
              <div class="custom-sort-opt" data-value="bestseller">Best Seller</div>
              <div class="custom-sort-opt" data-value="price-asc">Harga: Rendah ke Tinggi</div>
              <div class="custom-sort-opt" data-value="price-desc">Harga: Tinggi ke Rendah</div>
            </div>
          </div>
          <select id="sort-select" style="display:none;">
            <option value="default">Default</option>
            <option value="bestseller">Best Seller</option>
            <option value="price-asc">Harga: Rendah ke Tinggi</option>
            <option value="price-desc">Harga: Tinggi ke Rendah</option>
          </select>
        </div>
      </div>
      <div class="product-grid" id="katalog-grid"></div>
    </main>
  </div>

  {{-- FOOTER --}}
  <footer id="footer-section" style="background:#0D0D0D; color:#FFF; padding:5rem 4rem 2.5rem 4rem; margin-top: 5rem; position:relative; z-index:1;">
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
            <li><a href="/produk/{{ $bs->id }}" class="footer-collection-link" style="color:#8A8A8A; text-decoration:none; transition:color 0.2s;">{{ $bs->name }}</a></li>
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
<script>
  let currentPage = 1;
  const ITEMS_PER_PAGE = 15;

  const ALL_PRODUCTS = [
    { id: 1, name: 'Vanessence', type: 'Signature', gender: 'Wanita', variant: 'Gourmand Vanilla', size: '30ML', price: 45000, stock: 30, best_seller: true, image: '{{ asset("assets/images/penisence.webp") }}', tagline: 'Feminin, manis, dan memikat' },
    { id: 2, name: 'Dynamyst', type: 'Signature', gender: 'Pria', variant: 'Spicy Woody', size: '30ML', price: 45000, stock: 25, best_seller: true, image: '{{ asset("assets/images/dynamyst.png") }}', tagline: 'Maskulin, tegas, penuh energi' }
  ];

  const FALLBACK_IMG = '{{ asset("assets/images/refill.webp") }}';

  function formatPrice(n) { return 'Rp ' + Number(n).toLocaleString('id-ID'); }

  function renderGrid(products) {
    const grid = document.getElementById('katalog-grid');
    const countEl = document.getElementById('results-count');
    if (countEl) countEl.innerHTML = `<strong>${products.length}</strong> produk`;
    if (!products.length) {
      grid.innerHTML = `<div style="grid-column:1/-1;text-align:center;padding:4rem 0;color:#8A8A8A;font-size:0.9rem;">Tidak ada produk yang sesuai filter.</div>`;
      return;
    }

    // Pagination Calculation
    const totalPages = Math.ceil(products.length / ITEMS_PER_PAGE);
    if (currentPage > totalPages) currentPage = 1;

    const startIndex = (currentPage - 1) * ITEMS_PER_PAGE;
    const paginatedProducts = products.slice(startIndex, startIndex + ITEMS_PER_PAGE);

    const isSignature = (p) => {
      const name = p.name.toLowerCase();
      const type = (p.type || '').toLowerCase();
      return name.includes('dynamyst') || name.includes('vanessence') || type === 'signature';
    };

    const signatureProds = paginatedProducts.filter(isSignature);
    const refillProds = paginatedProducts.filter(p => !isSignature(p));

    const renderCard = (p) => `
      <div class="product-card" onclick="window.location.href='/produk/${p.id}'" role="button" tabindex="0">
        <div class="product-card-img-wrap">
          <img src="${p.image}" alt="${p.name}" loading="lazy" onerror="this.src='${FALLBACK_IMG}'">
          ${p.best_seller ? '<span class="best-seller-badge">Best Seller</span>' : ''}
        </div>
        <div class="product-card-body">
          <div class="product-card-meta">${p.type.toUpperCase()} • ${p.gender.toUpperCase()} • ${p.variant.toUpperCase()}</div>
          <div class="product-card-name">${p.name}</div>
          <div class="product-card-tagline">${p.tagline || ''}</div>
          <div class="product-card-price-row">
            <span class="product-card-price">${formatPrice(p.price)}</span>
          </div>
          <div class="product-card-actions">
            <a href="https://wa.me/6281234567890?text=Halo%2C%20saya%20ingin%20memesan%20${encodeURIComponent(p.name)}%20(${p.size})%20seharga%20${encodeURIComponent(formatPrice(p.price))}" target="_blank" rel="noopener" class="btn-card-wa" onclick="event.stopPropagation()">Pesan WhatsApp</a>
            <button class="btn-card-cart" onclick="event.stopPropagation(); window.addToCart(${p.id})" title="Masukkan ke Keranjang">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
            </button>
          </div>
        </div>
      </div>
    `;

    let html = '';

    // 1. Signature Section (Tampil di Halaman 1 jika ada)
    if (signatureProds.length > 0) {
      html += `
        <div class="katalog-section-divider-title" style="grid-column: 1/-1; margin-bottom: 0.5rem;">
          <div style="font-size: 0.72rem; font-weight: 700; letter-spacing: 0.2em; text-transform: uppercase; color: #b45309;">SIGNATURE COLLECTION</div>
          <h2 style="font-family: 'Zaloga', Georgia, serif; font-size: 1.8rem; font-weight: 300; margin: 0.2rem 0 1rem; color: #0D0D0D;">Parfum Signature</h2>
        </div>
        ${signatureProds.map(renderCard).join('')}
      `;
    }

    // Divider Line
    if (signatureProds.length > 0 && refillProds.length > 0) {
      html += `
        <div style="grid-column: 1/-1; padding: 2.5rem 0 1.5rem;">
          <hr style="border: none; border-top: 1px solid #E5E5E5; margin: 0;">
        </div>
      `;
    }

    // 2. Refill Section
    if (refillProds.length > 0) {
      html += `
        <div class="katalog-section-divider-title" style="grid-column: 1/-1; margin-bottom: 0.5rem;">
          <div style="font-size: 0.72rem; font-weight: 700; letter-spacing: 0.2em; text-transform: uppercase; color: #8A8A8A;">REFILL COLLECTION</div>
          <h2 style="font-family: 'Zaloga', Georgia, serif; font-size: 1.8rem; font-weight: 300; margin: 0.2rem 0 1rem; color: #0D0D0D;">Koleksi Parfum Refill</h2>
        </div>
        ${refillProds.map(renderCard).join('')}
      `;
    }

    // Render Pagination Controls if totalPages > 1
    if (totalPages > 1) {
      html += renderPaginationControls(totalPages);
    }

    grid.innerHTML = html;
  }

  function renderPaginationControls(totalPages) {
    let btns = '';

    // PREVIOUS Button (Clean Uppercase)
    btns += `<button class="page-btn page-nav ${currentPage === 1 ? 'disabled' : ''}" onclick="goToPage(${currentPage - 1})" ${currentPage === 1 ? 'disabled' : ''}>PREVIOUS</button>`;

    // Page Numbers
    for (let i = 1; i <= totalPages; i++) {
      btns += `<button class="page-btn ${i === currentPage ? 'active' : ''}" onclick="goToPage(${i})">${i}</button>`;
    }

    // NEXT Button (Clean Uppercase)
    btns += `<button class="page-btn page-nav ${currentPage === totalPages ? 'disabled' : ''}" onclick="goToPage(${currentPage + 1})" ${currentPage === totalPages ? 'disabled' : ''}>NEXT</button>`;

    return `<div class="katalog-pagination">${btns}</div>`;
  }

  function goToPage(page) {
    currentPage = page;
    applyFilters(false);
    // Smooth scroll back to top of products grid
    const mainEl = document.querySelector('.katalog-main');
    if (mainEl) mainEl.scrollIntoView({ behavior: 'smooth', block: 'start' });
  }

  function applyFilters(resetPage = true) {
    if (resetPage) currentPage = 1;
    let products = [...ALL_PRODUCTS];
    const genderChecks = [...document.querySelectorAll('input[name="gender"]:checked')].map(i => i.value.toLowerCase());
    if (genderChecks.length > 0) products = products.filter(p => genderChecks.includes(p.gender.toLowerCase()));
    
    const variantChecks = [...document.querySelectorAll('input[name="variant"]:checked')].map(i => i.value.toLowerCase());
    if (variantChecks.length > 0) {
      products = products.filter(p => {
        const fullNotes = `${p.variant || ''} ${p.top_notes || ''} ${p.middle_notes || ''} ${p.base_notes || ''} ${p.tagline || ''}`.toLowerCase();
        return variantChecks.some(v => fullNotes.includes(v));
      });
    }

    const priceMax = Number(document.getElementById('price-range-slider').value);
    products = products.filter(p => p.price <= priceMax);

    const sortVal = document.getElementById('sort-select').value;
    if (sortVal === 'bestseller') {
      products = products.filter(p => p.best_seller);
    } else if (sortVal === 'price-asc') {
      products.sort((a,b) => a.price - b.price);
    } else if (sortVal === 'price-desc') {
      products.sort((a,b) => b.price - a.price);
    } else if (sortVal === 'name-asc') {
      products.sort((a,b) => a.name.localeCompare(b.name));
    }

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
          <p class="product-detail-tagline">${product.tagline || ''}</p>
          <p class="product-detail-desc">${product.description || 'Detail parfum resmi Perfu.me dengan aroma pilihan.'}</p>

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

  function renderSkeletonGrid() {
    const grid = document.getElementById('katalog-grid');
    if (!grid) return;
    const skeletonCard = `
      <div class="skeleton-card">
        <div class="skeleton-img skeleton-shimmer"></div>
        <div class="skeleton-body">
          <div class="skeleton-line w-40 skeleton-shimmer"></div>
          <div class="skeleton-line w-70 skeleton-shimmer"></div>
          <div class="skeleton-line w-50 skeleton-shimmer"></div>
          <div class="skeleton-line w-30 skeleton-shimmer"></div>
          <div class="skeleton-line w-100 skeleton-shimmer"></div>
        </div>
      </div>
    `;
    grid.innerHTML = Array(6).fill(skeletonCard).join('');
  }

  async function initKatalog() {
    renderSkeletonGrid();
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

  function initCustomSortDropdown() {
    const wrap = document.getElementById('custom-sort-dropdown');
    const btn = document.getElementById('custom-sort-btn');
    const label = document.getElementById('custom-sort-label');
    const nativeSelect = document.getElementById('sort-select');
    const opts = document.querySelectorAll('.custom-sort-opt');

    if (!wrap || !btn || !nativeSelect) return;

    btn.addEventListener('click', (e) => {
      e.stopPropagation();
      wrap.classList.toggle('open');
    });

    document.addEventListener('click', () => {
      wrap.classList.remove('open');
    });

    opts.forEach(opt => {
      opt.addEventListener('click', (e) => {
        e.stopPropagation();
        const val = opt.getAttribute('data-value');
        const txt = opt.textContent.trim();

        label.textContent = txt;
        nativeSelect.value = val;

        opts.forEach(o => o.classList.remove('active'));
        opt.classList.add('active');
        wrap.classList.remove('open');

        applyFilters();
      });
    });
  }

  function toggleFilterSection(titleEl) {
    const section = titleEl.closest('.filter-section');
    if (!section) return;

    const span = titleEl.querySelector('span');
    const isOpen = section.classList.contains('open');

    if (isOpen) {
      section.classList.remove('open');
      if (span) span.textContent = '+';
    } else {
      section.classList.add('open');
      if (span) span.textContent = '—';
    }
  }

  document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('input[name="gender"], input[name="variant"]').forEach(el => el.addEventListener('change', () => applyFilters()));
    const slider = document.getElementById('price-range-slider');
    if (slider) {
      slider.addEventListener('input', () => { 
        document.getElementById('price-max').value = Number(slider.value).toLocaleString('id-ID'); 
        applyFilters(); 
      });
    }
    document.getElementById('sort-select').addEventListener('change', () => applyFilters());

    initCustomSortDropdown();
    initKatalog();
  });
</script>
<script src="{{ asset('js/navbar.js') }}"></script>
@endsection
