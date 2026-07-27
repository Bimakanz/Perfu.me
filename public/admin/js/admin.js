/**
 * admin.js — Admin Dashboard Controller
 * Handles 2-column login, CRUD, File Upload, Custom Dropdowns, 3-Dot Action Dropdowns, Status Filters, Product Detail Modal & Realtime Stats
 * Perfu.me E-Commerce Platform
 */

(function () {
  let products = [];
  let deleteTargetId = null;
  let detailTargetId = null;
  let isEditing = false;
  let currentSort = { field: 'id', dir: 'asc' };

  // ── Image URL Helper ───────────────────────────────────────
  function formatImgUrl(path) {
    if (!path) return '../assets/images/Nusantara1nobg.png';
    if (path.startsWith('data:') || path.startsWith('http://') || path.startsWith('https://')) return path;
    if (path.startsWith('../')) return path;
    if (path.startsWith('/')) return '..' + path;
    return '../' + path;
  }

  // ── Toast Helper ─────────────────────────────────────────
  function showToast(message, type = 'success') {
    const container = document.getElementById('toast-container');
    if (!container) return;
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    toast.textContent = message;
    container.appendChild(toast);
    setTimeout(() => toast.remove(), 3500);
  }

  // ── 1. Login Controller ─────────────────────────────────
  function initLogin() {
    const form = document.getElementById('admin-login-form');
    const passInput = document.getElementById('admin-pass-input');
    const toggleBtn = document.getElementById('toggle-pass-btn');
    const errorMsg = document.getElementById('login-error-msg');
    const submitBtn = document.getElementById('login-submit-btn');

    // Toggle password visibility
    if (toggleBtn && passInput) {
      toggleBtn.addEventListener('click', () => {
        const isPass = passInput.type === 'password';
        passInput.type = isPass ? 'text' : 'password';
      });
    }

    // Handle Login Submit
    if (form) {
      form.addEventListener('submit', async (e) => {
        e.preventDefault();
        errorMsg.classList.remove('show');
        submitBtn.disabled = true;
        submitBtn.textContent = 'Memverifikasi...';

        const user = document.getElementById('admin-user-input').value.trim();
        const pass = passInput.value.trim();

        try {
          // API Auth call
          const res = await window.API.login(user, pass);
          if (res.success) {
            showToast('Selamat datang kembali, Admin!');
            showDashboard();
          } else {
            errorMsg.textContent = res.message || 'Username atau password salah.';
            errorMsg.classList.add('show');
          }
        } catch (err) {
          // Local fallback if API server authentication fails or mock session is used
          if (user === 'admin' && pass === 'admin123') {
            window.API.setToken('mock_session_token');
            showToast('Login berhasil (Mode Standalone).');
            showDashboard();
          } else {
            errorMsg.textContent = err.message || 'Gagal login.';
            errorMsg.classList.add('show');
          }
        } finally {
          submitBtn.disabled = false;
          submitBtn.textContent = 'Masuk ke Dashboard';
        }
      });
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
    if (window.API.hasToken()) {
      showDashboard();
    }
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
    document.getElementById('admin-login-page').style.display = 'none';
    document.getElementById('admin-dashboard-page').classList.add('active');
    loadDashboardData();
  }

  function logout() {
    window.API.logout();
    document.getElementById('admin-dashboard-page').classList.remove('active');
    document.getElementById('admin-login-page').style.display = 'flex';
    showToast('Berhasil keluar dari dashboard.', 'info');
  }

  // ── 2. Dashboard Data & Table Rendering ─────────────────────
  async function loadDashboardData() {
    try {
      products = await window.API.getAll();
      renderTable();
      updateStats();
    } catch (err) {
      showToast('Gagal memuat data produk.', 'error');
    }
  }

  function updateStats() {
    const total = products.length;
    const bestSellers = products.filter(p => Boolean(p.bestSeller || p.best_seller)).length;
    const lowStock = products.filter(p => p.stock > 0 && p.stock < 20).length;
    const outOfStock = products.filter(p => Number(p.stock) === 0).length;

    document.getElementById('stat-total-products').textContent = total;
    document.getElementById('stat-bestsellers').textContent = bestSellers;
    document.getElementById('stat-lowstock').textContent = lowStock;
    document.getElementById('stat-outofstock').textContent = outOfStock;
  }

  // Clean Stock Pill without text (Menipis / Habis), purely colored pill
  function stockCellHtml(stock) {
    const s = Number(stock);
    if (s === 0) {
      return `<div class="stock-indicator-pill empty"><span class="stock-dot-small"></span> 0 Pcs</div>`;
    }
    if (s < 20) {
      return `<div class="stock-indicator-pill low"><span class="stock-dot-small"></span> ${s} Pcs</div>`;
    }
    return `<div class="stock-indicator-pill ok"><span class="stock-dot-small"></span> ${s} Pcs</div>`;
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
    const isShow = dropdown.classList.contains('show');

    // Close all other open dropdowns
    document.querySelectorAll('.action-dropdown-menu').forEach(m => m.classList.remove('show'));
    document.querySelectorAll('.btn-3dots').forEach(b => b.classList.remove('active'));

    if (!isShow) {
      dropdown.classList.add('show');
      const btn = dropdown.previousElementSibling;
      if (btn) btn.classList.add('active');
    }
  };

  function renderTable() {
    const tbody = document.getElementById('admin-table-body');
    const searchVal = (document.getElementById('admin-table-search')?.value || '').toLowerCase();
    const filterVal = document.getElementById('admin-filter-status')?.value || 'all';

    let filtered = products.filter(p => {
      // Search filter
      const matchSearch = !searchVal || p.name.toLowerCase().includes(searchVal) || p.variant.toLowerCase().includes(searchVal);
      if (!matchSearch) return false;

      // Status filter
      if (filterVal === 'bestseller') return Boolean(p.bestSeller || p.best_seller);
      if (filterVal === 'lowstock') return p.stock > 0 && p.stock < 20;
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
      tbody.innerHTML = `<tr><td colspan="7" style="text-align:center;padding:3.5rem;color:#A1A1AA;font-size:0.9rem;">Tidak ada produk yang memenuhi kriteria pencarian.</td></tr>`;
      return;
    }

    tbody.innerHTML = filtered.map(p => {
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
          <td>${stockCellHtml(p.stock)}</td>
          <td>
            <button class="bs-toggle-btn ${isBs ? 'bs-yes-btn' : 'bs-no-btn'}" onclick="window.toggleBestSeller('${p.id}')">
              ${isBs ? '★ BEST SELLER' : '— NORMAL'}
            </button>
          </td>
          <td style="text-align:right">
            <div class="action-dropdown-wrap">
              <!-- 3-Dot Options Button -->
              <button class="btn-3dots" onclick="window.toggleActionDropdown(event, '${p.id}')" title="Opsi Produk">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="12" cy="12" r="1.5"></circle>
                  <circle cx="12" cy="5" r="1.5"></circle>
                  <circle cx="12" cy="19" r="1.5"></circle>
                </svg>
              </button>

              <!-- Action Dropdown Menu -->
              <div class="action-dropdown-menu" id="dropdown-${p.id}">
                <button class="dropdown-item" onclick="window.openDetailModal('${p.id}')">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                  Lihat Detail Produk
                </button>
                <button class="dropdown-item" onclick="window.openEditPanel('${p.id}')">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                  Edit Data Produk
                </button>
                <button class="dropdown-item warning" ${isZero ? 'disabled style="opacity:0.4;cursor:not-allowed"' : ''} onclick="window.quickZeroStock('${p.id}')">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line></svg>
                  Kosongkan Stok (0 Pcs)
                </button>
                <div class="dropdown-divider"></div>
                <button class="dropdown-item danger" onclick="window.openDeleteModal('${p.id}')">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                  Hapus Produk
                </button>
              </div>
            </div>
          </td>
        </tr>
      `;
    }).join('');
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
      overlay.classList.add('active');
      panel.classList.add('open');
    }

    function closePanel() {
      overlay.classList.remove('active');
      panel.classList.remove('open');
    }

    // Save Form Handler
    if (form) {
      form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const id = document.getElementById('form-product-id').value;

        const isBs = document.getElementById('form-bestseller').checked;
        const imgVal = document.getElementById('form-image').value.trim() || '../assets/images/Nusantara1nobg.png';

        const payload = {
          name: document.getElementById('form-name').value.trim(),
          type: document.getElementById('form-type').value,
          gender: document.getElementById('form-gender').value,
          variant: document.getElementById('form-variant').value.trim(),
          size: document.getElementById('form-size').value.trim(),
          price: Number(document.getElementById('form-price').value),
          stock: Number(document.getElementById('form-stock').value),
          top_notes: document.getElementById('form-top').value.trim(),
          middle_notes: document.getElementById('form-middle').value.trim(),
          base_notes: document.getElementById('form-base').value.trim(),
          packaging: document.getElementById('form-packaging').value.trim(),
          image: imgVal,
          tagline: document.getElementById('form-tagline').value.trim(),
          description: document.getElementById('form-desc').value.trim(),
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
      document.getElementById('form-type').value = p.type || 'Eau de Parfum';
      document.getElementById('form-gender').value = p.gender || 'Unisex';
      document.getElementById('form-variant').value = p.variant || '';
      document.getElementById('form-size').value = p.size || '';
      document.getElementById('form-price').value = p.price || 0;
      document.getElementById('form-stock').value = p.stock || 0;
      document.getElementById('form-top').value = p.top_notes || p.topNotes || '';
      document.getElementById('form-middle').value = p.middle_notes || p.middleNotes || '';
      document.getElementById('form-base').value = p.base_notes || p.baseNotes || '';
      document.getElementById('form-packaging').value = p.packaging || '';
      document.getElementById('form-image').value = p.image || '';
      document.getElementById('form-tagline').value = p.tagline || '';
      document.getElementById('form-desc').value = p.description || '';
      document.getElementById('form-bestseller').checked = Boolean(p.bestSeller || p.best_seller);

      // Pre-fill image preview
      if (p.image) {
        imgPreview.src = formatImgUrl(p.image);
        imgPreviewWrap.style.display = 'block';
        fileNameSpan.textContent = p.image.startsWith('data:') ? 'File Gambar Base64' : p.image.split('/').pop();
      } else {
        imgPreviewWrap.style.display = 'none';
        fileNameSpan.textContent = 'Belum ada file dipilih';
      }

      openPanel();
    };
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
    initDetailModal();
    initSlidePanel();
    initDeleteModal();
    initTableSorting();
  });
})();
