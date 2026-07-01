@extends('admin.layout')

@section('title', 'Tambah Produk - Admin Panel')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Tambah Produk Baru</h2>
        </div>

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Nama Produk -->
            <div class="form-group">
                <label for="name">Nama Produk *</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    placeholder="Contoh: Retro Formal Black Leather"
                    value="{{ old('name') }}"
                    required
                >
                @error('name')
                    <div class="error-messages">
                        <li>{{ $message }}</li>
                    </div>
                @enderror
                <small>Nama unik yang akan ditampilkan di katalog</small>
            </div>

            <!-- Deskripsi -->
            <div class="form-group">
                <label for="description">Deskripsi *</label>
                <textarea 
                    id="description" 
                    name="description" 
                    placeholder="Jelaskan detail produk, bahan, kualitas, dll..."
                    required
                >{{ old('description') }}</textarea>
                @error('description')
                    <div class="error-messages">
                        <li>{{ $message }}</li>
                    </div>
                @enderror
                <small>Gunakan deskripsi yang detail untuk menarik pembeli</small>
            </div>

            <!-- Harga -->
            <div class="form-group">
                <label for="price">Harga (Rp) *</label>
                <input 
                    type="number" 
                    id="price" 
                    name="price" 
                    placeholder="Contoh: 300000"
                    step="1000"
                    min="0"
                    value="{{ old('price') }}"
                    required
                >
                @error('price')
                    <div class="error-messages">
                        <li>{{ $message }}</li>
                    </div>
                @enderror
                <small>Harga dalam rupiah (tanpa Rp.)</small>
            </div>

            <!-- Kategori -->
            <div class="form-group">
                <label for="category_id">Kategori *</label>
                <select id="category_id" name="category_id" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="error-messages">
                        <li>{{ $message }}</li>
                    </div>
                @enderror
                <small>Pilih kategori yang sesuai untuk produk ini</small>
            </div>

            <!-- Stok -->
            <div class="form-group">
                <label for="stock">Stok *</label>
                <input 
                    type="number" 
                    id="stock" 
                    name="stock" 
                    placeholder="Contoh: 5"
                    min="0"
                    value="{{ old('stock', 0) }}"
                    required
                >
                @error('stock')
                    <div class="error-messages">
                        <li>{{ $message }}</li>
                    </div>
                @enderror
                <small>Jumlah stok tersedia. Input 0 jika produk tidak tersedia</small>
            </div>

            <!-- Foto Utama -->
            <div class="form-group">
                <label for="image">Foto Produk (JPG/PNG/WebP, Max 5MB)</label>
                <input 
                    type="file" 
                    id="image" 
                    name="image" 
                    accept="image/jpeg,image/png,image/webp"
                >
                @error('image')
                    <div class="error-messages">
                        <li>{{ $message }}</li>
                    </div>
                @enderror
                <small>Upload foto utama produk. File akan dioptimasi otomatis.</small>
            </div>

            <!-- Bahan/Material -->
            <div class="form-group">
                <label for="materials">Bahan (pisahkan dengan koma)</label>
                <textarea 
                    id="materials" 
                    name="materials" 
                    placeholder="Contoh: Kulit Asli, Sol Karet Alami, Flock Lining"
                    style="min-height: 100px;"
                >{{ old('materials') }}</textarea>
                @error('materials')
                    <div class="error-messages">
                        <li>{{ $message }}</li>
                    </div>
                @enderror
                <small>Daftar bahan yang digunakan, pisahkan setiap bahan dengan koma</small>
            </div>

            <!-- Filosofi -->
            <div class="form-group">
                <label for="philosophy">Filosofi Produk</label>
                <textarea 
                    id="philosophy" 
                    name="philosophy" 
                    placeholder="Cerita dibalik produk ini, nilai-nilai yang diwakili, dll..."
                >{{ old('philosophy') }}</textarea>
                @error('philosophy')
                    <div class="error-messages">
                        <li>{{ $message }}</li>
                    </div>
                @enderror
                <small>Cerita unik dan filosofi produk untuk membuat pembeli terhubung emosional</small>
            </div>

            <!-- Foto Sudut Lain -->
            <div class="form-group">
                <label for="images_angles">Nama File Foto Sudut Lain (pisahkan dengan koma)</label>
                <textarea 
                    id="images_angles" 
                    name="images_angles" 
                    placeholder="Contoh: formal-black-side.jpg, formal-black-top.jpg, formal-black-sole.jpg"
                    style="min-height: 100px;"
                >{{ old('images_angles') }}</textarea>
                @error('images_angles')
                    <div class="error-messages">
                        <li>{{ $message }}</li>
                    </div>
                @enderror
                <small>Nama file foto dari sudut lain (harus sudah ada di folder /public/image). Pisahkan dengan koma.</small>
            </div>

            <!-- No WhatsApp -->
            <div class="form-group">
                <label for="whatsapp_phone">No. WhatsApp (optional)</label>
                <input 
                    type="text" 
                    id="whatsapp_phone" 
                    name="whatsapp_phone" 
                    placeholder="Contoh: 62895321683364"
                    value="{{ old('whatsapp_phone') }}"
                >
                @error('whatsapp_phone')
                    <div class="error-messages">
                        <li>{{ $message }}</li>
                    </div>
                @enderror
                <small>No. WhatsApp untuk inquiry produk ini (format: 62XXX...)</small>
            </div>

            <!-- Buttons -->
            <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                <button type="submit" class="btn btn-primary" style="flex: 1;">
                    💾 Simpan Produk
                </button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary" style="flex: 1; text-align: center;">
                    ← Kembali
                </a>
            </div>
        </form>
    </div>
@endsection
