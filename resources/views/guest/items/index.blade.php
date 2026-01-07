@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header">
            <h4>
                @auth
                    Daftar Barang
                @else
                    Pratinjau Barang
                @endauth
            </h4>
        </div>

        <div class="card-body">

            <!-- SEARCH & FILTER -->
            <form method="GET" action="{{ route('guest.items.index') }}" class="mb-4">
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" name="search" class="form-control"
                            placeholder="Cari nama / deskripsi"
                            value="{{ request('search') }}">
                    </div>

                    <div class="col-md-2">
                        <select name="category_id" class="form-control">
                            <option value="">Semua Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <select name="status" class="form-control">
                            <option value="">Semua Status</option>
                            <option value="tersedia">Tersedia</option>
                            <option value="dipinjam">Dipinjam</option>
                            <option value="dikeluarkan">Dikeluarkan</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <select name="condition" class="form-control">
                            <option value="">Semua Kondisi</option>
                            <option value="baik">Baik</option>
                            <option value="rusak">Rusak</option>
                            <option value="perlu_perbaikan">Perlu Perbaikan</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <button class="btn btn-secondary">Cari</button>
                        <a href="{{ route('guest.items.index') }}" class="btn btn-outline-secondary">Reset</a>
                    </div>
                </div>
            </form>

            <!-- TABLE -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Supplier</th>
                        <th>Stok</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->category->name ?? '-' }}</td>
                            <td>{{ $item->supplier->name ?? '-' }}</td>
                            <td>{{ $item->stock_quantity }}</td>
                            <td>{{ ucfirst($item->status) }}</td>
                            <td>
                                <a href="{{ route('guest.items.show', $item) }}" class="btn btn-sm btn-info">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- PAGINATION (LOGIN SAJA) -->
            @auth
                {{ $items->links() }}
            @endauth

            <!-- PESAN GUEST -->
            @guest
                <div class="alert alert-info text-center mt-4">
                    Kamu hanya melihat sebagian barang.<br>
                    <strong>Login untuk melihat semua barang.</strong><br>
                    <a href="{{ route('login') }}" class="btn btn-primary mt-2">
                        Login Sekarang
                    </a>
                </div>
            @endguest

        </div>
    </div>
</div>
@endsection

