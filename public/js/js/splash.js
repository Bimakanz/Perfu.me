/**
 * splash.js — Splash Screen Controller with Curtain Slide Up Exit
 * Perfu.me E-Commerce Platform
 */

(function () {
  const DURATION = 2200; // ms display duration

  function initSplash() {
    const splash = document.getElementById('splash');
    if (!splash) return;

    // Lock body scroll while splash is active
    document.body.style.overflow = 'hidden';

    setTimeout(() => {
      // Trigger slide-up curtain exit
      splash.classList.add('slide-up');
      document.body.style.overflow = '';

      // Clean up after slide animation finishes (900ms)
      setTimeout(() => {
        splash.style.display = 'none';
        triggerRevealCheck();
      }, 900);
    }, DURATION);
  }

  function triggerRevealCheck() {
    const reveals = document.querySelectorAll('.reveal');
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach(e => {
          if (e.isIntersecting) {
            e.target.classList.add('visible');
            observer.unobserve(e.target);
          }
        });
      },
      { threshold: 0.12 }
    );
    reveals.forEach(el => observer.observe(el));
  }

  document.addEventListener('DOMContentLoaded', () => {
    initSplash();
  });

  window.triggerRevealCheck = triggerRevealCheck;
})();
