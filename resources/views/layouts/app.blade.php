<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- SEO -->
  <title>@yield('title', 'Perfu.me — Luxury & Nusantara Fragrance Series')</title>
  <meta name="description" content="@yield('description', 'Perfu.me menghadirkan koleksi parfum premium vanessence, dynamyst, dan seri nusantara dengan konsentrat parfum grade A dan ketahanan aromatis hingga 10 jam.')">
  @yield('meta')

  <!-- Favicon -->
  <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>âœ¨</text></svg>">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Core CSS -->
  <link rel="stylesheet" href="{{ asset('css/main.css') }}">
  <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">

  <!-- Page-specific CSS -->
  @yield('styles')
</head>

<body>

  @yield('content')

  <!-- Toast Container -->
  <div id="toast-container"></div>

  <!-- Search Drawer -->
  <div id="search-drawer-overlay" class="drawer-overlay"></div>
  <aside id="search-drawer" class="right-drawer">
    <div class="drawer-head">
      <h2 class="drawer-title">Search</h2>
      <button class="drawer-close-btn" id="btn-close-search" aria-label="Tutup Search">&times;</button>
    </div>
    <div class="drawer-search-bar">
      <div class="drawer-search-input-wrap">
        <svg class="search-glass-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="11" cy="11" r="8"></circle>
          <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
        <input type="text" id="drawer-search-input" placeholder="Search..." autocomplete="off">
      </div>
    </div>
    <div class="drawer-search-results" id="drawer-search-results"></div>
  </aside>

  <!-- Cart Drawer -->
  <div id="cart-drawer-overlay" class="drawer-overlay"></div>
  <aside id="cart-drawer" class="right-drawer">
    <div class="drawer-head">
      <h2 class="drawer-title">Keranjang Belanja</h2>
      <button class="drawer-close-btn" id="btn-close-cart" aria-label="Tutup Keranjang">&times;</button>
    </div>
    <div class="drawer-cart-body" id="drawer-cart-items"></div>
    <div class="drawer-cart-footer">
      <div class="cart-subtotal-row">
        <span>Total Harga</span>
        <strong id="cart-subtotal-price">Rp 0</strong>
      </div>
      <a href="#" id="btn-cart-checkout-wa" target="_blank" rel="noopener" class="btn-cart-checkout">
        Checkout via WhatsApp
      </a>
    </div>
  </aside>

  <!-- Core JS -->
  <script src="{{ asset('js/db.js') }}"></script>
  <script src="{{ asset('js/cart-search.js') }}"></script>

  <!-- Page-specific JS -->
  @yield('scripts')

</body>
</html>

