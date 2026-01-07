<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Inventory System</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

<style>
:root{
    --primary:#6a5cff;
    --secondary:#9b6dff;
    --dark:#1f2937;
}

body{
    font-family:'Segoe UI',sans-serif;
    background:#f5f7fb;
}

/* NAVBAR */
.navbar{
    background:rgba(255,255,255,.85);
    backdrop-filter:blur(12px);
    box-shadow:0 8px 30px rgba(0,0,0,.08);
}
.navbar-brand{
    font-weight:800;
    color:var(--primary)!important;
}

/* HERO */
.hero{
    min-height:100vh;
    background:linear-gradient(135deg,var(--primary),var(--secondary));
    color:white;
    display:flex;
    align-items:center;
}
.hero-card{
    background:rgba(255,255,255,.15);
    backdrop-filter:blur(20px);
    border-radius:30px;
    padding:60px;
    box-shadow:0 30px 80px rgba(0,0,0,.3);
}
.hero-title{
    font-size:3.2rem;
    font-weight:800;
}
.hero-desc{
    opacity:.9;
    margin:20px 0 40px;
    font-size:1.1rem;
}
.hero-stats{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(160px,1fr));
    gap:20px;
}
.hero-stat{
    background:rgba(255,255,255,.2);
    border-radius:20px;
    padding:20px;
    text-align:center;
}
.hero-stat h3{
    font-size:2.2rem;
    margin:0;
    font-weight:700;
}

/* BUTTON */
.btn-main{
    background:linear-gradient(45deg,#ff6b6b,#ff8e53);
    border:none;
    color:white;
    padding:14px 36px;
    border-radius:40px;
    font-weight:600;
    box-shadow:0 10px 30px rgba(255,107,107,.4);
}
.btn-main:hover{
    transform:translateY(-2px);
}

/* SECTION */
.section{
    padding:90px 0;
}
.section-title{
    font-size:2.3rem;
    font-weight:700;
    text-align:center;
}
.section-subtitle{
    color:#6b7280;
    text-align:center;
    margin-bottom:60px;
}

/* ITEMS */
.items-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
    gap:30px;
}
.item-card{
    background:white;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 20px 40px rgba(0,0,0,.08);
    transition:.3s;
}
.item-card:hover{
    transform:translateY(-8px);
}
.item-image{
    height:160px;              /* ukuran pas */
    display:flex;
    align-items:center;
    justify-content:center;
    background:#f3f4f6;
}

.item-image img{
    width:100%;
    height:100%;
    object-fit:contain;        /* foto utuh, tidak kepotong */
}




.item-body{
    padding:25px;
}
.item-body h5{
    font-weight:600;
}
.item-category{
    font-size:14px;
    color:var(--primary);
}
.item-stock{
    display:inline-block;
    margin-top:12px;
    background:#eef2ff;
    color:#4338ca;
    padding:6px 14px;
    border-radius:20px;
    font-size:13px;
}

/* CTA */
.cta{
    background:linear-gradient(135deg,var(--primary),var(--secondary));
    color:white;
    padding:80px 0;
    text-align:center;
}

/* FOOTER */
footer{
    background:#111827;
    color:#9ca3af;
    padding:30px 0;
    text-align:center;
}

/* RESPONSIVE */
@media(max-width:768px){
    .hero-title{font-size:2.3rem}
    .hero-card{padding:40px}
}
</style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">
            <i class="fas fa-warehouse me-2"></i>Manajemen Investaris Barang
        </a>
        <a href="{{ route('login') }}" class="btn btn-outline-primary px-4">Login</a>
    </div>
</nav>

<!-- HERO -->
<section class="hero">
    <div class="container">
        <div class="hero-card text-center">
            <h1 class="hero-title">
                Kelola Inventaris <br>Lebih Modern & Efisien
            </h1>
            <p class="hero-desc">
                Sistem manajemen inventaris berbasis web yang rapi, cepat,
                dan mudah digunakan untuk semua kebutuhan.
            </p>

            <div class="hero-stats mb-4">
                <div class="hero-stat">
                    <h3>{{ $stats['total_items'] }}</h3>
                    <span>Barang</span>
                </div>
                <div class="hero-stat">
                    <h3>{{ $stats['total_categories'] }}</h3>
                    <span>Kategori</span>
                </div>
                <div class="hero-stat">
                    <h3>{{ $stats['total_suppliers'] }}</h3>
                    <span>Supplier</span>
                </div>
            </div>

            <a href="{{ route('login') }}" class="btn-main">
                <i class="fas fa-sign-in-alt me-2"></i>Masuk ke Sistem
            </a>
        </div>
    </div>
</section>

<!-- ITEMS -->
@if($stats['recent_items']->count() > 0)
<section class="section">
    <div class="container">
        <h2 class="section-title">Barang Terbaru</h2>


        <div class="items-grid">
            @foreach($stats['recent_items'] as $item)
           <div class="item-card">
    <div class="item-image">
        @if($item->image)
            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}">
        @else
            <img src="https://via.placeholder.com/400x200" alt="No Image">
        @endif
    </div>

    <div class="item-body">
        <h5>{{ $item->name }}</h5>
        <div class="item-category">
            {{ $item->category->name ?? 'Tanpa Kategori' }}
        </div>
        <span class="item-stock">
            {{ $item->stock_quantity }} unit tersedia
        </span>
    </div>
</div>

            @endforeach
        </div>
    </div>
</section>
@endif

<!-- CTA -->
<section class="cta">
    <div class="container">
        <h2 class="fw-bold mb-3">Siap Mengelola Inventaris?</h2>
        <p class="mb-4">Login untuk mulai mengelola data secara penuh.</p>
        <a href="{{ route('login') }}" class="btn-main">Login Sekarang</a>
    </div>
</section>

<!-- FOOTER -->
<footer>
    © {{ date('Y') }} Inventory System — Zahwa & Raja
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
