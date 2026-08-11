/**
 * pdp.js — Product Detail Page
 * Perfu.me E-Commerce Platform
 */

(function () {
  function formatPrice(n) {
    return 'Rp ' + Number(n).toLocaleString('id-ID');
  }

  function stockInfo(stock) {
    if (stock === 0) return `<span class="badge badge-lowstock">Stok Habis</span>`;
    if (stock < 20)  return `<span class="badge badge-lowstock">Stok Terbatas (${stock} pcs)</span>`;
    return `<span class="badge badge-instock">Tersedia (${stock} pcs)</span>`;
  }

  async function renderPDP(id) {
    const section = document.getElementById('pdp');
    if (!section) return;
    section.classList.add('active');

    // Show loading
    const content = document.getElementById('pdp-content');
    content.innerHTML = `<div style="padding:4rem;text-align:center;color:var(--silver-dark);">Memuat produk...</div>`;

    try {
      const p = await window.API.getById(id);
      if (!p) throw new Error('Not found');

      // Taglines per gender
      const genderTag = p.gender === 'Pria' ? '🧔 Pria' : p.gender === 'Wanita' ? '👩 Wanita' : '✦ Unisex';

      content.innerHTML = `
        <div class="pdp-back" id="pdp-back-btn">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
          Kembali ke Katalog
        </div>

        <div class="pdp-layout">
          <!-- Image -->
          <div class="pdp-image-panel">
            <div class="pdp-image-main">
              <img src="${p.image}" alt="${p.name}" onerror="this.src='assets/images/placeholder.png'">
            </div>
          </div>

          <!-- Details -->
          <div class="pdp-details-panel">
            <p class="pdp-breadcrumb">
              ${genderTag} <span>›</span> ${p.type} <span>›</span> ${p.variant}
            </p>

            <h1 class="pdp-name">${p.name}</h1>
            <p class="pdp-tagline">${p.tagline || ''}</p>
            <p class="pdp-description">${p.description || ''}</p>

            <!-- Scent Pyramid -->
            <div class="scent-pyramid">
              <p class="scent-pyramid-title">Scent Pyramid</p>
              <div class="scent-pyramid-layers">
                <div class="scent-layer top">
                  <div class="scent-layer-indicator"></div>
                  <div class="scent-layer-content">
                    <p class="scent-layer-label">Top Notes</p>
                    <p class="scent-layer-notes">${p.top_notes}</p>
                  </div>
                </div>
                <div class="scent-layer middle">
                  <div class="scent-layer-indicator"></div>
                  <div class="scent-layer-content">
                    <p class="scent-layer-label">Heart Notes</p>
                    <p class="scent-layer-notes">${p.middle_notes}</p>
                  </div>
                </div>
                <div class="scent-layer base">
                  <div class="scent-layer-indicator"></div>
                  <div class="scent-layer-content">
                    <p class="scent-layer-label">Base Notes</p>
                    <p class="scent-layer-notes">${p.base_notes}</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Info -->
            <ul class="pdp-info-list">
              <li>Parfum oil grade A, alkohol 90%</li>
              <li>Tanpa pewarna tambahan</li>
              <li>${p.packaging}</li>
              <li>Tahan 6–10 jam</li>
            </ul>

            <!-- Pricing -->
            <div class="pdp-pricing">
              <span class="pdp-price">${formatPrice(p.price)}</span>
              <span class="pdp-price-size">${p.size}</span>
            </div>
            <div class="pdp-stock-info">${stockInfo(p.stock)}</div>

            <a
              href="https://wa.me/6281234567890?text=Halo%2C%20saya%20ingin%20memesan%20${encodeURIComponent(p.name)}%20(${p.size})%20seharga%20${encodeURIComponent(formatPrice(p.price))}"
              target="_blank" rel="noopener"
              class="btn btn-whatsapp"
              id="whatsapp-order-btn"
            >
              <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
              Pesan via WhatsApp
            </a>
          </div>
        </div>

        <!-- Related Products -->
        <div class="pdp-related">
          <div class="pdp-related-inner">
            <h2 class="pdp-related-title">Produk Lainnya</h2>
            <div class="pdp-related-grid" id="pdp-related-grid"></div>
          </div>
        </div>
      `;

      // Back button
      document.getElementById('pdp-back-btn').addEventListener('click', () => {
        window.router && window.router.navigate('catalog');
      });

      // Load related
      loadRelated(id, p.gender, p.variant);

    } catch (err) {
      content.innerHTML = `
        <div style="padding:4rem;text-align:center;">
          <p style="color:#e05c5c;margin-bottom:1rem;">${err.message || 'Gagal memuat produk.'}</p>
          <button class="btn btn-outline-dark" onclick="window.router.navigate('catalog')">← Kembali</button>
        </div>`;
    }
  }

  async function loadRelated(currentId, gender, variant) {
    const grid = document.getElementById('pdp-related-grid');
    if (!grid) return;

    try {
      const all = await window.API.filter({ gender });
      const related = all.filter(p => String(p.id) !== String(currentId)).slice(0, 4);

      if (related.length === 0) {
        grid.style.display = 'none';
        return;
      }

      grid.innerHTML = related.map(p => `
        <article class="product-card" data-id="${p.id}" style="cursor:pointer" tabindex="0">
          <div class="product-card-image" style="aspect-ratio:1">
            <img src="${p.image}" alt="${p.name}" loading="lazy">
          </div>
          <div class="product-card-body">
            <p class="product-card-category">${p.gender} · ${p.type}</p>
            <h3 class="product-card-name">${p.name}</h3>
            <div class="product-card-footer">
              <div class="product-card-price">Rp ${Number(p.price).toLocaleString('id-ID')}</div>
            </div>
          </div>
        </article>
      `).join('');

      grid.querySelectorAll('.product-card').forEach(card => {
        card.addEventListener('click', () => {
          window.router && window.router.navigate('pdp', card.getAttribute('data-id'));
        });
      });
    } catch {
      // silently fail
    }
  }

  window.initPDP = renderPDP;
})();
