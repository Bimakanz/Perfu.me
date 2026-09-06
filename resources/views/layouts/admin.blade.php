<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Admin Portal — Perfu.me Dashboard')</title>
  <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
  <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('css/main.css') }}">
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
  <style>
    /* Styling Tambahan untuk Sidebar Layout */
    body { background-color: #F8F9FA; margin: 0; font-family: 'Inter', sans-serif; }
    .admin-layout-wrapper { display: flex; min-height: 100vh; }
    
    /* Sidebar Kiri */
    .admin-sidebar {
      width: 260px;
      background: #FFFFFF;
      border-right: 1px solid #EAEAEA;
      display: flex;
      flex-direction: column;
      position: fixed;
      top: 0; bottom: 0; left: 0;
      z-index: 100;
    }
    .admin-sidebar-brand {
      padding: 1.75rem 1.5rem;
      border-bottom: 1px solid #F1F1F1;
    }
    .admin-sidebar-menu {
      padding: 1.5rem 1rem;
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
      flex: 1;
    }
    .admin-menu-item {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      padding: 0.85rem 1rem;
      border-radius: 8px;
      font-size: 0.9rem;
      font-weight: 600;
      color: #4B5563;
      text-decoration: none;
      transition: all 0.2s;
    }
    .admin-menu-item:hover { background: #F3F4F6; color: #111827; }
    .admin-menu-item.active { background: #0D0D0D; color: #FFFFFF; }

    /* Area Konten Utama di Kanan */
    .admin-main-content {
      margin-left: 260px;
      flex: 1;
      display: flex;
      flex-direction: column;
    }
    .admin-topbar-new {
      background: #FFFFFF;
      height: 75px;
      border-bottom: 1px solid #EAEAEA;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 2.5rem;
      position: sticky;
      top: 0;
      z-index: 99;
    }
    /* Prevent Login Flash Flicker on Page Navigation when Logged In */
    html.has-admin-token #admin-login-page { display: none !important; }
    html.has-admin-token #admin-dashboard-page { display: flex !important; }
  </style>
  @yield('styles')
</head>

<body>
  <script>
    (function() {
      var token = sessionStorage.getItem('admin_token');
      if (token) {
        document.documentElement.classList.add('has-admin-token');
      }
    })();
  </script>

  <!-- ADMIN LOGIN PAGE (Jika belum login) -->
  <div id="admin-login-page" class="admin-page" style="display:none;">
    <div class="admin-login-left">
      <img class="admin-login-left-img" src="{{ asset('assets/images/adminhero.webp') }}" alt="Perfu.me Admin">
      <div class="admin-login-left-overlay">
        <div class="admin-brand-mark">Perfu.me</div>
        <div class="admin-brand-tagline">Inventory &amp; Management</div>
        <div class="admin-welcome-text">Kelola katalog parfum dengan cepat dan rapi.</div>
        <div class="admin-welcome-sub">Masuk untuk mengatur produk, stok, best seller, dan testimoni pelanggan.</div>
      </div>
    </div>

    <div class="admin-login-right">
      <div class="admin-login-logo">Perfu.me Admin</div>
      <div class="admin-login-logo-sub">Secure Dashboard</div>
      <h1 class="admin-login-title">Masuk Admin</h1>
      <p class="admin-login-subtitle">Gunakan akun administrator untuk membuka dashboard.</p>

      <form id="admin-login-form" autocomplete="off">
        <div class="admin-form-group">
          <label class="admin-form-label" for="admin-user-input">Username</label>
          <input id="admin-user-input" class="admin-form-input" type="text" name="username" required>
        </div>

        <div class="admin-form-group">
          <label class="admin-form-label" for="admin-pass-input">Password</label>
          <div class="admin-input-wrap">
            <input id="admin-pass-input" class="admin-form-input" type="password" name="password" required>
            <button id="toggle-pass-btn" class="admin-toggle-pass" type="button" aria-label="Tampilkan password">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                <circle cx="12" cy="12" r="3"></circle>
              </svg>
            </button>
          </div>
          <div id="login-error-msg" class="admin-form-error"></div>
        </div>

        <button id="login-submit-btn" class="admin-login-btn" type="submit">Masuk ke Dashboard</button>
      </form>
    </div>
  </div>

  <!-- ADMIN DASHBOARD WRAPPER DENGAN SIDEBAR -->
  <div class="admin-layout-wrapper" id="admin-dashboard-page" style="display:none;">
    
    <!-- SIDEBAR KIRI -->
    <aside class="admin-sidebar">
      <div class="admin-sidebar-brand">
        <div class="admin-brand-title" style="font-size: 1.3rem; font-family: 'Cormorant Garamond', serif; font-weight: 600;">Perfu.me Admin</div>
        <div class="admin-brand-sub" style="font-size: 0.75rem; color: #888;">Inventory &amp; Management</div>
      </div>

      <div class="admin-sidebar-menu">
        <a href="/admin" class="admin-menu-item {{ request()->is('admin*') && !request()->is('admin/testimoni*') ? 'active' : '' }}">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
          Manajemen Produk
        </a>
        <a href="/admin/testimoni" class="admin-menu-item {{ request()->is('admin/testimoni*') ? 'active' : '' }}">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
          Kelola Testimoni
        </a>
      </div>
    </aside>

    <!-- KONTEN UTAMA KANAN -->
    <div class="admin-main-content">
      
      <!-- Topbar Kanan -->
      <header class="admin-topbar-new">
        <div style="font-weight: 600; color: #111827; font-size: 1.05rem;">
          @yield('page-title', 'Dashboard Overview')
        </div>

        <div class="admin-topbar-right" style="display: flex; align-items: center; gap: 1.25rem;">
          <a href="/" class="btn-view-site" style="display: flex; align-items: center; gap: 0.4rem; font-size: 0.85rem; text-decoration: none; color: #4B5563; background: #F3F4F6; padding: 0.5rem 0.9rem; border-radius: 6px; font-weight: 500;">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
            Lihat Frontend Website
          </a>
          <div class="admin-user-badge" style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.9rem; font-weight: 500;">
            <div class="admin-user-avatar" style="background: #111; color: #fff; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; font-weight: bold;">A</div>
            <span>Administrator</span>
          </div>
          <button id="admin-logout-btn" class="admin-logout-btn" type="button" onclick="openLogoutModal(event)" style="background: #FEF2F2; color: #DC2626; border: none; padding: 0.5rem 1rem; border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 0.85rem;">Keluar</button>
        </div>
      </header>

      <!-- Main Body Content -->
      <main class="admin-body" style="padding: 2.5rem;">
        @yield('content')
      </main>

    </div>
  </div>

  <div id="admin-welcome-overlay" class="admin-welcome-overlay" style="display:none;">
    <div class="admin-welcome-card">
      <div class="admin-welcome-logo">Perfu.me</div>
      <div class="admin-welcome-title">Memuat Dashboard</div>
      <div class="welcome-progress">
        <div id="welcome-progress-fill" class="welcome-progress-fill"></div>
      </div>
    </div>
  </div>

  <!-- LOGOUT CONFIRMATION MODAL -->
  <div id="logout-modal-backdrop" class="admin-modal-backdrop" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 9999; align-items: center; justify-content: center; backdrop-filter: blur(4px);">
    <div class="admin-modal" style="background: #FFFFFF; width: 100%; max-width: 420px; border-radius: 16px; padding: 2.5rem 2rem; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1); text-align: center;">
      <h3 style="font-family: 'Cormorant Garamond', serif; font-size: 1.8rem; margin-bottom: 0.75rem; color: #111827;">Konfirmasi Keluar</h3>
      <p style="font-size: 0.95rem; color: #4B5563; margin-bottom: 2rem;">Apakah Anda yakin ingin keluar dari Admin Dashboard?</p>
      <div style="display: flex; gap: 1rem; justify-content: center;">
        <button type="button" id="btn-cancel-logout" style="flex: 1; padding: 0.85rem; background: #F3F4F6; color: #374151; border: none; border-radius: 8px; font-weight: 600; cursor: pointer;">Batal</button>
        <button type="button" id="btn-confirm-logout" style="flex: 1; padding: 0.85rem; background: #DC2626; color: #FFFFFF; border: none; border-radius: 8px; font-weight: 600; cursor: pointer;">Ya, Keluar</button>
      </div>
    </div>
  </div>

  <script src="{{ asset('js/db.js') }}"></script>
  <script>
    (function () {
      function showLogin(message) {
        document.documentElement.classList.remove('has-admin-token');
        sessionStorage.removeItem('admin_token');
        if (window.API && typeof window.API.clearToken === 'function') {
          window.API.clearToken();
        }

        const loginPage = document.getElementById('admin-login-page');
        const dashPage = document.getElementById('admin-dashboard-page');
        const errorMsg = document.getElementById('login-error-msg');

        if (dashPage) dashPage.style.cssText = 'display: none !important;';
        if (loginPage) loginPage.style.cssText = 'display: flex !important;';
        if (errorMsg) {
          errorMsg.textContent = message || '';
          errorMsg.classList.toggle('show', Boolean(message));
        }
      }

      function showDashboard() {
        const loginPage = document.getElementById('admin-login-page');
        const dashPage = document.getElementById('admin-dashboard-page');

        if (loginPage) loginPage.style.cssText = 'display: none !important;';
        if (dashPage) {
          dashPage.style.cssText = 'display: flex !important;';
          dashPage.classList.add('active');
        }
      }

      window.openLogoutModal = function (e) {
        if (e) {
          e.preventDefault();
          e.stopPropagation();
        }

        const backdrop = document.getElementById('logout-modal-backdrop');
        if (backdrop) {
          backdrop.style.display = 'flex';
          backdrop.classList.add('active');
        }
      };

      window.closeLogoutModal = function () {
        const backdrop = document.getElementById('logout-modal-backdrop');
        if (backdrop) {
          backdrop.classList.remove('active');
          backdrop.style.display = 'none';
        }
      };

      window.doAdminLogin = window.doAdminLogin || async function (e) {
        if (e) e.preventDefault();

        const errorMsg = document.getElementById('login-error-msg');
        const submitBtn = document.getElementById('login-submit-btn');
        const user = (document.getElementById('admin-user-input')?.value || '').trim();
        const pass = (document.getElementById('admin-pass-input')?.value || '').trim();

        if (errorMsg) errorMsg.classList.remove('show');
        if (!user || !pass) {
          if (errorMsg) {
            errorMsg.textContent = 'Username dan password tidak boleh kosong.';
            errorMsg.classList.add('show');
          }
          return false;
        }

        try {
          if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.textContent = 'Memproses...';
          }

          const result = await window.API.login(user, pass);
          if (result && result.success) {
            sessionStorage.setItem('just_logged_in', 'true');
            showDashboard();
            if (typeof window.loadDashboardData === 'function') {
              window.loadDashboardData();
            }
            return false;
          }

          throw { message: 'Login gagal.' };
        } catch (err) {
          if (errorMsg) {
            errorMsg.textContent = err.message || 'Login gagal. Periksa username dan password.';
            errorMsg.classList.add('show');
          }
        } finally {
          if (submitBtn) {
            submitBtn.disabled = false;
            submitBtn.textContent = 'Masuk ke Dashboard';
          }
        }

        return false;
      };

      window.handleSessionExpired = window.handleSessionExpired || function () {
        showLogin('Sesi login Anda telah berakhir. Silakan masuk kembali.');
      };

      document.addEventListener('DOMContentLoaded', async function () {
        const loginForm = document.getElementById('admin-login-form');
        if (loginForm && !loginForm.dataset.adminLoginBound) {
          loginForm.addEventListener('submit', window.doAdminLogin);
          loginForm.dataset.adminLoginBound = 'true';
        }
        document.getElementById('toggle-pass-btn')?.addEventListener('click', function () {
          const input = document.getElementById('admin-pass-input');
          if (input) input.type = input.type === 'password' ? 'text' : 'password';
        });
        document.getElementById('admin-logout-btn')?.addEventListener('click', window.openLogoutModal);
        document.getElementById('btn-cancel-logout')?.addEventListener('click', window.closeLogoutModal);
        document.getElementById('logout-modal-backdrop')?.addEventListener('click', function (e) {
          if (e.target === e.currentTarget) window.closeLogoutModal();
        });
        document.getElementById('btn-confirm-logout')?.addEventListener('click', async function (e) {
          if (e) e.preventDefault();
          window.closeLogoutModal();
          try {
            if (window.API && typeof window.API.logout === 'function') {
              await window.API.logout();
            }
          } catch (err) {
            if (window.API && typeof window.API.clearToken === 'function') window.API.clearToken();
          }
          document.documentElement.classList.remove('has-admin-token');
          sessionStorage.removeItem('admin_token');
          if (window.location.pathname.startsWith('/admin/')) {
            window.location.href = '/admin';
          } else {
            showLogin();
          }
        });

        if (!window.API || !window.API.hasToken()) {
          showLogin();
          return;
        }

        const authenticated = await window.API.checkAuth();
        if (authenticated) {
          showDashboard();
        } else {
          showLogin('Sesi login Anda telah berakhir. Silakan masuk kembali.');
        }
      });
    })();
  </script>

  @yield('scripts')
</body>
</html>
