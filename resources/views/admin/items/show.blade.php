@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Detail Barang</h4>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="{{ route('admin.items.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <a href="{{ route('admin.items.edit', $item) }}" class="btn btn-warning ms-2">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="img-fluid rounded">
                            @else
                                <div class="bg-light text-center p-5 rounded">
                                    <i class="fas fa-image fa-3x text-muted"></i>
                                    <p class="text-muted mt-2">Tidak ada gambar</p>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <h3>{{ $item->name }}</h3>
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <p><strong>Kategori:</strong> {{ $item->category->name ?? 'N/A' }}</p>
                                    <p><strong>Supplier:</strong> {{ $item->supplier->name ?? 'N/A' }}</p>
                                    <p><strong>Jumlah Stok:</strong> {{ $item->stock_quantity }}</p>
                                    <p><strong>Harga Satuan:</strong> Rp {{ number_format($item->unit_price, 0, ',', '.') }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Lokasi:</strong> {{ $item->location ?? 'N/A' }}</p>
                                    <p><strong>Kondisi:</strong>
                                        <span class="badge bg-{{ $item->condition == 'baik' ? 'success' : ($item->condition == 'rusak' ? 'danger' : 'warning') }}">
                                            {{ ucfirst(str_replace('_', ' ', $item->condition)) }}
                                        </span>
                                    </p>
                                    <p><strong>Status:</strong>
                                        <span class="badge bg-{{ $item->status == 'tersedia' ? 'success' : ($item->status == 'dipinjam' ? 'warning' : 'secondary') }}">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <p><strong>Tanggal Pembelian:</strong> {{ $item->purchase_date ? \Carbon\Carbon::parse($item->purchase_date)->format('d/m/Y') : 'N/A' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Tanggal Kadaluarsa Garansi:</strong> {{ $item->warranty_expiry ? \Carbon\Carbon::parse($item->warranty_expiry)->format('d/m/Y') : 'N/A' }}</p>
                                </div>
                            </div>
                            <div class="mt-3">
                                <strong>Deskripsi:</strong>
                                <p>{{ $item->description ?? 'Tidak ada deskripsi' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
