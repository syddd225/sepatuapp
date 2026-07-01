<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Aktivitas & Status Transaksi</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #2a2a2a; margin: 0; padding: 30px; color: #e0e0e0; }
        .container { max-width: 1200px; margin: 0 auto; background: #1e1e1e; padding: 25px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.5); border: 1px solid #333; }
        h1 { font-size: 24px; margin-bottom: 20px; color: #fff; border-bottom: 2px solid #333; padding-bottom: 10px; }
        
        .alert-success { background-color: #1b5e20; color: #c8e6c9; padding: 12px; border-radius: 6px; margin-bottom: 20px; font-weight: 500; border: 1px solid #2e7d32; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 15px; background: #1e1e1e; }
        th, td { padding: 14px; text-align: left; border-bottom: 1px solid #333; }
        th { background-color: #2a2a2a; color: #fff; font-weight: 600; text-transform: uppercase; font-size: 12px; letter-spacing: 0.5px; }
        tr:hover { background-color: #252525; }
        
        .badge { padding: 6px 12px; border-radius: 50px; font-size: 12px; font-weight: 600; display: inline-block; }
        .badge-diproses { background-color: #e65100; color: #ffe0b2; }
        .badge-siap_kirim { background-color: #0d47a1; color: #e3f2fd; }
        .badge-sudah_sampai { background-color: #1b5e20; color: #c8e6c9; }
        
        .action-form { display: flex; gap: 8px; align-items: center; }
        .select-status { padding: 8px 12px; background: #2a2a2a; border: 1px solid #444; border-radius: 6px; color: #fff; font-size: 13px; cursor: pointer; }
        .select-status:focus { border-color: #2196f3; outline: none; }
        
        .btn-acc { background-color: #2196f3; color: white; border: none; padding: 8px 16px; border-radius: 6px; font-weight: 600; font-size: 13px; cursor: pointer; transition: background 0.2s; }
        .btn-acc:hover { background-color: #1e88e5; }
    </style>
</head>
<body>

<div class="container">
    <h1>Aktivitas & Status Transaksi</h1>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID Transaksi</th>
                <th>Pelanggan</th>
                <th>Produk & Varian</th>
                <th>Total Bayar</th>
                <th>Status Paket</th>
                <th>Aksi Admin Worker</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
                <tr>
                    <td style="font-weight: 600; color: #2196f3;">{{ $order->transaction_id }}</td>
                    <td>{{ $order->user->name ?? 'Guest' }}</td>
                    <td>
                        <div style="font-weight: 500; color: #fff;">{{ $order->product->name ?? 'Produk Dihapus' }}</div>
                        <small style="color: #aaa;">Qty: {{ $order->qty }} | Ukuran: {{ $order->ukuran }} | Warna: {{ $order->warna }}</small>
                    </td>
                    <td style="font-weight: 600; color: #4caf50;">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</td>
                    <td>
                        @if($order->status == 'diproses' || !$order->status)
                            <span class="badge badge-diproses">Belum Siap Kirim (Diproses)</span>
                        @elseif($order->status == 'siap_kirim')
                            <span class="badge badge-siap_kirim">Siap Kirim</span>
                        @elseif($order->status == 'sudah_sampai')
                            <span class="badge badge-sudah_sampai">Sudah Sampai</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="action-form">
                            @csrf
                            <select name="status" class="select-status" required>
                                <option value="" disabled selected> Ubah Status </option>
                                <option value="siap_kirim" {{ $order->status == 'siap_kirim' ? 'selected' : '' }}>Dikirim</option>
                                <option value="sudah_sampai" {{ $order->status == 'sudah_sampai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                            <button type="submit" class="btn-acc">Update ACC</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: #94a3b8; padding: 40px;">Belum ada aktivitas transaksi saat ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

</body>
</html>