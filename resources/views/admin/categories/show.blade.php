@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Detail Kategori</h4>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nama Kategori:</label>
                                <p class="form-control-plaintext">{{ $category->name }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Jumlah Barang:</label>
                                <p class="form-control-plaintext">{{ $category->items_count ?? $category->items->count() }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Deskripsi:</label>
                        <p class="form-control-plaintext">{{ $category->description ?: 'Tidak ada deskripsi' }}</p>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Dibuat Pada:</label>
                                <p class="form-control-plaintext">{{ $category->created_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Terakhir Diupdate:</label>
                                <p class="form-control-plaintext">{{ $category->updated_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    @if($category->items->count() > 0)
                    <div class="mt-4">
                        <h5>Barang dalam Kategori Ini:</h5>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama Barang</th>
                                        <th>Status</th>
                                        <th>Jumlah Stok</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($category->items as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <span class="badge bg-{{ $item->status == 'tersedia' ? 'success' : ($item->status == 'dipinjam' ? 'warning' : 'danger') }}">
                                                {{ ucfirst($item->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $item->stock_quantity }}</td>
                                        <td>
                                            <a href="{{ route('admin.items.show', $item) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
