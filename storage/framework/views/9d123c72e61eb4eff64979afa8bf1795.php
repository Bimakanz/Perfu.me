<?php $__env->startSection('title', $product->name . ' — Perfu.me'); ?>
<?php $__env->startSection('description', $product->description); ?>

<?php $__env->startSection('styles'); ?>
<style>
  body {
    background: #FFFFFF;
    color: #0D0D0D;
    font-family: 'Manrope', system-ui, sans-serif;
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
    font-size: 2.5rem;
    color: #000000;
    margin-bottom: 2rem;
    text-align: center;
    text-transform: uppercase;
  }

  .detail-brand-watermark.is-signature {
    font-family: 'Zaloga', Georgia, serif;
    letter-spacing: 0.04em;
    font-weight: normal;
    text-transform: none;
  }

  .detail-brand-watermark.is-refill {
    font-family: 'Cormorant Garamond', Georgia, serif;
    letter-spacing: 0.18em;
    font-weight: 300;
  }

  .detail-img-box {
    width: 100%;
    max-width: 400px;
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
    height: 96px;
    background: #FFFFFF;
    border-top: 1px solid #E5E5E5;
    box-shadow: 0 -10px 35px rgba(0,0,0,0.08);
    z-index: 999;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .bottom-bar-content {
    width: 100%;
    max-width: 1240px;
    padding: 0 2rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1.75rem;
  }

  .bottom-bar-product-info {
    display: flex;
    align-items: center;
    gap: 1.1rem;
  }

  .bottom-bar-thumb {
    width: 58px;
    height: 58px;
    border-radius: 8px;
    object-fit: cover;
    background: #F4F4F5;
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
  }

  .bottom-bar-title-group {
    display: flex;
    flex-direction: column;
    gap: 0.15rem;
  }

  .bottom-bar-title {
    font-size: 1.05rem;
    font-weight: 700;
    color: #000000;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 360px;
  }

  .bottom-bar-price {
    font-size: 0.98rem;
    font-weight: 600;
    color: #333333;
  }

  .bottom-bar-controls {
    display: flex;
    align-items: center;
    gap: 1.1rem;
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
    gap: 0.9rem;
    padding: 0.78rem 1.3rem;
    border: 1.5px solid #000000;
    border-radius: 999px;
    font-family: inherit;
    font-size: 0.92rem;
    font-weight: 600;
    color: #000000;
    background: #FFFFFF;
    cursor: pointer;
    transition: all 0.2s ease;
    box-shadow: 0 2px 6px rgba(0,0,0,0.04);
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
    min-width: 240px;
    background: #FFFFFF;
    border: 1px solid #E5E5E5;
    border-radius: 12px;
    box-shadow: 0 14px 40px rgba(0,0,0,0.15);
    padding: 0.45rem;
    z-index: 1000;
    display: none;
    flex-direction: column;
    gap: 3px;
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
    padding: 0.75rem 1.1rem;
    font-size: 0.9rem;
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
    border: 1.5px solid #E5E5E5;
    border-radius: 999px;
    padding: 0.25rem 0.6rem;
    background: #FFFFFF;
  }

  .qty-btn {
    border: none;
    background: transparent !important;
    width: 36px;
    height: 36px;
    font-size: 1.15rem;
    font-weight: 600;
    color: #666666;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    user-select: none;
    outline: none;
    transition: color 0.15s ease, transform 0.15s ease;
  }

  .qty-btn:hover, .qty-btn:focus, .qty-btn:active {
    background: transparent !important;
    color: #000000;
    transform: scale(1.15);
  }

  .qty-val {
    font-size: 0.98rem;
    font-weight: 700;
    width: 32px;
    text-align: center;
  }

  /* Action Buttons */
  .btn-bottom-order {
    padding: 0.85rem 1.85rem;
    background: #000000;
    color: #FFFFFF;
    border: none;
    border-radius: 999px;
    font-size: 0.92rem;
    font-weight: 700;
    cursor: pointer;
    text-decoration: none;
    transition: all 0.2s ease;
    white-space: nowrap;
    box-shadow: 0 4px 14px rgba(0,0,0,0.12);
  }

  .btn-bottom-order:hover {
    background: #222222;
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.18);
  }

  .btn-bottom-cart {
    padding: 0.85rem 1.4rem;
    background: #FFFFFF;
    color: #000000;
    border: 1.5px solid #000000;
    border-radius: 999px;
    font-size: 0.92rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s ease;
    white-space: nowrap;
  }

  .btn-bottom-cart:hover {
    background: #F5F5F5;
    transform: translateY(-1px);
  }

  @media (max-width: 900px) {
    .detail-hero-grid { grid-template-columns: 1fr; gap: 2rem; }
    .bottom-bar-product-info { display: none; }
    .bottom-bar-controls { width: 100%; justify-content: space-between; }
  }

  /* Related Products Section */
  .related-section {
    border-top: 1px solid #EEEEEE;
    padding-top: 4rem;
    margin-top: 4rem;
  }

  .related-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-bottom: 2.5rem;
  }

  .related-title-sub {
    font-size: 0.72rem;
    font-weight: 700;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: #8A8A8A;
    margin-bottom: 0.35rem;
  }

  .related-title {
    font-family: 'Zaloga', Georgia, serif;
    font-size: 2.2rem;
    font-weight: 300;
    color: #0D0D0D;
    margin: 0;
  }

  .related-link-all {
    font-size: 0.82rem;
    font-weight: 600;
    color: #0D0D0D;
    text-decoration: none;
    letter-spacing: 0.04em;
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    transition: color 0.2s;
  }

  .related-link-all:hover { color: #555555; }

  .related-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1.5rem;
  }

  .related-card {
    background: #FFFFFF;
    border: 1px solid #E5E5E5;
    border-radius: 12px;
    overflow: hidden;
    text-decoration: none;
    color: inherit;
    transition: box-shadow 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    display: flex;
    flex-direction: column;
  }

  .related-card:hover {
    box-shadow: 0 10px 28px rgba(0,0,0,0.05);
  }

  .related-img-wrap {
    width: 100%;
    padding-top: 100%;
    position: relative;
    background: #F4F4F5;
    overflow: hidden;
  }

  .related-img-wrap img {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
  }

  .related-card:hover .related-img-wrap img {
    transform: scale(1.05);
  }

  .related-card-body {
    padding: 1.25rem;
    display: flex;
    flex-direction: column;
    flex: 1;
  }

  .related-card-tag {
    font-size: 0.65rem;
    font-weight: 700;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    color: #8A8A8A;
    margin-bottom: 0.35rem;
  }

  .related-card-name {
    font-size: 0.98rem;
    font-weight: 700;
    color: #0D0D0D;
    margin-bottom: 0.5rem;
    line-height: 1.35;
  }

  .related-card-title-text {
    position: relative;
    display: inline-block;
    padding-bottom: 2px;
  }

  .related-card-title-text::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 1.5px;
    background-color: #0D0D0D;
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1);
  }

  .related-card:hover .related-card-title-text::after {
    transform: scaleX(1);
  }

  .related-card-price {
    font-size: 0.9rem;
    font-weight: 600;
    color: #0D0D0D;
    margin-top: auto;
  }

  @media (max-width: 900px) {
    .related-grid { grid-template-columns: repeat(2, 1fr); gap: 1rem; }
  }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

  
  <nav id="navbar" aria-label="Main Navigation">
    <div class="nav-brand">
      <a href="/" class="nav-brand-name" style="text-decoration:none; color:inherit;">Perfu.me</a>
    </div>

    <ul class="nav-links">
      <li><a href="/katalog">Katalog</a></li>
      <li><a href="/quiz">Quiz</a></li>
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

  <?php
    $isSignature = strtolower($product->type) === 'signature' || str_contains(strtolower($product->name), 'dynamyst') || str_contains(strtolower($product->name), 'vanessence');
    $initialPrice = $isSignature ? $product->price : 45000; // Default Refill 35ml = Rp 45.000
  ?>

  <div class="detail-page-container">
    
    <div class="detail-breadcrumb">
      <a href="/">Home</a>
      <span>›</span>
      <a href="/katalog"><?php echo e($isSignature ? 'Signature Collection' : 'Refill Collection'); ?></a>
      <span>›</span>
      <span style="color:#000000; font-weight:600;"><?php echo e($product->name); ?></span>
    </div>

    <div class="detail-hero-grid">
      
      <div class="detail-media-col">
        <div class="detail-brand-watermark <?php echo e($isSignature ? 'is-signature' : 'is-refill'); ?>"><?php echo e($isSignature ? 'Perfu.me' : 'REFILL'); ?></div>
        <div class="detail-img-box">
          <img src="<?php echo e(asset($product->image)); ?>" alt="<?php echo e($product->name); ?>" onerror="this.src='<?php echo e(asset('assets/images/refill.webp')); ?>'">
        </div>
      </div>

      
      <div class="detail-info-col">
        <div class="detail-status-pill">
          <?php echo e($product->stock > 0 ? 'Ready Stock' : 'Stok Habis'); ?>

        </div>

        <h1 class="detail-product-name"><?php echo e($product->name); ?></h1>

        <div class="detail-price-text" id="display-price-text">
          Rp <?php echo e(number_format($initialPrice, 0, ',', '.')); ?>

        </div>
        <div class="detail-shipping-note">
          <span class="shipping-word">Shipping</span> calculated at checkout.
        </div>

        <div class="detail-desc-text">
          <?php echo e($product->description); ?>

        </div>

        
        <ul class="detail-features-list">
          <li>Parfum oil grade A, alkohol food grade</li>
          <li>Tanpa pewarna tambahan</li>
          <li><?php echo e($product->packaging ?? 'Botol kaca spray + dus karton'); ?></li>
          <li>Tahan 6–10 jam</li>
        </ul>

        <div class="detail-scent-notes-box">
          <div class="scent-notes-title">Aroma Pyramid Notes</div>
          <div class="scent-notes-grid">
            <div class="scent-note-col">
              <strong>Top Notes</strong>
              <span><?php echo e($product->top_notes ?? 'Fresh Notes'); ?></span>
            </div>
            <div class="scent-note-col">
              <strong>Heart Notes</strong>
              <span><?php echo e($product->middle_notes ?? 'Floral Accord'); ?></span>
            </div>
            <div class="scent-note-col">
              <strong>Base Notes</strong>
              <span><?php echo e($product->base_notes ?? 'Warm Musk'); ?></span>
            </div>
          </div>
        </div>
      </div>
    </div>

    
    <?php if(isset($relatedProducts) && count($relatedProducts) > 0): ?>
      <section class="related-section">
        <div class="related-header">
          <div>
            <div class="related-title-sub">EXPLORE MORE FRAGRANCES</div>
            <h2 class="related-title">Rekomendasi Parfum Pilihan</h2>
          </div>
          <a href="/katalog" class="related-link-all">
            Lihat Semua Produk
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg>
          </a>
        </div>

        <div class="related-grid">
          <?php $__currentLoopData = $relatedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
              $relIsSig = strtolower($rel->type) === 'signature' || str_contains(strtolower($rel->name), 'dynamyst') || str_contains(strtolower($rel->name), 'vanessence');
              $relPrice = $relIsSig ? $rel->price : 45000;
            ?>
            <a href="/produk/<?php echo e($rel->id); ?>" class="related-card">
              <div class="related-img-wrap">
                <img src="<?php echo e(asset($rel->image)); ?>" alt="<?php echo e($rel->name); ?>" loading="lazy" onerror="this.src='<?php echo e(asset('assets/images/refill.webp')); ?>'">
              </div>
              <div class="related-card-body">
                <div class="related-card-tag"><?php echo e($relIsSig ? 'Signature' : 'Refill'); ?> • <?php echo e($rel->gender); ?></div>
                <div class="related-card-name">
                  <span class="related-card-title-text"><?php echo e($rel->name); ?></span>
                </div>
                <div class="related-card-price">Rp <?php echo e(number_format($relPrice, 0, ',', '.')); ?></div>
              </div>
            </a>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </section>
    <?php endif; ?>
  </div>

  
  <div class="sticky-bottom-bar">
    <div class="bottom-bar-content">
      <div class="bottom-bar-product-info">
        <img src="<?php echo e(asset($product->image)); ?>" alt="<?php echo e($product->name); ?>" class="bottom-bar-thumb" onerror="this.src='<?php echo e(asset('assets/images/refill.webp')); ?>'">
        <div class="bottom-bar-title-group">
          <div class="bottom-bar-title"><?php echo e($product->name); ?></div>
          <div class="bottom-bar-price" id="bar-price-text">Rp <?php echo e(number_format($initialPrice, 0, ',', '.')); ?></div>
        </div>
      </div>

      <div class="bottom-bar-controls">
        
        <div class="custom-size-dropdown" id="custom-size-dropdown">
          <button type="button" class="custom-size-trigger" id="custom-size-trigger">
            <span id="custom-size-label"><?php echo e($isSignature ? 'Signature 30ml' : 'Refill 35ml — Rp 45.000'); ?></span>
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
          </button>
          
          <div class="custom-size-menu" id="custom-size-menu">
            <?php if($isSignature): ?>
              <div class="custom-size-opt active" data-size="30ml" data-price="<?php echo e($product->price); ?>">Signature 30ml</div>
            <?php else: ?>
              <div class="custom-size-opt" data-size="15ml" data-price="20000">Refill 15ml — Rp 20.000</div>
              <div class="custom-size-opt active" data-size="35ml" data-price="45000">Refill 35ml — Rp 45.000</div>
              <div class="custom-size-opt" data-size="50ml" data-price="65000">Refill 50ml — Rp 65.000</div>
            <?php endif; ?>
          </div>
        </div>

        
        <div class="qty-counter">
          <button class="qty-btn" onclick="changeQty(-1)">−</button>
          <span class="qty-val" id="qty-val">1</span>
          <button class="qty-btn" onclick="changeQty(1)">+</button>
        </div>

        
        <a id="btn-order-wa" href="#" target="_blank" rel="noopener" class="btn-bottom-order">
          Pesan WhatsApp
        </a>
        <button type="button" class="btn-bottom-cart" onclick="addSelectedToCart()">
          + Keranjang
        </button>
      </div>
    </div>
  </div>

  
  <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
  let currentQty = 1;
  let selectedPrice = <?php echo e($initialPrice); ?>;
  let selectedSize = "<?php echo e($isSignature ? '30ml' : '35ml'); ?>";
  const isSignature = <?php echo e($isSignature ? 'true' : 'false'); ?>;
  const productName = <?php echo json_encode($product->name, 15, 512) ?>;
  const productId = <?php echo e($product->id); ?>;

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

  function addSelectedToCart(evt) {
    if (window.addToCart) {
      window.addToCart(productId, currentQty, evt || window.event);
    }
  }

  document.addEventListener('DOMContentLoaded', () => {
    initCustomSizeDropdown();
    updateDisplay();
  });
</script>
<script src="<?php echo e(asset('js/navbar.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\bimag\Documents\SEKOLAH\Perfu.me\resources\views/product-detail.blade.php ENDPATH**/ ?>