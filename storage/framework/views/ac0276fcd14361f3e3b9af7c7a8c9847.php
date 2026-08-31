<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <title><?php echo $__env->yieldContent('title', 'Admin Portal — Perfu.me Dashboard'); ?></title>
  <link rel="icon" type="image/svg+xml" href="<?php echo e(asset('favicon.svg')); ?>">
  <link rel="icon" type="image/x-icon" href="<?php echo e(asset('favicon.ico')); ?>">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="<?php echo e(asset('css/main.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('css/admin.css')); ?>">
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
  </style>
  <?php echo $__env->yieldContent('styles'); ?>
</head>

<body>

  <!-- ADMIN LOGIN PAGE (Jika belum login) -->
  <div id="admin-login-page" class="admin-page" style="display:none;">
    <!-- Sediakan form login seperti biasa -->
  </div>

  <!-- ADMIN DASHBOARD WRAPPER DENGAN SIDEBAR -->
  <div class="admin-layout-wrapper" id="admin-dashboard-page">
    
    <!-- SIDEBAR KIRI -->
    <aside class="admin-sidebar">
      <div class="admin-sidebar-brand">
        <div class="admin-brand-title" style="font-size: 1.3rem; font-family: 'Cormorant Garamond', serif; font-weight: 600;">Perfu.me Admin</div>
        <div class="admin-brand-sub" style="font-size: 0.75rem; color: #888;">Inventory &amp; Management</div>
      </div>

      <div class="admin-sidebar-menu">
        <a href="/admin" class="admin-menu-item <?php echo e(request()->is('admin*') && !request()->is('admin/testimoni*') ? 'active' : ''); ?>">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
          Manajemen Produk
        </a>
        <a href="/admin/testimoni" class="admin-menu-item <?php echo e(request()->is('admin/testimoni*') ? 'active' : ''); ?>">
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
          <?php echo $__env->yieldContent('page-title', 'Dashboard Overview'); ?>
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
        <?php echo $__env->yieldContent('content'); ?>
      </main>

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

<script>
    window.openLogoutModal = function (e) {
      if (e) { 
        e.preventDefault(); 
        e.stopPropagation(); 
      }
      const backdrop = document.getElementById('logout-modal-backdrop');
      if (backdrop) {
        backdrop.style.display = 'flex'; // Paksa tampilkan modal
      }
    };

    document.getElementById('btn-cancel-logout')?.addEventListener('click', function() {
      document.getElementById('logout-modal-backdrop').style.display = 'none';
    });

    document.getElementById('btn-confirm-logout')?.addEventListener('click', function() {
      document.getElementById('logout-modal-backdrop').style.display = 'none';
      if (window.API && typeof window.API.logout === 'function') {
        window.API.logout();
      }
      window.location.href = '/admin';
    });
  </script>

  <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html><?php /**PATH D:\_DATA\Documents\Perfu.me\resources\views/layouts/admin.blade.php ENDPATH**/ ?>