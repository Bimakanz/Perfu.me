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

  function formatImgUrl(url) {
    if (!url) return '/assets/images/refill.webp';
    if (url.startsWith('http://') || url.startsWith('https://') || url.startsWith('/')) return url;
    return '/' + url;
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

  // ── Cool Simple Flying Cart Thumbnail Animation (1.2s Smooth) ─────
  function flyToCartAnimation(imgSrc, evt) {
    const cartBtn = document.getElementById('btn-open-cart');
    if (!cartBtn) return;

    const targetRect = cartBtn.getBoundingClientRect();
    let startX = window.innerWidth / 2;
    let startY = window.innerHeight / 2;

    if (evt && evt.target) {
      const rect = evt.target.getBoundingClientRect();
      startX = rect.left + rect.width / 2;
      startY = rect.top + rect.height / 2;
    }

    // Create floating thumbnail element
    const flyImg = document.createElement('img');
    flyImg.src = formatImgUrl(imgSrc);
    flyImg.style.cssText = `
      position: fixed;
      z-index: 99999;
      top: ${startY - 25}px;
      left: ${startX - 25}px;
      width: 54px;
      height: 54px;
      object-fit: cover;
      border-radius: 50%;
      box-shadow: 0 10px 28px rgba(0,0,0,0.3);
      border: 2px solid #FFFFFF;
      pointer-events: none;
      transition: all 1.2s cubic-bezier(0.25, 1, 0.3, 1);
      opacity: 1;
      transform: scale(1);
    `;

    document.body.appendChild(flyImg);

    // Trigger fly animation
    requestAnimationFrame(() => {
      flyImg.style.top = `${targetRect.top + targetRect.height / 2 - 15}px`;
      flyImg.style.left = `${targetRect.left + targetRect.width / 2 - 15}px`;
      flyImg.style.width = '28px';
      flyImg.style.height = '28px';
      flyImg.style.opacity = '0.15';
      flyImg.style.transform = 'scale(0.3)';
    });

    // Cleanup & bounce cart icon on hit after 1.2 seconds
    setTimeout(() => {
      flyImg.remove();
      cartBtn.style.transition = 'transform 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
      cartBtn.style.transform = 'scale(1.4)';
      setTimeout(() => {
        cartBtn.style.transform = 'scale(1)';
      }, 220);
    }, 1200);
  }
  window.flyToCartAnimation = flyToCartAnimation;

  // ── Add to Cart Function ──────────────────────────────────
  window.addToCart = async function (productId, qty = 1, evt = null) {
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
    flyToCartAnimation(product.image, evt || window.event);
    showCenterToast('Produk telah ditambahkan ke keranjang belanja');
    renderCartItems();
  };

  // ── Remove & Update Qty (No notifications/animations on delete) ──
  window.removeFromCart = function (id) {
    let cart = getCart();
    cart = cart.filter(i => i.id !== Number(id));
    saveCart(cart);
    renderCartItems();
  };

  window.updateCartQty = function (id, delta) {
    let cart = getCart();
    const item = cart.find(i => i.id === Number(id));
    if (!item) return;

    item.qty += delta;
    if (item.qty <= 0) {
      cart = cart.filter(i => i.id !== Number(id));
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

  // ── Centered Shopee-Style Invisible Soft Grey Toast Notification ──
  function showCenterToast(message) {
    // Remove existing toast if any
    const existing = document.getElementById('center-toast-box');
    if (existing) existing.remove();

    const box = document.createElement('div');
    box.id = 'center-toast-box';
    box.style.cssText = `
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%) scale(0.85);
      z-index: 100000;
      background: rgba(28, 28, 30, 0.82);
      color: #FFFFFF;
      padding: 1.6rem 2.25rem;
      border-radius: 18px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 1rem;
      box-shadow: 0 16px 40px rgba(0,0,0,0.22);
      backdrop-filter: blur(18px);
      -webkit-backdrop-filter: blur(18px);
      border: 1px solid rgba(255, 255, 255, 0.12);
      text-align: center;
      max-width: 320px;
      pointer-events: none;
      opacity: 0;
      animation: popInCenterBox 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
    `;

    box.innerHTML = `
      <div style="width: 54px; height: 54px; border-radius: 50%; background: #10B981; display: flex; align-items: center; justify-content: center; box-shadow: 0 6px 18px rgba(16, 185, 129, 0.35);">
        <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="20 6 9 17 4 12"></polyline>
        </svg>
      </div>
      <div style="font-size: 0.9rem; font-weight: 600; line-height: 1.5; color: #FFFFFF; letter-spacing: 0.02em;">
        ${message}
      </div>
    `;

    document.body.appendChild(box);

    // Inject CSS keyframes if not present
    if (!document.getElementById('center-toast-styles')) {
      const styleTag = document.createElement('style');
      styleTag.id = 'center-toast-styles';
      styleTag.innerHTML = `
        @keyframes popInCenterBox {
          from { opacity: 0; transform: translate(-50%, -50%) scale(0.85); }
          to { opacity: 1; transform: translate(-50%, -50%) scale(1); }
        }
        @keyframes fadeOutCenterBox {
          from { opacity: 1; transform: translate(-50%, -50%) scale(1); }
          to { opacity: 0; transform: translate(-50%, -50%) scale(0.9); }
        }
      `;
      document.head.appendChild(styleTag);
    }

    // Auto dismiss after 1.5s
    setTimeout(() => {
      box.style.animation = 'fadeOutCenterBox 0.3s ease forwards';
      setTimeout(() => {
        box.remove();
      }, 300);
    }, 1500);
  }
  window.showToast = showCenterToast;

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
          ${filtered.map(p => {
            const imgSrc = formatImgUrl(p.image);
            return `
              <div class="search-result-item" onclick="window.location.href='/produk/${p.id}'" style="cursor:pointer;" title="Lihat detail ${p.name}">
                <img src="${imgSrc}" alt="${p.name}" class="search-result-img" onerror="this.src='/assets/images/refill.webp'">
                <div class="search-result-info">
                  <div class="search-result-tag">${p.gender || 'Unisex'} · ${p.variant || ''}</div>
                  <div class="search-result-name">${p.name}</div>
                  <div class="search-result-price">${formatPrice(p.price)}</div>
                </div>
                <button class="search-result-add-btn" onclick="event.stopPropagation(); window.addToCart(${p.id})">
                  + Cart
                </button>
              </div>
            `;
          }).join('')}
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

    container.innerHTML = cart.map(item => {
      const imgSrc = formatImgUrl(item.image);
      return `
        <div class="cart-item-card">
          <img src="${imgSrc}" alt="${item.name}" class="cart-item-img" onerror="this.src='/assets/images/refill.webp'">
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
      `;
    }).join('');

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
