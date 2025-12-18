@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Kelola Supplier</h4>
                    <a href="{{ route('staff.suppliers.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Tambah Supplier
                    </a>
                </div>
                <div class="card-body">
                    <!-- Search Form -->
                    <form method="GET" action="{{ route('staff.suppliers.index') }}" class="mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="search" class="form-control" placeholder="Cari nama, contact person, email..." value="{{ request('search') }}">
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-secondary me-2">
                                    <i class="fas fa-search"></i> Cari
                                </button>
                                <a href="{{ route('staff.suppliers.index') }}" class="btn btn-outline-secondary">
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
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($suppliers as $supplier)
                                    <tr>
                                        <td>{{ $supplier->name }}</td>
                                        <td>{{ $supplier->contact_email ?? 'N/A' }}</td>
                                        <td>{{ $supplier->contact_phone ?? 'N/A' }}</td>
                                        <td>
                                            <a href="{{ route('staff.suppliers.show', $supplier) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada data supplier.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    {{ $suppliers->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
