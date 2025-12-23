<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link <?php echo e(request()->routeIs(auth()->user()->role . '.dashboard') ? 'active' : ''); ?>"
           href="<?php echo e(route(auth()->user()->role . '.dashboard')); ?>">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link <?php echo e(request()->routeIs(auth()->user()->role . '.items.*') ? 'active' : ''); ?>"
           href="<?php echo e(route(auth()->user()->role . '.items.index')); ?>">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-box-2 text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Barang</span>
        </a>
    </li>

    <?php if(auth()->user()->role == 'admin'): ?>
    <li class="nav-item">
        <a class="nav-link <?php echo e(request()->routeIs('admin.categories.*') ? 'active' : ''); ?>"
           href="<?php echo e(route('admin.categories.index')); ?>">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-tag text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Kategori</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link <?php echo e(request()->routeIs('admin.suppliers.*') ? 'active' : ''); ?>"
           href="<?php echo e(route('admin.suppliers.index')); ?>">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-delivery-fast text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Supplier</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link <?php echo e(request()->routeIs('admin.users.*') ? 'active' : ''); ?>"
           href="<?php echo e(route('admin.users.index')); ?>">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-single-02 text-danger text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Pengguna</span>
        </a>
    </li>
    <?php elseif(auth()->user()->role == 'staff'): ?>
    <li class="nav-item">
        <a class="nav-link <?php echo e(request()->routeIs('staff.categories.*') ? 'active' : ''); ?>"
           href="<?php echo e(route('staff.categories.index')); ?>">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-tag text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Kategori</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link <?php echo e(request()->routeIs('staff.suppliers.*') ? 'active' : ''); ?>"
           href="<?php echo e(route('staff.suppliers.index')); ?>">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-delivery-fast text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Supplier</span>
        </a>
    </li>
    <?php endif; ?>


</ul>
<?php /**PATH C:\Users\user\Documents\GitHub\Aplikasi-Manajemen-inventaris-barang\Aplikasi-Manajemen-inventaris-barang\resources\views\layouts\sidebar_updated.blade.php ENDPATH**/ ?>