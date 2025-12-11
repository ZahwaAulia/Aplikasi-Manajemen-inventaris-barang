@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Kategori Barang</h4>
                </div>
                <div class="card-body">
                    <!-- Search Form -->
                    <form method="GET" action="{{ route('guest.categories.index') }}" class="mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="search" class="form-control" placeholder="Cari nama kategori..." value="{{ request('search') }}">
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-secondary me-2">
                                    <i class="fas fa-search"></i> Cari
                                </button>
                                <a href="{{ route('guest.categories.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times"></i> Reset
                                </a>
                            </div>
                        </div>
                    </form>

                    <!-- Categories Grid -->
                    <div class="row">
                        @forelse($categories as $category)
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <i class="fas fa-tag fa-3x text-primary mb-3"></i>
                                        <h5>{{ $category->name }}</h5>
                                        <p class="text-muted">{{ $category->description ?? 'Tidak ada deskripsi' }}</p>
                                        <div class="mt-3">
                                            <span class="badge bg-info">{{ $category->items_count }} barang</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <p class="text-center text-muted">Tidak ada kategori tersedia.</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
