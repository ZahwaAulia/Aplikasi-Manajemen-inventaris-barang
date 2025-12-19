@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <!-- Welcome Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-gradient-primary border-0">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h2 class="text-white mb-2">Selamat Datang, {{ auth()->user()->name }}!</h2>
                            <p class="text-white-50 mb-0">Dashboard Staff - Sistem Manajemen Inventaris Barang</p>
                        </div>
                        <div class="col-lg-4 text-end">
                            <i class="fas fa-user-tie fa-4x text-white opacity-25"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Barang
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalItems }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-boxes fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Supplier
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalSuppliers }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-truck fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Barang Aktif
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalItems }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Supplier Aktif
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalSuppliers }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-star fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Navigasi Cepat</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('staff.items.index') }}" class="btn btn-primary btn-lg w-100 d-flex align-items-center justify-content-center">
                                <i class="fas fa-boxes fa-2x me-3"></i>
                                <div class="text-start">
                                    <div class="fw-bold">Kelola Barang</div>
                                    <small>Kelola inventaris barang</small>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('staff.suppliers.index') }}" class="btn btn-success btn-lg w-100 d-flex align-items-center justify-content-center">
                                <i class="fas fa-truck fa-2x me-3"></i>
                                <div class="text-start">
                                    <div class="fw-bold">Kelola Supplier</div>
                                    <small>Kelola data supplier</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="row">
        <!-- Recent Items -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Barang Terbaru</h6>
                </div>
                <div class="card-body">
                    @forelse($recentItems as $item)
                        <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
                            <div class="me-3">
                                @if($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <i class="fas fa-box text-muted"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-grow-1">
                                <div class="fw-bold text-gray-800">{{ $item->name }}</div>
                                <div class="text-xs text-muted">{{ $item->category->name ?? 'N/A' }} • Stok: {{ $item->stock_quantity }}</div>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-success">Aktif</span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <i class="fas fa-inbox fa-3x text-gray-300 mb-3"></i>
                            <p class="text-muted">Belum ada barang yang ditambahkan</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Recent Suppliers -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success">Supplier Terbaru</h6>
                </div>
                <div class="card-body">
                    @forelse($recentSuppliers as $supplier)
                        <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
                            <div class="me-3">
                                <div class="bg-success rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class="fas fa-building text-white"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <div class="fw-bold text-gray-800">{{ $supplier->name }}</div>
                                <div class="text-xs text-muted">{{ $supplier->contact_email ?? 'N/A' }} • {{ $supplier->contact_phone ?? 'N/A' }}</div>
                            </div>
                            <div class="text-end">
                                <span class="badge {{ $supplier->status === 'approved' ? 'bg-success' : 'bg-warning' }}">
                                    {{ $supplier->status === 'approved' ? 'Disetujui' : 'Pending' }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <i class="fas fa-users fa-3x text-gray-300 mb-3"></i>
                            <p class="text-muted">Belum ada supplier yang ditambahkan</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.border-left-primary {
    border-left: 0.25rem solid #4e73df !important;
}

.border-left-success {
    border-left: 0.25rem solid #1cc88a !important;
}

.border-left-info {
    border-left: 0.25rem solid #36b9cc !important;
}

.border-left-warning {
    border-left: 0.25rem solid #f6c23e !important;
}

.text-gray-800 {
    color: #5a5c69 !important;
}

.text-gray-300 {
    color: #dddfeb !important;
}

.shadow {
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15) !important;
}

.me-3 {
    margin-right: 1rem !important;
}

.py-3 {
    padding-top: 1rem !important;
    padding-bottom: 1rem !important;
}

.mb-3 {
    margin-bottom: 1rem !important;
}

.mb-4 {
    margin-bottom: 1.5rem !important;
}

.pb-3 {
    padding-bottom: 1rem !important;
}

.border-bottom {
    border-bottom: 1px solid #e3e6f0 !important;
}

.py-4 {
    padding-top: 1.5rem !important;
    padding-bottom: 1.5rem !important;
}

.text-xs {
    font-size: 0.7rem;
}

.font-weight-bold {
    font-weight: 700 !important;
}

.text-uppercase {
    text-transform: uppercase !important;
}

.h5 {
    font-size: 1.25rem;
}

.mb-0 {
    margin-bottom: 0 !important;
}

.mb-1 {
    margin-bottom: 0.25rem !important;
}

.mb-2 {
    margin-bottom: 0.5rem !important;
}

.m-0 {
    margin: 0 !important;
}

.mr-2 {
    margin-right: 0.5rem !important;
}

.no-gutters {
    margin-right: 0;
    margin-left: 0;
}

.no-gutters > .col,
.no-gutters > [class*="col-"] {
    padding-right: 0;
    padding-left: 0;
}

.align-items-center {
    align-items: center !important;
}

.d-flex {
    display: flex !important;
}

.flex-grow-1 {
    flex-grow: 1 !important;
}

.text-start {
    text-align: left !important;
}

.text-end {
    text-align: right !important;
}

.text-center {
    text-align: center !important;
}

.w-100 {
    width: 100% !important;
}

.h-100 {
    height: 100% !important;
}

.rounded {
    border-radius: 0.35rem !important;
}

.rounded-circle {
    border-radius: 50% !important;
}

.opacity-25 {
    opacity: 0.25 !important;
}

.text-white-50 {
    color: rgba(255, 255, 255, 0.5) !important;
}
</style>
@endsection
