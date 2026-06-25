# Ringkasan Struktur Proyek — sepatuapp

Dokumen ini berfungsi sebagai ringkasan struktur folder/file, skema basis data, dan relasi antar tabel agar agen AI atau pengembang baru dapat memahami proyek dengan cepat.

## Ikhtisar singkat
- Nama proyek: sepatuapp
- Framework: Laravel (PHP)
- Tujuan: Aplikasi katalog/produk (produk memiliki kategori, ada pengguna standar Laravel)

## Struktur folder utama

- `app/` — kode aplikasi utama (Models, Http, Providers, dll.)
- `bootstrap/` — bootstrap framework
- `config/` — konfigurasi aplikasi
- `database/` — migrations, factories, seeders
- `public/` — entry web (index.php), aset publik
- `resources/` — views, CSS/JS sumber
- `routes/` — definisi route (`web.php`, `api.php`)
- `storage/` — file yang di-generate runtime
- `tests/` — test suite
- `vendor/` — dependensi composer

## File penting

- `artisan` — CLI Laravel
- `composer.json` — dependensi PHP
- `package.json` & `vite.config.js` — asset tooling (frontend)
- `phpunit.xml` — konfigurasi tes

## Struktur `app/` yang penting

- `app/Models/` — model Eloquent utama:
  - `Category.php` — model `categories`
  - `Product.php` — model `products`
  - `User.php` — model `users` (extends Authenticatable)
- `app/Http/Controllers/` — tempat controller (lihat implementasi per fitur)
- `app/Providers/` — service providers

## Skema basis data (ringkasan dari migrations)

1) Tabel `users` (file migration: `database/migrations/2014_10_12_000000_create_users_table.php`)
   - Kolom utama: `id`, `name`, `email` (unique), `email_verified_at`, `password`, `remember_token`, `timestamps`

2) Tabel `categories` (file migration: `database/migrations/2026_04_27_000000_create_categories_table.php`)
   - Kolom utama: `id`, `name`, `slug` (unique), `description` (nullable), `timestamps`

3) Tabel `products` (file migration: `database/migrations/2026_04_27_000001_create_products_table.php`)
   - Kolom utama: `id`, `name`, `description` (nullable), `price` (decimal(10,2)), `image` (nullable), `category_id` (foreign key), `stock` (integer, default 0), `timestamps`

## Relasi antar model / tabel
- `Category` -> `Product`: One-to-Many
  - Terlihat di `app/Models/Category.php`: `products()` mengembalikan `hasMany(Product::class)`
- `Product` -> `Category`: Many-to-One (di database via `category_id` foreign key, constrained, onDelete cascade)
- `User` tidak memiliki relasi eksplisit di model ini (default Laravel `users` untuk otentikasi)

Catatan: `Product` model saat ini belum men-declare `belongsTo(Category::class)` secara eksplisit, namun relasi DB ada melalui migration `category_id`.

## Routes dan API
- Route utama berada di `routes/web.php` (web routes) dan `routes/api.php` (API endpoints). Periksa controller terkait di `app/Http/Controllers/` untuk detail endpoint.

## Testing & Development
- Menjalankan dependensi PHP:

```
composer install
```

- Memasang dependensi frontend & build assets:

```
npm install
npm run build
```

- Persiapan environment:
  - Salin `.env.example` ke `.env` dan sesuaikan database serta konfigurasi lain.
  - Generate app key: `php artisan key:generate`
  - Jalankan migration: `php artisan migrate`

## Panduan ringkas untuk agen AI
- Entitas utama: `User`, `Category`, `Product`.
- Hubungan penting: `Category` -> `Product` (1:N). Gunakan migration `category_id` untuk menemukan produk per kategori.
- Untuk memperluas pemahaman agen, lihat:
  - Model: `app/Models/Category.php`, `app/Models/Product.php`, `app/Models/User.php`
  - Migrations: `database/migrations/*create_*.php`
  - Route entry points: `routes/web.php`, `routes/api.php`

## Saran tindakan selanjutnya
- Tambahkan docstring di `Product.php` untuk menspesifikkan relasi `belongsTo(Category::class)`.
- Tambahkan ERD singkat (diagram) di repository jika ingin visualisasi relasi.

---
Generated on: 2026-06-13
