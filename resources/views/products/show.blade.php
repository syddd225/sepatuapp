<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Detail Produk</title>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
	<style>
		body {
			font-family: 'Inter', sans-serif;
			background-color: #F5F5F5;
			color: #333;
			margin: 0;
		}
		.container {
			max-width: 700px;
			margin: 60px auto;
			background-color: white;
			border-radius: 12px;
			box-shadow: 0 4px 15px rgba(0,0,0,0.1);
			overflow: hidden;
			padding: 40px;
		}
		.img-box {
			text-align: center;
		}
		.img-box img {
			width: 320px;
			height: 240px;
			object-fit: cover;
			border-radius: 12px;
			margin-bottom: 24px;
		}
		.name {
			font-size: 2.2rem;
			font-weight: 700;
			margin-bottom: 12px;
			color: #111;
			letter-spacing: 0.5px;
		}
		.category {
			font-size: 0.95rem;
			color: #C19A6B;
			margin-bottom: 20px;
			font-weight: 500;
			text-transform: uppercase;
			letter-spacing: 1px;
		}
		.desc {
			font-size: 1.05rem;
			line-height: 1.7;
			color: #666;
			margin-bottom: 24px;
			text-align: justify;
		}
		.price {
			color: #C19A6B;
			font-size: 1.5rem;
			font-weight: bold;
			margin-bottom: 18px;
		}
		.btn {
			display: inline-block;
			padding: 12px 28px;
			border-radius: 10px;
			background: #C19A6B;
			color: white;
			text-decoration: none;
			font-size: 1rem;
			transition: 0.3s;
		}
		.btn:hover {
			background: #a8855a;
		}
		.back-link {
			display: inline-block;
			margin-bottom: 20px;
			color: #C19A6B;
			text-decoration: none;
		}
	</style>
</head>
<body>
	<div class="container">
		<a href="/category/{{ $product->category_id }}" class="back-link">&larr; Kembali ke Produk</a>
		<div class="img-box">
			<img src="/image/{{ $product->image }}" alt="{{ $product->name }}">
		</div>
		<div class="name">{{ $product->name }}</div>
		<div class="category">Kategori: {{ $product->category->name ?? '-' }}</div>
		<div class="desc">{{ $product->description }}</div>
		<div class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
		<a href="https://wa.me/62895321683364?text=Saya mau {{ urlencode($product->name) }}" class="btn" target="_blank">Pesan Sekarang</a>
	</div>
</body>
</html>
