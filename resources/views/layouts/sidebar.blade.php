<li class="nav-item">
  <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
     href="{{ route('admin.dashboard') }}">
    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
      <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
    </div>
    <span class="nav-link-text ms-1">Dashboard</span>
  </a>
</li>

<li class="nav-item">
  <a class="nav-link {{ request()->routeIs('barang.*') ? 'active' : '' }}"
     href="{{ route('barang.index') }}">
    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
      <i class="ni ni-box-2 text-warning text-sm opacity-10"></i>
    </div>
    <span class="nav-link-text ms-1">Barang</span>
  </a>
</li>

<li class="nav-item">
  <a class="nav-link {{ request()->routeIs('kategori.*') ? 'active' : '' }}"
     href="{{ route('kategori.index') }}">
    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
      <i class="ni ni-tag text-success text-sm opacity-10"></i>
    </div>
    <span class="nav-link-text ms-1">Kategori</span>
  </a>
</li>

<li class="nav-item">
  <a class="nav-link {{ request()->routeIs('supplier.*') ? 'active' : '' }}"
     href="{{ route('supplier.index') }}">
    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
      <i class="ni ni-delivery-fast text-info text-sm opacity-10"></i>
    </div>
    <span class="nav-link-text ms-1">Supplier</span>
  </a>
</li>
