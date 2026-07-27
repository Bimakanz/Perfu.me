/**
 * hero.js — Cinematic Hero Canvas Particle System
 * Perfu.me E-Commerce Platform
 */

(function () {
  const NOTES = [
    { label: 'Bergamot',    color: '#D4C050', size: 3.5, speed: 0.35 },
    { label: 'Rose Petals', color: '#E0A0B8', size: 2.8, speed: 0.28 },
    { label: 'Sandalwood',  color: '#C4976A', size: 2.2, speed: 0.22 },
    { label: 'Spice Mist',  color: '#D4B8A0', size: 1.8, speed: 0.18 },
    { label: 'Silver Dew',  color: '#C8C8D4', size: 1.4, speed: 0.15 },
  ];

  const PARTICLE_COUNT = 120;
  let canvas, ctx, particles = [], W, H;
  let mouseX = 0, mouseY = 0;
  let animId;

  class Particle {
    constructor() { this.reset(true); }

    reset(random) {
      const note = NOTES[Math.floor(Math.random() * NOTES.length)];
      this.x      = random ? Math.random() * W : W * 0.5;
      this.y      = random ? Math.random() * H : H * 0.5;
      this.baseX  = this.x;
      this.baseY  = this.y;
      this.vx     = (Math.random() - 0.5) * note.speed;
      this.vy     = (Math.random() - 0.5) * note.speed - 0.1;
      this.r      = note.size * (0.6 + Math.random() * 0.8);
      this.color  = note.color;
      this.alpha  = 0.1 + Math.random() * 0.55;
      this.life   = 0;
      this.maxLife= 400 + Math.random() * 600;
      this.twinkle= Math.random() * Math.PI * 2;
    }

    update(mouseInfluence) {
      this.life++;
      this.twinkle += 0.02;

      // Drift
      this.x += this.vx;
      this.y += this.vy;

      // Mouse parallax (gentle push)
      const dx = this.x - mouseInfluence.x;
      const dy = this.y - mouseInfluence.y;
      const dist = Math.sqrt(dx * dx + dy * dy);
      if (dist < 180) {
        const force = (180 - dist) / 180 * 0.6;
        this.x += (dx / dist) * force;
        this.y += (dy / dist) * force;
      }

      // Boundary wrap
      if (this.x < -10) this.x = W + 10;
      if (this.x > W + 10) this.x = -10;
      if (this.y < -10) this.y = H + 10;
      if (this.y > H + 10) this.y = -10;

      // Fade in/out
      if (this.life > this.maxLife) this.reset(false);
    }

    draw() {
      const fade = Math.min(1, this.life / 60) * Math.min(1, (this.maxLife - this.life) / 60);
      const pulse = 0.85 + Math.sin(this.twinkle) * 0.15;
      const alpha = this.alpha * fade * pulse;

      ctx.save();
      ctx.globalAlpha = alpha;

      // Glow
      const grd = ctx.createRadialGradient(this.x, this.y, 0, this.x, this.y, this.r * 3.5);
      grd.addColorStop(0,   this.color + 'FF');
      grd.addColorStop(0.4, this.color + '88');
      grd.addColorStop(1,   this.color + '00');
      ctx.fillStyle = grd;
      ctx.beginPath();
      ctx.arc(this.x, this.y, this.r * 3.5, 0, Math.PI * 2);
      ctx.fill();

      // Core
      ctx.globalAlpha = alpha * 0.9;
      ctx.fillStyle = this.color;
      ctx.beginPath();
      ctx.arc(this.x, this.y, this.r, 0, Math.PI * 2);
      ctx.fill();
      ctx.restore();
    }
  }

  function resize() {
    W = canvas.width  = canvas.offsetWidth;
    H = canvas.height = canvas.offsetHeight;
  }

  function init() {
    canvas = document.getElementById('hero-canvas');
    if (!canvas) return;
    ctx = canvas.getContext('2d');
    resize();
    window.addEventListener('resize', resize);

    particles = Array.from({ length: PARTICLE_COUNT }, () => new Particle());

    // Mouse tracking
    const hero = document.getElementById('hero');
    hero.addEventListener('mousemove', e => {
      const rect = canvas.getBoundingClientRect();
      mouseX = e.clientX - rect.left;
      mouseY = e.clientY - rect.top;
    });

    hero.addEventListener('mouseleave', () => {
      mouseX = W / 2;
      mouseY = H / 2;
    });

    mouseX = W / 2;
    mouseY = H / 2;

    loop();
  }

  function loop() {
    ctx.clearRect(0, 0, W, H);
    const influence = { x: mouseX, y: mouseY };
    particles.forEach(p => { p.update(influence); p.draw(); });
    animId = requestAnimationFrame(loop);
  }

  document.addEventListener('DOMContentLoaded', init);
})();
