<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs(auth()->user()->role . '.dashboard') ? 'active' : '' }}"
           href="{{ route(auth()->user()->role . '.dashboard') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs(auth()->user()->role . '.items.*') ? 'active' : '' }}"
           href="{{ route(auth()->user()->role . '.items.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-box-2 text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Barang</span>
        </a>
    </li>

    @if(auth()->user()->role == 'admin')
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}"
           href="{{ route('admin.categories.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-tag text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Kategori</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.suppliers.*') ? 'active' : '' }}"
           href="{{ route('admin.suppliers.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-delivery-fast text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Supplier</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
           href="{{ route('admin.users.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-single-02 text-danger text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Pengguna</span>
        </a>
    </li>
    @endif


</ul>
