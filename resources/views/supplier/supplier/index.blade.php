@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Daftar Supplier</h4>
                            </div>
                            <div class="col-md-6 text-end">
                                <a href="{{ route('supplier.suppliers.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Ajukan Supplier Baru
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Search Form -->
                        <form method="GET" action="{{ route('supplier.suppliers.index') }}" class="mb-4">
                            <div class="row">
                                <div class="col-md-8">
                                    <input type="text" name="search" class="form-control"
                                        placeholder="Cari nama, kontak, email..." value="{{ request('search') }}">
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-secondary me-2">
                                        <i class="fas fa-search"></i> Cari
                                    </button>
                                    <a href="{{ route('supplier.suppliers.index') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-times"></i> Reset
                                    </a>
                                </div>
                            </div>
                        </form>

                        <!-- Suppliers Table -->
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Telepon</th>
                                        <th>Alamat</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($supplier as $sup)
                                        <tr>
                                            <td>{{ $sup->name }}</td>
                                            <td>{{ $sup->contact_email ?? '-' }}</td>
                                            <td>{{ $sup->contact_phone ?? '-' }}</td>
                                            <td>{{ $sup->address ?? '-' }}</td>
                                            <td>
                                                @if ($sup->status === 'approved')
                                                    <span class="badge bg-success">Disetujui</span>
                                                @elseif($sup->status === 'pending')
                                                    <span class="badge bg-warning">Menunggu Persetujuan</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ $sup->status }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak ada data supplier yang disetujui.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        {{ $supplier->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
