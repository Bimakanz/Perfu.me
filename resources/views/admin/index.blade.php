<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Portal â€” Perfu.me Dashboard</title>
  <link rel="icon"
    href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>ðŸ”’</text></svg>">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('css/main.css') }}">
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body>

  <!-- ============================================================
       1. TWO-COLUMN ADMIN LOGIN PAGE
       ============================================================ -->
  <div id="admin-login-page" class="admin-page">
    <!-- Left Section: Perfume Image Showcase + Welcome Greeting -->
    <div class="admin-login-left">
      <img src="{{ asset('assets/images/adminhero.webp') }}" alt="Perfume Showcase" class="admin-login-left-img"
        id="login-left-img" onerror="this.src='{{ asset('assets/images/penisence.webp') }}'">
      <div class="admin-login-left-overlay">
        <div class="admin-brand-mark">Perfu.me</div>
        <div class="admin-brand-tagline">Nusantara &amp; Luxury Fragrance Series</div>
        <h2 class="admin-welcome-text">Selamat Datang di Portal Pengelolaan Inventaris</h2>
        <p class="admin-welcome-sub">Kelola katalog parfum, penyesuaian stok real-time, status best seller, dan
          penambahan produk baru secara praktis.</p>
      </div>
    </div>

    <!-- Right Section: Clean Login Form -->
    <div class="admin-login-right">
      <div class="admin-login-logo">Perfu.me</div>
      <div class="admin-login-logo-sub">Internal Management Portal</div>

      <h1 class="admin-login-title">Masuk ke System</h1>
      <p class="admin-login-subtitle">Masukkan kredensial admin Anda untuk melanjutkan.</p>

      <form id="admin-login-form" autocomplete="off">
        <div class="admin-form-group">
          <label for="admin-user-input" class="admin-form-label">USERNAME</label>
          <input type="text" id="admin-user-input" class="admin-form-input" placeholder="Masukkan username" required
            autofocus value="admin">
        </div>

        <div class="admin-form-group">
          <label for="admin-pass-input" class="admin-form-label">PASSWORD</label>
          <div class="admin-input-wrap">
            <input type="password" id="admin-pass-input" class="admin-form-input" placeholder="Masukkan password"
              required value="admin123">
            <button type="button" class="admin-toggle-pass" id="toggle-pass-btn" aria-label="Lihat Password">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                <circle cx="12" cy="12" r="3"></circle>
              </svg>
            </button>
          </div>
          <div class="admin-form-error" id="login-error-msg">Username atau password salah.</div>
        </div>

        <button type="submit" class="admin-login-btn" id="login-submit-btn">
          Masuk ke Dashboard
        </button>
      </form>
    </div>
  </div>

  <!-- ============================================================
       2. ADMIN DASHBOARD (LUXURY CONTROLLER)
       ============================================================ -->
  <div id="admin-dashboard-page" class="admin-dashboard">
    <!-- Topbar Header -->
    <header class="admin-topbar">
      <div class="admin-topbar-brand">
        <div>
          <div class="admin-brand-title">Parfu.me Admin</div>
          <div class="admin-brand-sub">Inventory &amp; CRUD Management</div>
        </div>
      </div>

      <div class="admin-topbar-right">
        <a href="/" class="btn-view-site">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="2" y1="12" x2="22" y2="12"></line>
            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
          </svg>
          Lihat Frontend Website
        </a>
        <div class="admin-user-badge">
          <div class="admin-user-avatar">A</div>
          <span>Administrator</span>
        </div>
        <button id="admin-logout-btn" class="admin-logout-btn">Keluar</button>
      </div>
    </header>

    <!-- Main Content Container -->
    <main class="admin-body">
      <!-- Real-time Stats Cards Bar -->
      <div class="admin-stats-grid">
        <div class="admin-stat-card">
          <div class="admin-stat-top">
            <div class="admin-stat-icon-bg">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <path
                  d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
                </path>
                <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                <line x1="12" y1="22.08" x2="12" y2="12"></line>
              </svg>
            </div>
            <span class="admin-stat-tag">Katalog</span>
          </div>
          <div class="admin-stat-value" id="stat-total-products">0</div>
          <div class="admin-stat-label">Total Varian Produk</div>
        </div>

        <div class="admin-stat-card success">
          <div class="admin-stat-top">
            <div class="admin-stat-icon-bg">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <polygon
                  points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                </polygon>
              </svg>
            </div>
            <span class="admin-stat-tag">High Demand</span>
          </div>
          <div class="admin-stat-value" id="stat-bestsellers">0</div>
          <div class="admin-stat-label">Produk Best Seller</div>
        </div>

        <div class="admin-stat-card warning">
          <div class="admin-stat-top">
            <div class="admin-stat-icon-bg">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z">
                </path>
                <line x1="12" y1="9" x2="12" y2="13"></line>
                <line x1="12" y1="17" x2="12.01" y2="17"></line>
              </svg>
            </div>
            <span class="admin-stat-tag">Perlu Restok</span>
          </div>
          <div class="admin-stat-value" id="stat-lowstock">0</div>
          <div class="admin-stat-label">Stok Menipis (&lt; 20 Pcs)</div>
        </div>

        <div class="admin-stat-card danger">
          <div class="admin-stat-top">
            <div class="admin-stat-icon-bg">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line>
              </svg>
            </div>
            <span class="admin-stat-tag">Kritis</span>
          </div>
          <div class="admin-stat-value" id="stat-outofstock">0</div>
          <div class="admin-stat-label">Stok Habis (0 Pcs)</div>
        </div>
      </div>

      <!-- Products Inventory Table Container -->
      <section class="admin-table-section">
        <div class="admin-table-header">
          <div class="table-title-group">
            <h2 class="admin-table-title">Daftar Inventaris Produk</h2>
            <span class="table-count-badge" id="table-total-count">0 Produk</span>
          </div>

          <div class="admin-table-actions">
            <!-- Search Input -->
            <div class="search-wrap">
              <svg class="search-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
              </svg>
              <input type="text" id="admin-table-search" class="admin-search-input"
                placeholder="Cari nama atau varian...">
            </div>

            <!-- Custom Filter Select Dropdown Component -->
            <div class="custom-select-wrap" id="custom-filter-wrap">
              <button type="button" class="custom-select-trigger" id="custom-filter-trigger">
                <span class="custom-select-label" id="custom-filter-label">Semua Status Stok</span>
                <svg class="custom-select-arrow" width="14" height="14" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2">
                  <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
              </button>

              <div class="custom-select-dropdown" id="custom-filter-dropdown">
                <div class="custom-select-option active" data-value="all">
                  <span class="opt-dot"></span> Semua Status Stok
                </div>
                <div class="custom-select-option" data-value="bestseller">
                  <span class="opt-dot bestseller"></span> Best Seller Only
                </div>
                <div class="custom-select-option" data-value="lowstock">
                  <span class="opt-dot lowstock"></span> Stok Menipis (&lt; 20 Pcs)
                </div>
                <div class="custom-select-option" data-value="outofstock">
                  <span class="opt-dot outofstock"></span> Stok Habis (0 Pcs)
                </div>
              </div>
              <input type="hidden" id="admin-filter-status" value="all">
            </div>

            <!-- Add Product Button (Single SVG Plus Icon) -->
            <button id="btn-open-add-panel" class="admin-add-btn">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
              </svg>
              Tambah Produk Baru
            </button>
          </div>
        </div>

        <div class="admin-table-wrap">
          <table class="admin-table" id="admin-products-table">
            <thead>
              <tr>
                <th data-sort="name">PRODUK &amp; UKURAN</th>
                <th data-sort="gender">GENDER</th>
                <th data-sort="variant">VARIAN AROMA</th>
                <th data-sort="price">HARGA (RP)</th>
                <th data-sort="stock">STATUS STOK</th>
                <th data-sort="bestSeller">BEST SELLER</th>
                <th style="text-align:right">AKSI</th>
              </tr>
            </thead>
            <tbody id="admin-table-body">
              <!-- Rendered dynamically via JS -->
            </tbody>
          </table>
        </div>
      </section>

      <!-- Admin Table Pagination Container -->
      <div class="admin-pagination-wrapper">
        <div class="katalog-pagination" id="admin-pagination"></div>
      </div>
    </main>
  </div>

  <!-- ============================================================
       3. PRODUCT DETAIL PREVIEW MODAL
       ============================================================ -->
  <div id="detail-modal-backdrop" class="admin-modal-backdrop">
    <div class="admin-detail-modal">
      <div class="admin-detail-head">
        <div>
          <span class="badge-gender" id="detail-gender">UNISEX</span>
          <h3 class="admin-detail-name" id="detail-name">Product Name</h3>
        </div>
        <button class="admin-panel-close" id="btn-close-detail" aria-label="Tutup Detail">&times;</button>
      </div>

      <div class="admin-detail-body">
        <!-- Left: Image & Stock Status -->
        <div class="admin-detail-img-col">
          <div class="admin-detail-img-box">
            <img id="detail-img" src="" alt="Product Image"
              onerror="this.src='{{ asset('assets/images/Nusantara1nobg.png') }}'">
          </div>
          <div id="detail-stock-status-pill" style="margin-top:1rem; text-align:center;"></div>
        </div>

        <!-- Right: Specs, Scent Notes & Description -->
        <div class="admin-detail-info-col">
          <div
            style="font-size:0.75rem; font-weight:700; letter-spacing:0.12em; text-transform:uppercase; color:#8A8A8A;"
            id="detail-meta">
            EAU DE PARFUM Â· 30ML
          </div>
          <div class="admin-detail-price" id="detail-price">Rp 150.000</div>
          <div class="admin-detail-tagline" id="detail-tagline">"Elegan, segar, dan abadi"</div>
          <p class="admin-detail-desc" id="detail-desc">Deskripsi produk...</p>

          <div class="form-section-title">SCENT PYRAMID NOTES</div>
          <div class="detail-notes-grid">
            <div class="detail-note-box">
              <span class="detail-note-lbl">TOP NOTES</span>
              <span class="detail-note-val" id="detail-top">Bergamot, Lemon</span>
            </div>
            <div class="detail-note-box">
              <span class="detail-note-lbl">HEART NOTES</span>
              <span class="detail-note-val" id="detail-middle">Melati, Mawar</span>
            </div>
            <div class="detail-note-box">
              <span class="detail-note-lbl">BASE NOTES</span>
              <span class="detail-note-val" id="detail-base">Sandalwood, Musk</span>
            </div>
          </div>

          <div class="detail-specs-list">
            <div><strong>Detail Kemasan:</strong> <span id="detail-packaging">Botol kaca spray 30ml</span></div>
            <div><strong>Status Best Seller:</strong> <span id="detail-bestseller">Ya (Best Seller)</span></div>
          </div>
        </div>
      </div>

      <div class="admin-detail-footer">
        <button class="btn-action-zero" id="detail-btn-zero">ðŸš« Set 0 Stok</button>
        <button class="btn-action-edit" id="detail-btn-edit">âœï¸ Edit Produk Ini</button>
        <button class="admin-btn-secondary" id="detail-btn-close">Tutup</button>
      </div>
    </div>
  </div>

  <!-- ============================================================
       4. CREATE / EDIT SLIDE-IN PANEL FORM (WITH FILE UPLOADER)
       ============================================================ -->
  <div id="panel-overlay" class="admin-panel-overlay"></div>

  <aside id="product-slide-panel" class="admin-slide-panel">
    <div class="admin-panel-head">
      <h3 class="admin-panel-title" id="panel-title-text">Tambah Produk Baru</h3>
      <button class="admin-panel-close" id="btn-close-panel" aria-label="Tutup Panel">&times;</button>
    </div>

    <form id="product-crud-form" class="admin-panel-body">
      <input type="hidden" id="form-product-id">

      <div class="form-section-title" style="margin-top:0;">1. INFORMASI DASAR PRODUK</div>

      <div class="form-group">
        <label for="form-name" class="form-label">Nama Produk <span>*</span></label>
        <input type="text" id="form-name" class="form-control" placeholder="Contoh: Nusantara No.3" required>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Tipe Produk / Kategori <span>*</span></label>
          <input type="hidden" id="form-type" value="Signature">
          <div class="form-select-custom" id="custom-select-type">
            <div class="form-select-trigger">
              <span class="trigger-label">Signature</span>
              <svg class="form-select-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2">
                <polyline points="6 9 12 15 18 9"></polyline>
              </svg>
            </div>
            <div class="form-select-options">
              <div class="form-select-option selected" data-value="Signature"><span>Signature</span><span
                  class="opt-check">âœ“</span></div>
              <div class="form-select-option" data-value="Refill"><span>Refill</span><span
                  class="opt-check">âœ“</span></div>
              <div class="form-select-option" data-value="Eau de Parfum"><span>Eau de Parfum</span><span
                  class="opt-check">âœ“</span></div>
              <div class="form-select-option" data-value="Roll-on"><span>Roll-on</span><span class="opt-check">âœ“</span>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label class="form-label">Target Gender <span>*</span></label>
          <input type="hidden" id="form-gender" value="Unisex">
          <div class="form-select-custom" id="custom-select-gender">
            <div class="form-select-trigger">
              <span class="trigger-label">Unisex</span>
              <svg class="form-select-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2">
                <polyline points="6 9 12 15 18 9"></polyline>
              </svg>
            </div>
            <div class="form-select-options">
              <div class="form-select-option selected" data-value="Unisex"><span>Unisex</span><span
                  class="opt-check">âœ“</span></div>
              <div class="form-select-option" data-value="Pria"><span>Pria</span><span class="opt-check">âœ“</span></div>
              <div class="form-select-option" data-value="Wanita"><span>Wanita</span><span class="opt-check">âœ“</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="form-variant" class="form-label">Varian Aroma <span>*</span></label>
          <input type="text" id="form-variant" class="form-control" placeholder="Woody Floral, Gourmand..." required>
        </div>
        <div class="form-group">
          <label class="form-label">Ukuran Botol <span>*</span></label>
          <input type="hidden" id="form-size" value="30ML">
          <div class="form-select-custom" id="custom-select-size">
            <div class="form-select-trigger">
              <span class="trigger-label">30ML (Standard Size)</span>
              <svg class="form-select-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2">
                <polyline points="6 9 12 15 18 9"></polyline>
              </svg>
            </div>
            <div class="form-select-options">
              <div class="form-select-option selected" data-value="30ML" data-display="30ML (Standard Size)"><span>30ML
                  (Standard Size)</span><span class="opt-check">âœ“</span></div>
              <div class="form-select-option" data-value="50ML" data-display="50ML (Medium Size)"><span>50ML (Medium
                  Size)</span><span class="opt-check">âœ“</span></div>
              <div class="form-select-option" data-value="100ML" data-display="100ML (Full Size)"><span>100ML (Full
                  Size)</span><span class="opt-check">âœ“</span></div>
              <div class="form-select-option" data-value="10ML" data-display="10ML (Roll-On / Mini)"><span>10ML (Roll-On
                  / Mini)</span><span class="opt-check">âœ“</span></div>
            </div>
          </div>
        </div>
      </div>

      <div class="form-section-title">2. HARGA &amp; MANAJEMEN STOK</div>

      <div class="form-row">
        <div class="form-group">
          <label for="form-price" class="form-label">Harga Jual (Rp) <span>*</span></label>
          <input type="number" id="form-price" class="form-control" placeholder="150000" min="0" required>
        </div>
        <div class="form-group">
          <label for="form-stock" class="form-label">Jumlah Stok Ready <span>*</span></label>
          <input type="number" id="form-stock" class="form-control" placeholder="42" min="0" required>
        </div>
      </div>

      <div class="form-section-title">3. SCENT PYRAMID NOTES</div>

      <div class="form-group">
        <label for="form-top" class="form-label">Top Notes <span>*</span></label>
        <input type="text" id="form-top" class="form-control" placeholder="Bergamot, Lemon, Black Pepper" required>
      </div>
      <div class="form-group">
        <label for="form-middle" class="form-label">Heart / Middle Notes <span>*</span></label>
        <input type="text" id="form-middle" class="form-control" placeholder="Melati, Mawar, Peony" required>
      </div>
      <div class="form-group">
        <label for="form-base" class="form-label">Base Notes <span>*</span></label>
        <input type="text" id="form-base" class="form-control" placeholder="Sandalwood, Musk, Amber" required>
      </div>

      <div class="form-section-title">4. GAMBAR &amp; DESKRIPSI PRODUK</div>

      <div class="form-group">
        <label for="form-image-file" class="form-label">Upload File Gambar Produk <span>*</span></label>
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
          <span class="file-chosen-name" id="file-chosen-name">Belum ada file dipilih</span>
        </div>

        <input type="hidden" id="form-image">

        <div id="crud-img-preview-wrap" style="display:none; margin-top:0.85rem;">
          <div style="font-size:0.68rem; font-weight:700; color:#8A8A8A; letter-spacing:0.1em; margin-bottom:0.35rem;">
            PREVIEW GAMBAR:</div>
          <img id="crud-img-preview" src="" alt="Preview Gambar Produk"
            style="width:96px; height:96px; object-fit:cover; border-radius:10px; border:1px solid #E4E4E7; box-shadow:0 4px 12px rgba(0,0,0,0.06);">
        </div>
      </div>

      <div class="form-group">
        <label for="form-packaging" class="form-label">Kemasan &amp; Detail Kemasan</label>
        <input type="text" id="form-packaging" class="form-control" placeholder="Botol kaca spray 30ml, dus karton">
      </div>
      <div class="form-group">
        <label for="form-tagline" class="form-label">Tagline Singkat</label>
        <input type="text" id="form-tagline" class="form-control" placeholder="Elegan, segar, dan abadi">
      </div>
      <div class="form-group">
        <label for="form-desc" class="form-label">Deskripsi Lengkap Produk</label>
        <textarea id="form-desc" class="form-control" rows="3"
          placeholder="Tuliskan cerita dan deskripsi lengkap aroma..."></textarea>
      </div>

      <div class="form-group" style="margin-top:1.5rem;">
        <label class="form-toggle">
          <input type="checkbox" id="form-bestseller">
          <span class="form-toggle-track"><span class="form-toggle-thumb"></span></span>
          <span class="form-toggle-label">Tandai sebagai <strong>Best Seller â˜…</strong></span>
        </label>
      </div>
    </form>

    <div class="admin-panel-footer">
      <button type="button" id="btn-cancel-crud" class="admin-btn-secondary">Batal</button>
      <button type="submit" form="product-crud-form" id="btn-save-crud" class="admin-btn-primary">Simpan Produk</button>
    </div>
  </aside>

  <!-- ============================================================
       5. DELETE CONFIRMATION MODAL
       ============================================================ -->
  <div id="delete-modal-backdrop" class="admin-modal-backdrop">
    <div class="admin-modal">
      <div class="admin-modal-icon-svg">
        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#EF4444" stroke-width="1.75"
          stroke-linecap="round" stroke-linejoin="round">
          <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
          <line x1="12" y1="9" x2="12" y2="13"></line>
          <line x1="12" y1="17" x2="12.01" y2="17"></line>
        </svg>
      </div>
      <h3 class="admin-modal-title">Hapus Produk?</h3>
      <div class="admin-modal-body">
        Apakah Anda yakin ingin menghapus produk <strong id="delete-product-name">Product Name</strong> dari database?
        Tindakan ini tidak dapat dibatalkan.
      </div>
      <div class="admin-modal-footer">
        <button id="btn-cancel-delete" class="admin-btn-cancel">Batal</button>
        <button id="btn-confirm-delete" class="admin-btn-danger">Hapus Produk</button>
      </div>
    </div>
  </div>

  <!-- Toast Container -->
  <div id="toast-container"></div>

  <!-- Scripts -->
  <script src="{{ asset('js/db.js') }}"></script>
  <script src="{{ asset('js/admin.js') }}"></script>
</body>

</html>
