/**
 * navbar.js — Smooth Scroll, Sticky Glassmorphism Navbar & Mobile Hamburger
 * Perfu.me E-Commerce Platform
 */

(function () {
  function initNavbar() {
    const navbar = document.getElementById('navbar');
    if (!navbar) return;

    // ── Scroll-based show/hide ─────────────────────────────
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

    // ── Smooth Scroll Click Handlers ───────────────────────
    document.querySelectorAll('[data-nav]').forEach(el => {
      el.addEventListener('click', (e) => {
        const targetId = el.getAttribute('data-nav');

        if (targetId === 'admin') {
          window.location.href = '/admin';
          return;
        }

        const targetEl = document.getElementById(targetId) || document.querySelector(`[data-section="${targetId}"]`);

        if (targetEl) {
          e.preventDefault();
          const navHeight = navbar.offsetHeight || 70;
          const targetPos = targetEl.getBoundingClientRect().top + window.scrollY - navHeight;
          window.scrollTo({ top: targetPos, behavior: 'smooth' });
        } else if (targetId === 'home') {
          if (window.location.pathname === '/' || window.location.pathname === '') {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
          } else {
            window.location.href = '/';
          }
        }

        // Close mobile menu if open
        closeMobileMenu();
      });
    });

    // ── Hamburger / Mobile Menu Toggle ─────────────────────
    const hamburger = document.getElementById('nav-hamburger');
    const mobileMenu = document.getElementById('nav-mobile-menu');

    function openMobileMenu() {
      if (!hamburger || !mobileMenu) return;
      hamburger.classList.add('active');
      mobileMenu.classList.add('open');
      document.body.style.overflow = 'hidden';
    }

    function closeMobileMenu() {
      if (!hamburger || !mobileMenu) return;
      hamburger.classList.remove('active');
      mobileMenu.classList.remove('open');
      document.body.style.overflow = '';
    }

    if (hamburger) {
      hamburger.addEventListener('click', (e) => {
        e.stopPropagation();
        if (hamburger.classList.contains('active')) {
          closeMobileMenu();
        } else {
          openMobileMenu();
        }
      });
    }

    // Close mobile menu when clicking a link inside it
    if (mobileMenu) {
      mobileMenu.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
          closeMobileMenu();
        });
      });
    }

    // Close mobile menu on outside click
    document.addEventListener('click', (e) => {
      if (mobileMenu && mobileMenu.classList.contains('open')) {
        if (!navbar.contains(e.target) && !mobileMenu.contains(e.target)) {
          closeMobileMenu();
        }
      }
    });

    // Close mobile menu on ESC
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') closeMobileMenu();
    });

    // Expose for use by other scripts
    window.closeMobileMenu = closeMobileMenu;
  }

  document.addEventListener('DOMContentLoaded', initNavbar);
})();
