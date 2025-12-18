@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Detail Supplier</h4>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="{{ route('admin.suppliers.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <a href="{{ route('admin.suppliers.edit', $supplier) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nama Supplier</label>
                                <p class="form-control-plaintext">{{ $supplier->name }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Email</label>
                                <p class="form-control-plaintext">{{ $supplier->contact_email ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Telepon</label>
                                <p class="form-control-plaintext">{{ $supplier->contact_phone ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Alamat</label>
                                <p class="form-control-plaintext">{{ $supplier->address ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Dibuat Pada</label>
                                <p class="form-control-plaintext">{{ $supplier->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Diupdate Pada</label>
                                <p class="form-control-plaintext">{{ $supplier->updated_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    @if($supplier->items && $supplier->items->count() > 0)
                    <hr>
                    <h5>Barang dari Supplier Ini</h5>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Stok</th>
                                    <th>Kondisi</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($supplier->items as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->category->name ?? 'N/A' }}</td>
                                        <td>{{ $item->stock_quantity }}</td>
                                        <td>
                                            <span class="badge bg-{{ $item->condition == 'baik' ? 'success' : ($item->condition == 'rusak' ? 'danger' : 'warning') }}">
                                                {{ ucfirst(str_replace('_', ' ', $item->condition)) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $item->status == 'tersedia' ? 'success' : ($item->status == 'dipinjam' ? 'warning' : 'secondary') }}">
                                                {{ ucfirst($item->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
