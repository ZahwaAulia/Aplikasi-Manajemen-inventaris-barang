<?php $__env->startSection('content'); ?>
    <div class="container-fluid py-4">
        <!-- Welcome Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card bg-gradient-primary border-0">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-lg-2 text-center">
                                <?php if(Auth::user()->profile_photo): ?>
                                    <img src="<?php echo e(asset(Auth::user()->profile_photo)); ?>" alt="Profile Photo"
                                        class="rounded-circle border border-white border-3"
                                        style="width: 80px; height: 80px; object-fit: cover;">
                                <?php else: ?>
                                    <div class="bg-white rounded-circle d-flex align-items-center justify-content-center border border-white border-3"
                                        style="width: 80px; height: 80px;">
                                        <i class="fas fa-user-tie text-primary fa-2x"></i>
                                    </div>
                                <?php endif; ?>
                                <div class="mt-2">
                                    <a href="<?php echo e(route('profile.edit')); ?>" class="btn btn-sm btn-outline-light">
                                        <i class="fas fa-edit me-1"></i>Edit Profile
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-10">
                                <h2 class="text-white mb-2">Selamat Datang, <?php echo e(auth()->user()->name); ?>!</h2>
                                <p class="text-white-50 mb-0">Dashboard Supplier - Sistem Manajemen Inventaris Barang</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Barang Saya
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($totalItems); ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-boxes fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Barang Tersedia
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($availableItems); ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-check-circle fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Barang Dipinjam
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($borrowedItems); ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-hand-holding fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Barang Rusak
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($damagedItems); ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-exclamation-triangle fa-2x text-danger"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Navigasi Cepat</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <a href="<?php echo e(route('supplier.items.index')); ?>"
                                    class="btn btn-primary btn-lg w-100 d-flex align-items-center justify-content-center">
                                    <i class="fas fa-boxes fa-2x me-3"></i>
                                    <div class="text-start">
                                        <div class="fw-bold">Kelola Barang</div>
                                        <small>Kelola inventaris barang</small>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="<?php echo e(route('supplier.suppliers.index')); ?>"
                                    class="btn btn-success btn-lg w-100 d-flex align-items-center justify-content-center">
                                    <i class="fas fa-truck fa-2x me-3"></i>
                                    <div class="text-start">
                                        <div class="fw-bold">Kelola Supplier</div>
                                        <small>Kelola data supplier</small>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Items and Categories -->
        <div class="row">
            <!-- Recent Items -->
            <div class="col-lg-8 mb-4">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Barang Terbaru Saya</h6>
                    </div>
                    <div class="card-body">
                        <?php if($recentItems->count() > 0): ?>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nama Barang</th>
                                            <th>Kategori</th>
                                            <th>Status</th>
                                            <th>Tanggal Dibuat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $recentItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($item->name); ?></td>
                                                <td><?php echo e($item->category->name ?? 'N/A'); ?></td>
                                                <td>
                                                    <span class="badge
                                                        <?php if($item->status == 'tersedia'): ?> bg-success
                                                        <?php elseif($item->status == 'dipinjam'): ?> bg-warning
                                                        <?php else: ?> bg-danger
                                                        <?php endif; ?>">
                                                        <?php echo e(ucfirst($item->status)); ?>

                                                    </span>
                                                </td>
                                                <td><?php echo e($item->created_at->format('d M Y')); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-4">
                                <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Belum ada barang yang ditambahkan</p>
                                <a href="<?php echo e(route('supplier.items.create')); ?>" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Tambah Barang Pertama
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Categories Summary -->
            <div class="col-lg-4 mb-4">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Kategori Barang Saya</h6>
                    </div>
                    <div class="card-body">
                        <?php if($categories->count() > 0): ?>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span><?php echo e($category->name); ?></span>
                                    <span class="badge bg-primary"><?php echo e($category->items_count); ?> barang</span>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <div class="text-center py-4">
                                <i class="fas fa-tags fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Belum ada kategori</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>



        <style>
            .bg-gradient-primary {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            }

            .border-left-primary {
                border-left: 0.25rem solid #4e73df !important;
            }

            .border-left-success {
                border-left: 0.25rem solid #1cc88a !important;
            }

            .border-left-info {
                border-left: 0.25rem solid #36b9cc !important;
            }

            .border-left-warning {
                border-left: 0.25rem solid #f6c23e !important;
            }

            .text-gray-800 {
                color: #5a5c69 !important;
            }

            .text-gray-300 {
                color: #dddfeb !important;
            }

            .shadow {
                box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15) !important;
            }

            .me-3 {
                margin-right: 1rem !important;
            }

            .py-3 {
                padding-top: 1rem !important;
                padding-bottom: 1rem !important;
            }

            .mb-3 {
                margin-bottom: 1rem !important;
            }

            .mb-4 {
                margin-bottom: 1.5rem !important;
            }

            .pb-3 {
                padding-bottom: 1rem !important;
            }

            .border-bottom {
                border-bottom: 1px solid #e3e6f0 !important;
            }

            .py-4 {
                padding-top: 1.5rem !important;
                padding-bottom: 1.5rem !important;
            }

            .text-xs {
                font-size: 0.7rem;
            }

            .font-weight-bold {
                font-weight: 700 !important;
            }

            .text-uppercase {
                text-transform: uppercase !important;
            }

            .h5 {
                font-size: 1.25rem;
            }

            .mb-0 {
                margin-bottom: 0 !important;
            }

            .mb-1 {
                margin-bottom: 0.25rem !important;
            }

            .mb-2 {
                margin-bottom: 0.5rem !important;
            }

            .m-0 {
                margin: 0 !important;
            }

            .mr-2 {
                margin-right: 0.5rem !important;
            }

            .no-gutters {
                margin-right: 0;
                margin-left: 0;
            }

            .no-gutters>.col,
            .no-gutters>[class*="col-"] {
                padding-right: 0;
                padding-left: 0;
            }

            .align-items-center {
                align-items: center !important;
            }

            .d-flex {
                display: flex !important;
            }

            .flex-grow-1 {
                flex-grow: 1 !important;
            }

            .text-start {
                text-align: left !important;
            }

            .text-end {
                text-align: right !important;
            }

            .text-center {
                text-align: center !important;
            }

            .w-100 {
                width: 100% !important;
            }

            .h-100 {
                height: 100% !important;
            }

            .rounded {
                border-radius: 0.35rem !important;
            }

            .rounded-circle {
                border-radius: 50% !important;
            }

            .opacity-25 {
                opacity: 0.25 !important;
            }

            .text-white-50 {
                color: rgba(255, 255, 255, 0.5) !important;
            }
        </style>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\laragon-6.0-minimal\www\Aplikasi-Manajemen-inventaris-barang\Aplikasi-Manajemen-inventaris-barang\resources\views/supplier/dashboard.blade.php ENDPATH**/ ?>