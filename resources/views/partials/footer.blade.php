@php
  try {
    $footerBestSellers = \App\Models\Product::where('best_seller', true)->take(5)->get();
  } catch (\Throwable $e) {
    $footerBestSellers = collect();
  }
@endphp

{{-- MAIN DARK FOOTER --}}
<footer id="footer-section" class="site-footer">
  <div class="footer-container">
    
    {{-- 3 COLUMNS GRID WITH TOP DIVIDERS --}}
    <div class="footer-grid">
      
      {{-- Column 1: KOLEKSI --}}
      <div class="footer-col">
        <div class="footer-col-divider"></div>
        <h4 class="footer-col-title">KOLEKSI</h4>
        <ul class="footer-col-list">
          @forelse($footerBestSellers as $bs)
            <li><a href="/produk/{{ $bs->id }}" class="footer-link">{{ $bs->name }}</a></li>
          @empty
            <li><a href="/katalog" class="footer-link">Vanessence Series</a></li>
            <li><a href="/katalog" class="footer-link">Dynamyst Series</a></li>
            <li><a href="/katalog" class="footer-link">Nusantara Series</a></li>
          @endforelse
          <li><a href="/katalog" class="footer-link font-semibold">Lihat Semua Katalog &rarr;</a></li>
        </ul>
      </div>

      {{-- Column 2: QUICK LINKS --}}
      <div class="footer-col">
        <div class="footer-col-divider"></div>
        <h4 class="footer-col-title">QUICK LINKS</h4>
        <ul class="footer-col-list">
          <li><a href="/katalog" class="footer-link">Katalog Produk</a></li>
          <li><a href="/quiz" class="footer-link">Quiz Rekomendasi Aroma</a></li>
          <li><a href="/#about-story-section" class="footer-link">Tentang Perfu.me</a></li>
          <li><a href="/#testimoni-section" class="footer-link">Testimoni Pelanggan</a></li>
          <li><a href="https://wa.me/6281383415432?text=Halo%20Perfu.me,%20saya%20tertarik%20menjadi%20Agen%20/%20Reseller" target="_blank" rel="noopener" class="footer-link">Gabung Agen & Reseller</a></li>
        </ul>
      </div>

      {{-- Column 3: KONTAK & LEGAL --}}
      <div class="footer-col">
        <div class="footer-col-divider"></div>
        <h4 class="footer-col-title">KONTAK & LEGAL</h4>
        <ul class="footer-col-list">
          <li><a href="https://wa.me/6281383415432?text=Halo%20Perfu.me,%20saya%20butuh%20bantuan%20layanan%20pelanggan" target="_blank" rel="noopener" class="footer-link">WhatsApp CS: +62 813-8341-5432</a></li>
          <li><a href="mailto:perfumeofficial30@gmail.com" class="footer-link">Email: perfumeofficial30@gmail.com</a></li>
          <li><a href="https://www.instagram.com/perfu.mefragrance/" target="_blank" rel="noopener" class="footer-link">Instagram @perfu.mefragrance</a></li>
          <li><a href="https://maps.app.goo.gl/xui1fMK73WXR1DD29" target="_blank" rel="noopener" class="footer-link">Lokasi: Jl. Lingkar Dramaga RT 03/04</a></li>
          <li><a href="#" onclick="document.getElementById('privacy-modal').style.display='flex'; return false;" class="footer-link">Kebijakan Privasi</a></li>
        </ul>
      </div>

    </div>

  </div>

  {{-- MARQUEE TICKER BANNER --}}
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

  {{-- COPYRIGHT BAR --}}
  <div class="footer-bottom-bar">
    <div class="footer-bottom-content">
      <span>&copy; 2026 <a href="/" class="footer-link">Perfu.me</a>. All rights reserved.</span>
    </div>
  </div>
</footer>

{{-- PRIVACY POLICY MODAL --}}
<div id="privacy-modal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.7); z-index:99999; align-items:center; justify-content:center; padding:1.5rem;" onclick="if(event.target===this)this.style.display='none'">
  <div style="background:#FFFFFF; border-radius:16px; max-width:560px; width:100%; max-height:80vh; overflow-y:auto; padding:2.5rem; position:relative;">
    <button onclick="document.getElementById('privacy-modal').style.display='none'" style="position:absolute; top:1rem; right:1rem; background:none; border:none; font-size:1.5rem; cursor:pointer; color:#8A8A8A;" aria-label="Tutup">&times;</button>
    <h2 style="font-family:'Cormorant Garamond', Georgia, serif; font-size:1.6rem; font-weight:300; color:#0D0D0D; margin-bottom:1rem;">Kebijakan Privasi</h2>
    <p style="font-size:0.85rem; color:#8A8A8A; margin-bottom:1.5rem;">Terakhir diperbarui: Agustus 2026</p>
    <div style="font-family:'Manrope', sans-serif; font-size:0.88rem; color:#4A4A4A; line-height:1.75;">
      <p style="margin-bottom:1rem;"><strong>1. Informasi yang Kami Kumpulkan</strong><br>
      Perfu.me hanya mengumpulkan informasi yang Anda berikan secara sukarela melalui formulir kontak atau pesan WhatsApp, seperti nama dan nomor telepon untuk keperluan transaksi.</p>
      <p style="margin-bottom:1rem;"><strong>2. Penggunaan Informasi</strong><br>
      Informasi yang dikumpulkan digunakan semata-mata untuk memproses pesanan dan memberikan layanan pelanggan. Kami tidak menjual atau membagikan data Anda kepada pihak ketiga.</p>
      <p style="margin-bottom:1rem;"><strong>3. Keamanan Data</strong><br>
      Kami berkomitmen menjaga kerahasiaan data pribadi Anda dengan standar keamanan yang wajar.</p>
      <p style="margin-bottom:1rem;"><strong>4. Kontak</strong><br>
      Jika Anda memiliki pertanyaan mengenai kebijakan privasi ini, silakan hubungi kami melalui WhatsApp: <a href="https://wa.me/6281383415432" target="_blank" rel="noopener" style="color:#0D0D0D;">+62 813-8341-5432</a></p>
    </div>
  </div>
</div>
