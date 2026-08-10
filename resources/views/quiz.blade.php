@extends('layouts.app')

@section('title', 'Scent Finder Quiz — Parfu.me')
@section('description', 'Temukan parfum terbaik untuk karakter Anda melalui 5 pertanyaan simpel dari Parfu.me.')

@section('styles')
  <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
  <style>
    body {
      background-color: #FAFAFA;
      color: #0D0D0D;
    }

    /* Always Visible Navbar Fix for Quiz */
    #navbar {
      display: flex !important;
      opacity: 1 !important;
      visibility: visible !important;
      transform: translateY(0) !important;
      pointer-events: auto !important;
      background: rgba(255, 255, 255, 0.98) !important;
      backdrop-filter: blur(14px) !important;
      -webkit-backdrop-filter: blur(14px) !important;
      border-bottom: 1px solid rgba(0, 0, 0, 0.08) !important;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04) !important;
      position: fixed !important;
      top: 0 !important;
      left: 0 !important;
      right: 0 !important;
      z-index: 1000 !important;
    }

    .quiz-hero-header {
      text-align: center;
      padding: 8rem 1.5rem 1rem;
      max-width: 800px;
      margin: 0 auto 3rem;
    }

    .quiz-badge {
      display: inline-block;
      font-size: 0.72rem;
      font-weight: 700;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      color: #8A8A8A;
      margin-bottom: 0.1rem;
    }

    .quiz-title {
      font-family: 'Cormorant Garamond', Georgia, serif;
      font-size: clamp(2.4rem, 4vw, 3.6rem);
      font-weight: 300;
      color: #0D0D0D;
      line-height: 1.15;
      margin-bottom: 1rem;
    }

    .quiz-subtitle {
      font-size: 0.98rem;
      color: #555555;
      line-height: 1.7;
      max-width: 600px;
      margin: 0 auto 1.5rem;
    }

    /* Seamless Quiz Container (No Box / No Card) */
    .quiz-main-container {
      max-width: 800px;
      margin: 0 auto 6rem;
      padding: 0 1.5rem;
      transition: max-width 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .quiz-main-container.wide-results {
      max-width: 1200px;
    }

    /* Progress Bar */
    .quiz-progress-wrap {
      margin-bottom: 3.5rem;
      max-width: 680px;
      margin-left: auto;
      margin-right: auto;
    }

    .quiz-progress-bar-bg {
      height: 5px;
      background: #E5E5E7;
      border-radius: 999px;
      overflow: hidden;
      margin-bottom: 0.75rem;
    }

    .quiz-progress-fill {
      height: 100%;
      width: 20%;
      background: #0D0D0D;
      border-radius: 999px;
      transition: width 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .quiz-progress-info {
      display: flex;
      justify-content: space-between;
      font-size: 0.8rem;
      font-weight: 600;
      color: #8A8A8A;
      letter-spacing: 0.05em;
    }

    /* Question Item */
    .question-block {
      display: none;
      animation: fadeInQuestion 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    .question-block.active {
      display: block;
    }

    @keyframes fadeInQuestion {
      from {
        opacity: 0;
        transform: translateY(10px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .question-text {
      font-family: 'Cormorant Garamond', Georgia, serif;
      font-size: clamp(1.8rem, 3vw, 2.4rem);
      font-weight: 400;
      color: #0D0D0D;
      text-align: center;
      line-height: 1.35;
      margin-bottom: 3.5rem;
    }

    /* Personality Scale (16personalities Circle Slider Style) */
    .scale-wrapper {
      display: flex;
      align-items: center;
      justify-content: space-between;
      max-width: 680px;
      margin: 0 auto;
      gap: 1rem;
      user-select: none;
    }

    .scale-label {
      font-size: 0.85rem;
      font-weight: 700;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      white-space: nowrap;
    }

    .scale-label.agree {
      color: #10B981;
    }

    .scale-label.disagree {
      color: #8B5CF6;
    }

    .scale-circles-group {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 1.1rem;
      flex: 1;
    }

    .scale-circle-btn {
      border-radius: 50%;
      background: transparent;
      cursor: pointer;
      transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
      display: inline-flex;
      align-items: center;
      justify-content: center;
      position: relative;
      padding: 0;
    }

    /* Circles Sizes */
    .scale-circle-btn.size-large {
      width: 54px;
      height: 54px;
    }

    .scale-circle-btn.size-medium {
      width: 44px;
      height: 44px;
    }

    .scale-circle-btn.size-small {
      width: 34px;
      height: 34px;
    }

    .scale-circle-btn.size-neutral {
      width: 28px;
      height: 28px;
    }

    /* Agree Circles (Green Theme) */
    .scale-circle-btn.agree-type {
      border: 2.5px solid #10B981;
    }

    .scale-circle-btn.agree-type:hover,
    .scale-circle-btn.agree-type.selected {
      background: #10B981;
      box-shadow: 0 4px 14px rgba(16, 185, 129, 0.4);
      transform: scale(1.12);
    }

    /* Neutral Circle (Grey Theme) */
    .scale-circle-btn.neutral-type {
      border: 2px solid #A1A1AA;
    }

    .scale-circle-btn.neutral-type:hover,
    .scale-circle-btn.neutral-type.selected {
      background: #71717A;
      border-color: #71717A;
      box-shadow: 0 4px 14px rgba(113, 113, 122, 0.35);
      transform: scale(1.12);
    }

    /* Disagree Circles (Purple Theme) */
    .scale-circle-btn.disagree-type {
      border: 2.5px solid #8B5CF6;
    }

    .scale-circle-btn.disagree-type:hover,
    .scale-circle-btn.disagree-type.selected {
      background: #8B5CF6;
      box-shadow: 0 4px 14px rgba(139, 92, 246, 0.4);
      transform: scale(1.12);
    }

    /* Quiz Navigation Controls */
    .quiz-actions-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 4rem;
      padding-top: 2rem;
      border-top: 1px solid #E5E5E7;
      max-width: 680px;
      margin-left: auto;
      margin-right: auto;
    }

    .btn-quiz-prev {
      background: transparent;
      border: none;
      font-size: 0.82rem;
      font-weight: 700;
      letter-spacing: 0.15em;
      text-transform: uppercase;
      color: #8A8A8A;
      cursor: pointer;
      transition: color 0.2s;
    }

    .btn-quiz-prev:hover:not(:disabled) {
      color: #0D0D0D;
    }

    .btn-quiz-prev:disabled {
      opacity: 0.3;
      cursor: not-allowed;
    }

    .btn-quiz-next {
      padding: 0.85rem 2.2rem;
      background: #0D0D0D;
      color: #FFFFFF;
      border: none;
      border-radius: 999px;
      font-size: 0.85rem;
      font-weight: 700;
      letter-spacing: 0.08em;
      cursor: pointer;
      transition: all 0.25s ease;
    }

    .btn-quiz-next:hover:not(:disabled) {
      background: #252525;
      transform: translateY(-1px);
      box-shadow: 0 4px 14px rgba(0, 0, 0, 0.15);
    }

    .btn-quiz-next:disabled {
      background: #E4E4E7;
      color: #A1A1AA;
      cursor: not-allowed;
    }

    /* Results Section */
    .quiz-results-wrapper {
      display: none;
      animation: fadeInQuestion 0.5s ease forwards;
    }

    .quiz-results-wrapper.active {
      display: block;
    }

    .results-header {
      text-align: center;
      margin-bottom: 3.5rem;
    }

    .results-subtitle {
      font-size: 0.75rem;
      font-weight: 700;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      color: #8A8A8A;
      margin-bottom: 0.5rem;
    }

    .results-title {
      font-family: 'Cormorant Garamond', Georgia, serif;
      font-size: 2.6rem;
      font-weight: 300;
      color: #0D0D0D;
      margin: 0 0 0.5rem;
    }

    .results-desc {
      font-size: 0.95rem;
      color: #555555;
      max-width: 550px;
      margin: 0 auto;
    }

    /* Recommendation Cards Grid */
    .results-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 2rem;
      margin-bottom: 3.5rem;
    }

    .rec-card {
      background: #FFFFFF;
      border: 1px solid #E5E5E5;
      border-radius: 16px;
      overflow: hidden;
      display: flex;
      flex-direction: column;
      transition: box-shadow 0.3s cubic-bezier(0.16, 1, 0.3, 1);
      position: relative;
    }

    .rec-card:hover {
      box-shadow: 0 14px 40px rgba(0, 0, 0, 0.08);
    }

    .rec-match-badge {
      position: absolute;
      top: 0.85rem;
      right: 0.85rem;
      background: rgba(13, 13, 13, 0.9);
      color: #FFFFFF;
      font-size: 0.72rem;
      font-weight: 700;
      padding: 0.4rem 0.75rem;
      border-radius: 999px;
      letter-spacing: 0.05em;
      z-index: 2;
      backdrop-filter: blur(4px);
    }

    .rec-img-wrap {
      width: 100%;
      padding-top: 90%;
      position: relative;
      background: #F4F4F5;
      overflow: hidden;
    }

    .rec-img-wrap img {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .rec-card:hover .rec-img-wrap img {
      transform: scale(1.05);
    }

    .rec-card-body {
      padding: 1.5rem 1.75rem;
      display: flex;
      flex-direction: column;
      flex: 1;
    }

    .rec-card-tag {
      font-size: 0.68rem;
      font-weight: 700;
      letter-spacing: 0.14em;
      text-transform: uppercase;
      color: #8A8A8A;
      margin-bottom: 0.4rem;
    }

    .rec-card-name {
      font-size: 1.25rem;
      font-weight: 700;
      color: #0D0D0D;
      margin-bottom: 0.6rem;
      position: relative;
      width: fit-content;
      max-width: 100%;
    }

    .rec-card-name::after {
      content: '';
      position: absolute;
      bottom: -2px;
      left: 0;
      width: 100%;
      height: 1.5px;
      background-color: #0D0D0D;
      transform: scaleX(0);
      transform-origin: left;
      transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .rec-card:hover .rec-card-name::after {
      transform: scaleX(1);
    }

    .rec-card-notes {
      font-size: 0.78rem;
      color: #666666;
      margin-bottom: 1rem;
      line-height: 1.5;
    }

    .rec-card-price {
      font-size: 0.95rem;
      font-weight: 700;
      color: #0D0D0D;
      margin-top: auto;
      margin-bottom: 1rem;
    }

    .rec-btn-detail {
      display: block;
      width: 100%;
      padding: 0.75rem;
      background: #0D0D0D;
      color: #FFFFFF;
      border: none;
      border-radius: 8px;
      font-size: 0.82rem;
      font-weight: 700;
      text-align: center;
      text-decoration: none;
      transition: background 0.2s;
    }

    .rec-btn-detail:hover {
      background: #252525;
    }

    .btn-retake-quiz {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      padding: 0.85rem 1.75rem;
      background: transparent;
      border: 1.5px solid #0D0D0D;
      border-radius: 999px;
      font-size: 0.85rem;
      font-weight: 700;
      color: #0D0D0D;
      cursor: pointer;
      transition: all 0.2s;
    }

    .btn-retake-quiz:hover {
      background: #0D0D0D;
      color: #FFFFFF;
    }

    @media (max-width: 860px) {
      .results-grid {
        grid-template-columns: repeat(1, 1fr);
      }

      .scale-wrapper {
        flex-direction: column;
        gap: 1.5rem;
      }
    }
  </style>
@endsection

@section('content')
  {{-- NAVBAR --}}
  <nav id="navbar" aria-label="Main Navigation">
    <div class="nav-brand" data-nav="home">
      <a href="/" style="text-decoration:none; color:inherit;"><span class="nav-brand-name">Parfu.me</span></a>
    </div>

    <ul class="nav-links">
      <li><a href="/katalog">Katalog</a></li>
      <li><a href="/quiz" class="active">Quiz</a></li>
      <li><a href="/#about-story-section">Tentang</a></li>
      <li><a href="/#testimoni-section">Testimoni</a></li>
      <li><a href="#footer-section">Kontak</a></li>
    </ul>

    <div class="nav-actions">
      <button id="btn-open-search" class="nav-icon-btn" aria-label="Cari Parfum" title="Cari Parfum">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
          stroke-linecap="round" stroke-linejoin="round">
          <circle cx="11" cy="11" r="8"></circle>
          <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
      </button>
      <button id="btn-open-cart" class="nav-icon-btn" aria-label="Keranjang Belanja" title="Keranjang Belanja">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
          stroke-linecap="round" stroke-linejoin="round">
          <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
          <line x1="3" y1="6" x2="21" y2="6"></line>
          <path d="M16 10a4 4 0 0 1-8 0"></path>
        </svg>
        <span class="cart-badge-count" id="cart-badge-count">0</span>
      </button>
    </div>
  </nav>

  {{-- Header --}}
  <header class="quiz-hero-header" id="quiz-hero-header">
    <h1 class="quiz-title" id="quiz-hero-title">Temukan Aroma Parfum Anda</h1>
    <p class="quiz-subtitle" id="quiz-hero-subtitle">
      Jawab 5 pertanyaan simpel di bawah ini untuk menemukan varian parfum Parfu.me yang paling cocok dengan selera & gaya Anda.
    </p>
  </header>

  {{-- Main Seamless Quiz Box --}}
  <main class="quiz-main-container">

    {{-- Stage 1: Active Questions --}}
    <div id="quiz-active-stage">
      {{-- Progress Bar --}}
      <div class="quiz-progress-wrap">
        <div class="quiz-progress-bar-bg">
          <div class="quiz-progress-fill" id="quiz-progress-fill"></div>
        </div>
        <div class="quiz-progress-info">
          <span id="quiz-step-indicator">Pertanyaan 1 dari 5</span>
          <span id="quiz-progress-percent">20%</span>
        </div>
      </div>

      {{-- Question 1 --}}
      <div class="question-block active" data-step="1">
        <div class="question-text">
          "Saya suka bau yang manis dan hangat."
        </div>
        <div class="scale-wrapper">
          <span class="scale-label agree">SETUJU</span>
          <div class="scale-circles-group" data-question="1">
            <button type="button" class="scale-circle-btn size-large agree-type" data-score="3"
              title="Sangat Setuju"></button>
            <button type="button" class="scale-circle-btn size-medium agree-type" data-score="2" title="Setuju"></button>
            <button type="button" class="scale-circle-btn size-small agree-type" data-score="1"
              title="Agak Setuju"></button>
            <button type="button" class="scale-circle-btn size-neutral neutral-type" data-score="0"
              title="Netral"></button>
            <button type="button" class="scale-circle-btn size-small disagree-type" data-score="-1"
              title="Agak Tidak Setuju"></button>
            <button type="button" class="scale-circle-btn size-medium disagree-type" data-score="-2"
              title="Tidak Setuju"></button>
            <button type="button" class="scale-circle-btn size-large disagree-type" data-score="-3"
              title="Sangat Tidak Setuju"></button>
          </div>
          <span class="scale-label disagree">TIDAK SETUJU</span>
        </div>
      </div>

      {{-- Question 2 --}}
      <div class="question-block" data-step="2">
        <div class="question-text">
          "Saya sering beraktivitas di luar ruangan (outdoor)."
        </div>
        <div class="scale-wrapper">
          <span class="scale-label agree">SETUJU</span>
          <div class="scale-circles-group" data-question="2">
            <button type="button" class="scale-circle-btn size-large agree-type" data-score="3"
              title="Sangat Setuju"></button>
            <button type="button" class="scale-circle-btn size-medium agree-type" data-score="2" title="Setuju"></button>
            <button type="button" class="scale-circle-btn size-small agree-type" data-score="1"
              title="Agak Setuju"></button>
            <button type="button" class="scale-circle-btn size-neutral neutral-type" data-score="0"
              title="Netral"></button>
            <button type="button" class="scale-circle-btn size-small disagree-type" data-score="-1"
              title="Agak Tidak Setuju"></button>
            <button type="button" class="scale-circle-btn size-medium disagree-type" data-score="-2"
              title="Tidak Setuju"></button>
            <button type="button" class="scale-circle-btn size-large disagree-type" data-score="-3"
              title="Sangat Tidak Setuju"></button>
          </div>
          <span class="scale-label disagree">TIDAK SETUJU</span>
        </div>
      </div>

      {{-- Question 3 --}}
      <div class="question-block" data-step="3">
        <div class="question-text">
          "Saya lebih menyukai wangi bunga dan alam yang segar."
        </div>
        <div class="scale-wrapper">
          <span class="scale-label agree">SETUJU</span>
          <div class="scale-circles-group" data-question="3">
            <button type="button" class="scale-circle-btn size-large agree-type" data-score="3"
              title="Sangat Setuju"></button>
            <button type="button" class="scale-circle-btn size-medium agree-type" data-score="2" title="Setuju"></button>
            <button type="button" class="scale-circle-btn size-small agree-type" data-score="1"
              title="Agak Setuju"></button>
            <button type="button" class="scale-circle-btn size-neutral neutral-type" data-score="0"
              title="Netral"></button>
            <button type="button" class="scale-circle-btn size-small disagree-type" data-score="-1"
              title="Agak Tidak Setuju"></button>
            <button type="button" class="scale-circle-btn size-medium disagree-type" data-score="-2"
              title="Tidak Setuju"></button>
            <button type="button" class="scale-circle-btn size-large disagree-type" data-score="-3"
              title="Sangat Tidak Setuju"></button>
          </div>
          <span class="scale-label disagree">TIDAK SETUJU</span>
        </div>
      </div>

      {{-- Question 4 --}}
      <div class="question-block" data-step="4">
        <div class="question-text">
          "Saya butuh parfum eksklusif untuk acara formal atau pesta."
        </div>
        <div class="scale-wrapper">
          <span class="scale-label agree">SETUJU</span>
          <div class="scale-circles-group" data-question="4">
            <button type="button" class="scale-circle-btn size-large agree-type" data-score="3"
              title="Sangat Setuju"></button>
            <button type="button" class="scale-circle-btn size-medium agree-type" data-score="2" title="Setuju"></button>
            <button type="button" class="scale-circle-btn size-small agree-type" data-score="1"
              title="Agak Setuju"></button>
            <button type="button" class="scale-circle-btn size-neutral neutral-type" data-score="0"
              title="Netral"></button>
            <button type="button" class="scale-circle-btn size-small disagree-type" data-score="-1"
              title="Agak Tidak Setuju"></button>
            <button type="button" class="scale-circle-btn size-medium disagree-type" data-score="-2"
              title="Tidak Setuju"></button>
            <button type="button" class="scale-circle-btn size-large disagree-type" data-score="-3"
              title="Sangat Tidak Setuju"></button>
          </div>
          <span class="scale-label disagree">TIDAK SETUJU</span>
        </div>
      </div>

      {{-- Question 5 --}}
      <div class="question-block" data-step="5">
        <div class="question-text">
          "Saya lebih suka parfum yang praktis dan mudah dibawa kemana-mana."
        </div>
        <div class="scale-wrapper">
          <span class="scale-label agree">SETUJU</span>
          <div class="scale-circles-group" data-question="5">
            <button type="button" class="scale-circle-btn size-large agree-type" data-score="3"
              title="Sangat Setuju"></button>
            <button type="button" class="scale-circle-btn size-medium agree-type" data-score="2" title="Setuju"></button>
            <button type="button" class="scale-circle-btn size-small agree-type" data-score="1"
              title="Agak Setuju"></button>
            <button type="button" class="scale-circle-btn size-neutral neutral-type" data-score="0"
              title="Netral"></button>
            <button type="button" class="scale-circle-btn size-small disagree-type" data-score="-1"
              title="Agak Tidak Setuju"></button>
            <button type="button" class="scale-circle-btn size-medium disagree-type" data-score="-2"
              title="Tidak Setuju"></button>
            <button type="button" class="scale-circle-btn size-large disagree-type" data-score="-3"
              title="Sangat Tidak Setuju"></button>
          </div>
          <span class="scale-label disagree">TIDAK SETUJU</span>
        </div>
      </div>

      {{-- Navigation Actions --}}
      <div class="quiz-actions-row">
        <button type="button" class="btn-quiz-prev" id="btn-quiz-prev" disabled>KEMBALI</button>
        <button type="button" class="btn-quiz-next" id="btn-quiz-next" disabled>SELANJUTNYA</button>
      </div>
    </div>

    {{-- Stage 2: Results Display --}}
    <div id="quiz-results-stage" class="quiz-results-wrapper">
      <div class="results-grid" id="results-grid-container">
        {{-- Dynamically populated via JS matching DB products --}}
      </div>

      <div style="text-align: center; margin-top: 2rem;">
        <button type="button" class="btn-retake-quiz" onclick="resetQuiz()">
          Ulangi Quiz
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="1 4 1 10 7 10"></polyline>
            <path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"></path>
          </svg>
        </button>
      </div>
    </div>

  </main>
@endsection

@section('scripts')
  <script>
    // Products Database passed from Laravel PHP
    const DB_PRODUCTS = @json(\App\Models\Product::all());

    let currentStep = 1;
    const totalSteps = 5;
    const userAnswers = {};

    document.addEventListener('DOMContentLoaded', () => {
      initCirclesSelection();
      initNavigation();
    });

    function initCirclesSelection() {
      const groups = document.querySelectorAll('.scale-circles-group');
      groups.forEach(group => {
        const qNum = group.getAttribute('data-question');
        const btns = group.querySelectorAll('.scale-circle-btn');

        btns.forEach(btn => {
          btn.addEventListener('click', () => {
            btns.forEach(b => b.classList.remove('selected'));
            btn.classList.add('selected');

            userAnswers[qNum] = parseInt(btn.getAttribute('data-score'));
            document.getElementById('btn-quiz-next').disabled = false;
          });
        });
      });
    }

    function initNavigation() {
      const btnNext = document.getElementById('btn-quiz-next');
      const btnPrev = document.getElementById('btn-quiz-prev');

      btnNext.addEventListener('click', () => {
        if (currentStep < totalSteps) {
          currentStep++;
          updateQuestionStep();
        } else {
          calculateDatabaseMatches();
        }
      });

      btnPrev.addEventListener('click', () => {
        if (currentStep > 1) {
          currentStep--;
          updateQuestionStep();
        }
      });
    }

    function updateQuestionStep() {
      // Hide all questions
      document.querySelectorAll('.question-block').forEach(b => b.classList.remove('active'));

      // Show active question
      const activeBlock = document.querySelector(`.question-block[data-step="${currentStep}"]`);
      if (activeBlock) activeBlock.classList.add('active');

      // Update Progress
      const fillPercent = (currentStep / totalSteps) * 100;
      document.getElementById('quiz-progress-fill').style.width = fillPercent + '%';
      document.getElementById('quiz-step-indicator').textContent = `Pertanyaan ${currentStep} dari ${totalSteps}`;
      document.getElementById('quiz-progress-percent').textContent = `${Math.round(fillPercent)}%`;

      // Toggle Prev Button
      document.getElementById('btn-quiz-prev').disabled = (currentStep === 1);

      // Toggle Next Button
      const btnNext = document.getElementById('btn-quiz-next');
      if (btnNext) {
        btnNext.disabled = (userAnswers[currentStep] === undefined);
        btnNext.textContent = (currentStep === totalSteps) ? 'LIHAT HASIL REKOMENDASI' : 'SELANJUTNYA';
      }
    }

    function calculateDatabaseMatches() {
      const a1 = userAnswers[1] || 0; // Bau manis & hangat
      const a2 = userAnswers[2] || 0; // Aktivitas outdoor / woody & spicy
      const a3 = userAnswers[3] || 0; // Floral / segar
      const a4 = userAnswers[4] || 0; // Signature / formal
      const a5 = userAnswers[5] || 0; // Refill / praktis / roll-on

      // Score each product in DB
      const scoredProducts = DB_PRODUCTS.map(p => {
        let score = 50; // Base score

        const name = p.name.toLowerCase();
        const variant = (p.variant || '').toLowerCase();
        const top = (p.top_notes || '').toLowerCase();
        const mid = (p.middle_notes || '').toLowerCase();
        const base = (p.base_notes || '').toLowerCase();
        const type = (p.type || '').toLowerCase();

        // Q1: Manis & Warm (Vanilla, Gourmand)
        if (variant.includes('vanilla') || top.includes('vanilla') || mid.includes('vanilla') || base.includes('vanilla') || variant.includes('gourmand')) {
          score += a1 * 12;
        }
        // Q2: Outdoor (Woody, Spicy, Rempah)
        if (variant.includes('woody') || variant.includes('spicy') || variant.includes('rempah') || top.includes('spicy') || base.includes('woody')) {
          score += a2 * 12;
        }
        // Q3: Bunga & Segar (Floral, Fresh)
        if (variant.includes('floral') || variant.includes('fresh') || top.includes('fresh') || mid.includes('floral') || mid.includes('rose') || top.includes('anise')) {
          score += a3 * 12;
        }
        // Q4: Eksklusif & Formal (Signature)
        if (type.includes('signature') || name.includes('dynamyst') || name.includes('vanessence')) {
          score += a4 * 10;
        }
        // Q5: Praktis (Refill, Roll-On)
        if (type.includes('refill') || type.includes('roll-on') || name.includes('roll-on')) {
          score += a5 * 10;
        }

        // Add a little deterministic variation so scores are distinct
        score += (p.id * 3) % 7;

        // Clamp percentage between 82% and 99%
        let matchPercent = Math.min(99, Math.max(82, Math.round(score)));

        return { ...p, matchPercent };
      });

      // Sort descending by match score
      scoredProducts.sort((a, b) => b.matchPercent - a.matchPercent);
      const top3 = scoredProducts.slice(0, 3);

      // Hide stage 1 & show stage 2
      document.getElementById('quiz-active-stage').style.display = 'none';
      const resultsStage = document.getElementById('quiz-results-stage');
      resultsStage.classList.add('active');

      // In-Place Header Text Replacement (No extra spacing / no scrolling needed)
      const heroTitle = document.getElementById('quiz-hero-title');
      const heroSubtitle = document.getElementById('quiz-hero-subtitle');
      if (heroTitle) heroTitle.textContent = 'Rekomendasi Parfum Paling Cocok Untuk Anda';
      if (heroSubtitle) heroSubtitle.textContent = 'Berdasarkan pilihan Anda, berikut adalah 3 varian parfum Parfu.me yang paling cocok dengan karakter & kebutuhan Anda:';

      // Widen container for cards
      document.querySelector('.quiz-main-container')?.classList.add('wide-results');

      // Render Grid Cards
      const container = document.getElementById('results-grid-container');
      container.innerHTML = top3.map(p => {
        const isSig = (p.type || '').toLowerCase() === 'signature' || p.name.toLowerCase().includes('dynamyst') || p.name.toLowerCase().includes('vanessence');
        const priceText = isSig ? `Rp ${Number(p.price).toLocaleString('id-ID')}` : 'Rp 45.000 (35ml)';

        return `
          <div class="rec-card">
            <div class="rec-match-badge">${p.matchPercent}% MATCH</div>
            <div class="rec-img-wrap">
              <img src="${p.image}" alt="${p.name}" onerror="this.src='/assets/images/refill.webp'">
            </div>
            <div class="rec-card-body">
              <div class="rec-card-tag">${p.type} • ${p.gender}</div>
              <div class="rec-card-name">${p.name}</div>
              <div class="rec-card-notes">
                <strong>Varian:</strong> ${p.variant}<br>
                <strong>Top Notes:</strong> ${p.top_notes || '-'}<br>
                <strong>Base Notes:</strong> ${p.base_notes || '-'}
              </div>
              <div class="rec-card-price">${priceText}</div>
              <a href="/produk/${p.id}" class="rec-btn-detail">Lihat Detail Produk</a>
            </div>
          </div>
        `;
      }).join('');
    }

    function resetQuiz() {
      currentStep = 1;
      for (let k in userAnswers) delete userAnswers[k];

      // Reset Hero Header Text back to original
      const heroTitle = document.getElementById('quiz-hero-title');
      const heroSubtitle = document.getElementById('quiz-hero-subtitle');
      if (heroTitle) heroTitle.textContent = 'Temukan Aroma Parfum Anda';
      if (heroSubtitle) heroSubtitle.textContent = 'Jawab 5 pertanyaan simpel di bawah ini untuk menemukan varian parfum Parfu.me yang paling cocok dengan selera & gaya Anda.';

      document.querySelector('.quiz-main-container')?.classList.remove('wide-results');
      document.querySelectorAll('.scale-circle-btn').forEach(b => b.classList.remove('selected'));
      document.getElementById('quiz-results-stage').classList.remove('active');
      document.getElementById('quiz-active-stage').style.display = 'block';

      updateQuestionStep();
    }
  </script>
@endsection