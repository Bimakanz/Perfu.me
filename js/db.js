/**
 * db.js — PerfumeAPI (fetch-based Laravel REST client)
 * Perfu.me E-Commerce Platform
 */

class PerfumeAPI {
  constructor() {
    this.base = '/api';
    this._token = sessionStorage.getItem('admin_token') || null;
  }

  // ── Token Management ─────────────────────────────────────
  setToken(token) {
    this._token = token;
    sessionStorage.setItem('admin_token', token);
  }

  clearToken() {
    this._token = null;
    sessionStorage.removeItem('admin_token');
  }

  hasToken() {
    return !!this._token;
  }

  // ── Request Helper ────────────────────────────────────────
  async _request(method, path, body = null, auth = false) {
    const headers = { 'Content-Type': 'application/json', 'Accept': 'application/json' };
    if (auth && this._token) {
      headers['Authorization'] = `Bearer ${this._token}`;
    }

    const opts = { method, headers };
    if (body) opts.body = JSON.stringify(body);

    try {
      const res = await fetch(this.base + path, opts);
      const json = await res.json();

      if (!res.ok) {
        throw { status: res.status, message: json.message || 'Server error', errors: json.errors };
      }
      return json;
    } catch (err) {
      if (err.status) throw err;
      throw { status: 0, message: 'Tidak dapat menghubungi server. Pastikan Laravel server berjalan.' };
    }
  }

  // ── Auth ──────────────────────────────────────────────────
  async login(username, password) {
    const res = await this._request('POST', '/auth/login', { username, password });
    if (res.success) this.setToken(res.token);
    return res;
  }

  async logout() {
    const res = await this._request('POST', '/auth/logout', null, true);
    this.clearToken();
    return res;
  }

  async checkAuth() {
    try {
      const res = await this._request('GET', '/auth/check', null, true);
      return res.authenticated;
    } catch {
      return false;
    }
  }

  // ── Products — Public ─────────────────────────────────────
  async getAll() {
    const res = await this._request('GET', '/products');
    return res.data;
  }

  async getById(id) {
    const res = await this._request('GET', `/products/${id}`);
    return res.data;
  }

  async filter({ gender, variant, minPrice, maxPrice, query } = {}) {
    const params = new URLSearchParams();
    if (gender && gender !== 'all')  params.set('gender', gender);
    if (variant && variant !== 'all') params.set('variant', variant);
    if (minPrice != null)             params.set('min_price', minPrice);
    if (maxPrice != null)             params.set('max_price', maxPrice);
    if (query)                        params.set('q', query);

    const qs = params.toString() ? '?' + params.toString() : '';
    const res = await this._request('GET', `/products${qs}`);
    return res.data;
  }

  async getStats() {
    const res = await this._request('GET', '/products/stats');
    return res.data;
  }

  // ── Products — Admin (auth required) ─────────────────────
  async create(data) {
    const res = await this._request('POST', '/products', data, true);
    return res.data;
  }

  async update(id, data) {
    const res = await this._request('PUT', `/products/${id}`, data, true);
    return res.data;
  }

  async delete(id) {
    const res = await this._request('DELETE', `/products/${id}`, null, true);
    return res.success;
  }

  async zeroStock(id) {
    const res = await this._request('PATCH', `/products/${id}/zero-stock`, null, true);
    return res.data;
  }
}

// Singleton
window.API = new PerfumeAPI();
// Legacy alias for compatibility with older code
window.DB = window.API;
