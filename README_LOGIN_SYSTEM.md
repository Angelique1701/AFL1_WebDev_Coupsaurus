# Sistem Login dengan Role Admin dan Pembeli

## 📋 Deskripsi
Sistem login PHP native dengan 2 role:
- **Admin**: Dapat CRUD Produk dan Toko
- **Pembeli**: Dapat CRUD Review mereka sendiri

## 🚀 Cara Setup

### 1. Import Database
Jalankan file `database_setup.sql` di MySQL/phpMyAdmin:
```bash
mysql -u root -p agency < database_setup.sql
```

Atau buka phpMyAdmin dan import file tersebut.

### 2. Konfigurasi Database
Edit file `config.php` jika perlu mengubah kredensial database:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'agency');
```

### 3. Jalankan Server
Pilih salah satu cara:

#### Opsi A: PHP Built-in Server (Port 8000)
```bash
php -S 127.0.0.1:8000
```
Akses: `http://127.0.0.1:8000`

#### Opsi B: XAMPP/WAMP
- Letakkan folder project di `htdocs` atau `www`
- Akses: `http://localhost/nama-folder`

#### Opsi C: Laravel Valet (untuk Mac)
```bash
valet link afl2_webdev
```
Akses: `http://afl2_webdev.test`

## 👤 Akun Demo

### Admin
- **Username**: `admin`
- **Password**: `admin123`
- **Akses**: CRUD Produk & Toko

### Pembeli
- **Username**: `pembeli1`
- **Password**: `pembeli123`
- **Akses**: CRUD Review sendiri

## 📁 Struktur File

### Core Files
- `config.php` - Konfigurasi database & session
- `login.php` - Halaman login
- `register.php` - Halaman registrasi (untuk pembeli)
- `dashboard.php` - Dashboard setelah login
- `logout.php` - Logout

### Models
- `model_User.php` - Authentication & user management
- `model_Product.php` - CRUD produk
- `model_Store.php` - CRUD toko
- `model_Review.php` - CRUD review

### Views (Admin)
- `stores.php` - Kelola toko (Admin only)
- `products.php` - Kelola produk (Admin only)

### Views (Pembeli)
- `products.php` - Lihat daftar produk
- `product_detail.php` - Detail produk & review
- `reviews.php` - Kelola review sendiri (Pembeli only)

### Includes
- `includes/navbar.php` - Navigation bar

## 🔐 Fitur Keamanan

1. **Password Hashing**: Menggunakan `password_hash()` dan `password_verify()`
2. **Session Management**: Session-based authentication
3. **Role-Based Access Control**: 
   - `requireLogin()` - Harus login
   - `requireAdmin()` - Harus admin
   - `requirePembeli()` - Harus pembeli
4. **SQL Injection Prevention**: Prepared statements
5. **XSS Prevention**: `htmlspecialchars()` pada output

## 📊 Database Schema

### users
- user_id (PK)
- username (unique)
- email (unique)
- password (hashed)
- role (admin/pembeli)
- full_name
- created_at

### stores
- store_id (PK)
- store_name
- location
- description
- created_at

### products
- product_id (PK)
- store_id (FK)
- product_name
- description
- price
- stock
- created_at

### reviews
- review_id (PK)
- product_id (FK)
- user_id (FK)
- rating (1-5)
- comment
- created_at

## 🎯 Fitur

### Admin
✅ Login/Logout
✅ CRUD Toko (Create, Read, Update, Delete)
✅ CRUD Produk (Create, Read, Update, Delete)
✅ Lihat semua review

### Pembeli
✅ Login/Logout/Register
✅ Lihat daftar produk
✅ Lihat detail produk & review
✅ CRUD Review sendiri (hanya review milik sendiri)

## ❓ Kenapa URL Berubah?

### `http://afl2_webdev.test/login`
- Menggunakan virtual host (Laravel Valet/Apache/Nginx)
- Konfigurasi di web server

### `http://127.0.0.1:8000/login`
- Menggunakan PHP built-in server
- Command: `php -S 127.0.0.1:8000`
- Atau Laravel: `php artisan serve`

**Solusi**: Pilih salah satu metode dan gunakan secara konsisten.

## 🔧 Troubleshooting

### Error: Connection failed
- Pastikan MySQL running
- Cek kredensial di `config.php`
- Pastikan database `agency` sudah dibuat

### Error: Session already started
- Hapus `session_start()` duplikat
- `config.php` sudah handle session

### Error: Cannot modify header
- Pastikan tidak ada output sebelum `header()`
- Cek BOM di file PHP

## 📝 Catatan

- Password default untuk demo account: `admin123` dan `pembeli123`
- Untuk production, ganti password dan tambah validasi lebih ketat
- Sistem ini menggunakan session, bukan JWT/token
- Review hanya bisa diedit/hapus oleh pemiliknya (pembeli)
- Admin tidak bisa membuat review (sesuai requirement)

## 🔄 Integrasi dengan Project Lama

File lama (Agency & Group) masih bisa diakses melalui:
- `controller.php?controller=agency&action=list`
- Link tersedia di navbar

## 📞 Support

Jika ada pertanyaan atau error, silakan hubungi developer.
