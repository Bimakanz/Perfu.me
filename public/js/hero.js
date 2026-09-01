/**
 * hero.js — Luxury Hero Video & Interaction Controller
 * Perfu.me E-Commerce Platform
 */

(function () {
  'use strict';

  function initHeroVideo() {
    const video = document.querySelector('.hero-video-bg');
    if (!video) return;

    // Ensure muted, playsinline, loop are set programmatically
    video.muted = true;
    video.playsInline = true;
    video.loop = true;

    const playPromise = video.play();
    if (playPromise !== undefined) {
      playPromise.catch(() => {
        // Autoplay was prevented; retry on first user interaction
        const startPlaybackOnAction = () => {
          video.play().catch(() => {});
          window.removeEventListener('touchstart', startPlaybackOnAction);
          window.removeEventListener('click', startPlaybackOnAction);
          window.removeEventListener('scroll', startPlaybackOnAction);
        };

        window.addEventListener('touchstart', startPlaybackOnAction, { passive: true, once: true });
        window.addEventListener('click', startPlaybackOnAction, { passive: true, once: true });
        window.addEventListener('scroll', startPlaybackOnAction, { passive: true, once: true });
      });
    }
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initHeroVideo);
  } else {
    initHeroVideo();
  }
})();
