/**
 * router.js — Hash-based SPA Router
 * Perfu.me E-Commerce Platform
 */

class Router {
  constructor(routes) {
    this.routes = routes; // { 'home': fn, 'catalog': fn, 'pdp': fn }
    this._current = null;
    window.addEventListener('hashchange', () => this._handle());
    // Initial route
    this._handle();
  }

  _parse() {
    const hash = window.location.hash.replace('#', '') || 'home';
    const parts = hash.split('/');
    return { page: parts[0], param: parts[1] || null };
  }

  _handle() {
    const { page, param } = this._parse();
    const handler = this.routes[page] || this.routes['home'];
    if (handler) {
      // Hide all page sections
      document.querySelectorAll('.page-section').forEach(s => s.classList.remove('active'));
      handler(param);
      this._current = page;
      window.scrollTo({ top: 0, behavior: 'smooth' });
    }
  }

  navigate(page, param) {
    const hash = param ? `#${page}/${param}` : `#${page}`;
    window.location.hash = hash;
  }

  current() {
    return this._current;
  }
}

window.Router = Router;
