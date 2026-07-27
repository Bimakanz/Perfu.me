/**
 * splash.js — Typewriter Intro & Slide-Up Curtain Exit
 * Perfu.me E-Commerce Platform
 */

(function () {
  const textToType = 'Parfu.me';
  const SPLASH_KEY = 'perfume_splash_shown';
  let charIndex = 0;

  function skipSplash() {
    const splash = document.getElementById('splash');
    if (splash) splash.style.display = 'none';
  }

  function runSplash() {
    const splash = document.getElementById('splash');
    const typingEl = document.getElementById('splash-typing');
    const sloganEl = document.getElementById('splash-slogan');
    const cursor = document.querySelector('.typing-cursor');

    if (!splash || !typingEl) return;

    // Mark as shown for this session
    sessionStorage.setItem(SPLASH_KEY, '1');

    // Reset element text
    typingEl.textContent = '';

    // 1. Typewriter effect for Parfu.me
    function typeNextChar() {
      if (charIndex < textToType.length) {
        typingEl.textContent += textToType.charAt(charIndex);
        charIndex++;
        setTimeout(typeNextChar, 100);
      } else {
        // Hide blinking cursor after typing completes
        if (cursor) cursor.style.display = 'none';

        // 2. Reveal slogan "smell good, feel confident"
        setTimeout(() => {
          if (sloganEl) sloganEl.classList.add('show');

          // 3. Slide up curtain exit to reveal Hero section
          setTimeout(() => {
            splash.classList.add('slide-up');
            setTimeout(() => {
              splash.style.display = 'none';
            }, 800);
          }, 800);
        }, 200);
      }
    }

    // Start typing after short initial delay
    setTimeout(typeNextChar, 200);
  }

  function init() {
    // If splash already shown in this session, skip it instantly
    if (sessionStorage.getItem(SPLASH_KEY)) {
      skipSplash();
    } else {
      runSplash();
    }
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
