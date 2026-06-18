<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Retro Collection</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background-color: #1E1E1E;
            color: #ddd;
            line-height: 1.6;
        }

        .admin-container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Header/Navigation */
        .admin-header {
            background: #2a2a2a;
            border-bottom: 1px solid #C19A6B;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .admin-header h1 {
            font-size: 1.5rem;
            color: #C19A6B;
        }

        .admin-nav {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .admin-nav a {
            color: #ddd;
            text-decoration: none;
            transition: color 0.3s;
        }

        .admin-nav a:hover {
            color: #C19A6B;
        }

        .logout-btn {
            background: #C19A6B;
            color: #1E1E1E;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 600;
            transition: background 0.3s;
        }

        .logout-btn:hover {
            background: #d4a86a;
        }

        /* Main Content */
        .admin-content {
            flex: 1;
            padding: 2rem;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
        }

        /* Alert Messages */
        .alert {
            padding: 1rem;
            border-radius: 4px;
            margin-bottom: 1.5rem;
            animation: slideIn 0.3s ease-in;
        }

        .alert-success {
            background: rgba(76, 175, 80, 0.1);
            border-left: 4px solid #4caf50;
            color: #81c784;
        }

        .alert-error {
            background: rgba(244, 67, 54, 0.1);
            border-left: 4px solid #f44336;
            color: #ef5350;
        }

        .alert-warning {
            background: rgba(255, 193, 7, 0.1);
            border-left: 4px solid #ffc107;
            color: #ffb74d;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Cards */
        .card {
            background: #2a2a2a;
            border: 1px solid #444;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #444;
        }

        .card-header h2 {
            font-size: 1.3rem;
            color: #C19A6B;
        }

        /* Buttons */
        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
            font-size: 0.95rem;
        }

        .btn-primary {
            background: #C19A6B;
            color: #1E1E1E;
        }

        .btn-primary:hover {
            background: #d4a86a;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: #444;
            color: #ddd;
        }

        .btn-secondary:hover {
            background: #555;
        }

        .btn-danger {
            background: #f44336;
            color: white;
        }

        .btn-danger:hover {
            background: #e53935;
        }

        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.85rem;
        }

        /* Forms */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #C19A6B;
            font-weight: 600;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 0.75rem;
            background: #1E1E1E;
            border: 1px solid #444;
            border-radius: 4px;
            color: #ddd;
            font-family: inherit;
            font-size: 0.95rem;
            transition: border-color 0.3s;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #C19A6B;
        }

        .form-group textarea {
            min-height: 150px;
            resize: vertical;
        }

        .form-group small {
            display: block;
            margin-top: 0.5rem;
            color: #999;
            font-size: 0.85rem;
        }

        .error-messages {
            margin-top: 0.5rem;
            color: #ef5350;
            font-size: 0.85rem;
        }

        .error-messages li {
            list-style: none;
            margin-bottom: 0.25rem;
        }

        /* Table */
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        .table th {
            background: #333;
            color: #C19A6B;
            padding: 1rem;
            text-align: left;
            border-bottom: 2px solid #444;
            font-weight: 600;
        }

        .table td {
            padding: 1rem;
            border-bottom: 1px solid #444;
        }

        .table tbody tr:hover {
            background: #252525;
        }

        .table-actions {
            display: flex;
            gap: 0.5rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .admin-header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .admin-nav {
                flex-wrap: wrap;
                justify-content: center;
            }

            .table {
                font-size: 0.85rem;
            }

            .table th,
            .table td {
                padding: 0.75rem 0.5rem;
            }

            .table-actions {
                flex-direction: column;
            }

            .btn-sm {
                width: 100%;
                text-align: center;
            }
        }

        /* Stats Dashboard */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: #2a2a2a;
            border: 1px solid #444;
            border-radius: 8px;
            padding: 1.5rem;
            text-align: center;
        }

        .stat-card h3 {
            color: #999;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .stat-card .value {
            font-size: 2.5rem;
            color: #C19A6B;
            font-weight: 700;
        }

        /* Image Preview */
        .image-preview {
            max-width: 200px;
            max-height: 200px;
            border-radius: 4px;
            margin-top: 1rem;
            border: 1px solid #444;
        }

        /* Loading State */
        .loading {
            opacity: 0.6;
            pointer-events: none;
        }

        /* Pagination */
        .pagination {
            display: flex;
            gap: 0.5rem;
            margin-top: 2rem;
            justify-content: center;
        }

        .pagination a,
        .pagination span {
            padding: 0.5rem 1rem;
            background: #2a2a2a;
            border: 1px solid #444;
            color: #ddd;
            text-decoration: none;
            border-radius: 4px;
            transition: all 0.3s;
        }

        .pagination a:hover {
            background: #444;
            border-color: #C19A6B;
        }

        .pagination .active span {
            background: #C19A6B;
            color: #1E1E1E;
            border-color: #C19A6B;
        }
    </style>
    @yield('extra_styles')
</head>
<body>
    <div class="admin-container">
        @if (!Route::is('admin.login'))
            <header class="admin-header">
                <h1>🛠️ Admin Panel</h1>
                <nav class="admin-nav">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    <a href="{{ route('admin.products.create') }}">+ Produk Baru</a>
                    <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="logout-btn">Logout</button>
                    </form>
                </nav>
            </header>
        @endif

        <main class="admin-content">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    ✅ {{ $message }}
                </div>
            @endif

            @if ($message = Session::get('error'))
                <div class="alert alert-error">
                    ❌ {{ $message }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
