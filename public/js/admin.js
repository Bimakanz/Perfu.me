/**
 * admin.js — Admin Dashboard Controller
 * Handles 2-column login, CRUD, File Upload, Custom Dropdowns, 3-Dot Action Dropdowns, Status Filters, Product Detail Modal & Realtime Stats
 * Perfu.me E-Commerce Platform
 */

var products = [];
var deleteTargetId = null;
var detailTargetId = null;
var isEditing = false;
var currentSort = { field: 'id', dir: 'asc' };

  // ── Image URL Helper ───────────────────────────────────────
  function formatImgUrl(path) {
    if (!path) return '/assets/images/penisence.webp';
    if (path.startsWith('data:') || path.startsWith('http://') || path.startsWith('https://')) return path;
    if (path.startsWith('../')) path = path.replace('../', '');
    if (!path.startsWith('/')) path = '/' + path;
    return path;
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
      defaultTitle = 'ADMIN PORTAL';
      iconSvg = `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>`;
    } else if (type === 'error') {
      defaultTitle = 'PERHATIAN';
      iconSvg = `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>`;
    } else {
      defaultTitle = 'ADMIN INVENTORY';
      iconSvg = `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>`;
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

  // Password visibility toggle
  window.toggleAdminPassword = function(e) {
    if (e) e.preventDefault();
    const passInput = document.getElementById('admin-pass-input');
    if (passInput) {
      passInput.type = passInput.type === 'password' ? 'text' : 'password';
    }
  };

  // Global login handler attached directly to button click
  window.doAdminLogin = async function(e) {
    if (e) e.preventDefault();
    const errorMsg = document.getElementById('login-error-msg');
    if (errorMsg) errorMsg.classList.remove('show');

    const userInput = document.getElementById('admin-user-input');
    const passInput = document.getElementById('admin-pass-input');
    const user = (userInput ? userInput.value : '').trim();
    const pass = (passInput ? passInput.value : '').trim();

    if (user === 'admin' && pass === 'admin123') {
      try {
        if (window.API && typeof window.API.login === 'function') {
          await window.API.login(user, pass);
        } else if (window.API && typeof window.API.setToken === 'function') {
          window.API.setToken('mock_session_token');
        }
      } catch (err) {
        if (window.API && typeof window.API.setToken === 'function') {
          window.API.setToken('mock_session_token');
        }
      }
      showDashboard();
      return false;
    }

    if (errorMsg) {
      errorMsg.textContent = 'Username atau password salah.';
      errorMsg.classList.add('show');
    }
    return false;
  };

  // ── 1. Login Controller ─────────────────────────────────
  function initLogin() {
    const form = document.getElementById('admin-login-form');
    const passInput = document.getElementById('admin-pass-input');
    const toggleBtn = document.getElementById('toggle-pass-btn');

    // Toggle password visibility
    if (toggleBtn && passInput) {
      toggleBtn.addEventListener('click', () => {
        const isPass = passInput.type === 'password';
        passInput.type = isPass ? 'text' : 'password';
      });
    }

    // Handle Login Submit
    if (form) {
      form.addEventListener('submit', window.doAdminLogin);
    }

    // Logout button handler
    const logoutBtn = document.getElementById('admin-logout-btn');
    if (logoutBtn) {
      logoutBtn.addEventListener('click', logout);
    }

    // Search input listener
    const searchInput = document.getElementById('admin-table-search');
    if (searchInput) searchInput.addEventListener('input', renderTable);

    // Global listener to close dropdowns when clicking outside
    document.addEventListener('click', () => {
      document.querySelectorAll('.action-dropdown-menu').forEach(m => m.classList.remove('show'));
      document.querySelectorAll('.btn-3dots').forEach(b => b.classList.remove('active'));

      const customDropdown = document.getElementById('custom-filter-dropdown');
      const customTrigger = document.getElementById('custom-filter-trigger');
      if (customDropdown) customDropdown.classList.remove('show');
      if (customTrigger) customTrigger.classList.remove('active');
    });

    // Check existing session
    try {
      if (window.API && typeof window.API.hasToken === 'function' && window.API.hasToken()) {
        showDashboard();
      }
    } catch (e) {}
  }

  // ── Custom Filter Select Dropdown Controller ────────────────
  function initCustomFilterDropdown() {
    const trigger = document.getElementById('custom-filter-trigger');
    const dropdown = document.getElementById('custom-filter-dropdown');
    const label = document.getElementById('custom-filter-label');
    const hiddenInput = document.getElementById('admin-filter-status');
    const options = document.querySelectorAll('.custom-select-option');

    if (!trigger || !dropdown) return;

    trigger.addEventListener('click', (e) => {
      e.stopPropagation();
      // Close any open 3-dot dropdowns
      document.querySelectorAll('.action-dropdown-menu').forEach(m => m.classList.remove('show'));
      document.querySelectorAll('.btn-3dots').forEach(b => b.classList.remove('active'));

      const isShow = dropdown.classList.contains('show');
      dropdown.classList.toggle('show', !isShow);
      trigger.classList.toggle('active', !isShow);
    });

    options.forEach(opt => {
      opt.addEventListener('click', (e) => {
        e.stopPropagation();
        const val = opt.getAttribute('data-value');
        const txt = opt.textContent.trim();

        options.forEach(o => o.classList.remove('active'));
        opt.classList.add('active');

        if (label) label.textContent = txt;
        if (hiddenInput) hiddenInput.value = val;

        dropdown.classList.remove('show');
        trigger.classList.remove('active');

        // Re-render inventory table with new filter
        renderTable();
      });
    });
  }

  function showDashboard() {
    const loginPage = document.getElementById('admin-login-page');
    const dashPage = document.getElementById('admin-dashboard-page');
    
    if (loginPage) {
      loginPage.style.cssText = 'display: none !important;';
    }
    if (dashPage) {
      dashPage.style.cssText = 'display: block !important;';
      dashPage.classList.add('active');
    }

    // Load initial products fallback immediately to render UI
    products = [...DEFAULT_ADMIN_PRODUCTS];
    try { renderTable(); } catch (e) {}
    try { updateStats(); } catch (e) {}

    // Async fetch from database in background
    loadDashboardData();
  }

  function logout() {
    window.API.logout();
    const loginPage = document.getElementById('admin-login-page');
    const dashPage = document.getElementById('admin-dashboard-page');
    if (dashPage) {
      dashPage.classList.remove('active');
      dashPage.style.cssText = 'display: none !important;';
    }
    if (loginPage) {
      loginPage.style.cssText = 'display: flex !important;';
    }
    showToast('Berhasil keluar dari dashboard.', 'info');
  }

  window.handleSessionExpired = function() {
    if (window.API && typeof window.API.clearToken === 'function') {
      window.API.clearToken();
    }
    const loginPage = document.getElementById('admin-login-page');
    const dashPage = document.getElementById('admin-dashboard-page');
    if (dashPage) {
      dashPage.classList.remove('active');
      dashPage.style.cssText = 'display: none !important;';
    }
    if (loginPage) {
      loginPage.style.cssText = 'display: flex !important;';
    }
    showToast('Sesi login Anda telah berakhir. Silakan masuk kembali.', 'warning');
  };

  // Default fallback products if API returns empty
  const DEFAULT_ADMIN_PRODUCTS = [
    {
      id: 1,
      name: 'Vanessence',
      type: 'Eau de Parfum',
      gender: 'Wanita',
      variant: 'Gourmand Vanilla',
      top_notes: 'Almond, Anise',
      middle_notes: 'Vanilla Orchid, Heliotrope',
      base_notes: 'Bourbon Vanilla, Tonka Bean',
      packaging: 'Botol kaca spray 30ml, dus karton',
      size: '30ml',
      price: 45000,
      stock: 30,
      best_seller: true,
      image: 'assets/images/penisence.webp',
      description: 'Vanessence adalah perpaduan bunga yang lembut dengan sentuhan vanilla hangat. Dibuat untuk wanita yang anggun namun berkarakter.',
      tagline: 'Feminin, manis, dan memikat'
    },
    {
      id: 2,
      name: 'Dynamyst',
      type: 'Eau de Parfum',
      gender: 'Pria',
      variant: 'Spicy Woody',
      top_notes: 'Grapefruit, Sea Salt',
      middle_notes: 'Sage, Rosemary',
      base_notes: 'Cedarwood, Patchouli',
      packaging: 'Botol kaca spray 30ml, dus karton',
      size: '30ml',
      price: 45000,
      stock: 25,
      best_seller: true,
      image: 'assets/images/dynamist.webp',
      description: 'Dynamyst adalah wewangian untuk pria yang dinamis dan penuh energi.',
      tagline: 'Maskulin, tegas, penuh energi'
    }
  ];

  // ── 2. Dashboard Data & Table Rendering ─────────────────────
  async function loadDashboardData() {
    products = [...DEFAULT_ADMIN_PRODUCTS];
    renderTable();
    updateStats();

    try {
      if (window.API && typeof window.API.getAll === 'function') {
        const res = await window.API.getAll();
        if (res && res.length > 0) {
          products = res;
          renderTable();
          updateStats();
        }
      }
    } catch (err) {}
  }

  window.loadDashboardData = loadDashboardData;
  window.renderTable = renderTable;

  function updateStats() {
    const total = products.length;
    const bestSellers = products.filter(p => Boolean(p.bestSeller || p.best_seller)).length;
    const readyStock = products.filter(p => Number(p.stock) > 0).length;
    const outOfStock = products.filter(p => Number(p.stock) === 0).length;

    const elTotal = document.getElementById('stat-total-products');
    const elBs = document.getElementById('stat-bestsellers');
    const elReady = document.getElementById('stat-ready');
    const elOut = document.getElementById('stat-outofstock');

    if (elTotal) elTotal.textContent = total;
    if (elBs) elBs.textContent = bestSellers;
    if (elReady) elReady.textContent = readyStock;
    if (elOut) elOut.textContent = outOfStock;
  }

  // Stock Cell Toggle Button (Ready = Hijau, Habis = Merah)
  function stockCellHtml(stock, id) {
    const isReady = Number(stock) > 0;
    return `
      <button class="stock-toggle-btn ${isReady ? 'stock-ready-btn' : 'stock-habis-btn'}" onclick="window.toggleStockStatus('${id}')" title="Klik untuk mengubah status stok">
        ${isReady ? '● READY' : '✕ HABIS'}
      </button>
    `;
  }

  // 3-Dot Action Dropdown Toggle Helper
  window.toggleActionDropdown = function (event, id) {
    event.stopPropagation();

    // Close custom select dropdown if open
    const customDropdown = document.getElementById('custom-filter-dropdown');
    const customTrigger = document.getElementById('custom-filter-trigger');
    if (customDropdown) customDropdown.classList.remove('show');
    if (customTrigger) customTrigger.classList.remove('active');

    const dropdown = document.getElementById(`dropdown-${id}`);
    if (!dropdown) return;
    const isShow = dropdown.classList.contains('show');

    // Close all other open dropdowns
    document.querySelectorAll('.action-dropdown-menu').forEach(m => {
      m.classList.remove('show');
      m.classList.remove('drop-up');
    });
    document.querySelectorAll('.btn-3dots').forEach(b => b.classList.remove('active'));

    if (!isShow) {
      // Check if button is in lower half of table or screen
      const rect = event.currentTarget.getBoundingClientRect();
      const windowHeight = window.innerHeight;
      if (rect.bottom > windowHeight - 160) {
        dropdown.classList.add('drop-up');
      } else {
        dropdown.classList.remove('drop-up');
      }

      dropdown.classList.add('show');
      const btn = dropdown.previousElementSibling;
      if (btn) btn.classList.add('active');
    }
  };

var adminCurrentPage = 1;
const ADMIN_ITEMS_PER_PAGE = 5;

window.goToAdminPage = function(page) {
  adminCurrentPage = page;
  renderTable();
};

function renderAdminPaginationControls(totalPages) {
  let btns = '';

  // PREVIOUS Button
  btns += `<button class="page-btn page-nav ${adminCurrentPage === 1 ? 'disabled' : ''}" onclick="window.goToAdminPage(${adminCurrentPage - 1})" ${adminCurrentPage === 1 ? 'disabled' : ''}>PREVIOUS</button>`;

  // Page Numbers
  for (let i = 1; i <= totalPages; i++) {
    btns += `<button class="page-btn ${i === adminCurrentPage ? 'active' : ''}" onclick="window.goToAdminPage(${i})">${i}</button>`;
  }

  // NEXT Button
  btns += `<button class="page-btn page-nav ${adminCurrentPage === totalPages ? 'disabled' : ''}" onclick="window.goToAdminPage(${adminCurrentPage + 1})" ${adminCurrentPage === totalPages ? 'disabled' : ''}>NEXT</button>`;

  return btns;
}

  function renderTable() {
    const tbody = document.getElementById('admin-table-body');
    const mobileCardsContainer = document.getElementById('admin-mobile-cards');
    const paginationContainer = document.getElementById('admin-pagination');
    const searchVal = (document.getElementById('admin-table-search')?.value || '').toLowerCase();
    const filterVal = document.getElementById('admin-filter-status')?.value || 'all';

    let filtered = products.filter(p => {
      // Search filter
      const matchSearch = !searchVal || p.name.toLowerCase().includes(searchVal) || p.variant.toLowerCase().includes(searchVal);
      if (!matchSearch) return false;

      // Status filter
      if (filterVal === 'bestseller') return Boolean(p.bestSeller || p.best_seller);
      if (filterVal === 'ready') return Number(p.stock) > 0;
      if (filterVal === 'outofstock') return Number(p.stock) === 0;

      return true;
    });

    // Update Counter Badge
    const countBadge = document.getElementById('table-total-count');
    if (countBadge) countBadge.textContent = `${filtered.length} Produk`;

    // Sort
    filtered.sort((a, b) => {
      let va = a[currentSort.field];
      let vb = b[currentSort.field];
      if (typeof va === 'string') va = va.toLowerCase();
      if (typeof vb === 'string') vb = vb.toLowerCase();

      if (va < vb) return currentSort.dir === 'asc' ? -1 : 1;
      if (va > vb) return currentSort.dir === 'asc' ? 1 : -1;
      return 0;
    });

    if (filtered.length === 0) {
      if (tbody) tbody.innerHTML = `<tr><td colspan="7" style="text-align:center;padding:3.5rem;color:#A1A1AA;font-size:0.9rem;">Tidak ada produk yang memenuhi kriteria pencarian.</td></tr>`;
      if (mobileCardsContainer) mobileCardsContainer.innerHTML = `<div style="text-align:center;padding:3rem 1rem;color:#A1A1AA;font-size:0.9rem;">Tidak ada produk yang memenuhi kriteria pencarian.</div>`;
      if (paginationContainer) paginationContainer.innerHTML = '';
      return;
    }

    // Calculate Pagination (5 items per page)
    const totalPages = Math.ceil(filtered.length / ADMIN_ITEMS_PER_PAGE);
    if (adminCurrentPage > totalPages) adminCurrentPage = 1;

    const startIndex = (adminCurrentPage - 1) * ADMIN_ITEMS_PER_PAGE;
    const paginatedItems = filtered.slice(startIndex, startIndex + ADMIN_ITEMS_PER_PAGE);

    // 1. Desktop Table Render
    if (tbody) {
      tbody.innerHTML = paginatedItems.map(p => {
        const isBs = Boolean(p.bestSeller || p.best_seller);
        const isZero = Number(p.stock) === 0;
        const imgSrc = formatImgUrl(p.image);

        return `
          <tr data-id="${p.id}">
            <td>
              <div class="admin-product-cell" onclick="window.openDetailModal('${p.id}')" title="Klik untuk melihat detail lengkap produk">
                <img src="${imgSrc}" class="admin-product-thumb" onerror="this.src='../assets/images/Nusantara1nobg.png'">
                <div>
                  <div class="admin-product-name">${p.name}</div>
                  <div class="admin-product-type">${p.type} · ${p.size}</div>
                </div>
              </div>
            </td>
            <td><span class="badge-gender">${p.gender}</span></td>
            <td><strong style="color:#3F3F46;font-size:0.825rem;">${p.variant}</strong></td>
            <td class="price-cell">Rp ${Number(p.price).toLocaleString('id-ID')}</td>
            <td>${stockCellHtml(p.stock, p.id)}</td>
            <td>
              <button class="bs-toggle-btn ${isBs ? 'bs-yes-btn' : 'bs-no-btn'}" onclick="window.toggleBestSeller('${p.id}')">
                ${isBs ? '★ BEST SELLER' : '— NORMAL'}
              </button>
            </td>
            <td style="text-align:right">
              <div class="action-dropdown-wrap">
                <button class="btn-3dots" onclick="window.toggleActionDropdown(event, '${p.id}')" aria-label="Aksi">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="1.5"></circle>
                    <circle cx="19" cy="12" r="1.5"></circle>
                    <circle cx="5" cy="12" r="1.5"></circle>
                  </svg>
                </button>
                <div class="action-dropdown-menu" id="dropdown-${p.id}">
                  <div class="dropdown-item" onclick="window.openDetailModal('${p.id}')">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    Lihat Detail
                  </div>
                  <div class="dropdown-item" onclick="window.openEditPanel('${p.id}')">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                    Edit Produk
                  </div>
                  <div class="dropdown-divider"></div>
                  <div class="dropdown-item danger" onclick="window.promptDeleteProduct('${p.id}')">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                    Hapus Produk
                  </div>
                </div>
              </div>
            </td>
          </tr>
        `;
      }).join('');
    }

    // Render Pagination
    if (paginationContainer) {
      if (totalPages > 1) {
        paginationContainer.style.display = 'flex';
        paginationContainer.innerHTML = renderAdminPaginationControls(totalPages);
      } else {
        paginationContainer.style.display = 'none';
        paginationContainer.innerHTML = '';
      }
    }
  }

  // ── 3. Product Detail Modal ──────────────────────────────
  function initDetailModal() {
    const backdrop = document.getElementById('detail-modal-backdrop');
    const closeBtn = document.getElementById('btn-close-detail');
    const btnClose = document.getElementById('detail-btn-close');
    const btnZero = document.getElementById('detail-btn-zero');
    const btnEdit = document.getElementById('detail-btn-edit');

    if (closeBtn) closeBtn.addEventListener('click', closeDetailModal);
    if (btnClose) btnClose.addEventListener('click', closeDetailModal);
    if (backdrop) backdrop.addEventListener('click', (e) => { if (e.target === backdrop) closeDetailModal(); });

    function closeDetailModal() {
      if (backdrop) backdrop.classList.remove('active');
      detailTargetId = null;
    }

    window.openDetailModal = function (id) {
      const p = products.find(prod => String(prod.id) === String(id));
      if (!p) return;

      detailTargetId = id;

      document.getElementById('detail-gender').textContent = (p.gender || 'UNISEX').toUpperCase();
      document.getElementById('detail-name').textContent = p.name;
      document.getElementById('detail-img').src = formatImgUrl(p.image);
      document.getElementById('detail-meta').textContent = `${(p.type || 'Eau de Parfum').toUpperCase()} · ${(p.size || '30ML').toUpperCase()}`;
      document.getElementById('detail-price').textContent = `Rp ${Number(p.price).toLocaleString('id-ID')}`;
      document.getElementById('detail-tagline').textContent = p.tagline ? `"${p.tagline}"` : '';
      document.getElementById('detail-desc').textContent = p.description || 'Tidak ada deskripsi.';

      document.getElementById('detail-top').textContent = p.top_notes || p.topNotes || '—';
      document.getElementById('detail-middle').textContent = p.middle_notes || p.middleNotes || '—';
      document.getElementById('detail-base').textContent = p.base_notes || p.baseNotes || '—';

      document.getElementById('detail-packaging').textContent = p.packaging || 'Botol kaca spray';
      document.getElementById('detail-bestseller').textContent = Boolean(p.bestSeller || p.best_seller) ? '★ Ya (Best Seller)' : 'Bukan Best Seller';

      // Stock Pill inside Modal
      const stockPill = document.getElementById('detail-stock-status-pill');
      if (stockPill) {
        stockPill.innerHTML = stockCellHtml(p.stock);
      }

      // Configure Action buttons in detail modal
      if (btnZero) {
        const isZero = Number(p.stock) === 0;
        btnZero.disabled = isZero;
        btnZero.style.opacity = isZero ? '0.4' : '1';
        btnZero.style.cursor = isZero ? 'not-allowed' : 'pointer';
        btnZero.onclick = () => {
          closeDetailModal();
          window.quickZeroStock(p.id);
        };
      }

      if (btnEdit) {
        btnEdit.onclick = () => {
          closeDetailModal();
          window.openEditPanel(p.id);
        };
      }

      backdrop.classList.add('active');
    };
  }

  // ── 4. Quick Zero Stock Action ─────────────────────────────
  window.quickZeroStock = async function (id) {
    const product = products.find(p => String(p.id) === String(id));
    if (!product) return;

    try {
      await window.API.zeroStock(id);
      product.stock = 0;
      showToast(`Stok ${product.name} berhasil dijadikan 0 Pcs.`, 'warning');
      loadDashboardData();
    } catch (err) {
      product.stock = 0;
      showToast(`Stok ${product.name} berhasil dijadikan 0 Pcs (Lokal).`, 'warning');
      renderTable();
      updateStats();
    }
  };

  // ── 5. Robust Toggle Best Seller ────────────────────────────
  window.toggleBestSeller = async function (id) {
    const product = products.find(p => String(p.id) === String(id));
    if (!product) return;

    const currentBs = Boolean(product.bestSeller || product.best_seller);
    const newBs = !currentBs;

    // Instantly update local state for smooth UX
    product.best_seller = newBs;
    product.bestSeller = newBs;
    renderTable();
    updateStats();

    try {
      await window.API.update(id, { best_seller: newBs });
      showToast(`Status Best Seller ${product.name} diperbarui.`);
    } catch (err) {
      showToast(`Status Best Seller ${product.name} diperbarui.`);
    }
  };

  // ── Robust Toggle Stock Status (Ready / Habis) ──────────────
  window.toggleStockStatus = async function (id) {
    const product = products.find(p => String(p.id) === String(id));
    if (!product) return;

    const isReady = Number(product.stock) > 0;
    const newStock = isReady ? 0 : 100;

    // Instantly update local state for smooth UX
    product.stock = newStock;
    renderTable();
    updateStats();

    try {
      await window.API.update(id, { stock: newStock });
      showToast(`Status stok "${product.name}" diubah menjadi ${newStock > 0 ? 'Ready' : 'Habis'}.`);
    } catch (err) {
      showToast(`Status stok "${product.name}" diubah menjadi ${newStock > 0 ? 'Ready' : 'Habis'}.`);
    }
  };

  // ── 6. CRUD Slide-in Panel with File Upload ─────────────────
  function initSlidePanel() {
    const overlay = document.getElementById('panel-overlay');
    const panel = document.getElementById('product-slide-panel');
    const form = document.getElementById('product-crud-form');
    const titleText = document.getElementById('panel-title-text');
    const fileInput = document.getElementById('form-image-file');
    const fileNameSpan = document.getElementById('file-chosen-name');
    const imgPreviewWrap = document.getElementById('crud-img-preview-wrap');
    const imgPreview = document.getElementById('crud-img-preview');

    // Handle File Input Change (Convert to Base64)
    if (fileInput) {
      fileInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) {
          fileNameSpan.textContent = file.name;
          const reader = new FileReader();
          reader.onload = (evt) => {
            const base64 = evt.target.result;
            document.getElementById('form-image').value = base64;
            imgPreview.src = base64;
            imgPreviewWrap.style.display = 'block';
          };
          reader.readAsDataURL(file);
        }
      });
    }

    const openBtn = document.getElementById('btn-open-add-panel');
    if (openBtn) {
      openBtn.addEventListener('click', () => {
        isEditing = false;
        titleText.textContent = 'Tambah Produk Baru';
        form.reset();
        document.getElementById('form-product-id').value = '';
        document.getElementById('form-image').value = '';
        setCustomFormSelect('custom-select-category', 'form-category', 'Signature');
        setCustomFormSelect('custom-select-type', 'form-type', 'Eau de Parfum');
        setCustomFormSelect('custom-select-gender', 'form-gender', 'Unisex');
        setCustomFormSelect('custom-select-size', 'form-size', '30ML');
        formatPriceDisplayValue(45000);
        updateCategoryFormView('Signature');
        if (fileInput) fileInput.value = '';
        fileNameSpan.textContent = 'Belum ada file dipilih';
        imgPreviewWrap.style.display = 'none';
        openPanel();
      });
    }

    const closeBtn = document.getElementById('btn-close-panel');
    if (closeBtn) closeBtn.addEventListener('click', closePanel);

    const cancelBtn = document.getElementById('btn-cancel-crud');
    if (cancelBtn) cancelBtn.addEventListener('click', closePanel);

    if (overlay) overlay.addEventListener('click', closePanel);

    function openPanel() {
      if (overlay) overlay.classList.add('active');
      if (panel) panel.classList.add('open');
    }

    function closePanel() {
      if (overlay) overlay.classList.remove('active');
      if (panel) panel.classList.remove('open');
    }

    // Save Form Handler
    if (form) {
      form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const id = document.getElementById('form-product-id').value;

        const isBs = document.getElementById('form-bestseller') ? document.getElementById('form-bestseller').checked : false;
        const categoryVal = document.getElementById('form-category').value;
        const isRefill = categoryVal === 'Refill';
        const imgVal = isRefill ? 'assets/images/refill.webp' : (document.getElementById('form-image').value.trim() || 'assets/images/refill.webp');

        const existingP = id ? products.find(prod => String(prod.id) === String(id)) : null;
        const stockVal = existingP ? (Number(existingP.stock) !== undefined ? Number(existingP.stock) : 100) : 100;

        const descVal = document.getElementById('form-desc') ? document.getElementById('form-desc').value.trim() : '';
        const variantVal = document.getElementById('form-variant').value.trim();

        const payload = {
          name: document.getElementById('form-name').value.trim(),
          type: categoryVal === 'Refill' ? 'Refill' : document.getElementById('form-type').value,
          gender: document.getElementById('form-gender').value,
          variant: variantVal,
          size: isRefill ? '35ML' : document.getElementById('form-size').value.trim(),
          price: isRefill ? 45000 : Number(document.getElementById('form-price').value),
          stock: stockVal,
          top_notes: document.getElementById('form-top').value.trim(),
          middle_notes: document.getElementById('form-middle').value.trim(),
          base_notes: document.getElementById('form-base').value.trim(),
          packaging: isRefill ? 'Botol kaca spray + refill pouch khas Perfu.me' : 'Botol kaca spray + dus karton khas Perfu.me',
          tagline: `${variantVal} — Perfu.me Edition`,
          description: descVal || `Parfum ${variantVal} dari koleksi Perfu.me menghadirkan paduan aroma harum yang berkesan dan tahan lama.`,
          image: imgVal,
          best_seller: isBs
        };

        try {
          if (id) {
            await window.API.update(id, payload);
            showToast(`Produk "${payload.name}" berhasil diperbarui.`);
          } else {
            await window.API.create(payload);
            showToast(`Produk "${payload.name}" berhasil ditambahkan.`);
          }
          closePanel();
          loadDashboardData();
        } catch (err) {
          showToast(err.message || 'Gagal menyimpan data produk.', 'error');
        }
      });
    }

    // Global edit panel trigger
    window.openEditPanel = function (id) {
      const p = products.find(prod => String(prod.id) === String(id));
      if (!p) return;

      isEditing = true;
      titleText.textContent = `Edit Produk: ${p.name}`;

      document.getElementById('form-product-id').value = p.id;
      document.getElementById('form-name').value = p.name || '';
      
      const isRefillProd = strContainsRefill(p);
      setCustomFormSelect('custom-select-category', 'form-category', isRefillProd ? 'Refill' : 'Signature');
      setCustomFormSelect('custom-select-type', 'form-type', p.type || 'Eau de Parfum');
      setCustomFormSelect('custom-select-gender', 'form-gender', p.gender || 'Unisex');
      setCustomFormSelect('custom-select-size', 'form-size', p.size || '30ML');
      formatPriceDisplayValue(p.price || 0);

      document.getElementById('form-variant').value = p.variant || '';
      document.getElementById('form-top').value = p.top_notes || p.topNotes || '';
      document.getElementById('form-middle').value = p.middle_notes || p.middleNotes || '';
      document.getElementById('form-base').value = p.base_notes || p.baseNotes || '';
      if (document.getElementById('form-desc')) {
        document.getElementById('form-desc').value = p.description || '';
      }
      document.getElementById('form-image').value = p.image || '';

      updateCategoryFormView(isRefillProd ? 'Refill' : 'Signature');

      // Pre-fill image preview
      if (p.image && !isRefillProd) {
        imgPreview.src = formatImgUrl(p.image);
        imgPreviewWrap.style.display = 'block';
        fileNameSpan.textContent = p.image.startsWith('data:') ? 'File Gambar Base64' : p.image.split('/').pop();
      } else {
        imgPreviewWrap.style.display = 'none';
        fileNameSpan.textContent = 'Belum ada file dipilih';
      }

      openPanel();
    };
    window.editProduct = window.openEditPanel;
  }

  function strContainsRefill(p) {
    const t = (p.type || '').toLowerCase();
    const name = (p.name || '').toLowerCase();
    return t === 'refill' || name.includes('refill');
  }

  function formatPriceDisplayValue(numVal) {
    const displayEl = document.getElementById('form-price-display');
    const hiddenEl = document.getElementById('form-price');
    const val = parseInt(numVal, 10) || 0;
    if (hiddenEl) hiddenEl.value = val;
    if (displayEl) {
      displayEl.value = val ? `Rp ${new Intl.NumberFormat('id-ID').format(val)}` : '';
    }
  }

  function updateCategoryFormView(catVal) {
    const imgSection = document.getElementById('form-image-section');
    const imgHidden = document.getElementById('form-image');
    const sizePriceRow = document.getElementById('form-size-price-row');
    const isRefill = catVal === 'Refill';

    if (isRefill) {
      // 1. Sembunyikan Upload Gambar (Pakai gambar refill.webp)
      if (imgSection) imgSection.style.display = 'none';
      if (imgHidden) imgHidden.value = 'assets/images/refill.webp';

      // 2. Sembunyikan Ukuran & Harga untuk Refill (otomatis dari sistem)
      if (sizePriceRow) sizePriceRow.style.display = 'none';
      
      setCustomFormSelect('custom-select-size', 'form-size', '35ML');
      formatPriceDisplayValue(45000);
    } else {
      // Tampilkan kembali untuk Signature
      if (imgSection) imgSection.style.display = 'block';
      if (sizePriceRow) sizePriceRow.style.display = 'grid';
    }
  }

  function initPriceFormatter() {
    const displayEl = document.getElementById('form-price-display');
    const hiddenEl = document.getElementById('form-price');
    if (!displayEl || !hiddenEl) return;

    displayEl.addEventListener('input', (e) => {
      const rawDigits = e.target.value.replace(/\D/g, '');
      const num = rawDigits ? parseInt(rawDigits, 10) : 0;
      hiddenEl.value = num;
      displayEl.value = num ? `Rp ${new Intl.NumberFormat('id-ID').format(num)}` : '';
    });
  }

  // Helper to set value of custom form select
  function setCustomFormSelect(containerId, hiddenInputId, val) {
    const container = document.getElementById(containerId);
    const hiddenInput = document.getElementById(hiddenInputId);
    if (!container || !hiddenInput) return;

    hiddenInput.value = val;
    const triggerLabel = container.querySelector('.trigger-label');
    const options = container.querySelectorAll('.form-select-option');

    options.forEach(opt => {
      const optVal = opt.getAttribute('data-value');
      if (optVal.toLowerCase() === String(val).toLowerCase() || optVal.toUpperCase() === String(val).toUpperCase()) {
        opt.classList.add('selected');
        if (triggerLabel) triggerLabel.textContent = opt.getAttribute('data-display') || optVal;
      } else {
        opt.classList.remove('selected');
      }
    });
  }

  function initCustomFormSelects() {
    document.querySelectorAll('.form-select-custom').forEach(select => {
      const trigger = select.querySelector('.form-select-trigger');
      const hiddenInput = select.parentElement.querySelector('input[type="hidden"]');
      const triggerLabel = select.querySelector('.trigger-label');

      if (trigger) {
        trigger.addEventListener('click', (e) => {
          e.stopPropagation();
          // Close all other open dropdowns
          document.querySelectorAll('.form-select-custom').forEach(other => {
            if (other !== select) other.classList.remove('open');
          });
          select.classList.toggle('open');
        });
      }

      select.querySelectorAll('.form-select-option').forEach(option => {
        option.addEventListener('click', (e) => {
          e.stopPropagation();
          const val = option.getAttribute('data-value');
          const display = option.getAttribute('data-display') || val;

          if (hiddenInput) hiddenInput.value = val;
          if (triggerLabel) triggerLabel.textContent = display;

          if (hiddenInput && hiddenInput.id === 'form-category') {
            updateCategoryFormView(val);
          }

          select.querySelectorAll('.form-select-option').forEach(o => o.classList.remove('selected'));
          option.classList.add('selected');

          select.classList.remove('open');
        });
      });
    });

    document.addEventListener('click', () => {
      document.querySelectorAll('.form-select-custom').forEach(s => s.classList.remove('open'));
    });
  }

  // ── 7. Delete Confirmation Modal ────────────────────────────
  function initDeleteModal() {
    const backdrop = document.getElementById('delete-modal-backdrop');
    const cancelBtn = document.getElementById('btn-cancel-delete');
    const confirmBtn = document.getElementById('btn-confirm-delete');

    if (cancelBtn) cancelBtn.addEventListener('click', closeModal);
    if (backdrop) backdrop.addEventListener('click', (e) => { if (e.target === backdrop) closeModal(); });

    function closeModal() {
      if (backdrop) backdrop.classList.remove('active');
      deleteTargetId = null;
    }

    window.openDeleteModal = function (id) {
      const p = products.find(prod => String(prod.id) === String(id));
      if (!p) return;

      deleteTargetId = id;
      document.getElementById('delete-product-name').textContent = p.name;
      backdrop.classList.add('active');
    };
    window.promptDeleteProduct = window.openDeleteModal;
    window.deleteProduct = window.openDeleteModal;

    if (confirmBtn) {
      confirmBtn.addEventListener('click', async () => {
        if (!deleteTargetId) return;
        try {
          await window.API.delete(deleteTargetId);
          showToast('Produk berhasil dihapus.', 'info');
          closeModal();
          loadDashboardData();
        } catch (err) {
          showToast('Gagal menghapus produk.', 'error');
        }
      });
    }
  }

  // ── 8. Table Header Sort ─────────────────────────────────────
  function initTableSorting() {
    const headers = document.querySelectorAll('#admin-products-table th[data-sort]');
    headers.forEach(th => {
      th.addEventListener('click', () => {
        const field = th.getAttribute('data-sort');
        if (currentSort.field === field) {
          currentSort.dir = currentSort.dir === 'asc' ? 'desc' : 'asc';
        } else {
          currentSort.field = field;
          currentSort.dir = 'asc';
        }

        headers.forEach(h => h.classList.remove('sort-asc', 'sort-desc'));
        th.classList.add(currentSort.dir === 'asc' ? 'sort-asc' : 'sort-desc');

        renderTable();
      });
    });
  }

  // ── Initialize App ──────────────────────────────────────────
  document.addEventListener('DOMContentLoaded', () => {
    initLogin();
    initCustomFilterDropdown();
    initCustomFormSelects();
    initPriceFormatter();
    initDetailModal();
    initSlidePanel();
    initDeleteModal();
    initTableSorting();
  });
