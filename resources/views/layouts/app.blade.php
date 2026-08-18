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
  <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>✨</text></svg>">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- FontAwesome 6 Icon Library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

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

  <!-- Floating WhatsApp Widget (Green WA Icon + Popover Menu) -->
  <div id="floating-wa-container" class="floating-wa-container">
    
    <!-- Popover Option Menu -->
    <div id="floating-wa-menu" class="floating-wa-menu">
      <div class="wa-menu-header">
        <div class="wa-avatar-box">
          <i class="fa-brands fa-whatsapp" style="font-size: 20px; color: #25D366;"></i>
        </div>
        <div>
          <div class="wa-menu-title">Customer Care Perfu.me</div>
          <div class="wa-menu-sub">Pilih jenis layanan bantuan yang Anda butuhkan:</div>
        </div>
      </div>
      <div class="wa-menu-body">
        <a href="https://wa.me/6281383415432?text=Halo%20Perfu.me,%20saya%20ingin%20bertanya%20dan%20meminta%20rekomendasi%20mengenai%20varian%20parfum%20yang%20cocok%20untuk%20saya." 
           target="_blank" 
           rel="noopener" 
           class="wa-option-item">
          <div class="wa-option-icon">
            <i class="fa-brands fa-whatsapp" style="font-size: 24px; color: #25D366;"></i>
          </div>
          <div class="wa-option-text">
            <strong>Tanya Produk & Rekomendasi</strong>
            <span>Konsultasi pilihan aroma parfum terbaik</span>
          </div>
        </a>
        <a href="https://wa.me/6281383415432?text=Halo%20Perfu.me,%20saya%20tertarik%20untuk%20menjadi%20Agen%20/%20Reseller%20Perfu.me.%20Mohon%20informasi%20syarat%20dan%20ketentuannya." 
           target="_blank" 
           rel="noopener" 
           class="wa-option-item">
          <div class="wa-option-icon">
            <i class="fa-brands fa-whatsapp" style="font-size: 24px; color: #25D366;"></i>
          </div>
          <div class="wa-option-text">
            <strong>Gabung Agen & Reseller</strong>
            <span>Dapatkan harga grosir & penawaran bisnis</span>
          </div>
        </a>
      </div>
    </div>

    <!-- Green WhatsApp Trigger Button -->
    <button id="floating-wa-btn" class="floating-wa-trigger" aria-label="Buka Menu WhatsApp" title="Chat WhatsApp Perfu.me">
      <i class="fa-brands fa-whatsapp wa-icon-svg" style="font-size: 30px; color: #FFFFFF;"></i>
      <span class="wa-close-icon">&times;</span>
    </button>
  </div>

  <!-- Core JS -->
  <script src="{{ asset('js/db.js') }}"></script>
  <script src="{{ asset('js/cart-search.js') }}"></script>

  <!-- Scroll Listener & Toggle for Floating WA Widget -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const container = document.getElementById('floating-wa-container');
      const waBtn = document.getElementById('floating-wa-btn');
      const waMenu = document.getElementById('floating-wa-menu');
      const heroEl = document.getElementById('hero');

      if (container && waBtn) {
        // 1. Always show the WA widget fixed in the corner
        container.classList.add('visible');

        // 2. Toggle menu popover when green WA button is clicked
        waBtn.addEventListener('click', function (e) {
          e.stopPropagation();
          container.classList.toggle('active');
        });

        // 3. Close menu when clicking outside
        document.addEventListener('click', function (e) {
          if (!container.contains(e.target)) {
            container.classList.remove('active');
          }
        });
      }
    });
  </script>

  <!-- Page-specific JS -->
  @yield('scripts')

</body>
</html>

