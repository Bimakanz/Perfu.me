# Checklist Konfigurasi Production Hosting Perfu.me

Sebelum melakukan deploy/hosting ke server produksi (cPanel / VPS / Cloud Hosting), pastikan nilai di file `.env` pada server disesuaikan sebagai berikut:

```env
# 1. Nonaktifkan Debug Mode (KRITIS)
APP_ENV=production
APP_DEBUG=false

# 2. Sesuaikan URL Domain Asli
APP_URL=https://perfu.me

# 3. Kunci Aplikasi (Pastikan terisi & acak)
APP_KEY=base64:...

# 4. Database Production (Sangat Disarankan MySQL/PostgreSQL daripada SQLite)
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=perfu_me_db
DB_USERNAME=perfu_me_user
DB_PASSWORD=your_secure_password
```

## Perintah Optimasi Setelah Deploy di Server:

```bash
composer install --no-dev --optimize-autoloader
php artisan config:cache
php artisan route:cache
php artisan view:cache
```
