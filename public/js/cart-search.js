/**
 * cart-search.js — Interactive Cart & Search Drawer System
 * Matching User Design Specifications & Reference Image
 * Perfu.me E-Commerce Platform
 */

(function () {
  // ── Products Cache (populated from API at init) ───────────
  let PRODUCTS_DATA = [];

  async function loadProductsCache() {
    try {
      if (window.API && typeof window.API.getAll === 'function') {
        const apiProducts = await window.API.getAll();
        if (apiProducts && apiProducts.length > 0) {
          PRODUCTS_DATA = apiProducts;
          return;
        }
      }
    } catch (e) {}
    // Fallback hardcoded if API not available
    PRODUCTS_DATA = [
      { id: 1, name: 'Vanessence', type: 'Eau de Parfum', gender: 'Wanita', variant: 'Gourmand Vanilla', size: '30ML', price: 150000, image: 'assets/images/vanessence.png', tagline: 'Feminin, manis, dan memikat' },
      { id: 2, name: 'Dynamyst', type: 'Eau de Parfum', gender: 'Pria', variant: 'Spicy Woody', size: '30ML', price: 150000, image: 'assets/images/dynamyst.png', tagline: 'Maskulin, tegas, penuh energi' },
      { id: 3, name: 'Nusantara No.1', type: 'Eau de Parfum', gender: 'Unisex', variant: 'Woody Floral', size: '30ML', price: 85000, image: 'assets/images/Nusantara1nobg.png', tagline: 'Elegan, segar, dan abadi' },
      { id: 4, name: 'Nusantara No.2 \u2013 Rempah', type: 'Eau de Parfum', gender: 'Pria', variant: 'Spicy Oriental', size: '30ML', price: 95000, image: 'assets/images/nusantara_no2.png', tagline: 'Berani, hangat, dan penuh karakter' },
      { id: 5, name: 'Nusantara Roll-On Mini', type: 'Roll-on', gender: 'Wanita', variant: 'Sweet Floral', size: '10ML', price: 35000, image: 'assets/images/nusantara_rollon.png', tagline: 'Manis, segar, dan memikat' }
    ];
  }

  // ── Helper Functions ─────────────────────────────────────
  function getCart() {
    try {
      return JSON.parse(localStorage.getItem('perfume_cart')) || [];
    } catch {
      return [];
    }
  }

  function saveCart(cart) {
    localStorage.setItem('perfume_cart', JSON.stringify(cart));
    updateCartBadge();
  }

  function formatPrice(num) {
    return 'Rp ' + Number(num).toLocaleString('id-ID');
  }

  function closeSearchDrawer() {
    const searchOverlay = document.getElementById('search-drawer-overlay');
    const searchDrawer = document.getElementById('search-drawer');
    searchOverlay?.classList.remove('active');
    searchDrawer?.classList.remove('open');
  }

  function closeCartDrawer() {
    const overlay = document.getElementById('cart-drawer-overlay');
    const drawer = document.getElementById('cart-drawer');
    overlay?.classList.remove('active');
    drawer?.classList.remove('open');
  }
  window.closeCartDrawer = closeCartDrawer;

  // ── Add to Cart Function ──────────────────────────────────
  window.addToCart = async function (productId, qty = 1) {
    let product = PRODUCTS_DATA.find(p => p.id === Number(productId));

    // If not in cache, try fetching directly from API
    if (!product && window.API && typeof window.API.getById === 'function') {
      try {
        product = await window.API.getById(Number(productId));
        if (product) PRODUCTS_DATA.push(product); // add to cache
      } catch (e) {}
    }

    if (!product) {
      console.warn('addToCart: product ID not found:', productId);
      return;
    }

    let cart = getCart();
    const existingIndex = cart.findIndex(item => item.id === product.id);

    if (existingIndex > -1) {
      cart[existingIndex].qty += qty;
    } else {
      cart.push({
        id: product.id,
        name: product.name,
        type: product.type,
        variant: product.variant,
        size: product.size,
        price: product.price,
        image: product.image,
        qty: qty
      });
    }

    saveCart(cart);
    showToast(`"${product.name}" telah ditambahkan ke keranjang!`);
    renderCartItems();
  };

  // ── Remove & Update Qty ───────────────────────────────────
  window.removeFromCart = function (id) {
    let cart = getCart();
    const item = cart.find(i => i.id === Number(id));
    const name = item ? item.name : 'Produk';
    cart = cart.filter(i => i.id !== Number(id));
    saveCart(cart);
    renderCartItems();
    showToast(`"${name}" dihapus dari keranjang.`, 'info');
  };

  window.updateCartQty = function (id, delta) {
    let cart = getCart();
    const item = cart.find(i => i.id === Number(id));
    if (!item) return;

    item.qty += delta;
    if (item.qty <= 0) {
      cart = cart.filter(i => i.id !== Number(id));
      showToast(`"${item.name}" dihapus dari keranjang.`, 'info');
    }

    saveCart(cart);
    renderCartItems();
  };

  // ── Update Badge Counter ─────────────────────────────────
  function updateCartBadge() {
    const cart = getCart();
    const totalCount = cart.reduce((sum, item) => sum + item.qty, 0);
    const badge = document.getElementById('cart-badge-count');
    if (badge) {
      badge.textContent = totalCount;
      badge.style.display = totalCount > 0 ? 'flex' : 'none';
    }
  }

  // ── Toast Helper (Luxury Toast Notification) ─────────────
  function showToast(message, type = 'success', title = '') {
    let container = document.getElementById('toast-container');
    if (!container) {
      container = document.createElement('div');
      container.id = 'toast-container';
      document.body.appendChild(container);
    }

    const toast = document.createElement('div');
    toast.className = `toast ${type}`;

    let iconSvg = '';
    let defaultTitle = '';

    if (type === 'success') {
      defaultTitle = 'KERANJANG BELANJA';
      iconSvg = `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>`;
    } else if (type === 'error') {
      defaultTitle = 'PERHATIAN';
      iconSvg = `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>`;
    } else {
      defaultTitle = 'KERANJANG BELANJA';
      iconSvg = `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>`;
    }

    toast.innerHTML = `
      <div class="toast-icon-box">${iconSvg}</div>
      <div class="toast-content">
        <div class="toast-title">${title || defaultTitle}</div>
        <div class="toast-message">${message}</div>
      </div>
      <button class="toast-close" aria-label="Tutup">&times;</button>
      <div class="toast-progress"></div>
    `;

    const closeBtn = toast.querySelector('.toast-close');
    if (closeBtn) {
      closeBtn.onclick = () => removeToast(toast);
    }

    container.appendChild(toast);

    const timer = setTimeout(() => {
      removeToast(toast);
    }, 3500);

    function removeToast(el) {
      clearTimeout(timer);
      el.classList.add('toast-hiding');
      setTimeout(() => el.remove(), 300);
    }
  }

  // ── Search Drawer Logic ──────────────────────────────────
  function initSearchDrawer() {
    const searchBtn = document.getElementById('btn-open-search');
    const closeBtn = document.getElementById('btn-close-search');
    const overlay = document.getElementById('search-drawer-overlay');
    const drawer = document.getElementById('search-drawer');
    const input = document.getElementById('drawer-search-input');
    const resultsContainer = document.getElementById('drawer-search-results');

    if (searchBtn) {
      searchBtn.addEventListener('click', () => {
        closeCartDrawer();
        overlay?.classList.add('active');
        drawer?.classList.add('open');
        setTimeout(() => input?.focus(), 200);
        renderSearchResults('');
      });
    }

    if (closeBtn) closeBtn.addEventListener('click', closeSearchDrawer);
    if (overlay) overlay.addEventListener('click', closeSearchDrawer);

    if (input) {
      input.addEventListener('input', () => {
        const query = input.value.trim();
        renderSearchResults(query);
      });
    }

    function renderSearchResults(query) {
      if (!resultsContainer) return;

      if (!query) {
        resultsContainer.innerHTML = `
          <div class="search-empty-state" style="padding:4rem 1.5rem; text-align:center;">
            <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#CCCCCC" stroke-width="1.5"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            <p style="font-size:0.85rem; color:#8A8A8A; margin-top:0.75rem;">Ketik nama parfum atau varian untuk mulai mencari...</p>
          </div>
        `;
        return;
      }

      const q = query.toLowerCase();
      const filtered = PRODUCTS_DATA.filter(p =>
        p.name.toLowerCase().includes(q) ||
        p.variant.toLowerCase().includes(q) ||
        (p.tagline && p.tagline.toLowerCase().includes(q))
      );

      if (filtered.length === 0) {
        resultsContainer.innerHTML = `
          <div class="search-empty-state">
            <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#A1A1AA" stroke-width="1.5"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            <p style="font-size:0.88rem; color:#555; margin-top:0.75rem;">Tidak ada parfum yang cocok dengan "<strong>${query}</strong>"</p>
          </div>
        `;
        return;
      }

      resultsContainer.innerHTML = `
        <div class="search-results-list">
          ${filtered.map(p => `
            <div class="search-result-item" onclick="window.location.href='/produk/${p.id}'" style="cursor:pointer;" title="Lihat detail ${p.name}">
              <img src="${p.image}" alt="${p.name}" class="search-result-img" onerror="this.src='assets/images/refill.webp'">
              <div class="search-result-info">
                <div class="search-result-tag">${p.gender || 'Unisex'} · ${p.variant || ''}</div>
                <div class="search-result-name">${p.name}</div>
                <div class="search-result-price">${formatPrice(p.price)}</div>
              </div>
              <button class="search-result-add-btn" onclick="event.stopPropagation(); window.addToCart(${p.id})">
                + Cart
              </button>
            </div>
          `).join('')}
        </div>
      `;
    }
  }

  // ── Cart Drawer Logic ────────────────────────────────────
  function initCartDrawer() {
    const cartBtn = document.getElementById('btn-open-cart');
    const closeBtn = document.getElementById('btn-close-cart');
    const overlay = document.getElementById('cart-drawer-overlay');
    const drawer = document.getElementById('cart-drawer');

    if (cartBtn) {
      cartBtn.addEventListener('click', () => {
        closeSearchDrawer();
        overlay?.classList.add('active');
        drawer?.classList.add('open');
        renderCartItems();
      });
    }

    if (closeBtn) closeBtn.addEventListener('click', closeCartDrawer);
    if (overlay) overlay.addEventListener('click', closeCartDrawer);
  }

  function renderCartItems() {
    const container = document.getElementById('drawer-cart-items');
    const totalEl = document.getElementById('cart-subtotal-price');
    const checkoutBtn = document.getElementById('btn-cart-checkout-wa');
    if (!container) return;

    const cart = getCart();

    if (cart.length === 0) {
      container.innerHTML = `
        <div class="cart-empty-state">
          <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#D4D4D8" stroke-width="1.5"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
          <p class="cart-empty-text">Keranjang belanja Anda masih kosong</p>
          <span class="cart-empty-sub">Pilih varian parfum favorit Anda dan tambahkan ke sini.</span>
        </div>
      `;
      if (totalEl) totalEl.textContent = 'Rp 0';
      if (checkoutBtn) {
        checkoutBtn.style.opacity = '0.5';
        checkoutBtn.style.pointerEvents = 'none';
        checkoutBtn.href = '#';
      }
      return;
    }

    const subtotal = cart.reduce((sum, item) => sum + (item.price * item.qty), 0);

    container.innerHTML = cart.map(item => `
      <div class="cart-item-card">
        <img src="${item.image}" alt="${item.name}" class="cart-item-img" onerror="this.src='assets/images/Nusantara1nobg.png'">
        <div class="cart-item-details">
          <div class="cart-item-name">${item.name}</div>
          <div class="cart-item-variant">${item.variant} · ${item.size}</div>
          <div class="cart-item-price">${formatPrice(item.price)}</div>

          <div class="cart-qty-control">
            <button class="qty-btn" onclick="window.updateCartQty(${item.id}, -1)">−</button>
            <span class="qty-num">${item.qty}</span>
            <button class="qty-btn" onclick="window.updateCartQty(${item.id}, 1)">+</button>
          </div>
        </div>
        <button class="cart-item-remove" onclick="window.removeFromCart(${item.id})" title="Hapus produk">&times;</button>
      </div>
    `).join('');

    if (totalEl) totalEl.textContent = formatPrice(subtotal);

    if (checkoutBtn) {
      checkoutBtn.style.opacity = '1';
      checkoutBtn.style.pointerEvents = 'all';

      let waMsg = 'Halo, saya ingin memesan parfum dari Perfu.me:\n\n';
      cart.forEach((i, index) => {
        waMsg += `${index + 1}. ${i.name} (${i.size}) x${i.qty} — ${formatPrice(i.price * i.qty)}\n`;
      });
      waMsg += `\n*Total Harga: ${formatPrice(subtotal)}*`;

      checkoutBtn.href = `https://wa.me/6281234567890?text=${encodeURIComponent(waMsg)}`;
    }
  }

  // Init on DOM ready
  document.addEventListener('DOMContentLoaded', () => {
    loadProductsCache(); // populate product cache from API
    updateCartBadge();
    initSearchDrawer();
    initCartDrawer();
  });
})();
