<?php $__env->startSection('title', 'Quiz Parfum — Parfu.me'); ?>
<?php $__env->startSection('description', 'Temukan parfum terbaik untuk gaya dan aktivitas kamu melalui quiz cepat Parfu.me.'); ?>

<?php $__env->startSection('styles'); ?>
<style>
  body { background: #FAFAFA; color: #111; }
  .quiz-page { max-width: 1200px; margin: 0 auto; padding: 3rem 2rem 5rem; }
  .quiz-nav { display: flex; justify-content: space-between; align-items: center; gap: 1rem; margin-bottom: 2rem; }
  .quiz-nav .nav-links { display: flex; gap: 1rem; flex-wrap: wrap; list-style: none; margin: 0; padding: 0; }
  .quiz-nav .nav-links a { color: #0d0d0d; text-decoration: none; font-weight: 600; }
  .quiz-nav .nav-links a.active { color: #000; text-decoration: underline; }
  .quiz-hero { background: #fff; border: 1px solid #eaeaea; border-radius: 22px; padding: 2.5rem; display: grid; grid-template-columns: 1fr 380px; gap: 2rem; align-items: center; margin-bottom: 2rem; }
  .quiz-hero h1 { margin: 0 0 1rem; font-size: clamp(2.4rem, 3.5vw, 3.75rem); font-family: 'Cormorant Garamond', Georgia, serif; line-height: 1.05; }
  .quiz-hero p { margin: 0; color: #4a4a4a; line-height: 1.9; }
  .quiz-hero .hero-badge { display: inline-flex; align-items: center; gap: 0.55rem; background: #f6f5ff; color: #2e2b8b; border-radius: 999px; padding: 0.55rem 0.95rem; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.14em; }
  .quiz-grid { display: block; }
  .quiz-card, .quiz-results-content { background: #fff; border: 1px solid #e7e7e7; border-radius: 24px; padding: 1.75rem; }
  .quiz-card h2, .quiz-results-content h2 { margin-top: 0; font-size: 1.25rem; letter-spacing: 0.03em; }
  .quiz-progress { display: flex; justify-content: space-between; align-items: center; gap: 1rem; margin-bottom: 1.25rem; }
  .quiz-progress-text { font-size: 0.95rem; font-weight: 700; color: #222; }
  .quiz-progress-track { height: 8px; border-radius: 999px; background: #e9e9e9; overflow: hidden; margin-bottom: 1rem; }
  .quiz-progress-fill { width: 0%; height: 100%; background: #111; transition: width 0.25s ease; }
  .quiz-selected-tags { display: flex; flex-wrap: wrap; gap: 0.6rem; margin-bottom: 1rem; }
  .quiz-tag { background: #f4f4f4; color: #111; padding: 0.55rem 0.9rem; border-radius: 999px; font-size: 0.88rem; border: 1px solid #d7d7d7; }
  .quiz-step { display: none; margin-bottom: 1.75rem; }
  .quiz-step.active { display: block; }
  .quiz-step:last-child { margin-bottom: 0; }
  .quiz-step-label { display: block; font-size: 0.82rem; font-weight: 700; letter-spacing: 0.16em; text-transform: uppercase; color: #8a8a8a; margin-bottom: 0.85rem; }
  .quiz-results-content { display: none; margin-top: 1.75rem; }
  .quiz-results-content.active { display: block; }
  .hidden { display: none !important; }
  .quiz-options { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 0.85rem; }
  .quiz-option { border: 1px solid #d6d6d6; border-radius: 999px; background: #fff; color: #111; padding: 1rem 1.1rem; text-align: center; cursor: pointer; transition: all 0.2s ease; font-weight: 600; }
  .quiz-option:hover { border-color: #0d0d0d; }
  .quiz-option.active { background: #0d0d0d; color: #fff; border-color: #0d0d0d; }
  .quiz-footer { display: flex; flex-direction: column; gap: 1rem; margin-top: 1rem; }
  .btn-primary, .btn-secondary { display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem; border: none; border-radius: 999px; padding: 0.95rem 1.4rem; cursor: pointer; font-weight: 700; transition: background 0.2s ease; }
  .btn-primary { background: #0d0d0d; color: #fff; }
  .btn-primary:hover { background: #111; }
  .btn-secondary { background: #f3f3f3; color: #111; }
  .btn-secondary:hover { background: #e5e5e5; }
  .quiz-summary { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 0.9rem; margin-top: 1.5rem; }
  .quiz-summary-item { background: #faf9ff; border-radius: 14px; padding: 1rem; font-size: 0.9rem; color: #333; }
  .quiz-summary-item span { display: block; margin-top: 0.5rem; color: #6f6f6f; font-size: 0.8rem; }
  .quiz-result-item { background: #f7f7ff; padding: 1rem 1.1rem; border-radius: 16px; border: 1px solid #e6e6ff; }
  .quiz-result-item strong { display: block; margin-bottom: 0.35rem; }
  .quiz-result-item p { margin: 0; color: #555; line-height: 1.55; }
  .quiz-result-note { font-size: 0.86rem; color: #555; line-height: 1.7; margin-top: 1rem; }
  .quiz-result-actions { display: flex; flex-wrap: wrap; gap: 0.75rem; margin-top: 1.2rem; }
  .quiz-result-actions a { width: auto; min-width: 220px; text-align: center; }
  .quiz-products-title { margin: 1rem 0 0.75rem; font-size: 1rem; }
  .quiz-product-card { display: grid; grid-template-columns: 72px 1fr; gap: 0.85rem; align-items: center; padding: 1rem; border-radius: 18px; background: #fff; border: 1px solid #ececec; }
  .quiz-product-card img { width: 72px; height: 72px; object-fit: cover; border-radius: 14px; }
  .quiz-product-info strong { display: block; font-size: 0.95rem; margin-bottom: 0.4rem; }
  .quiz-product-info small { color: #7a7a7a; }
  .quiz-product-cta { display: flex; flex-direction: column; gap: 0.55rem; margin-top: 0.85rem; }
  .quiz-product-cta button { width: 100%; }
  .quiz-warning { color: #b34747; font-size: 0.92rem; margin-top: 1rem; }

  @media (max-width: 980px) {
    .quiz-hero { grid-template-columns: 1fr; }
    .quiz-grid { grid-template-columns: 1fr; }
  }

  @media (max-width: 640px) {
    .quiz-options { grid-template-columns: 1fr; }
    .quiz-summary { grid-template-columns: 1fr; }
  }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <div class="quiz-page">
    <div class="quiz-nav">
      <div class="nav-brand"><a href="/" class="nav-brand-name" style="font-size:1.2rem; font-weight:700;">Parfu.me</a></div>
      <ul class="nav-links">
        <li><a href="/katalog">Produk</a></li>
        <li><a href="/quiz" class="active">Quiz</a></li>
      </ul>
    </div>

    <section class="quiz-hero">
      <div>
        <span class="hero-badge">Quiz Parfum</span>
        <h1>Tentukan parfum terbaik untuk kamu</h1>
        <p>Lakukan quiz singkat ini berdasarkan gender, tujuan, aktivitas, dan lokasi. Di akhir, kamu akan mendapatkan rekomendasi produk yang paling cocok, termasuk opsi refill bila relevan.</p>
      </div>
      <div>
        
      </div>
    </section>

    <div class="quiz-grid">
      <div class="quiz-card">
        <h2>Quiz Parfum</h2>
        <div id="quiz-stage">
          <div class="quiz-progress-track">
            <div class="quiz-progress-fill" id="quiz-progress-fill"></div>
          </div>
          <div class="quiz-selected-tags" id="quiz-selected-tags"></div>
          <div class="quiz-progress">
            <span class="quiz-progress-text" id="quiz-progress-text">Pertanyaan 1 dari 4</span>
            <span class="quiz-progress-step" id="quiz-progress-step">Siapa yang akan menggunakan parfum ini?</span>
          </div>

          <div id="quiz-question-area">
            <div class="quiz-step active" data-question="gender" data-step="0">
            <label class="quiz-step-label">1. Gender</label>
            <div class="quiz-options">
              <button type="button" class="quiz-option" data-value="Wanita">Wanita</button>
              <button type="button" class="quiz-option" data-value="Pria">Pria</button>
              <button type="button" class="quiz-option" data-value="Unisex">Unisex</button>
            </div>
          </div>

          <div class="quiz-step" data-question="purpose" data-step="1">
            <label class="quiz-step-label">2. Untuk apa parfum ini?</label>
            <div class="quiz-options">
              <button type="button" class="quiz-option" data-value="Rumah">Di rumah</button>
              <button type="button" class="quiz-option" data-value="Pesta">Pesta</button>
              <button type="button" class="quiz-option" data-value="Kado">Kado</button>
              <button type="button" class="quiz-option" data-value="Kantor">Kantor</button>
            </div>
          </div>

          <div class="quiz-step" data-question="activity" data-step="2">
            <label class="quiz-step-label">3. Aktivitas kamu nanti</label>
            <div class="quiz-options">
              <button type="button" class="quiz-option" data-value="Santai">Santai</button>
              <button type="button" class="quiz-option" data-value="Hangout">Hangout</button>
              <button type="button" class="quiz-option" data-value="Kencan">Kencan</button>
              <button type="button" class="quiz-option" data-value="Meeting">Meeting</button>
            </div>
          </div>

          <div class="quiz-step" data-question="location" data-step="3">
            <label class="quiz-step-label">4. Lokasi pemakaian</label>
            <div class="quiz-options">
              <button type="button" class="quiz-option" data-value="Rumah">Rumah</button>
              <button type="button" class="quiz-option" data-value="Mall">Mall</button>
              <button type="button" class="quiz-option" data-value="Kantor">Kantor</button>
              <button type="button" class="quiz-option" data-value="Outdoor">Outdoor</button>
            </div>
          </div>

          <div class="quiz-footer">
            <button type="button" class="btn-secondary" id="btn-back" style="display:none;">Kembali</button>
            <button type="button" class="btn-primary" id="btn-next" disabled>Selanjutnya</button>
          </div>
        </div>
      </div>

        <div id="quiz-results-stage" style="display:none;">
          <div id="quiz-results-content" class="quiz-results-content">
            <div class="quiz-result-item">
              <strong>Hasil Quiz</strong>
              <p class="quiz-result-note">Jawaban sudah lengkap. Berikut pilihan parfum yang paling cocok dengan gaya kamu.</p>
            </div>
            <div class="quiz-products-title">Produk Direkomendasikan</div>
            <div id="quiz-results-list"></div>
            <div class="quiz-result-actions">
              <a href="/katalog" class="btn-primary">Lihat Semua Produk</a>
            </div>
          </div>

          <div id="quiz-reset-panel" style="display:none; margin-top:1rem; text-align:center;">
            <button type="button" class="btn-secondary" id="btn-reset-quiz">Ulangi Quiz</button>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
  const QUIZ_PRODUCTS_FALLBACK = [
    { id: 1, name: 'Dynamyst', gender: 'Pria', type: 'Eau de Parfum', variant: 'Citrus, Fresh Accord', size: '30ml', price: 45000, image: '<?php echo e(asset("assets/images/dynamyst.png")); ?>', description: 'Aroma fresh, sporty, dan clean.', best_seller: true },
    { id: 2, name: 'Vanessence', gender: 'Wanita', type: 'Eau de Parfum', variant: 'Vanilla, Fresh Notes', size: '30ml', price: 45000, image: '<?php echo e(asset("assets/images/vanessence.png")); ?>', description: 'Aroma vanilla yang lembut, creamy, dan elegan.', best_seller: true },
    { id: 3, name: 'VS Scandalous (Refill)', gender: 'Unisex', type: 'Refill', variant: 'Raspberry, Pear', size: '15, 35, 50', price: 20000, image: '<?php echo e(asset("assets/images/Nusantara1nobg.png")); ?>', description: 'Aroma fruity manis dan playful.', best_seller: false },
    { id: 4, name: 'VS Romantic Wish (Refill)', gender: 'Unisex', type: 'Refill', variant: 'Mandarin, Red Fruits', size: '15, 35, 51', price: 20000, image: '<?php echo e(asset("assets/images/Nusantara1nobg.png")); ?>', description: 'Aroma romantis, manis, dan elegan.', best_seller: false },
    { id: 5, name: 'Dior Sauvage (Refill)', gender: 'Unisex', type: 'Refill', variant: 'Bergamot, Pepper', size: '15, 35, 52', price: 20000, image: '<?php echo e(asset("assets/images/Nusantara1nobg.png")); ?>', description: 'Aroma fresh spicy dengan karakter maskulin.', best_seller: false },
    { id: 6, name: 'Baccarat Rouge 540', gender: 'Unisex', type: 'Eau de Parfum', variant: 'Saffron, Jasmine', size: '15, 35, 56', price: 20000, image: '<?php echo e(asset("assets/images/Nusantara1nobg.png")); ?>', description: 'Aroma hangat dan mewah amber woody.', best_seller: true },
    { id: 7, name: 'White Musk (The Body Shop)', gender: 'Unisex', type: 'Eau de Toilette / Eau de Parfum', variant: 'Musk, Lily', size: '50ml', price: 20000, image: '<?php echo e(asset("assets/images/Nusantara1nobg.png")); ?>', description: 'Aroma musk clean dan powdery.', best_seller: true },
  ];

  const QUIZ_STATE = {
    gender: null,
    purpose: null,
    activity: null,
    location: null
  };

  let quizProducts = QUIZ_PRODUCTS_FALLBACK;

  function getRecommendationList() {
    if (!QUIZ_STATE.gender) {
      return [];
    }

    const gender = QUIZ_STATE.gender;
    const purpose = QUIZ_STATE.purpose;
    const activity = QUIZ_STATE.activity;
    const location = QUIZ_STATE.location;

    const isRefill = purpose === 'Rumah' || purpose === 'Kantor' || location === 'Rumah' || location === 'Kantor' || activity === 'Santai';
    const isParty = purpose === 'Pesta' || activity === 'Hangout' || activity === 'Kencan';

    const bucket = {
      Wanita: ['Vanessence', 'VS Scandalous (Refill)', 'VS Romantic Wish (Refill)', 'YSL Black Opium'],
      Pria: ['Dynamyst', 'Dior Sauvage (Refill)', 'Aigner Black', 'Versace Eros'],
      Unisex: ['Baccarat Rouge 540', 'White Musk (The Body Shop)', 'VS Scandalous (Refill)', 'Zahrat Hawaii (Al-Rehab)']
    };

    let candidates = bucket[gender] || [];
    if (isRefill) {
      candidates = candidates.filter(name => name.toLowerCase().includes('refill'));
    }
    if (isParty && candidates.length === 0) {
      candidates = bucket[gender].filter(name => !name.toLowerCase().includes('refill'));
    }
    if (!isRefill && candidates.length === 0) {
      candidates = bucket[gender];
    }

    return quizProducts.filter(p => candidates.includes(p.name)).slice(0, 3);
  }

  async function loadQuizProducts() {
    try {
      const data = await window.API.getAll();
      if (Array.isArray(data) && data.length) {
        quizProducts = data.map(p => ({
          id: p.id,
          name: p.name,
          gender: p.gender,
          type: p.type,
          variant: p.variant,
          size: p.size,
          price: p.price,
          image: p.image || '<?php echo e(asset("assets/images/Nusantara1nobg.png")); ?>',
          description: p.description || '',
          best_seller: p.best_seller,
        }));
      }
    } catch {
      quizProducts = QUIZ_PRODUCTS_FALLBACK;
    }
  }

  const STEPS = [
    { question: 'gender', prompt: 'Siapa yang akan menggunakan parfum ini?' },
    { question: 'purpose', prompt: 'Untuk keperluan apa parfum ini?' },
    { question: 'activity', prompt: 'Aktivitas apa yang akan kamu lakukan?' },
    { question: 'location', prompt: 'Dimana kamu akan memakainya?' }
  ];

  let currentStep = 0;

  function updateProgress() {
    const progressText = document.getElementById('quiz-progress-text');
    const progressStep = document.getElementById('quiz-progress-step');
    progressText.textContent = `Pertanyaan ${currentStep + 1} dari ${STEPS.length}`;
    progressStep.textContent = STEPS[currentStep].prompt;
  }

  function showStep(index) {
    currentStep = index;
    document.querySelectorAll('.quiz-step').forEach((step, stepIndex) => {
      step.classList.toggle('active', stepIndex === index);
    });
    document.getElementById('btn-back').style.display = index === 0 ? 'none' : 'inline-flex';
    document.getElementById('btn-next').style.display = 'inline-flex';
    document.getElementById('btn-next').textContent = index === STEPS.length - 1 ? 'Lihat Rekomendasi' : 'Selanjutnya';
    document.getElementById('quiz-results-content').classList.remove('active');
    document.getElementById('quiz-reset-panel').style.display = 'none';
    setNextButtonState();
    updateProgress();
    updateProgressBar();
    updateSelectedTags();
  }

  function updateSelectedTags() {
    const tags = Object.entries(QUIZ_STATE)
      .filter(([, value]) => !!value)
      .map(([, value]) => `<span class="quiz-tag">${value}</span>`)
      .join('');

    document.getElementById('quiz-selected-tags').innerHTML = tags;
  }

  function updateProgressBar() {
    const fill = document.getElementById('quiz-progress-fill');
    const percent = Math.round((currentStep / (STEPS.length - 1)) * 100);
    fill.style.width = `${percent}%`;
  }

  function setNextButtonState() {
    const currentQuestion = STEPS[currentStep].question;
    const isAnswered = !!QUIZ_STATE[currentQuestion];
    const nextButton = document.getElementById('btn-next');
    nextButton.disabled = !isAnswered;
    nextButton.style.opacity = isAnswered ? '1' : '0.6';
  }

  function resetQuiz() {
    QUIZ_STATE.gender = null;
    QUIZ_STATE.purpose = null;
    QUIZ_STATE.activity = null;
    QUIZ_STATE.location = null;
    currentStep = 0;
    document.querySelectorAll('.quiz-option').forEach(button => button.classList.remove('active'));
    document.getElementById('quiz-results-stage').style.display = 'none';
    document.getElementById('quiz-results-content').classList.remove('active');
    document.getElementById('quiz-stage').style.display = 'block';
    document.getElementById('quiz-reset-panel').style.display = 'none';
    document.getElementById('quiz-results-list').innerHTML = '';
    document.getElementById('btn-next').style.display = 'inline-flex';
    showStep(0);
    updateSelectedTags();
  }

  async function displayResults() {
    await loadQuizProducts();
    const productList = getRecommendationList();
    const resultsList = document.getElementById('quiz-results-list');

    if (!productList.length) {
      resultsList.innerHTML = '<div class="quiz-result-item"><p class="quiz-result-note">Belum ada produk yang cocok. Coba ulangi quiz dengan jawaban lain.</p></div>';
    } else {
      resultsList.innerHTML = productList.map(p => {
        const isRefillProduct = p.type.toLowerCase().includes('refill') || p.name.toLowerCase().includes('refill');
        const imageBlock = isRefillProduct
          ? `<div style="padding:1rem; background:#f4f4f4; border-radius:18px; text-align:center; color:#6b6b6b; font-size:0.92rem;">Foto refill belum tersedia</div>`
          : `<img src="${p.image}" alt="${p.name}" onerror="this.src='<?php echo e(asset("assets/images/Nusantara1nobg.png")); ?>'">`;

        return `
          <article class="quiz-product-card">
            ${imageBlock}
            <div class="quiz-product-info">
              <strong>${p.name}</strong>
              <small>${p.type} • ${p.variant}</small>
              <small>${p.size} • ${p.price ? 'Rp ' + Number(p.price).toLocaleString('id-ID') : 'Harga mulai dari 20rb'}</small>
            </div>
          </article>
        `;
      }).join('');
    }

    document.getElementById('quiz-stage').style.display = 'none';
    document.getElementById('quiz-results-stage').style.display = 'block';
    document.getElementById('quiz-results-content').classList.add('active');
    document.getElementById('quiz-reset-panel').style.display = 'block';
    document.getElementById('btn-next').style.display = 'none';
    document.getElementById('btn-back').style.display = 'none';
  }

  function stepOptionSelected(button) {
    const question = button.closest('.quiz-step')?.getAttribute('data-question');
    if (!question) return;
    QUIZ_STATE[question] = button.getAttribute('data-value');
    button.closest('.quiz-step').querySelectorAll('.quiz-option').forEach(item => item.classList.remove('active'));
    button.classList.add('active');
    setNextButtonState();
    updateSelectedTags();
  }

  document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.quiz-step .quiz-option').forEach(button => {
      button.addEventListener('click', () => stepOptionSelected(button));
    });

    document.getElementById('btn-next').addEventListener('click', async () => {
      if (currentStep < STEPS.length - 1) {
        showStep(currentStep + 1);
        return;
      }

      await displayResults();
    });

    document.getElementById('btn-back').addEventListener('click', () => {
      if (document.getElementById('quiz-results-content').classList.contains('active')) {
        return;
      }
      if (currentStep > 0) showStep(currentStep - 1);
    });

    document.getElementById('btn-reset-quiz').addEventListener('click', resetQuiz);

    showStep(0);
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\Perfu.me\resources\views/quiz.blade.php ENDPATH**/ ?>