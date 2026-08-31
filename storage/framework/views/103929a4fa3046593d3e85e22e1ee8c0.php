<?php $__env->startSection('title', 'Admin Portal — Manajemen Produk'); ?>

<?php $__env->startSection('content'); ?>
  <!-- Real-time Stats Cards Bar -->
  <div class="admin-stats-grid">
    <div class="admin-stat-card">
      <div class="admin-stat-top">
        <div class="admin-stat-icon-bg">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
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
            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
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
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
            <polyline points="22 4 12 14.01 9 11.01"></polyline>
          </svg>
        </div>
        <span class="admin-stat-tag">Tersedia</span>
      </div>
      <div class="admin-stat-value" id="stat-ready">0</div>
      <div class="admin-stat-label">Produk Status Ready</div>
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
        <span class="admin-stat-tag">Kosong</span>
      </div>
      <div class="admin-stat-value" id="stat-outofstock">0</div>
      <div class="admin-stat-label">Produk Status Habis</div>
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
          <svg class="search-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
          </svg>
          <input type="text" id="admin-table-search" class="admin-search-input" placeholder="Cari nama produk / varian...">
        </div>

        <!-- Custom Filter Dropdown -->
        <div class="custom-select-wrap" id="custom-filter-wrap">
          <button type="button" class="custom-select-trigger" id="custom-filter-trigger">
            <span class="custom-select-label" id="custom-filter-label">Semua Status Stok</span>
            <svg class="custom-select-arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
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
            <div class="custom-select-option" data-value="ready">
              <span class="opt-dot bestseller"></span> Status Ready
            </div>
            <div class="custom-select-option" data-value="outofstock">
              <span class="opt-dot outofstock"></span> Status Habis
            </div>
          </div>
          <input type="hidden" id="admin-filter-status" value="all">
        </div>

        <!-- Add Product Button -->
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

  <!-- ============================================================
        CREATE / EDIT SLIDE-IN PANEL FORM (WITH FILE UPLOADER)
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
          <label class="form-label">Kategori <span>*</span></label>
          <input type="hidden" id="form-category" value="Signature">
          <div class="form-select-custom" id="custom-select-category">
            <div class="form-select-trigger">
              <span class="trigger-label">Signature Collection</span>
              <svg class="form-select-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="6 9 12 15 18 9"></polyline>
              </svg>
            </div>
            <div class="form-select-options">
              <div class="form-select-option selected" data-value="Signature" data-display="Signature Collection">
                <span>Signature Collection</span><span class="opt-check">✔</span>
              </div>
              <div class="form-select-option" data-value="Refill" data-display="Refill Collection">
                <span>Refill Collection</span><span class="opt-check">✔</span>
              </div>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">Tipe / Konsentrasi Parfum <span>*</span></label>
          <input type="hidden" id="form-type" value="Eau de Parfum">
          <div class="form-select-custom" id="custom-select-type">
            <div class="form-select-trigger">
              <span class="trigger-label">Eau de Parfum</span>
              <svg class="form-select-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="6 9 12 15 18 9"></polyline>
              </svg>
            </div>
            <div class="form-select-options">
              <div class="form-select-option selected" data-value="Eau de Parfum"><span>Eau de Parfum</span><span class="opt-check">✔</span></div>
              <div class="form-select-option" data-value="Roll-on"><span>Roll-on</span><span class="opt-check">✔</span></div>
            </div>
          </div>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Target Gender <span>*</span></label>
          <input type="hidden" id="form-gender" value="Unisex">
          <div class="form-select-custom" id="custom-select-gender">
            <div class="form-select-trigger">
              <span class="trigger-label">Unisex</span>
              <svg class="form-select-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="6 9 12 15 18 9"></polyline>
              </svg>
            </div>
            <div class="form-select-options">
              <div class="form-select-option selected" data-value="Unisex"><span>Unisex</span><span class="opt-check">✔</span></div>
              <div class="form-select-option" data-value="Pria"><span>Pria</span><span class="opt-check">✔</span></div>
              <div class="form-select-option" data-value="Wanita"><span>Wanita</span><span class="opt-check">✔</span></div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="form-variant" class="form-label">Varian Aroma <span>*</span></label>
          <input type="text" id="form-variant" class="form-control" placeholder="Woody Floral, Gourmand..." required>
        </div>
      </div>

      <div class="form-row" id="form-size-price-row">
        <div class="form-group">
          <label class="form-label">Ukuran Botol <span>*</span></label>
          <input type="hidden" id="form-size" value="30ML">
          <div class="form-select-custom" id="custom-select-size">
            <div class="form-select-trigger">
              <span class="trigger-label">30ML (Standard Size)</span>
              <svg class="form-select-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="6 9 12 15 18 9"></polyline>
              </svg>
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
          <input type="text" id="form-price-display" class="form-control" placeholder="Rp 45.000" required autocomplete="off">
          <input type="hidden" id="form-price" value="45000">
        </div>
      </div>

      <div class="form-section-title">2. SCENT PYRAMID NOTES</div>

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

      <div id="form-image-section">
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
            <span class="file-chosen-name" id="file-chosen-name">Belum ada file dipilih</span>
          </div>

          <input type="hidden" id="form-image">

          <div id="crud-img-preview-wrap" style="display:none; margin-top:0.85rem;">
            <div style="font-size:0.68rem; font-weight:700; color:#8A8A8A; letter-spacing:0.1em; margin-bottom:0.35rem;">PREVIEW GAMBAR:</div>
            <img id="crud-img-preview" src="" alt="Preview Gambar Produk" style="width:96px; height:96px; object-fit:cover; border-radius:10px; border:1px solid #E4E4E7; box-shadow:0 4px 12px rgba(0,0,0,0.06);">
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="form-desc" class="form-label">Deskripsi Lengkap Produk (Opsional)</label>
        <textarea id="form-desc" class="form-control" rows="3" placeholder="Tuliskan cerita dan deskripsi lengkap aroma..."></textarea>
      </div>

      <div class="form-group" style="margin-top:1.5rem;">
        <label class="form-toggle">
          <input type="checkbox" id="form-bestseller">
          <span class="form-toggle-track"><span class="form-toggle-thumb"></span></span>
          <span class="form-toggle-label">Tandai sebagai <strong>Best Seller ★</strong></span>
        </label>
      </div>
    </form>

    <div class="admin-panel-footer">
      <button type="button" id="btn-cancel-crud" class="admin-btn-secondary">Batal</button>
      <button type="submit" form="product-crud-form" id="btn-save-crud" class="admin-btn-primary">Simpan Produk</button>
    </div>
  </aside>

  <!-- ============================================================
        DELETE CONFIRMATION MODAL
        ============================================================ -->
  <div id="delete-modal-backdrop" class="admin-modal-backdrop">
    <div class="admin-modal">
      <div class="admin-modal-icon-svg">
        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#EF4444" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
          <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
          <line x1="12" y1="9" x2="12" y2="13"></line>
          <line x1="12" y1="17" x2="12.01" y2="17"></line>
        </svg>
      </div>
      <h3 class="admin-modal-title">Hapus Produk?</h3>
      <div class="admin-modal-body">
        Apakah Anda yakin ingin menghapus produk <strong id="delete-product-name">Product Name</strong> dari database? Tindakan ini tidak dapat dibatalkan.
      </div>
      <div class="admin-modal-footer">
        <button id="btn-cancel-delete" class="admin-btn-cancel">Batal</button>
        <button id="btn-confirm-delete" class="admin-btn-danger">Hapus Produk</button>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
  <script src="<?php echo e(asset('js/admin.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\_DATA\Documents\Perfu.me\resources\views/admin/index.blade.php ENDPATH**/ ?>