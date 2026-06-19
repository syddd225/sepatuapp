@extends('admin.layout')

@section('title', 'Edit Produk - Admin Panel')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Edit Produk</h2>
        </div>

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Nama Produk -->
            <div class="form-group">
                <label for="name">Nama Produk *</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    placeholder="Contoh: Retro Formal Black Leather"
                    value="{{ old('name', $product->name) }}"
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
                >{{ old('description', $product->description) }}</textarea>
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
                    value="{{ old('price', $product->price) }}"
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
                        <option 
                            value="{{ $category->id }}" 
                            @selected(old('category_id', $product->category_id) == $category->id)
                        >
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
                    value="{{ old('stock', $product->stock) }}"
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
                
                @if ($product->image && file_exists(public_path('image/' . $product->image)))
                    <div style="margin-bottom: 1rem;">
                        <p style="margin-bottom: 0.5rem; color: #999;">Foto saat ini:</p>
                        <img 
                            src="/image/{{ $product->image }}" 
                            alt="{{ $product->name }}"
                            class="image-preview"
                        >
                    </div>
                @endif

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
                <small>Upload foto baru untuk mengganti. Biarkan kosong jika tidak ingin mengubah.</small>
            </div>

            <!-- Bahan/Material -->
            <div class="form-group">
    <label for="materials">Bahan (pisahkan dengan koma)</label>
    <textarea 
        id="materials" 
        name="materials" 
        placeholder="Contoh: Kulit Asli, Sol Karet Alami, Flock Lining"
        style="min-height: 100px;"
    >{{ old('materials', @implode(', ', (array)$product->materials) ?: $product->materials) }}</textarea>
    @error('materials')
        <div class="error-messages">
            <li>{{ $message }}</li>
        </div>
    @enderror
    <small>Daftar bahan yang digunakan, pisahkan setiap bahan dengan koma</small>
</div>

            <div class="form-group">
                <label for="philosophy">Filosofi Produk</label>
                <textarea 
                    id="philosophy" 
                    name="philosophy" 
                    placeholder="Cerita dibalik produk ini, nilai-nilai yang diwakili, dll..."
                    >{{ old('philosophy', $product->philosophy) }}</textarea>
                    @error('philosophy')
                <div class="error-messages">
                <li>{{ $message }}</li>
            </div>
                @enderror
                <small>Cerita unik dan filosofi produk untuk membuat pembeli terhubung emosional</small>
            </div>

        <div class="form-group">
        <label for="images_angles">Nama File Foto Sudut Lain (pisahkan dengan koma)</label>
        @php
            // Mengamankan data images_angles apa pun bentuknya
            $anglesValue = old('images_angles');
            if (is_null($anglesValue)) {
                if (is_array($product->images_angles)) {
                    $anglesValue = implode(', ', $product->images_angles);
                } elseif (is_string($product->images_angles)) {
                    $decodedAngles = json_decode($product->images_angles, true);
                    $anglesValue = is_array($decodedAngles) ? implode(', ', $decodedAngles) : $product->images_angles;
                } else {
                    $anglesValue = '';
                }
            }
            @endphp
            <textarea 
                id="images_angles" 
                name="images_angles" 
                placeholder="Contoh: formal-black-side.jpg, formal-black-top.jpg, formal-black-sole.jpg"
                style="min-height: 100px;"
            >{{ $anglesValue }}</textarea>
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
                    value="{{ old('whatsapp_phone', $product->whatsapp_phone) }}"
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
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary" style="flex: 1; text-align: center;">
                    Kembali
                </a>
            </div>
        </form>
    </div>

    <!-- Danger Zone -->
    <div class="card" style="margin-top: 2rem; border-left: 4px solid #f44336;">
        <div class="card-header">
            <h2 style="color: #ef5350;">Zona Bahaya</h2>
        </div>

        <p style="margin-bottom: 1rem; color: #ef5350;">
            Menghapus produk tidak dapat dibatalkan. Foto produk juga akan dihapus.
        </p>

        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin akan menghapus produk &quot;{{ $product->name }}&quot;? Tindakan ini tidak dapat dibatalkan!');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                Hapus Produk Selamanya
            </button>
        </form>
    </div>
@endsection
