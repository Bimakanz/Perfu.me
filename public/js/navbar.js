/**
 * navbar.js — Scroll-triggered Glassmorphism Navbar
 * Perfu.me E-Commerce Platform
 */

(function () {
  function init() {
    const navbar = document.getElementById('navbar');
    if (!navbar) return;

    const THRESHOLD = window.innerHeight * 0.85;

    function onScroll() {
      if (window.scrollY > THRESHOLD) {
        navbar.classList.add('scrolled');
      } else {
        navbar.classList.remove('scrolled');
      }
    }

    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll(); // Initial check

    // Smooth navigate to section
    document.querySelectorAll('[data-nav]').forEach(el => {
      el.addEventListener('click', () => {
        const target = el.getAttribute('data-nav');
        if (target === 'catalog') {
          window.router && window.router.navigate('catalog');
        } else if (target === 'home') {
          window.router && window.router.navigate('home');
          setTimeout(() => window.scrollTo({ top: 0, behavior: 'smooth' }), 50);
        } else if (target === 'admin') {
          window.location.href = 'admin/index.html';
        } else {
          const section = document.getElementById(target);
          section && section.scrollIntoView({ behavior: 'smooth' });
        }
      });
    });
  }

  document.addEventListener('DOMContentLoaded', init);
})();
