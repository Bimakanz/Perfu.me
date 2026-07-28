/**
 * navbar.js — Smooth Scroll & Sticky Glassmorphism Navbar
 * Perfu.me E-Commerce Platform
 */

(function () {
  function initNavbar() {
    const navbar = document.getElementById('navbar');
    if (!navbar) return;

    // If page doesn't have a hero section (e.g. Katalog page), always show navbar immediately
    const hasHero = !!document.getElementById('hero');

    function onScroll() {
      if (!hasHero || window.scrollY > 200) {
        navbar.classList.add('scrolled');
      } else {
        navbar.classList.remove('scrolled');
      }
    }

    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    // Smooth Scroll Click Handlers
    document.querySelectorAll('[data-nav]').forEach(el => {
      el.addEventListener('click', (e) => {
        const targetId = el.getAttribute('data-nav');

        if (targetId === 'admin') {
          window.location.href = 'admin/index.html';
          return;
        }

        e.preventDefault();
        const targetEl = document.getElementById(targetId) || document.querySelector(`[data-section="${targetId}"]`);

        if (targetEl) {
          const navHeight = navbar.offsetHeight || 70;
          const targetPos = targetEl.getBoundingClientRect().top + window.scrollY - navHeight;
          window.scrollTo({ top: targetPos, behavior: 'smooth' });
        } else if (targetId === 'home') {
          window.scrollTo({ top: 0, behavior: 'smooth' });
        }
      });
    });
  }

  document.addEventListener('DOMContentLoaded', initNavbar);
})();
