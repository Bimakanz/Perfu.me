/**
 * catalog.js — Alternating Zig-Zag Product Showcase & Filter Controller
 * Matching User Reference Image
 * Perfu.me E-Commerce Platform
 */

(function () {
  let activeFilters = {
    gender: 'all',
    variant: 'all',
    query: ''
  };

  const FALLBACK_PRODUCTS = [
    {
      id: 1,
      name: 'Vanessence',
      type: 'Eau de Parfum',
      gender: 'Wanita',
      variant: 'Gourmand Vanilla',
      top_notes: 'Bergamot, Pear',
      middle_notes: 'Melati, Mawar, Peony',
      base_notes: 'Vanilla, Musk, Sandalwood',
      packaging: 'Botol kaca spray 30ml + dus karton',
      size: '30ML',
      price: 150000,
      stock: 30,
      best_seller: true,
      image: 'assets/images/vanessence.png',
      description: 'Vanessence adalah perpaduan bunga yang lembut dengan sentuhan vanilla hangat. Dibuat untuk wanita yang anggun namun berkarakter — wangi yang manis di awal, floral di tengah, dan meninggalkan jejak musky yang menggoda sepanjang hari.',
      tagline: 'Feminin, manis, dan memikat'
    },
    {
      id: 2,
      name: 'Dynamyst',
      type: 'Eau de Parfum',
      gender: 'Pria',
      variant: 'Spicy Woody',
      top_notes: 'Bergamot, Black Pepper',
      middle_notes: 'Lavender, Cengkeh',
      base_notes: 'Cedarwood, Amber, Musk',
      packaging: 'Botol kaca spray 30ml + dus karton',
      size: '30ML',
      price: 150000,
      stock: 25,
      best_seller: false,
      image: 'assets/images/dynamyst.png',
      description: 'Dynamyst hadir dengan karakter kayu yang kuat dan sentuhan rempah yang berani. Cocok untuk pria yang percaya diri dan dinamis — segar di awal, hangat di tengah, dengan base woody-amber yang maskulin dan tahan lama.',
      tagline: 'Maskulin, tegas, penuh energi'
    },
    {
      id: 3,
      name: 'Nusantara No.1',
      type: 'Eau de Parfum',
      gender: 'Unisex',
      variant: 'Woody Floral',
      top_notes: 'Bergamot, Lemon',
      middle_notes: 'Melati, Mawar',
      base_notes: 'Sandalwood, Musk',
      packaging: 'Botol kaca spray 30ml + dus karton',
      size: '30ML',
      price: 85000,
      stock: 42,
      best_seller: true,
      image: 'assets/images/nusantara_no1.png',
      description: 'Nusantara No.1 adalah simfoni aroma yang menyatukan keharuman bunga nusantara dengan sentuhan wood yang elegan. Wewangian unisex ini hadir dengan bukaan segar bergamot dan lemon, berkembang menjadi buket melati dan mawar yang menawan.',
      tagline: 'Elegan, segar, dan abadi'
    },
    {
      id: 4,
      name: 'Nusantara No.2 – Rempah',
      type: 'Eau de Parfum',
      gender: 'Pria',
      variant: 'Spicy Oriental',
      top_notes: 'Cengkeh, Kayu Manis',
      middle_notes: 'Cendana',
      base_notes: 'Amber, Vanilla',
      packaging: 'Botol kaca spray 30ml + dus karton',
      size: '30ML',
      price: 95000,
      stock: 18,
      best_seller: false,
      image: 'assets/images/nusantara_no2.png',
      description: 'Nusantara No.2 Rempah membawa semangat kepulauan rempah Indonesia ke dalam sebuah botol. Diperkaya dengan cengkeh dan kayu manis yang kuat di awal, dihaluskan oleh cendana di hati, dan ditutup oleh amber serta vanilla.',
      tagline: 'Berani, hangat, dan penuh karakter'
    },
    {
      id: 5,
      name: 'Nusantara Roll-On Mini',
      type: 'Roll-on',
      gender: 'Wanita',
      variant: 'Sweet Floral',
      top_notes: 'Strawberry, Raspberry',
      middle_notes: 'Mawar, Peony',
      base_notes: 'Musk, Vanilla',
      packaging: 'Botol roll-on plastik 10ml',
      size: '10ML',
      price: 35000,
      stock: 76,
      best_seller: true,
      image: 'assets/images/nusantara_rollon.png',
      description: 'Nusantara Roll-On Mini adalah teman manis yang selalu siap menemani harimu. Dengan semburan buah beri segar di awal, jantung bunga yang feminin, dan akhir musk-vanilla yang lembut.',
      tagline: 'Manis, segar, dan memikat'
    }
  ];

  function formatPrice(n) {
    return 'Rp ' + Number(n).toLocaleString('id-ID');
  }

  // ── Render Zig-Zag Product Rows ───────────────────────────
  function renderZigZag(products) {
    const container = document.getElementById('produk-section-list');
    if (!container) return;

    if (!products || products.length === 0) {
      products = FALLBACK_PRODUCTS;
    }

    container.innerHTML = products.map((p, index) => {
      const isReverse = index % 2 === 1; // Alternating Left / Right
      const topStr = p.top_notes || p.topNotes || '';
      const middleStr = p.middle_notes || p.middleNotes || '';
      const baseStr = p.base_notes || p.baseNotes || '';

      const categoryTag = `${(p.gender || 'UNISEX').toUpperCase()} • ${(p.variant || '').toUpperCase()}`;
      const originalPrice = 220000;

      const imgHtml = `
        <div class="zigzag-img-col">
          <div class="zigzag-img-box">
            <img src="${p.image}" alt="${p.name}" loading="lazy" onerror="this.src='assets/images/nusantara_no1.png'">
          </div>
        </div>`;

      const detailsHtml = `
        <div class="zigzag-info-col">
          <div class="zigzag-meta">${categoryTag}</div>
          <h3 class="zigzag-title">${p.name}</h3>
          <p class="zigzag-tagline">${p.tagline || ''}</p>
          <p class="zigzag-desc">${p.description || ''}</p>

          <!-- Scent Pyramid Notes -->
          <div class="zigzag-notes-grid">
            <div class="zigzag-note-col">
              <span class="zigzag-note-head">TOP NOTES</span>
              <span class="zigzag-note-val">${topStr}</span>
            </div>
            <div class="zigzag-note-col">
              <span class="zigzag-note-head">HEART NOTES</span>
              <span class="zigzag-note-val">${middleStr}</span>
            </div>
            <div class="zigzag-note-col">
              <span class="zigzag-note-head">BASE NOTES</span>
              <span class="zigzag-note-val">${baseStr}</span>
            </div>
          </div>

          <!-- Bullet Points -->
          <ul class="zigzag-bullets">
            <li>Parfum oil grade A, alkohol 90%</li>
            <li>Tanpa pewarna tambahan</li>
            <li>${p.packaging || 'Botol kaca spray + dus karton'}</li>
            <li>Tahan 6–10 jam</li>
          </ul>

          <!-- Pricing & WhatsApp CTA -->
          <div class="zigzag-price-wrap">
            <span class="zigzag-price-main">${formatPrice(p.price)}</span>
            <span class="zigzag-price-slash">${formatPrice(originalPrice)}</span>
            <span class="zigzag-size">${p.size || '30ML'}</span>
          </div>

          <a
            href="https://wa.me/6281234567890?text=Halo%2C%20saya%20ingin%20memesan%20${encodeURIComponent(p.name)}%20(${p.size})%20seharga%20${encodeURIComponent(formatPrice(p.price))}"
            target="_blank"
            rel="noopener"
            class="btn-whatsapp-full"
          >
            Pesan via WhatsApp
          </a>
        </div>`;

      return `
        <article class="product-zigzag-row ${isReverse ? 'reverse' : ''} reveal" id="product-item-${p.id}">
          ${isReverse ? `${detailsHtml}${imgHtml}` : `${imgHtml}${detailsHtml}`}
        </article>
      `;
    }).join('');

    // Trigger reveal animations
    if (window.triggerRevealCheck) setTimeout(window.triggerRevealCheck, 50);
  }

  // ── Load & Filter Data ────────────────────────────────────
  async function refreshProducts() {
    try {
      let products;
      if (window.API && typeof window.API.filter === 'function') {
        products = await window.API.filter(activeFilters);
      }
      if (!products || products.length === 0) {
        products = FALLBACK_PRODUCTS.filter(p => {
          if (activeFilters.gender !== 'all' && p.gender.toLowerCase() !== activeFilters.gender.toLowerCase()) return false;
          if (activeFilters.variant !== 'all' && !p.variant.toLowerCase().includes(activeFilters.variant.toLowerCase())) return false;
          if (activeFilters.query) {
            const q = activeFilters.query.toLowerCase();
            return p.name.toLowerCase().includes(q) || p.variant.toLowerCase().includes(q);
          }
          return true;
        });
      }
      renderZigZag(products);
    } catch (err) {
      renderZigZag(FALLBACK_PRODUCTS);
    }
  }

  // ── Filters Setup ─────────────────────────────────────────
  function initFilters() {
    // Gender Chips
    document.querySelectorAll('.filter-chip[data-gender]').forEach(chip => {
      chip.addEventListener('click', () => {
        document.querySelectorAll('.filter-chip[data-gender]').forEach(c => c.classList.remove('active'));
        chip.classList.add('active');
        activeFilters.gender = chip.getAttribute('data-gender');
        refreshProducts();
      });
    });

    // Variant Select
    const variantSelect = document.getElementById('variant-select');
    if (variantSelect) {
      variantSelect.addEventListener('change', () => {
        activeFilters.variant = variantSelect.value;
        refreshProducts();
      });
    }

    // Search Input
    const searchInput = document.getElementById('catalog-search-input');
    if (searchInput) {
      let debounce;
      searchInput.addEventListener('input', () => {
        clearTimeout(debounce);
        debounce = setTimeout(() => {
          activeFilters.query = searchInput.value.trim();
          refreshProducts();
        }, 250);
      });
    }
  }

  // Init on DOM ready
  document.addEventListener('DOMContentLoaded', () => {
    initFilters();
    refreshProducts();
  });

  window.refreshCatalog = refreshProducts;
})();
