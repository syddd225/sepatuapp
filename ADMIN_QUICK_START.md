# 🚀 QUICK START - Admin Panel

Ini adalah panduan cepat 5 menit untuk mulai menggunakan admin panel!

---

## 1️⃣ Login (1 menit)

Buka browser, ketik:
```
http://localhost:8000/admin/login
```

**Password:** `admin123`

Click **Login** → Done!

---

## 2️⃣ Dashboard (1 menit)

Akan melihat:
- 📊 Stats (Total Produk, Stok Rendah, Kategori)
- 🔍 Search bar
- 📦 Tabel produk existing
- ⚡ Edit/Hapus buttons

---

## 3️⃣ Tambah Produk (2 menit)

1. Click **"+ Produk Baru"** button
2. Isi form:
   ```
   Nama: "Sepatu Retro Hitam"
   Deskripsi: "Sepatu formal dengan desain modern"
   Harga: 300000
   Kategori: Formal
   Stok: 5
   ```
3. (Optional) Upload foto
4. Click **"💾 Simpan Produk"**
5. Done! Produk langsung muncul di dashboard dan katalog frontend

---

## 4️⃣ Edit Produk (1 menit)

1. Di dashboard, click **"Edit"** pada produk
2. Update field yang mau diubah
3. Click **"💾 Simpan Perubahan"**
4. Done!

---

## 5️⃣ Hapus Produk (30 detik)

1. Click **"Hapus"** button pada produk
2. Confirm di dialog
3. Done! Produk hilang dari katalog

---

## 🔑 Password

Default: `admin123`

**Ganti password:**
1. Edit file `.env` (di root folder)
2. Cari baris: `ADMIN_PASSWORD=admin123`
3. Ubah jadi: `ADMIN_PASSWORD=password_baru`
4. Clear cache: `php artisan config:cache`

---

## 📋 Form Fields

| Field | Required? | Notes |
|-------|-----------|-------|
| Nama | ✅ Yes | Harus unik (tidak boleh duplikat) |
| Deskripsi | ✅ Yes | Max 1000 karakter |
| Harga | ✅ Yes | Angka saja, contoh: 300000 |
| Kategori | ✅ Yes | Pilih dari dropdown |
| Stok | ✅ Yes | 0 = tidak tersedia, >0 = tersedia |
| Foto | ❌ No | JPG/PNG/WebP, max 5MB |
| Bahan | ❌ No | Pisahkan dengan koma, contoh: "Kulit, Sol Karet" |
| Filosofi | ❌ No | Text area, cerita produk |
| Foto Sudut | ❌ No | Nama file, pisahkan koma |
| WhatsApp | ❌ No | Nomor 62XXX |

---

## ⚡ Tips

- **Search:** Ketik nama produk di search bar
- **Filter:** Pilih kategori di dropdown
- **Pagination:** Click nomor halaman buat lihat produk lebih banyak
- **Images:** Foto harus di folder `/public/image/` terlebih dahulu (kecuali upload langsung)
- **Color Stock:**
  - 🟢 Green = Stok > 10 (banyak)
  - 🟡 Yellow = Stok 1-10 (sedang)
  - 🔴 Red = Stok 0 (habis)

---

## 🆘 Problem?

**Lupa password?**
- Edit `.env` → ganti `ADMIN_PASSWORD` value

**Foto tidak upload?**
- Check format (JPG/PNG/WebP only)
- Check ukuran (max 5MB)
- Check folder `/public/image/` exists

**Login tidak bekerja?**
- Refresh page
- Clear browser cache
- Check password di `.env`

**Table tidak update?**
- Refresh page
- Clear Laravel cache: `php artisan cache:clear`

---

## 📱 Mobile?

Admin panel sudah mobile-friendly! Gunakan di smartphone juga.

---

## ✨ Itu saja!

Admin panel sudah siap. Mulai kelola produk sekarang! 🎉

Untuk panduan lebih detail → buka `ADMIN_PANEL_GUIDE.md`

Happy selling! 🚀
