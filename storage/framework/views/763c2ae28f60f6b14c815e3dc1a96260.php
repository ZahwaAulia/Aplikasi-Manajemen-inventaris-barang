<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Selamat Datang di Sistem Manajemen Inventaris Barang</h4>
                    <p class="mb-0">Jelajahi koleksi barang yang tersedia untuk dipinjam atau dibeli.</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card bg-primary text-white">
                                <div class="card-body text-center">
                                    <i class="fas fa-boxes fa-3x mb-3"></i>
                                    <h5><?php echo e($availableItems->count()); ?> Barang Tersedia</h5>
                                    <p>Jelajahi berbagai barang yang siap digunakan.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-success text-white">
                                <div class="card-body text-center">
                                    <i class="fas fa-tags fa-3x mb-3"></i>
                                    <h5><?php echo e($categories->count()); ?> Kategori</h5>
                                    <p>Temukan barang berdasarkan kategori.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-info text-white">
                                <div class="card-body text-center">
                                    <i class="fas fa-search fa-3x mb-3"></i>
                                    <h5>Pencarian Mudah</h5>
                                    <p>Cari barang dengan fitur pencarian kami.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Categories Section -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Kategori Barang</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="col-md-3 mb-3">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <i class="fas fa-tag fa-2x text-primary mb-2"></i>
                                        <h6><?php echo e($category->name); ?></h6>
                                        <p class="text-muted"><?php echo e($category->items_count); ?> barang</p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="col-12">
                                <p class="text-center text-muted">Tidak ada kategori tersedia.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Available Items Section -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Barang Tersedia</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php $__empty_1 = true; $__currentLoopData = $availableItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <?php if($item->image): ?>
                                            <img src="<?php echo e(asset('storage/' . $item->image)); ?>" alt="<?php echo e($item->name); ?>" class="img-fluid mb-3" style="height: 200px; object-fit: cover;">
                                        <?php else: ?>
                                            <div class="bg-light text-center mb-3" style="height: 200px; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-image fa-3x text-muted"></i>
                                            </div>
                                        <?php endif; ?>
                                        <h6><?php echo e($item->name); ?></h6>
                                        <p class="text-muted"><?php echo e(Str::limit($item->description, 100)); ?></p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="badge bg-success">Tersedia</span>
                                            <span class="text-primary fw-bold"><?php echo e($item->stock_quantity); ?> unit</span>
                                        </div>
                                        <div class="mt-2">
                                            <small class="text-muted">Kategori: <?php echo e($item->category->name ?? 'N/A'); ?></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="col-12">
                                <p class="text-center text-muted">Tidak ada barang tersedia saat ini.</p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        <?php echo e($availableItems->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Documents\GitHub\Aplikasi-Manajemen-inventaris-barang\Aplikasi-Manajemen-inventaris-barang\resources\views/guest/dashboard.blade.php ENDPATH**/ ?>