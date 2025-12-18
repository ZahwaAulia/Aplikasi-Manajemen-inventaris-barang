@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Detail Barang</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Nama Barang</label>
                                        <p class="form-control-plaintext">{{ $item->name }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Kategori</label>
                                        <p class="form-control-plaintext">{{ $item->category->name ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Supplier</label>
                                        <p class="form-control-plaintext">{{ $item->supplier->name ?? 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Jumlah Stok</label>
                                        <p class="form-control-plaintext">{{ $item->stock_quantity }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Harga Satuan</label>
                                        <p class="form-control-plaintext">Rp {{ number_format($item->unit_price, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Lokasi</label>
                                        <p class="form-control-plaintext">{{ $item->location ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Kondisi</label>
                                        <p class="form-control-plaintext">
                                            @if($item->condition == 'baik')
                                                <span class="badge bg-success">Baik</span>
                                            @elseif($item->condition == 'rusak')
                                                <span class="badge bg-danger">Rusak</span>
                                            @else
                                                <span class="badge bg-warning">Perlu Perbaikan</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Status</label>
                                        <p class="form-control-plaintext">
                                            @if($item->status == 'tersedia')
                                                <span class="badge bg-success">Tersedia</span>
                                            @elseif($item->status == 'dipinjam')
                                                <span class="badge bg-info">Dipinjam</span>
                                            @else
                                                <span class="badge bg-secondary">Dikeluarkan</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Tanggal Pembelian</label>
                                        <p class="form-control-plaintext">{{ $item->purchase_date ? $item->purchase_date->format('d/m/Y') : 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Tanggal Kadaluarsa Garansi</label>
                                        <p class="form-control-plaintext">{{ $item->warranty_expiry ? $item->warranty_expiry->format('d/m/Y') : 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">Deskripsi</label>
                                <p class="form-control-plaintext">{{ $item->description ?? 'Tidak ada deskripsi' }}</p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            @if($item->image)
                                <div class="form-group">
                                    <label class="form-control-label">Gambar</label>
                                    <div class="text-center">
                                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="img-fluid rounded" style="max-width: 100%; height: auto;">
                                    </div>
                                </div>
                            @else
                                <div class="form-group">
                                    <label class="form-control-label">Gambar</label>
                                    <div class="text-center">
                                        <div class="bg-light rounded p-4">
                                            <i class="fas fa-image fa-3x text-muted"></i>
                                            <p class="text-muted mt-2">Tidak ada gambar</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('staff.items.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        <div>
                            <a href="{{ route('staff.items.edit', $item) }}" class="btn btn-warning">
                                <i class="fas fa-edit me-2"></i>Edit
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
