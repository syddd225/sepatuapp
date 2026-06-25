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

            <div class="form-group">
                <label for="images">Foto-Foto Produk (Maksimal 3 Gambar sekaligus)</label>
                <input 
                    type="file" 
                    id="images" 
                    name="images[]" 
                    accept="image/jpeg,image/png,image/webp"
                    multiple
                >
                
                @if ($errors->has('images'))
                    <div class="error-messages">
                        @foreach ($errors->get('images') as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </div>
                @endif

                @if ($errors->has('images.*'))
                    <div class="error-messages">
                        @foreach ($errors->all() as $error)
                            @if (str_contains($error, 'images.'))
                                <li>{{ $error }}</li>
                            @endif
                        @endforeach
                    </div>
                @endif
                
                <small style="display: block; margin-top: 5px; color: #666;">
                    Anda bisa memilih hingga <strong>3 gambar</strong> secara bersamaan. <br>
                    • Gambar ke-1: Menjadi Foto Utama di halaman depan.<br>
                    • Gambar ke-2 & ke-3: Menjadi Foto Sudut Lain (Carousel Slider).<br>
                    • <em>Kosongkan jika tidak ingin mengubah foto saat ini.</em>
                </small>
            </div>

            <div class="form-group">
                <label>Foto Produk Aktif Saat Ini:</label>
                <div style="display: flex; gap: 12px; flex-wrap: wrap; margin-top: 0.5rem;">
                    
                    @if ($product->image && file_exists(public_path('image/' . $product->image)))
                        <div style="text-align: center;">
                            <img src="/image/{{ $product->image }}" style="width: 90px; height: 90px; object-fit: cover; border-radius: 6px; border: 2px solid #C19A6B;">
                        </div>
                    @endif

                    @if (!empty($product->images_angles))
                        @php
                            if (is_array($product->images_angles)) {
                                $angles = $product->images_angles;
                            } elseif (is_string($product->images_angles)) {
                                $decoded = json_decode($product->images_angles, true);
                                $angles = is_array($decoded) ? $decoded : explode(',', $product->images_angles);
                            } else {
                                $angles = [];
                            }
                        @endphp
                        @foreach ($angles as $angle)
                            @if (!empty(trim($angle)) && file_exists(public_path('image/' . trim($angle))))
                                <div style="text-align: center;">
                                    <img src="/image/{{ trim($angle) }}" style="width: 90px; height: 90px; object-fit: cover; border-radius: 6px; border: 1px solid #ddd;">
                                </div>
                            @endif
                        @endforeach
                    @endif

                </div>
            </div>

            <div class="form-group">
    <label for="materials">Bahan (pisahkan dengan koma)</label>
    @php
        // Ambil data lama dari inputan jika gagal validasi
        $materialsValue = old('materials');
        
        // Jika tidak ada data 'old', kita olah data dari database ($product)
        if (is_null($materialsValue)) {
            if (is_array($product->materials)) {
                // Jika tipenya array, gabungkan dengan koma
                $materialsValue = implode(', ', $product->materials);
            } elseif (is_string($product->materials)) {
                // Jika berupa string JSON, kita coba decode dulu
                $decodedMaterials = json_decode($product->materials, true);
                if (is_array($decodedMaterials)) {
                    $materialsValue = implode(', ', $decodedMaterials);
                } else {
                    $materialsValue = $product->materials;
                }
            } else {
                $materialsValue = '';
            }
        }
    @endphp
    <textarea 
        id="materials" 
        name="materials" 
        placeholder="Contoh: Kulit Asli, Sol Karet Alami, Flock Lining"
        style="min-height: 100px;"
    >{{ $materialsValue }}</textarea>
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

    <script>
        document.getElementById('images').addEventListener('change', function() {
            if (this.files.length > 3) {
                alert('Maksimal foto yang boleh diunggah adalah 3 gambar! Silakan pilih ulang.');
                this.value = ''; // Reset inputan file
            }
        });
    </script>
@endsection