@extends('layouts.app')

@php
  $isSignature = strtolower($product->type) === 'signature' || str_contains(strtolower($product->name), 'dynamyst') || str_contains(strtolower($product->name), 'vanessence');
  $initialPrice = $isSignature ? $product->price : 45000;
@endphp

@section('title', 'Admin Preview: ' . $product->name . ' — Perfu.me')

@section('styles')
  <link rel="stylesheet" href="{{ asset('css/pdp.css') }}">
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
  <style>
    body {
      background-color: #FFFFFF;
      color: #0D0D0D;
    }

    .detail-page-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 2.5rem 2rem 6.5rem;
    }

    /* Breadcrumbs: DASHBOARD > [NAMA PRODUK] */
    .admin-detail-breadcrumbs {
      display: flex;
      align-items: center;
      gap: 0.6rem;
      font-size: 0.78rem;
      font-weight: 700;
      letter-spacing: 0.12em;
      text-transform: uppercase;
      color: #8A8A8A;
      margin-bottom: 2.5rem;
    }

    .admin-detail-breadcrumbs a {
      color: #8A8A8A;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 0.4rem;
      transition: color 0.2s ease;
    }

    .admin-detail-breadcrumbs a:hover {
      color: #0D0D0D;
    }

    .admin-detail-breadcrumbs .sep {
      color: #D4D4D8;
    }

    .admin-detail-breadcrumbs .current {
      color: #0D0D0D;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      max-width: 250px;
    }

    .detail-hero-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 4rem;
      align-items: flex-start;
    }

    .detail-media-col {
      display: flex;
      flex-direction: column;
      align-items: center;
      width: 100%;
    }

    /* Brand Watermark / Title Above Image (Matching User Storefront PDP) */
    .detail-brand-watermark {
      font-size: 2.5rem;
      color: #000000;
      margin-bottom: 2rem;
      text-align: center;
      text-transform: uppercase;
    }

    .detail-brand-watermark.is-signature {
      font-family: 'Zaloga', Georgia, serif;
      letter-spacing: 0.04em;
      font-weight: normal;
      text-transform: none;
    }

    .detail-brand-watermark.is-refill {
      font-family: 'Cormorant Garamond', Georgia, serif;
      letter-spacing: 0.18em;
      font-weight: 300;
    }

    .detail-img-box {
      width: 100%;
      max-width: 400px;
      background: #F7F7F7;
      border-radius: 16px;
      overflow: hidden;
      position: relative;
      border: 1px solid #EAEAEA;
      box-shadow: 0 10px 32px rgba(0,0,0,0.05);
      transition: transform 0.3s ease;
    }

    .detail-img-box img {
      width: 100%;
      height: auto;
      display: block;
      object-fit: cover;
    }

    .detail-status-pill {
      display: inline-flex;
      align-items: center;
      gap: 0.45rem;
      padding: 0.35rem 0.85rem;
      border-radius: 999px;
      font-size: 0.74rem;
      font-weight: 700;
      letter-spacing: 0.04em;
      margin-bottom: 1.1rem;
    }

    .detail-status-pill.is-in-stock {
      background: #ECFDF5;
      color: #059669;
      border: 1px solid #A7F3D0;
    }

    .detail-status-pill.is-in-stock .status-dot {
      width: 6px;
      height: 6px;
      border-radius: 50%;
      background: #10B981;
    }

    .detail-status-pill.is-out-of-stock {
      background: #FEF2F2;
      color: #DC2626;
      border: 1px solid #FECACA;
    }

    .detail-status-pill.is-out-of-stock .status-dot {
      width: 6px;
      height: 6px;
      border-radius: 50%;
      background: #EF4444;
    }

    /* Product Name with Manrope font */
    .detail-product-name {
      font-family: 'Manrope', sans-serif;
      font-size: clamp(1.85rem, 3.5vw, 2.75rem);
      font-weight: 700;
      letter-spacing: -0.02em;
      color: #000000;
      margin: 0 0 1rem;
      line-height: 1.15;
    }

    .detail-price-text {
      font-family: 'Manrope', sans-serif;
      font-size: 1.5rem;
      font-weight: 700;
      color: #000000;
      margin-bottom: 0.25rem;
    }

    .detail-shipping-note {
      font-size: 0.85rem;
      color: #666666;
      margin-bottom: 1.5rem;
    }

    .detail-desc-text {
      font-size: 0.95rem;
      line-height: 1.7;
      color: #333333;
      margin-bottom: 1.75rem;
    }

    .detail-features-list {
      list-style: none;
      padding: 0;
      margin: 0 0 2rem;
      display: flex;
      flex-direction: column;
      gap: 0.65rem;
    }

    .detail-features-list li {
      font-size: 0.88rem;
      font-weight: 500;
      color: #222222;
      display: flex;
      align-items: center;
      gap: 0.6rem;
    }

    .detail-features-list li::before {
      content: "✓";
      font-weight: 700;
      color: #000000;
      font-size: 0.9rem;
    }

    .detail-scent-notes-box {
      border-top: 1px solid #EEEEEE;
      padding-top: 1.5rem;
      margin-top: 1.5rem;
    }

    .scent-notes-title {
      font-size: 0.8rem;
      font-weight: 700;
      letter-spacing: 0.12em;
      text-transform: uppercase;
      color: #000000;
      margin-bottom: 1rem;
    }

    .scent-notes-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 1rem;
      background: #FAFAFA;
      padding: 1rem 1.25rem;
      border-radius: 10px;
      border: 1px solid #F0F0F0;
    }

    .scent-note-col strong {
      display: block;
      font-size: 0.68rem;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      color: #888888;
      margin-bottom: 0.25rem;
    }

    .scent-note-col span {
      font-size: 0.85rem;
      font-weight: 600;
      color: #111111;
      word-break: break-word;
    }

    /* Related Products Section */
    .related-section {
      border-top: 1px solid #EEEEEE;
      padding-top: 3.5rem;
      margin-top: 3.5rem;
    }

    .related-header {
      display: flex;
      justify-content: space-between;
      align-items: flex-end;
      margin-bottom: 2rem;
    }

    .related-title-sub {
      font-size: 0.72rem;
      font-weight: 700;
      letter-spacing: 0.18em;
      text-transform: uppercase;
      color: #8A8A8A;
      margin-bottom: 0.35rem;
    }

    .related-title {
      font-family: 'Zaloga', Georgia, serif;
      font-size: 2.2rem;
      font-weight: 300;
      color: #0D0D0D;
      margin: 0;
    }

    .admin-related-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 1.5rem;
    }

    .admin-related-card {
      text-decoration: none;
      color: inherit;
      background: #FFFFFF;
      border: 1px solid #EAEAEA;
      border-radius: 12px;
      overflow: hidden;
      display: flex;
      flex-direction: column;
      transition: transform 0.25s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.25s ease;
    }

    .admin-related-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 24px rgba(0,0,0,0.06);
    }

    .admin-related-img-wrap {
      width: 100%;
      aspect-ratio: 1/1;
      background: #F4F4F5;
      overflow: hidden;
      position: relative;
    }

    .admin-related-img-wrap img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.4s ease;
    }

    .admin-related-card:hover .admin-related-img-wrap img {
      transform: scale(1.05);
    }

    .admin-related-badge-stock-out {
      position: absolute;
      top: 8px;
      right: 8px;
      background: rgba(220, 38, 38, 0.9);
      color: #FFFFFF;
      font-size: 0.62rem;
      font-weight: 700;
      padding: 0.2rem 0.5rem;
      border-radius: 999px;
      text-transform: uppercase;
      letter-spacing: 0.05em;
    }

    .admin-related-body {
      padding: 1rem;
      flex: 1;
      display: flex;
      flex-direction: column;
    }

    .admin-related-tag {
      font-size: 0.68rem;
      font-weight: 700;
      letter-spacing: 0.12em;
      text-transform: uppercase;
      color: #8A8A8A;
      margin-bottom: 0.35rem;
    }

    .admin-related-name {
      font-size: 0.95rem;
      font-weight: 700;
      color: #0D0D0D;
      margin-bottom: 0.4rem;
      font-family: 'Manrope', sans-serif;
      line-height: 1.25;
    }

    .admin-related-price {
      font-size: 0.88rem;
      font-weight: 700;
      color: #0D0D0D;
      margin-top: auto;
    }

    /* Sticky Bottom Control Bar for Admin */
    .sticky-bottom-bar {
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      height: 90px;
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(14px);
      -webkit-backdrop-filter: blur(14px);
      border-top: 1px solid #E5E5E5;
      box-shadow: 0 -10px 30px rgba(0,0,0,0.06);
      z-index: 999;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.3s ease;
    }

    .sticky-bottom-bar.panel-active {
      transform: translateY(100%);
      opacity: 0;
      pointer-events: none;
    }

    .bottom-bar-content {
      width: 100%;
      max-width: 1240px;
      padding: 0 2rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .bottom-bar-product-info {
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .bottom-bar-thumb {
      width: 44px;
      height: 44px;
      border-radius: 8px;
      object-fit: cover;
      border: 1px solid #EAEAEA;
    }

    .bottom-bar-title {
      font-family: 'Manrope', sans-serif;
      font-size: 0.95rem;
      font-weight: 700;
      color: #0D0D0D;
    }

    .admin-actions-group {
      display: flex;
      align-items: center;
      gap: 1rem;
      margin-left: auto;
    }

    .btn-admin-stock-toggle {
      padding: 0.85rem 1.85rem;
      border-radius: 999px;
      font-family: 'Manrope', sans-serif;
      font-size: 0.92rem;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.2s ease;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      text-decoration: none;
      background: {{ $product->stock > 0 ? '#F0FDF4' : '#FEF2F2' }};
      color: {{ $product->stock > 0 ? '#16A34A' : '#DC2626' }};
      border: 1.5px solid {{ $product->stock > 0 ? '#86EFAC' : '#FCA5A5' }};
    }

    .btn-admin-stock-toggle:hover {
      transform: translateY(-1px);
    }

    .stock-indicator-dot {
      width: 7px;
      height: 7px;
      border-radius: 50%;
      background: {{ $product->stock > 0 ? '#16A34A' : '#DC2626' }};
    }

    .btn-admin-edit {
      padding: 0.85rem 2.2rem;
      background: #000000;
      color: #FFFFFF;
      border: none;
      border-radius: 999px;
      font-size: 0.92rem;
      font-weight: 700;
      cursor: pointer;
      text-decoration: none;
      transition: all 0.2s ease;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 0.45rem;
      box-shadow: 0 4px 14px rgba(0,0,0,0.12);
    }

    .btn-admin-edit:hover {
      background: #222222;
      transform: translateY(-1px);
    }

    /* Tablet Responsive */
    @media (max-width: 900px) {
      .detail-hero-grid { grid-template-columns: 1fr; gap: 2rem; }
      .admin-related-grid { grid-template-columns: repeat(2, 1fr); gap: 1rem; }
      .bottom-bar-product-info { display: none; }
      .admin-actions-group { width: 100%; justify-content: space-between; margin-left: 0; }
    }

    /* Mobile Responsive (<= 768px) */
    @media (max-width: 768px) {
      .detail-page-container {
        padding: 1.25rem 1rem 7.5rem !important;
      }

      .admin-detail-breadcrumbs {
        margin-bottom: 1.25rem !important;
        font-size: 0.72rem !important;
      }

      .admin-detail-breadcrumbs .current {
        max-width: 180px !important;
      }

      .detail-hero-grid {
        grid-template-columns: 1fr !important;
        gap: 1.5rem !important;
      }

      .detail-brand-watermark {
        font-size: 1.75rem !important;
        margin-bottom: 1rem !important;
      }

      .detail-img-box {
        max-width: 270px !important;
        margin: 0 auto !important;
        border-radius: 14px !important;
      }

      .detail-product-name {
        font-size: 1.6rem !important;
        margin-bottom: 0.35rem !important;
        line-height: 1.2 !important;
      }

      .detail-price-text {
        font-size: 1.35rem !important;
      }

      .detail-shipping-note {
        font-size: 0.8rem !important;
        margin-bottom: 1rem !important;
      }

      .detail-desc-text {
        font-size: 0.88rem !important;
        line-height: 1.6 !important;
        margin-bottom: 1.25rem !important;
      }

      .detail-features-list {
        gap: 0.45rem !important;
        margin-bottom: 1.25rem !important;
      }

      .detail-features-list li {
        font-size: 0.82rem !important;
      }

      .detail-scent-notes-box {
        padding-top: 1.25rem !important;
        margin-top: 1.25rem !important;
      }

      .scent-notes-grid {
        grid-template-columns: repeat(3, 1fr) !important;
        gap: 0.45rem !important;
        padding: 0.75rem 0.65rem !important;
      }

      .scent-note-col strong {
        font-size: 0.62rem !important;
      }

      .scent-note-col span {
        font-size: 0.78rem !important;
      }

      .related-section {
        padding-top: 2rem !important;
        margin-top: 2.25rem !important;
      }

      .related-header {
        margin-bottom: 1.15rem !important;
      }

      .related-title-sub {
        font-size: 0.65rem !important;
        letter-spacing: 0.15em !important;
      }

      .related-title {
        font-size: 1.45rem !important;
        line-height: 1.2 !important;
      }

      .admin-related-grid {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 0.75rem !important;
      }

      .admin-related-body {
        padding: 0.75rem 0.65rem !important;
      }

      .admin-related-tag {
        font-size: 0.62rem !important;
        letter-spacing: 0.06em !important;
        margin-bottom: 0.25rem !important;
      }

      .admin-related-name {
        font-size: 0.85rem !important;
        line-height: 1.2 !important;
        margin-bottom: 0.35rem !important;
      }

      .admin-related-price {
        font-size: 0.82rem !important;
      }

      /* Compact Luxury Mobile Bottom Bar */
      .sticky-bottom-bar {
        height: 68px !important;
        background: rgba(255, 255, 255, 0.96) !important;
        backdrop-filter: blur(16px) !important;
        -webkit-backdrop-filter: blur(16px) !important;
        border-top: 1px solid rgba(0,0,0,0.08) !important;
        box-shadow: 0 -4px 20px rgba(0,0,0,0.06) !important;
      }

      .bottom-bar-content {
        padding: 0 1rem !important;
      }

      .admin-actions-group {
        width: 100% !important;
        gap: 0.65rem !important;
      }

      .btn-admin-stock-toggle {
        flex: 1 !important;
        justify-content: center !important;
        padding: 0.65rem 0.5rem !important;
        font-size: 0.82rem !important;
        white-space: nowrap !important;
      }

      .btn-admin-edit {
        flex: 1 !important;
        justify-content: center !important;
        padding: 0.65rem 0.5rem !important;
        font-size: 0.82rem !important;
        white-space: nowrap !important;
      }
    }

    @media (max-width: 380px) {
      .scent-notes-grid {
        grid-template-columns: 1fr !important;
        gap: 0.65rem !important;
      }
    }
  </style>
@endsection

@section('content')

  <div class="detail-page-container">
    {{-- Breadcrumbs: DASHBOARD > [NAMA PRODUK] --}}
    <div class="admin-detail-breadcrumbs">
      <a href="/admin">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
        DASHBOARD
      </a>
      <span class="sep">›</span>
      <span class="current">{{ strtoupper($product->name) }}</span>
    </div>

    <div class="detail-hero-grid">
      {{-- Media Column --}}
      <div class="detail-media-col">
        {{-- Brand Title Above Image (Zaloga for Signature, Cormorant Garamond for Refill) --}}
        <div class="detail-brand-watermark {{ $isSignature ? 'is-signature' : 'is-refill' }}">
          {{ $isSignature ? 'Perfu.me' : 'REFILL' }}
        </div>

        <div class="detail-img-box">
          <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" onerror="this.src='{{ asset('assets/images/refill.webp') }}'">
        </div>
      </div>

      {{-- Info Column --}}
      <div class="detail-info-col">
        <div class="detail-status-pill {{ $product->stock > 0 ? 'is-in-stock' : 'is-out-of-stock' }}">
          <span class="status-dot"></span>
          {{ $product->stock > 0 ? 'Ready Stock' : 'Stok Habis' }}
        </div>

        <h1 class="detail-product-name">{{ $product->name }}</h1>

        <div class="detail-price-text">
          Rp {{ number_format($initialPrice, 0, ',', '.') }}
        </div>
        <div class="detail-shipping-note">
          <span class="shipping-word">Shipping</span> calculated at checkout.
        </div>

        <div class="detail-desc-text">
          {{ $product->description ?? 'Belum ada deskripsi produk yang ditambahkan.' }}
        </div>

        {{-- Keunggulan / Key Features List --}}
        <ul class="detail-features-list">
          <li>Parfum oil grade A, alkohol food grade</li>
          <li>Tanpa pewarna tambahan</li>
          <li>{{ $product->packaging ?? 'Botol kaca spray + dus karton' }}</li>
          <li>Tahan 6–10 jam</li>
        </ul>

        <div class="detail-scent-notes-box">
          <div class="scent-notes-title">Aroma Pyramid Notes</div>
          <div class="scent-notes-grid">
            <div class="scent-note-col">
              <strong>Top Notes</strong>
              <span>{{ $product->top_notes ?? 'Fresh Notes' }}</span>
            </div>
            <div class="scent-note-col">
              <strong>Heart Notes</strong>
              <span>{{ $product->middle_notes ?? 'Floral Accord' }}</span>
            </div>
            <div class="scent-note-col">
              <strong>Base Notes</strong>
              <span>{{ $product->base_notes ?? 'Warm Musk' }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- Rekomendasi Parfum Pilihan Lainnya --}}
    @if(isset($relatedProducts) && count($relatedProducts) > 0)
      <section class="related-section">
        <div class="related-header">
          <div>
            <div class="related-title-sub">EXPLORE MORE FRAGRANCES</div>
            <h2 class="related-title">Produk Lainnya di Inventaris</h2>
          </div>
        </div>

        <div class="admin-related-grid">
          @foreach($relatedProducts as $rel)
            @php
              $relIsSig = strtolower($rel->type) === 'signature' || str_contains(strtolower($rel->name), 'dynamyst') || str_contains(strtolower($rel->name), 'vanessence');
              $relPrice = $relIsSig ? $rel->price : 45000;
            @endphp
            <a href="/admin/produk/{{ $rel->id }}" class="admin-related-card">
              <div class="admin-related-img-wrap">
                <img src="{{ asset($rel->image) }}" alt="{{ $rel->name }}" loading="lazy" onerror="this.src='{{ asset('assets/images/refill.webp') }}'">
                @if($rel->stock <= 0)
                  <span class="admin-related-badge-stock-out">Habis</span>
                @endif
              </div>
              <div class="admin-related-body">
                <div class="admin-related-tag">{{ $relIsSig ? 'Signature' : 'Refill' }} • {{ $rel->gender }}</div>
                <div class="admin-related-name">{{ $rel->name }}</div>
                <div class="admin-related-price">Rp {{ number_format($relPrice, 0, ',', '.') }}</div>
              </div>
            </a>
          @endforeach
        </div>
      </section>
    @endif
  </div>

  {{-- Admin Sticky Bottom Bar --}}
  <div class="sticky-bottom-bar">
    <div class="bottom-bar-content">
      <div class="bottom-bar-product-info">
        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="bottom-bar-thumb" onerror="this.src='{{ asset('assets/images/refill.webp') }}'">
        <div class="bottom-bar-title-group">
          <div class="bottom-bar-title">{{ $product->name }}</div>
        </div>
      </div>

      <div class="admin-actions-group">
        @if($product->stock > 0)
          <button id="btn-toggle-stock" type="button" class="btn-admin-stock-toggle" onclick="toggleStockStatus(0)" title="Klik untuk mengubah status menjadi Stock Habis">
            <span class="stock-indicator-dot"></span> Stock Ready
          </button>
        @else
          <button id="btn-toggle-stock" type="button" class="btn-admin-stock-toggle" onclick="toggleStockStatus(10)" title="Klik untuk mengubah status menjadi Stock Ready">
            <span class="stock-indicator-dot"></span> Stock Habis
          </button>
        @endif

        <button type="button" class="btn-admin-edit" onclick="openDetailEditPanel()">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
          Edit Produk
        </button>
      </div>
    </div>
  </div>

  <!-- Slide-in Panel Form for Product Detail Page -->
  <div id="panel-overlay" class="admin-panel-overlay"></div>

  <aside id="product-slide-panel" class="admin-slide-panel">
    <div class="admin-panel-head">
      <h3 class="admin-panel-title" id="panel-title-text">Edit Produk: {{ $product->name }}</h3>
      <button class="admin-panel-close" id="btn-close-panel" aria-label="Tutup Panel">&times;</button>
    </div>

    <form id="product-crud-form" class="admin-panel-body">
      <input type="hidden" id="form-product-id" value="{{ $product->id }}">

      <div class="form-section-title" style="margin-top:0;">1. INFORMASI DASAR PRODUK</div>

      <div class="form-group">
        <label for="form-name" class="form-label">Nama Produk <span>*</span></label>
        <input type="text" id="form-name" class="form-control" value="{{ $product->name }}" required>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Kategori <span>*</span></label>
          <input type="hidden" id="form-category" value="{{ $isSignature ? 'Signature' : 'Refill' }}">
          <div class="form-select-custom" id="custom-select-category">
            <div class="form-select-trigger">
              <span class="trigger-label">{{ $isSignature ? 'Signature Collection' : 'Refill Collection' }}</span>
              <svg class="form-select-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </div>
            <div class="form-select-options">
              <div class="form-select-option {{ $isSignature ? 'selected' : '' }}" data-value="Signature" data-display="Signature Collection">
                <span>Signature Collection</span><span class="opt-check">✔</span>
              </div>
              <div class="form-select-option {{ !$isSignature ? 'selected' : '' }}" data-value="Refill" data-display="Refill Collection">
                <span>Refill Collection</span><span class="opt-check">✔</span>
              </div>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">Tipe / Konsentrasi Parfum <span>*</span></label>
          <input type="hidden" id="form-type" value="{{ $product->type ?? 'Eau de Parfum' }}">
          <div class="form-select-custom" id="custom-select-type">
            <div class="form-select-trigger">
              <span class="trigger-label">{{ $product->type ?? 'Eau de Parfum' }}</span>
              <svg class="form-select-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </div>
            <div class="form-select-options">
              <div class="form-select-option {{ ($product->type ?? '') === 'Eau de Parfum' ? 'selected' : '' }}" data-value="Eau de Parfum"><span>Eau de Parfum</span><span class="opt-check">✔</span></div>
              <div class="form-select-option {{ ($product->type ?? '') === 'Roll-on' ? 'selected' : '' }}" data-value="Roll-on"><span>Roll-on</span><span class="opt-check">✔</span></div>
            </div>
          </div>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Target Gender <span>*</span></label>
          <input type="hidden" id="form-gender" value="{{ $product->gender ?? 'Unisex' }}">
          <div class="form-select-custom" id="custom-select-gender">
            <div class="form-select-trigger">
              <span class="trigger-label">{{ $product->gender ?? 'Unisex' }}</span>
              <svg class="form-select-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </div>
            <div class="form-select-options">
              <div class="form-select-option {{ ($product->gender ?? '') === 'Unisex' ? 'selected' : '' }}" data-value="Unisex"><span>Unisex</span><span class="opt-check">✔</span></div>
              <div class="form-select-option {{ ($product->gender ?? '') === 'Pria' ? 'selected' : '' }}" data-value="Pria"><span>Pria</span><span class="opt-check">✔</span></div>
              <div class="form-select-option {{ ($product->gender ?? '') === 'Wanita' ? 'selected' : '' }}" data-value="Wanita"><span>Wanita</span><span class="opt-check">✔</span></div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="form-variant" class="form-label">Varian Aroma <span>*</span></label>
          <input type="text" id="form-variant" class="form-control" value="{{ $product->variant }}" required>
        </div>
      </div>

      <div class="form-row" id="form-size-price-row" style="{{ !$isSignature ? 'display:none;' : '' }}">
        <div class="form-group">
          <label class="form-label">Ukuran Botol <span>*</span></label>
          <input type="hidden" id="form-size" value="{{ $product->size ?? '30ML' }}">
          <div class="form-select-custom" id="custom-select-size">
            <div class="form-select-trigger">
              <span class="trigger-label">{{ $product->size ?? '30ML' }}</span>
              <svg class="form-select-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </div>
            <div class="form-select-options">
              <div class="form-select-option" data-value="35ML" data-display="35ML (Refill Standard Size)"><span>35ML (Refill Standard Size)</span><span class="opt-check">✔</span></div>
              <div class="form-select-option selected" data-value="30ML" data-display="30ML (Signature Size)"><span>30ML (Signature Size)</span><span class="opt-check">✔</span></div>
              <div class="form-select-option" data-value="50ML" data-display="50ML (Medium Size)"><span>50ML (Medium Size)</span><span class="opt-check">✔</span></div>
              <div class="form-select-option" data-value="100ML" data-display="100ML (Full Size)"><span>100ML (Full Size)</span><span class="opt-check">✔</span></div>
              <div class="form-select-option" data-value="10ML" data-display="10ML (Roll-On / Mini)"><span>10ML (Roll-On / Mini)</span><span class="opt-check">✔</span></div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="form-price-display" class="form-label">Harga Jual (Rp) <span>*</span></label>
          <input type="text" id="form-price-display" class="form-control" value="Rp {{ number_format($product->price, 0, ',', '.') }}" required autocomplete="off">
          <input type="hidden" id="form-price" value="{{ $product->price }}">
        </div>
      </div>

      <div class="form-section-title">2. SCENT PYRAMID NOTES</div>

      <div class="form-group">
        <label for="form-top" class="form-label">Top Notes <span>*</span></label>
        <input type="text" id="form-top" class="form-control" value="{{ $product->top_notes }}" required>
      </div>
      <div class="form-group">
        <label for="form-middle" class="form-label">Heart / Middle Notes <span>*</span></label>
        <input type="text" id="form-middle" class="form-control" value="{{ $product->middle_notes }}" required>
      </div>
      <div class="form-group">
        <label for="form-base" class="form-label">Base Notes <span>*</span></label>
        <input type="text" id="form-base" class="form-control" value="{{ $product->base_notes }}" required>
      </div>

      <div id="form-image-section" style="{{ !$isSignature ? 'display:none;' : '' }}">
        <div class="form-section-title">3. GAMBAR PRODUK SIGNATURE</div>

        <div class="form-group">
          <label for="form-image-file" class="form-label">Upload File Gambar Produk Signature <span>*</span></label>
          <div class="file-upload-box">
            <input type="file" id="form-image-file" accept="image/*" style="display:none;">
            <button type="button" class="btn-choose-file" onclick="document.getElementById('form-image-file').click()">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                <polyline points="17 8 12 3 7 8"></polyline>
                <line x1="12" y1="3" x2="12" y2="15"></line>
              </svg>
              Pilih File Gambar
            </button>
            <span class="file-chosen-name" id="file-chosen-name">File Gambar Tersedia</span>
          </div>

          <input type="hidden" id="form-image" value="{{ $product->image }}">

          <div id="crud-img-preview-wrap" style="margin-top:0.85rem;">
            <div style="font-size:0.68rem; font-weight:700; color:#8A8A8A; letter-spacing:0.1em; margin-bottom:0.35rem;">PREVIEW GAMBAR:</div>
            <img id="crud-img-preview" src="{{ asset($product->image) }}" alt="Preview Gambar Produk" style="width:96px; height:96px; object-fit:cover; border-radius:10px; border:1px solid #E4E4E7; box-shadow:0 4px 12px rgba(0,0,0,0.06);">
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="form-desc" class="form-label">Deskripsi Lengkap Produk (Opsional)</label>
        <textarea id="form-desc" class="form-control" rows="3">{{ $product->description }}</textarea>
      </div>

      <div class="form-group" style="margin-top:1.5rem;">
        <label class="form-toggle">
          <input type="checkbox" id="form-bestseller" {{ $product->best_seller ? 'checked' : '' }}>
          <span class="form-toggle-track"><span class="form-toggle-thumb"></span></span>
          <span class="form-toggle-label">Tandai sebagai <strong>Best Seller ★</strong></span>
        </label>
      </div>
    </form>

    <div class="admin-panel-footer">
      <button type="button" id="btn-cancel-crud" class="admin-btn-secondary" onclick="closeDetailEditPanel()">Batal</button>
      <button type="submit" form="product-crud-form" id="btn-save-crud" class="admin-btn-primary">Simpan Perubahan</button>
    </div>
  </aside>

@endsection

@section('scripts')
<script>
  function openDetailEditPanel() {
    const overlay = document.getElementById('panel-overlay');
    const panel = document.getElementById('product-slide-panel');
    const bottomBar = document.querySelector('.sticky-bottom-bar');
    if (overlay) overlay.classList.add('active');
    if (panel) panel.classList.add('open');
    if (bottomBar) bottomBar.classList.add('panel-active');
  }

  function closeDetailEditPanel() {
    const overlay = document.getElementById('panel-overlay');
    const panel = document.getElementById('product-slide-panel');
    const bottomBar = document.querySelector('.sticky-bottom-bar');
    if (overlay) overlay.classList.remove('active');
    if (panel) panel.classList.remove('open');
    if (bottomBar) bottomBar.classList.remove('panel-active');
  }

  async function toggleStockStatus(newStock) {
    try {
      if (window.API && typeof window.API.update === 'function') {
        const res = await window.API.update({{ $product->id }}, { stock: newStock });
        if (res) {
          window.location.reload();
        }
      } else {
        alert('API backend tidak tersedia.');
      }
    } catch (e) {
      alert('Gagal mengupdate stok produk.');
    }
  }

  document.addEventListener('DOMContentLoaded', () => {
    const overlay = document.getElementById('panel-overlay');
    const closeBtn = document.getElementById('btn-close-panel');
    if (overlay) overlay.addEventListener('click', closeDetailEditPanel);
    if (closeBtn) closeBtn.addEventListener('click', closeDetailEditPanel);

    // Setup File Upload Base64 listener
    const fileInput = document.getElementById('form-image-file');
    const fileNameSpan = document.getElementById('file-chosen-name');
    const imgPreview = document.getElementById('crud-img-preview');
    const imgPreviewWrap = document.getElementById('crud-img-preview-wrap');

    if (fileInput) {
      fileInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) {
          fileNameSpan.textContent = file.name;
          const reader = new FileReader();
          reader.onload = (evt) => {
            const base64 = evt.target.result;
            document.getElementById('form-image').value = base64;
            if (imgPreview) imgPreview.src = base64;
            if (imgPreviewWrap) imgPreviewWrap.style.display = 'block';
          };
          reader.readAsDataURL(file);
        }
      });
    }

    // Handle Form Submit on Edit Panel
    const form = document.getElementById('product-crud-form');
    if (form) {
      form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const id = document.getElementById('form-product-id').value;
        const categoryVal = document.getElementById('form-category').value;
        const isRefill = categoryVal === 'Refill';
        const isBs = document.getElementById('form-bestseller') ? document.getElementById('form-bestseller').checked : false;
        const imgVal = isRefill ? 'assets/images/refill.webp' : (document.getElementById('form-image').value.trim() || 'assets/images/refill.webp');
        const variantVal = document.getElementById('form-variant').value.trim();

        const payload = {
          name: document.getElementById('form-name').value.trim(),
          type: isRefill ? 'Refill' : document.getElementById('form-type').value,
          gender: document.getElementById('form-gender').value,
          variant: variantVal,
          size: isRefill ? '35ML' : document.getElementById('form-size').value.trim(),
          price: isRefill ? 45000 : Number(document.getElementById('form-price').value),
          top_notes: document.getElementById('form-top').value.trim(),
          middle_notes: document.getElementById('form-middle').value.trim(),
          base_notes: document.getElementById('form-base').value.trim(),
          packaging: isRefill ? 'Botol kaca spray + refill pouch khas Perfu.me' : 'Botol kaca spray + dus karton khas Perfu.me',
          tagline: variantVal,
          description: document.getElementById('form-desc') ? document.getElementById('form-desc').value.trim() : '',
          image: imgVal,
          best_seller: isBs
        };

        try {
          if (window.API && typeof window.API.update === 'function') {
            await window.API.update(id, payload);
            window.location.reload();
          }
        } catch (err) {
          alert(err.message || 'Gagal menyimpan perubahan.');
        }
      });
    }
  });
</script>
@endsection
