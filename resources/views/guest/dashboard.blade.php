@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    {{-- Profile Section --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        @if(Auth::user()->profile_photo)
                            <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Profile Photo" class="rounded-circle" style="width: 60px; height: 60px; object-fit: cover;">
                        @else
                            <div class="bg-gradient-dark rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="fas fa-user text-white"></i>
                            </div>
                        @endif
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="mb-0">Welcome back, {{ Auth::user()->name }}!</h5>
                        <p class="text-sm text-secondary mb-0">Guest User</p>
                    </div>
                    <div>
                        <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-edit me-1"></i>Edit Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Selamat Datang di Sistem Manajemen Inventaris Barang</h4>
                    <p class="mb-0">Jelajahi koleksi barang yang tersedia untuk dipinjam atau dibeli.</p>
                </div>

                <div class="card-body">
                    <div class="row">

                        <!-- BARANG TERSEDIA -->
                        <div class="col-md-4">
                            <a href="{{ route('guest.items.index', ['status' => 'tersedia']) }}"
                               class="text-decoration-none">
                                <div class="card bg-primary text-white h-100 dashboard-card">
                                    <div class="card-body text-center">
                                        <i class="fas fa-boxes fa-3x mb-3"></i>
                                        <h5>{{ $availableItems->count() }} Barang Tersedia</h5>
                                        <p>Jelajahi berbagai barang yang siap digunakan.</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- KATEGORI -->
                        <div class="col-md-4">
                            <a href="{{ route('guest.categories.index') }}"
                               class="text-decoration-none">
                                <div class="card bg-success text-white h-100 dashboard-card">
                                    <div class="card-body text-center">
                                        <i class="fas fa-tags fa-3x mb-3"></i>
                                        <h5>{{ $categories->count() }} Kategori</h5>
                                        <p>Temukan barang berdasarkan kategori.</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- PENCARIAN MUDAH -->
                        <div class="col-md-4">
                            <a href="{{ route('guest.items.index', ['focus' => 'search']) }}"
                               class="text-decoration-none">
                                <div class="card bg-info text-white h-100 dashboard-card">
                                    <div class="card-body text-center">
                                        <i class="fas fa-search fa-3x mb-3"></i>
                                        <h5>Pencarian Mudah</h5>
                                        <p>Cari barang dengan fitur pencarian kami.</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- KATEGORI BARANG -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Kategori Barang</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @forelse($categories as $category)
                            <div class="col-md-3 mb-3">
                                <a href="{{ route('guest.items.index', ['category_id' => $category->id]) }}"
                                   class="text-decoration-none">
                                    <div class="card h-100 dashboard-card">
                                        <div class="card-body text-center">
                                            <i class="fas fa-tag fa-2x text-primary mb-2"></i>
                                            <h6>{{ $category->name }}</h6>
                                            <p class="text-muted">{{ $category->items_count }} barang</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <div class="col-12">
                                <p class="text-center text-muted">Tidak ada kategori tersedia.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- BARANG TERSEDIA -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Barang Tersedia</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @forelse($availableItems as $item)
                            <div class="col-md-4 mb-4">
                                <a href="{{ route('guest.items.show', $item) }}"
                                   class="text-decoration-none">
                                    <div class="card h-100 dashboard-card">
                                        <div class="card-body">
                                            @if($item->image)
                                                <img src="{{ asset('storage/' . $item->image) }}"
                                                     class="img-fluid mb-3"
                                                     style="height:200px; object-fit:cover;">
                                            @else
                                                <div class="bg-light text-center mb-3"
                                                     style="height:200px; display:flex; align-items:center; justify-content:center;">
                                                    <i class="fas fa-image fa-3x text-muted"></i>
                                                </div>
                                            @endif

                                            <h6>{{ $item->name }}</h6>
                                            <p class="text-muted">
                                                {{ Str::limit($item->description, 100) }}
                                            </p>

                                            <div class="d-flex justify-content-between">
                                                <span class="badge bg-success">Tersedia</span>
                                                <span class="fw-bold text-primary">
                                                    {{ $item->stock_quantity }} unit
                                                </span>
                                            </div>

                                            <small class="text-muted d-block mt-2">
                                                Kategori: {{ $item->category->name ?? 'N/A' }}
                                            </small>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <div class="col-12">
                                <p class="text-center text-muted">
                                    Tidak ada barang tersedia saat ini.
                                </p>
                            </div>
                        @endforelse
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $availableItems->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- STYLE -->
<style>
.dashboard-card {
    cursor: pointer;
    transition: transform .2s, box-shadow .2s;
}
.dashboard-card:hover {
    transform: scale(1.03);
    box-shadow: 0 8px 20px rgba(0,0,0,.15);
}
</style>
@endsection
