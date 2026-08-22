{{--
  partials/navbar.blade.php
  Shared navigation bar — used across all storefront pages.
  Pass $activeNav = 'katalog'|'quiz'|'' to highlight the active link.
--}}
@php $activeNav = $activeNav ?? ''; @endphp

<nav id="navbar" aria-label="Main Navigation">
  <div class="nav-brand" data-nav="home">
    <a href="/" style="text-decoration:none; color:inherit;"><span class="nav-brand-name">Perfu.me</span></a>
  </div>

  <ul class="nav-links">
    <li><a href="/katalog" @if($activeNav === 'katalog') style="color:#0D0D0D; font-weight:700; text-decoration:underline; text-underline-offset:4px;" @endif>Katalog</a></li>
    <li><a href="/quiz" @if($activeNav === 'quiz') class="active" @endif>Quiz</a></li>
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
