@extends('admin.layout')

@section('title', 'Dashboard - Admin Panel')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>📊 Dashboard</h2>
            <div>
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary">+ Tambah Produk</a>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Produk</h3>
                <div class="value">{{ $totalProducts ?? 0 }}</div>
            </div>
            <div class="stat-card">
                <h3>Stok Rendah</h3>
                <div class="value">{{ $lowStockProducts ?? 0 }}</div>
            </div>
            <div class="stat-card">
                <h3>Kategori</h3>
                <div class="value">{{ $categories->count() ?? 0 }}</div>
            </div>
        </div>
    </div>

    <!-- Search & Filter -->
    <div class="card">
        <form action="{{ route('admin.search') }}" method="GET" style="display: flex; gap: 1rem; flex-wrap: wrap;">
            <input 
                type="text" 
                name="q" 
                placeholder="Cari nama produk atau deskripsi..." 
                value="{{ $searchQuery ?? '' }}"
                style="flex: 1; min-width: 200px; padding: 0.75rem; background: #1E1E1E; border: 1px solid #444; border-radius: 4px; color: #ddd;"
            >
            <select 
                name="category" 
                style="padding: 0.75rem; background: #1E1E1E; border: 1px solid #444; border-radius: 4px; color: #ddd;"
            >
                <option value="">Semua Kategori</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" @selected($selectedCategory == $cat->id)>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary">Cari</button>
        </form>
    </div>

    <!-- Products Table -->
    <div class="card">
        <div class="card-header">
            <h2>📦 Daftar Produk</h2>
        </div>

        @if ($products->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>
                                @if ($product->image && file_exists(public_path('image/' . $product->image)))
                                    <img 
                                        src="/image/{{ $product->image }}" 
                                        alt="{{ $product->name }}"
                                        style="max-width: 60px; height: 60px; object-fit: cover; border-radius: 4px;"
                                    >
                                @else
                                    <div style="width: 60px; height: 60px; background: #444; border-radius: 4px; display: flex; align-items: center; justify-content: center; color: #999;">
                                        No Image
                                    </div>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $product->name }}</strong><br>
                                <small style="color: #999;">{{ Str::limit($product->description, 40) }}</small>
                            </td>
                            <td>
                                <span style="background: #C19A6B; color: #1E1E1E; padding: 0.25rem 0.75rem; border-radius: 4px; font-size: 0.85rem;">
                                    {{ $product->category->name ?? 'N/A' }}
                                </span>
                            </td>
                            <td>
                                <strong>Rp {{ number_format($product->price, 0, ',', '.') }}</strong>
                            </td>
                            <td>
                                <strong style="color: @if($product->stock > 10) #81c784 @elseif($product->stock > 0) #ffb74d @else #ef5350 @endif;">
                                    {{ $product->stock }}
                                </strong>
                            </td>
                            <td>
                                <div class="table-actions">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin akan menghapus produk ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="pagination">
                @if ($products->onFirstPage())
                    <span style="opacity: 0.5; cursor: not-allowed;">← Sebelumnya</span>
                @else
                    <a href="{{ $products->previousPageUrl() }}">← Sebelumnya</a>
                @endif

                @for ($i = 1; $i <= $products->lastPage(); $i++)
                    @if ($i == $products->currentPage())
                        <span class="active"><span>{{ $i }}</span></span>
                    @else
                        <a href="{{ $products->url($i) }}">{{ $i }}</a>
                    @endif
                @endfor

                @if ($products->hasMorePages())
                    <a href="{{ $products->nextPageUrl() }}">Selanjutnya →</a>
                @else
                    <span style="opacity: 0.5; cursor: not-allowed;">Selanjutnya →</span>
                @endif
            </div>
        @else
            <div style="padding: 2rem; text-align: center; color: #999;">
                <p>Belum ada produk. <a href="{{ route('admin.products.create') }}" style="color: #C19A6B;">Buat produk baru</a></p>
            </div>
        @endif
    </div>
@endsection
