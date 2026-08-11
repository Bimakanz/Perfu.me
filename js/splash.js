/**
 * splash.js — Typewriter Intro & Slide-Up Curtain Exit
 * Perfu.me E-Commerce Platform
 */

(function () {
  const textToType = 'Perfu.me';
  let charIndex = 0;

  function runSplash() {
    const splash = document.getElementById('splash');
    const typingEl = document.getElementById('splash-typing');
    const sloganEl = document.getElementById('splash-slogan');
    const cursor = document.querySelector('.typing-cursor');

    if (!splash || !typingEl) return;

    // Reset element text
    typingEl.textContent = '';
    charIndex = 0;

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

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', runSplash);
  } else {
    runSplash();
  }
})();
