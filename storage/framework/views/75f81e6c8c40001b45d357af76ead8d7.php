<?php
  try {
    $footerBestSellers = \App\Models\Product::where('best_seller', true)->take(5)->get();
  } catch (\Throwable $e) {
    $footerBestSellers = collect();
  }
?>


<footer id="footer-section" class="site-footer">
  <div class="footer-container">
    
    
    <div class="footer-grid">
      
      
      <div class="footer-col">
        <div class="footer-col-divider"></div>
        <h4 class="footer-col-title">KOLEKSI</h4>
        <ul class="footer-col-list">
          <?php $__empty_1 = true; $__currentLoopData = $footerBestSellers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <li><a href="/produk/<?php echo e($bs->id); ?>" class="footer-link"><?php echo e($bs->name); ?></a></li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <li><a href="/katalog" class="footer-link">Vanessence Series</a></li>
            <li><a href="/katalog" class="footer-link">Dynamyst Series</a></li>
            <li><a href="/katalog" class="footer-link">Nusantara Series</a></li>
          <?php endif; ?>
          <li><a href="/katalog" class="footer-link font-semibold">Lihat Semua Katalog &rarr;</a></li>
        </ul>
      </div>

      
      <div class="footer-col">
        <div class="footer-col-divider"></div>
        <h4 class="footer-col-title">QUICK LINKS</h4>
        <ul class="footer-col-list">
          <li><a href="/katalog" class="footer-link">Katalog Produk</a></li>
          <li><a href="/quiz" class="footer-link">Quiz Rekomendasi Aroma</a></li>
          <li><a href="/#about-story-section" class="footer-link">Tentang Perfu.me</a></li>
          <li><a href="/#testimoni-section" class="footer-link">Testimoni Pelanggan</a></li>
          <li><a href="https://wa.me/6281383415432?text=Halo%20Perfu.me,%20saya%20tertarik%20menjadi%20Agen%20/%20Reseller" target="_blank" rel="noopener" class="footer-link">Gabung Agen & Reseller</a></li>
          <li><a href="/admin" class="footer-link">Admin Portal</a></li>
        </ul>
      </div>

      
      <div class="footer-col">
        <div class="footer-col-divider"></div>
        <h4 class="footer-col-title">KONTAK & LEGAL</h4>
        <ul class="footer-col-list">
          <li><a href="https://wa.me/6281383415432?text=Halo%20Perfu.me,%20saya%20butuh%20bantuan%20layanan%20pelanggan" target="_blank" rel="noopener" class="footer-link">WhatsApp CS: +62 813-8341-5432</a></li>
          <li><a href="mailto:perfumeofficial30@gmail.com" class="footer-link">Email: perfumeofficial30@gmail.com</a></li>
          <li><a href="https://www.instagram.com/perfu.mefragrance/" target="_blank" rel="noopener" class="footer-link">Instagram @perfu.mefragrance</a></li>
          <li><a href="https://maps.app.goo.gl/xui1fMK73WXR1DD29" target="_blank" rel="noopener" class="footer-link">Lokasi: Jl. Lingkar Dramaga RT 03/04</a></li>
          <li><a href="#" onclick="alert('Perfu.me menjamin kerahasiaan data pribadi pelanggan.'); return false;" class="footer-link">Kebijakan Privasi</a></li>
        </ul>
      </div>

    </div>

  </div>

  
  <div class="footer-marquee-strip">
    <div class="footer-marquee-track">
      <span>PERFU.ME</span> <span class="dot">&bull;</span>
      <span>PREMIUM & NUSANTARA FRAGRANCE</span> <span class="dot">&bull;</span>
      <span>ELEGANCE IN EVERY DROP</span> <span class="dot">&bull;</span>
      <span>GRADE A PARFUM CONCENTRATE</span> <span class="dot">&bull;</span>
      <span>KETAHANAN AROMATIS 8+ JAM</span> <span class="dot">&bull;</span>
      <span>RAMAH DI KANTONG</span> <span class="dot">&bull;</span>
      <span>PERFU.ME</span> <span class="dot">&bull;</span>
      <span>PREMIUM & NUSANTARA FRAGRANCE</span> <span class="dot">&bull;</span>
      <span>ELEGANCE IN EVERY DROP</span> <span class="dot">&bull;</span>
      <span>GRADE A PARFUM CONCENTRATE</span> <span class="dot">&bull;</span>
      <span>KETAHANAN AROMATIS 8+ JAM</span> <span class="dot">&bull;</span>
      <span>RAMAH DI KANTONG</span> <span class="dot">&bull;</span>
    </div>
  </div>

  
  <div class="footer-bottom-bar">
    <div class="footer-bottom-content">
      <span>&copy; 2026 <a href="/" class="footer-link">Perfu.me</a>. All rights reserved.</span>
    </div>
  </div>
</footer>
<?php /**PATH C:\Users\bimag\Documents\SEKOLAH\Perfu.me\resources\views/partials/footer.blade.php ENDPATH**/ ?>