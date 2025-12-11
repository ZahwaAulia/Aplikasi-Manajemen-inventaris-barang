@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Staff Dashboard - Manajemen Inventaris Barang</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <h5>{{ $totalItems }}</h5>
                                    <p>Total Barang</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <h5>{{ $lowStockItems }}</h5>
                                    <p>Barang Stok Rendah</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h5>{{ $totalCategories }}</h5>
                                    <p>Total Kategori</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <h5>{{ $totalSuppliers }}</h5>
                                    <p>Total Supplier</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Navigasi Cepat</h5>
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="{{ route('staff.items.index') }}" class="btn btn-outline-primary btn-lg w-100 mb-3">
                                        <i class="fas fa-box"></i> Kelola Barang
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="{{ route('staff.categories.index') }}" class="btn btn-outline-success btn-lg w-100 mb-3">
                                        <i class="fas fa-tags"></i> Lihat Kategori
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="{{ route('staff.suppliers.index') }}" class="btn btn-outline-info btn-lg w-100 mb-3">
                                        <i class="fas fa-truck"></i> Lihat Supplier
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
