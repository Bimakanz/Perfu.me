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
    
    /* Sidebar Kiri Desktop Defaults */
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

    /* Mobile helpers hidden by default on desktop */
    .btn-toggle-admin-sidebar { display: none !important; }
    .btn-close-admin-sidebar { display: none !important; }
    .admin-sidebar-overlay { display: none; }
    .admin-table-scroll-hint { display: none; }

    /* Prevent Login Flash Flicker on Page Navigation when Logged In */
    html.has-admin-token #admin-login-page { display: none !important; }
    html.has-admin-token #admin-dashboard-page { display: flex !important; }

    /* Mobile Responsive Dashboard Layout */
    @media (max-width: 900px) {
      html, body {
        overflow-x: hidden !important;
        width: 100% !important;
        max-width: 100vw !important;
      }

      .admin-layout-wrapper {
        width: 100% !important;
        max-width: 100vw !important;
        overflow-x: hidden !important;
      }

      .admin-main-content {
        margin-left: 0 !important;
        width: 100% !important;
        max-width: 100vw !important;
        min-width: 0 !important;
        overflow-x: hidden !important;
      }

      .admin-body {
        padding: 0.85rem 0.75rem 2.5rem !important;
        width: 100% !important;
        max-width: 100% !important;
        box-sizing: border-box !important;
        min-width: 0 !important;
      }

      .btn-toggle-admin-sidebar {
        display: flex !important;
        align-items: center;
        justify-content: center;
        background: #FFFFFF;
        border: 1px solid #E5E7EB;
        border-radius: 6px;
        padding: 6px;
        color: #111827;
        cursor: pointer;
        transition: background 0.2s;
        flex-shrink: 0 !important;
      }
      .btn-toggle-admin-sidebar:active {
        background: #F3F4F6;
      }

      .btn-close-admin-sidebar {
        display: flex !important;
        background: transparent;
        border: none;
        font-size: 1.25rem;
        color: #4B5563;
        padding: 0.25rem 0.5rem;
        cursor: pointer;
      }

      .admin-sidebar-overlay {
        display: block;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.45);
        backdrop-filter: blur(2px);
        -webkit-backdrop-filter: blur(2px);
        z-index: 99998;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s cubic-bezier(0.16, 1, 0.3, 1);
      }
      .admin-sidebar-overlay.active {
        opacity: 1;
        pointer-events: auto;
      }

      .admin-sidebar {
        position: fixed !important;
        top: 0 !important;
        bottom: 0 !important;
        left: 0 !important;
        width: 250px !important;
        max-width: 80vw !important;
        z-index: 99999 !important;
        box-shadow: 10px 0 35px rgba(0, 0, 0, 0.15) !important;
        transform: translateX(-105%) !important;
        transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1) !important;
        background: #FFFFFF !important;
      }
      .admin-sidebar.mobile-open {
        transform: translateX(0) !important;
      }

      .admin-sidebar-brand {
        padding: 1.25rem 1rem !important;
      }
      .admin-brand-title {
        font-size: 1.15rem !important;
      }
      .admin-brand-sub {
        font-size: 0.68rem !important;
      }
      .admin-sidebar-menu {
        padding: 1rem 0.75rem !important;
        gap: 0.35rem !important;
      }
      .admin-menu-item {
        padding: 0.65rem 0.85rem !important;
        font-size: 0.82rem !important;
        gap: 0.6rem !important;
      }
      .admin-menu-item svg {
        width: 16px !important;
        height: 16px !important;
      }

      .admin-topbar-new {
        height: 54px !important;
        padding: 0 0.75rem !important;
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        width: 100% !important;
        box-sizing: border-box !important;
      }
      .admin-topbar-left {
        display: flex !important;
        align-items: center !important;
        gap: 0.5rem !important;
        min-width: 0 !important;
        flex: 1 !important;
      }
      .admin-page-header-title {
        font-size: 0.88rem !important;
        font-weight: 700 !important;
        color: #111827 !important;
        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
      }

      .admin-topbar-right {
        display: flex !important;
        align-items: center !important;
        gap: 0.45rem !important;
        flex-shrink: 0 !important;
      }
      .btn-view-site {
        width: 32px !important;
        height: 32px !important;
        padding: 0 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        border-radius: 8px !important;
        background: #F3F4F6 !important;
        color: #4B5563 !important;
        flex-shrink: 0 !important;
      }
      .btn-view-site svg {
        width: 16px !important;
        height: 16px !important;
      }
      .btn-view-site-text {
        display: none !important;
      }
      .admin-user-badge {
        display: none !important;
      }
      .admin-logout-btn {
        padding: 0.35rem 0.65rem !important;
        font-size: 0.75rem !important;
        font-weight: 600 !important;
        border-radius: 6px !important;
      }

      .admin-table-scroll-hint {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 0.35rem !important;
        padding: 0.4rem 0.75rem !important;
        background: #F8FAFC !important;
        color: #64748B !important;
        font-size: 0.68rem !important;
        font-weight: 600 !important;
        border-top: 1px solid #F1F5F9 !important;
        border-bottom: 1px solid #F1F5F9 !important;
        letter-spacing: 0.02em !important;
      }
    }
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
  <div id="admin-login-page" class="admin-page">
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
            <input id="admin-pass-input" class="admin-form-input" type="password" name="password" required autocomplete="current-password">
            <button id="toggle-pass-btn" class="admin-toggle-pass" type="button" onclick="window.toggleAdminPassword(event)" aria-label="Tampilkan password" title="Tampilkan password" tabindex="0">
              <svg id="icon-eye-show" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="pointer-events: none; display: block;">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                <circle cx="12" cy="12" r="3"></circle>
              </svg>
              <svg id="icon-eye-hide" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="pointer-events: none; display: none;">
                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"></path>
                <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"></path>
                <line x1="1" y1="1" x2="23" y2="23"></line>
              </svg>
            </button>
          </div>
          <div id="login-error-msg" class="admin-form-error"></div>
        </div>

        <button id="login-submit-btn" class="admin-login-btn" type="submit">Masuk ke Dashboard</button>
      </form>

      <script>
        window.toggleAdminPassword = function (e) {
          if (e) {
            if (typeof e.preventDefault === 'function') e.preventDefault();
            if (typeof e.stopPropagation === 'function') e.stopPropagation();
          }
          var btn   = document.getElementById('toggle-pass-btn');
          var input = document.getElementById('admin-pass-input');
          var show  = document.getElementById('icon-eye-show');
          var hide  = document.getElementById('icon-eye-hide');

          if (!input) return;

          var isCurrentlyPass = input.type === 'password';
          input.type = isCurrentlyPass ? 'text' : 'password';

          if (show) show.style.display = isCurrentlyPass ? 'none' : 'block';
          if (hide) hide.style.display = isCurrentlyPass ? 'block' : 'none';

          var label = isCurrentlyPass ? 'Sembunyikan password' : 'Tampilkan password';
          if (btn) {
            btn.setAttribute('aria-label', label);
            btn.setAttribute('title', label);
          }
        };
      </script>
    </div>
  </div>

  <!-- ADMIN DASHBOARD WRAPPER DENGAN SIDEBAR -->
  <div class="admin-sidebar-overlay" id="admin-sidebar-overlay"></div>
  <div class="admin-layout-wrapper" id="admin-dashboard-page" style="display:none;">
    
    <!-- SIDEBAR KIRI -->
    <aside class="admin-sidebar" id="admin-sidebar">
      <div class="admin-sidebar-brand" style="display: flex; align-items: center; justify-content: space-between;">
        <div>
          <div class="admin-brand-title" style="font-size: 1.3rem; font-family: 'Cormorant Garamond', serif; font-weight: 600;">Perfu.me Admin</div>
          <div class="admin-brand-sub" style="font-size: 0.75rem; color: #888;">Inventory &amp; Management</div>
        </div>
        <button type="button" class="btn-close-admin-sidebar" id="btn-close-admin-sidebar" aria-label="Tutup Menu">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
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
        <div class="admin-topbar-left" style="display: flex; align-items: center; gap: 0.75rem;">
          <button type="button" id="btn-toggle-admin-sidebar" class="btn-toggle-admin-sidebar" aria-label="Buka Menu Admin">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
          </button>
          <div class="admin-page-header-title">
            @yield('page-title', 'Dashboard Overview')
          </div>
        </div>

        <div class="admin-topbar-right" style="display: flex; align-items: center; gap: 1.25rem;">
          <a href="/" class="btn-view-site" style="display: flex; align-items: center; gap: 0.4rem; font-size: 0.85rem; text-decoration: none; color: #4B5563; background: #F3F4F6; padding: 0.5rem 0.9rem; border-radius: 6px; font-weight: 500;">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
            <span class="btn-view-site-text">Lihat Frontend</span>
          </a>
          <div class="admin-user-badge" style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.9rem; font-weight: 500;">
            <div class="admin-user-avatar" style="background: #111; color: #fff; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; font-weight: bold;">A</div>
            <span class="admin-user-name">Administrator</span>
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

      // Mobile Sidebar Drawer Handlers
      window.openAdminSidebar = function () {
        const sidebar = document.getElementById('admin-sidebar');
        const overlay = document.getElementById('admin-sidebar-overlay');
        if (sidebar) sidebar.classList.add('mobile-open');
        if (overlay) overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
      };

      window.closeAdminSidebar = function () {
        const sidebar = document.getElementById('admin-sidebar');
        const overlay = document.getElementById('admin-sidebar-overlay');
        if (sidebar) sidebar.classList.remove('mobile-open');
        if (overlay) overlay.classList.remove('active');
        document.body.style.overflow = '';
      };

      document.addEventListener('DOMContentLoaded', async function () {
        // Mobile sidebar buttons
        document.getElementById('btn-toggle-admin-sidebar')?.addEventListener('click', window.openAdminSidebar);
        document.getElementById('btn-close-admin-sidebar')?.addEventListener('click', window.closeAdminSidebar);
        document.getElementById('admin-sidebar-overlay')?.addEventListener('click', window.closeAdminSidebar);

        // Close sidebar when pressing ESC
        document.addEventListener('keydown', function (e) {
          if (e.key === 'Escape') {
            window.closeAdminSidebar();
          }
        });

        // Close sidebar if window resized to desktop
        window.addEventListener('resize', function () {
          if (window.innerWidth > 900) {
            window.closeAdminSidebar();
          }
        });

        const loginForm = document.getElementById('admin-login-form');
        if (loginForm && !loginForm.dataset.adminLoginBound) {
          loginForm.addEventListener('submit', window.doAdminLogin);
          loginForm.dataset.adminLoginBound = 'true';
        }
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
