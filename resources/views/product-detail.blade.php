@extends('layouts.app')

@section('title', $product->name . ' — Parfu.me')
@section('description', $product->description)

@section('styles')
<style>
  body {
    background: #FFFFFF;
    color: #0D0D0D;
    font-family: 'Inter', system-ui, -apple-system, sans-serif;
    margin: 0;
    padding-bottom: 100px; /* space for sticky bottom bar */
  }

  .detail-page-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 3rem 2rem 5rem;
  }

  .detail-breadcrumb {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.8rem;
    color: #666666;
    margin-bottom: 2.5rem;
  }

  .detail-breadcrumb a { color: #666666; text-decoration: none; transition: color 0.2s; }
  .detail-breadcrumb a:hover { color: #000000; }
  .detail-breadcrumb span { color: #CCCCCC; }

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
  }

  .detail-brand-watermark {
    font-family: 'Cormorant Garamond', Georgia, serif;
    font-size: 2.5rem;
    font-weight: 400;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    color: #000000;
    margin-bottom: 2rem;
    text-align: center;
  }

  .detail-img-box {
    width: 100%;
    max-width: 480px;
    background: #F7F7F7;
    border-radius: 12px;
    overflow: hidden;
    position: relative;
    box-shadow: 0 8px 30px rgba(0,0,0,0.04);
  }

  .detail-img-box img {
    width: 100%;
    height: auto;
    display: block;
    object-fit: cover;
  }

  .detail-status-pill {
    display: inline-block;
    padding: 0.3rem 0.75rem;
    background: #F0F0F0;
    color: #666666;
    border-radius: 4px;
    font-size: 0.75rem;
    font-weight: 600;
    margin-bottom: 1rem;
  }

  .detail-product-name {
    font-family: 'Inter', system-ui, sans-serif;
    font-size: clamp(2rem, 3.5vw, 2.75rem);
    font-weight: 700;
    letter-spacing: -0.02em;
    color: #000000;
    margin: 0 0 1rem;
    line-height: 1.15;
  }

  .detail-price-text {
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

  .detail-shipping-note span.shipping-word { 
    color: #666666; 
    text-decoration: underline; 
    text-underline-offset: 3px;
    cursor: default;
    transition: color 0.2s;
  }
  
  .detail-shipping-note span.shipping-word:hover {
    color: #000000;
  }

  .detail-desc-text {
    font-size: 0.95rem;
    line-height: 1.7;
    color: #333333;
    margin-bottom: 1.75rem;
  }

  /* Key Features Bullet List */
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
    border-radius: 8px;
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
  }

  /* ── Sticky Bottom Bar ────────────────────────────────────────── */
  .sticky-bottom-bar {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    height: 84px;
    background: #FFFFFF;
    border-top: 1px solid #E5E5E5;
    box-shadow: 0 -10px 30px rgba(0,0,0,0.06);
    z-index: 999;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .bottom-bar-content {
    width: 100%;
    max-width: 1200px;
    padding: 0 2rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1.5rem;
  }

  .bottom-bar-product-info {
    display: flex;
    align-items: center;
    gap: 1rem;
  }

  .bottom-bar-thumb {
    width: 48px;
    height: 48px;
    border-radius: 6px;
    object-fit: cover;
    background: #F4F4F5;
  }

  .bottom-bar-title-group {
    display: flex;
    flex-direction: column;
  }

  .bottom-bar-title {
    font-size: 0.92rem;
    font-weight: 700;
    color: #000000;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 320px;
  }

  .bottom-bar-price {
    font-size: 0.88rem;
    font-weight: 600;
    color: #333333;
  }

  .bottom-bar-controls {
    display: flex;
    align-items: center;
    gap: 1rem;
  }

  /* Custom Luxury Dropdown for Size Selection */
  .custom-size-dropdown {
    position: relative;
    user-select: none;
  }

  .custom-size-trigger {
    display: inline-flex;
    align-items: center;
    justify-content: space-between;
    gap: 0.85rem;
    padding: 0.65rem 1.1rem;
    border: 1px solid #000000;
    border-radius: 999px;
    font-family: inherit;
    font-size: 0.85rem;
    font-weight: 600;
    color: #000000;
    background: #FFFFFF;
    cursor: pointer;
    transition: all 0.2s ease;
    box-shadow: 0 1px 3px rgba(0,0,0,0.03);
  }

  .custom-size-trigger:hover, .custom-size-dropdown.open .custom-size-trigger {
    background: #F8F8F8;
  }

  .custom-size-trigger svg {
    transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
  }

  .custom-size-dropdown.open .custom-size-trigger svg {
    transform: rotate(180deg);
  }

  .custom-size-menu {
    position: absolute;
    bottom: calc(100% + 10px);
    right: 0;
    min-width: 220px;
    background: #FFFFFF;
    border: 1px solid #E5E5E5;
    border-radius: 12px;
    box-shadow: 0 12px 36px rgba(0,0,0,0.14);
    padding: 0.4rem;
    z-index: 1000;
    display: none;
    flex-direction: column;
    gap: 2px;
    animation: sizeMenuPop 0.2s cubic-bezier(0.16, 1, 0.3, 1) forwards;
  }

  @keyframes sizeMenuPop {
    from { opacity: 0; transform: translateY(6px); }
    to { opacity: 1; transform: translateY(0); }
  }

  .custom-size-dropdown.open .custom-size-menu {
    display: flex;
  }

  .custom-size-opt {
    padding: 0.65rem 1rem;
    font-size: 0.85rem;
    font-weight: 500;
    color: #333333;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .custom-size-opt:hover {
    background: #F4F4F5;
    color: #000000;
  }

  .custom-size-opt.active {
    background: #000000;
    color: #FFFFFF;
    font-weight: 600;
  }

  /* Quantity Counter (- 1 +) */
  .qty-counter {
    display: flex;
    align-items: center;
    border: 1px solid #E5E5E5;
    border-radius: 999px;
    padding: 0.2rem 0.5rem;
    background: #FFFFFF;
  }

  .qty-btn {
    border: none;
    background: transparent;
    width: 32px;
    height: 32px;
    font-size: 1rem;
    color: #333333;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    user-select: none;
  }

  .qty-val {
    font-size: 0.9rem;
    font-weight: 600;
    width: 28px;
    text-align: center;
  }

  /* Action Buttons */
  .btn-bottom-order {
    padding: 0.75rem 1.75rem;
    background: #000000;
    color: #FFFFFF;
    border: none;
    border-radius: 999px;
    font-size: 0.85rem;
    font-weight: 700;
    cursor: pointer;
    text-decoration: none;
    transition: all 0.2s ease;
    white-space: nowrap;
  }

  .btn-bottom-order:hover {
    background: #222222;
  }

  .btn-bottom-cart {
    padding: 0.75rem 1.25rem;
    background: #FFFFFF;
    color: #000000;
    border: 1px solid #000000;
    border-radius: 999px;
    font-size: 0.85rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s ease;
    white-space: nowrap;
  }

  .btn-bottom-cart:hover {
    background: #F5F5F5;
  }

  @media (max-width: 900px) {
    .detail-hero-grid { grid-template-columns: 1fr; gap: 2rem; }
    .bottom-bar-product-info { display: none; }
    .bottom-bar-controls { width: 100%; justify-content: space-between; }
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

  @php
    $isSignature = strtolower($product->type) === 'signature' || str_contains(strtolower($product->name), 'dynamyst') || str_contains(strtolower($product->name), 'vanessence');
    $initialPrice = $isSignature ? $product->price : 45000; // Default Refill 35ml = Rp 45.000
  @endphp

  <div class="detail-page-container">
    {{-- Breadcrumb --}}
    <div class="detail-breadcrumb">
      <a href="/">Home</a>
      <span>›</span>
      <a href="/katalog">{{ $isSignature ? 'Signature Collection' : 'Refill Collection' }}</a>
      <span>›</span>
      <span style="color:#000000; font-weight:600;">{{ $product->name }}</span>
    </div>

    <div class="detail-hero-grid">
      {{-- Media Column --}}
      <div class="detail-media-col">
        <div class="detail-brand-watermark">{{ $isSignature ? 'PARFU.ME' : 'REFILL' }}</div>
        <div class="detail-img-box">
          <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" onerror="this.src='{{ asset('assets/images/refill.webp') }}'">
        </div>
      </div>

      {{-- Info Column --}}
      <div class="detail-info-col">
        <div class="detail-status-pill">
          {{ $product->stock > 0 ? 'Ready Stock' : 'Stok Habis' }}
        </div>

        <h1 class="detail-product-name">{{ $product->name }}</h1>

        <div class="detail-price-text" id="display-price-text">
          Rp {{ number_format($initialPrice, 0, ',', '.') }}
        </div>
        <div class="detail-shipping-note">
          <span class="shipping-word">Shipping</span> calculated at checkout.
        </div>

        <div class="detail-desc-text">
          {{ $product->description }}
        </div>

        {{-- Keunggulan / Key Features List --}}
        <ul class="detail-features-list">
          <li>Parfum oil grade A, alkohol 90%</li>
          <li>Tanpa pewarna tambahan</li>
          <li>{{ $product->packaging ?? 'Botol kaca spray + dus karton' }}</li>
          <li>Tahan 6–10 jam di kulit</li>
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
  </div>

  {{-- Sticky Bottom Bar --}}
  <div class="sticky-bottom-bar">
    <div class="bottom-bar-content">
      <div class="bottom-bar-product-info">
        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="bottom-bar-thumb" onerror="this.src='{{ asset('assets/images/refill.webp') }}'">
        <div class="bottom-bar-title-group">
          <div class="bottom-bar-title">{{ $product->name }}</div>
          <div class="bottom-bar-price" id="bar-price-text">Rp {{ number_format($initialPrice, 0, ',', '.') }}</div>
        </div>
      </div>

      <div class="bottom-bar-controls">
        {{-- Custom Luxury Dropdown for Size Selection --}}
        <div class="custom-size-dropdown" id="custom-size-dropdown">
          <button type="button" class="custom-size-trigger" id="custom-size-trigger">
            <span id="custom-size-label">{{ $isSignature ? 'Signature 30ml' : 'Refill 35ml — Rp 45.000' }}</span>
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
          </button>
          
          <div class="custom-size-menu" id="custom-size-menu">
            @if($isSignature)
              <div class="custom-size-opt active" data-size="30ml" data-price="{{ $product->price }}">Signature 30ml</div>
            @else
              <div class="custom-size-opt" data-size="15ml" data-price="20000">Refill 15ml — Rp 20.000</div>
              <div class="custom-size-opt active" data-size="35ml" data-price="45000">Refill 35ml — Rp 45.000</div>
              <div class="custom-size-opt" data-size="50ml" data-price="65000">Refill 50ml — Rp 65.000</div>
            @endif
          </div>
        </div>

        {{-- Quantity counter (- 1 +) --}}
        <div class="qty-counter">
          <button class="qty-btn" onclick="changeQty(-1)">−</button>
          <span class="qty-val" id="qty-val">1</span>
          <button class="qty-btn" onclick="changeQty(1)">+</button>
        </div>

        {{-- Action Buttons --}}
        <a id="btn-order-wa" href="#" target="_blank" rel="noopener" class="btn-bottom-order">
          Pesan WhatsApp
        </a>
        <button type="button" class="btn-bottom-cart" onclick="addSelectedToCart()">
          + Keranjang
        </button>
      </div>
    </div>
  </div>

@endsection

@section('scripts')
<script>
  let currentQty = 1;
  let selectedPrice = {{ $initialPrice }};
  let selectedSize = "{{ $isSignature ? '30ml' : '35ml' }}";
  const isSignature = {{ $isSignature ? 'true' : 'false' }};
  const productName = @json($product->name);
  const productId = {{ $product->id }};

  function updateDisplay() {
    const totalPrice = selectedPrice * currentQty;
    const formattedPrice = 'Rp ' + totalPrice.toLocaleString('id-ID');

    document.getElementById('display-price-text').textContent = 'Rp ' + selectedPrice.toLocaleString('id-ID');
    document.getElementById('bar-price-text').textContent = formattedPrice;
    document.getElementById('qty-val').textContent = currentQty;

    const waMessage = `Halo, saya ingin memesan ${productName} (Varian: ${selectedSize}, Jumlah: ${currentQty} pcs) total seharga ${formattedPrice}`;
    document.getElementById('btn-order-wa').href = `https://wa.me/6281234567890?text=${encodeURIComponent(waMessage)}`;
  }

  function initCustomSizeDropdown() {
    const wrap = document.getElementById('custom-size-dropdown');
    const trigger = document.getElementById('custom-size-trigger');
    const label = document.getElementById('custom-size-label');
    const opts = document.querySelectorAll('.custom-size-opt');

    if (!wrap || !trigger) return;

    trigger.addEventListener('click', (e) => {
      e.stopPropagation();
      wrap.classList.toggle('open');
    });

    document.addEventListener('click', () => {
      wrap.classList.remove('open');
    });

    opts.forEach(opt => {
      opt.addEventListener('click', (e) => {
        e.stopPropagation();
        const price = Number(opt.getAttribute('data-price'));
        const size = opt.getAttribute('data-size');
        const txt = opt.textContent.trim();

        selectedPrice = price;
        selectedSize = size;
        label.textContent = txt;

        opts.forEach(o => o.classList.remove('active'));
        opt.classList.add('active');
        wrap.classList.remove('open');

        updateDisplay();
      });
    });
  }

  function changeQty(delta) {
    currentQty += delta;
    if (currentQty < 1) currentQty = 1;
    updateDisplay();
  }

  function addSelectedToCart() {
    if (window.addToCart) {
      window.addToCart(productId);
    }
  }

  document.addEventListener('DOMContentLoaded', () => {
    initCustomSizeDropdown();
    updateDisplay();
  });
</script>
<script src="{{ asset('js/navbar.js') }}"></script>
@endsection
