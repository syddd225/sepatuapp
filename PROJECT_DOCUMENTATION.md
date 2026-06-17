# Project Documentation — sepatuapp

Dokumen ini merangkum struktur folder, tech stack, skema basis data, relasi antar tabel, serta panduan pengembangan untuk proyek `sepatuapp`. Tujuan: memudahkan agen AI atau pengembang baru memahami dan bekerja pada kode.

## 1. Ikhtisar
- Nama proyek: sepatuapp
- Framework: Laravel (PHP)
- PHP: ^8.1
- Database default: SQLite (lihat `database/database.sqlite` dan `config/database.php`)
- Tujuan: Aplikasi katalog produk sederhana (produk terkait kategori) — cocok sebagai basis e-commerce/katalog.

## 2. Tech Stack & Dependensi
- Backend: Laravel (lihat `composer.json`)
  - Dependensi utama: `laravel/framework`, `laravel/sanctum`, `guzzlehttp/guzzle`
  - Dev packages: `fakerphp/faker`, `phpunit/phpunit`, `nunomaduro/collision`, dll.
- Frontend/tooling: Vite, Laravel Vite plugin (lihat `package.json`)
  - DevDependencies: `vite`, `laravel-vite-plugin`, `axios`

## 3. Struktur Folder Ringkas
- `app/` — kode aplikasi (Models, Http, Providers)
  - `app/Models/` berisi `Category.php`, `Product.php`, `User.php`
- `bootstrap/` — bootstrap framework
- `config/` — konfigurasi aplikasi
- `database/` — migrations, factories, seeders, `database.sqlite`
- `public/` — entry point web (`index.php`) dan aset publik
- `resources/` — views, css, js, sass
- `routes/` — `web.php`, `api.php`
- `storage/` — file runtime
- `tests/` — unit/feature tests

## 4. Models & Skema Basis Data (dari migrations)

1) `users` (`database/migrations/2014_10_12_000000_create_users_table.php`)
   - Kolom: `id`, `name`, `email` (unique), `email_verified_at`, `password`, `remember_token`, `timestamps`
   - Model: `app/Models/User.php` (Authenticatable, Sanctum tokens enabled)

2) `categories` (`database/migrations/2026_04_27_000000_create_categories_table.php`)
   - Kolom: `id`, `name`, `slug` (unique), `description` (nullable), `timestamps`
   - Model: `app/Models/Category.php`
   - Relasi: `hasMany` terhadap `Product`

3) `products` (`database/migrations/2026_04_27_000001_create_products_table.php`)
   - Kolom: `id`, `name`, `description` (nullable), `price` (decimal 10,2), `image` (nullable), `category_id` (foreign key), `stock` (integer default 0), `timestamps`
   - Model: `app/Models/Product.php`

## 5. Relasi Antar Model
- `Category` -> `Product`: One-to-Many
  - `app/Models/Category.php` declares `products()` returning `hasMany(Product::class)`.
- `Product` -> `Category`: Many-to-One (via `category_id` FK, constrained, `onDelete('cascade')` in migration). Note: `Product` model currently does not declare `belongsTo(Category::class)` explicitly — disarankan ditambahkan.
- `User` tidak memiliki relasi domain lain dalam kode saat ini.

## 6. Routes & Entry Points
- Web routes: [routes/web.php](routes/web.php)
- API routes: [routes/api.php](routes/api.php)
- Periksa controller di `app/Http/Controllers/` untuk implementation detail endpoint.

## 7. Development & Runbook
1. Install PHP deps:

```bash
composer install
```

2. Install Node deps & build assets:

```bash
npm install
npm run build
```

3. Environment setup:

```bash
copy .env.example .env
php artisan key:generate
```

4. Database (SQLite):

```bash
php artisan migrate
```

5. Run local server:

```bash
php artisan serve
```

## 8. Pengamatan & Saran Perbaikan
- Tambahkan relasi `belongsTo(Category::class)` di `app/Models/Product.php` agar relasi Eloquent lengkap.
- Tambahkan factory & seeder untuk `Category` dan `Product` guna mempercepat pengujian lokal.
- Jika menggunakan Windows (Laragon), pertimbangkan endpoint file-server untuk melayani file upload publik tanpa symlink.

## 9. Referensi cepat (file penting)
- Model utama: [app/Models/Category.php](app/Models/Category.php), [app/Models/Product.php](app/Models/Product.php), [app/Models/User.php](app/Models/User.php)
- Migrations: [database/migrations/2026_04_27_000000_create_categories_table.php](database/migrations/2026_04_27_000000_create_categories_table.php), [database/migrations/2026_04_27_000001_create_products_table.php](database/migrations/2026_04_27_000001_create_products_table.php)
- Composer & Node config: [composer.json](composer.json), [package.json](package.json)

---
Generated on: 2026-06-13
