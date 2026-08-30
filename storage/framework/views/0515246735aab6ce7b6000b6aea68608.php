<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>404 — Halaman Tidak Ditemukan | Perfu.me</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400&family=Manrope:wght@400;500;600&display=swap" rel="stylesheet">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: 'Manrope', sans-serif;
      background: #0D0D0D;
      color: #FFFFFF;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
      padding: 2rem;
    }
    .error-brand {
      font-family: 'Zaloga', 'Cormorant Garamond', Georgia, serif;
      font-size: 1.5rem;
      letter-spacing: 0.04em;
      color: #C0C0C0;
      margin-bottom: 3rem;
      text-decoration: none;
    }
    .error-code {
      font-family: 'Cormorant Garamond', Georgia, serif;
      font-size: clamp(6rem, 15vw, 10rem);
      font-weight: 300;
      line-height: 1;
      color: #FFFFFF;
      letter-spacing: -0.04em;
      margin-bottom: 1rem;
    }
    .error-title {
      font-size: clamp(1.1rem, 2.5vw, 1.4rem);
      font-weight: 500;
      color: #C0C0C0;
      margin-bottom: 0.75rem;
    }
    .error-desc {
      font-size: 0.9rem;
      color: #8A8A8A;
      line-height: 1.7;
      max-width: 420px;
      margin-bottom: 2.5rem;
    }
    .error-divider {
      width: 40px;
      height: 1px;
      background: #3A3A3A;
      margin: 1.5rem auto;
    }
    .error-actions {
      display: flex;
      gap: 1rem;
      flex-wrap: wrap;
      justify-content: center;
    }
    .btn-primary {
      padding: 0.85rem 2rem;
      background: #FFFFFF;
      color: #0D0D0D;
      border-radius: 999px;
      font-size: 0.82rem;
      font-weight: 700;
      letter-spacing: 0.06em;
      text-transform: uppercase;
      text-decoration: none;
      transition: all 0.25s;
    }
    .btn-primary:hover { background: #E5E5E5; }
    .btn-secondary {
      padding: 0.85rem 2rem;
      background: transparent;
      color: #C0C0C0;
      border: 1px solid #3A3A3A;
      border-radius: 999px;
      font-size: 0.82rem;
      font-weight: 600;
      letter-spacing: 0.06em;
      text-transform: uppercase;
      text-decoration: none;
      transition: all 0.25s;
    }
    .btn-secondary:hover { border-color: #8A8A8A; color: #FFFFFF; }
  </style>
</head>
<body>
  <a href="/" class="error-brand">Perfu.me</a>
  <div class="error-code">404</div>
  <div class="error-divider"></div>
  <p class="error-title">Halaman Tidak Ditemukan</p>
  <p class="error-desc">
    Maaf, halaman yang Anda cari tidak ada atau mungkin sudah dipindahkan.
    Coba kembali ke halaman utama atau jelajahi koleksi kami.
  </p>
  <div class="error-actions">
    <a href="/" class="btn-primary">Kembali ke Beranda</a>
    <a href="/katalog" class="btn-secondary">Lihat Katalog</a>
  </div>
</body>
</html>
<?php /**PATH D:\_DATA\Documents\Perfu.me\resources\views/errors/404.blade.php ENDPATH**/ ?>