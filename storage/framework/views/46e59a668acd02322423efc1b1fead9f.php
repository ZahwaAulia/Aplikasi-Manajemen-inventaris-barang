<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Kelola Barang</h4>
                    <a href="<?php echo e(route('staff.items.create')); ?>" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Tambah Barang
                    </a>
                </div>
                <div class="card-body">
                    <!-- Search and Filter Form -->
                    <form method="GET" action="<?php echo e(route('staff.items.index')); ?>" class="mb-4">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" name="search" class="form-control" placeholder="Cari nama, deskripsi, lokasi..." value="<?php echo e(request('search')); ?>">
                            </div>
                            <div class="col-md-2">
                                <select name="category_id" class="form-control">
                                    <option value="">Semua Kategori</option>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>" <?php echo e(request('category_id') == $category->id ? 'selected' : ''); ?>>
                                        <?php echo e($category->name); ?>

                                    </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="status" class="form-control">
                                    <option value="">Semua Status</option>
                                    <option value="tersedia" <?php echo e(request('status') == 'tersedia' ? 'selected' : ''); ?>>Tersedia</option>
                                    <option value="dipinjam" <?php echo e(request('status') == 'dipinjam' ? 'selected' : ''); ?>>Dipinjam</option>
                                    <option value="dikeluarkan" <?php echo e(request('status') == 'dikeluarkan' ? 'selected' : ''); ?>>Dikeluarkan</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="condition" class="form-control">
                                    <option value="">Semua Kondisi</option>
                                    <option value="baik" <?php echo e(request('condition') == 'baik' ? 'selected' : ''); ?>>Baik</option>
                                    <option value="rusak" <?php echo e(request('condition') == 'rusak' ? 'selected' : ''); ?>>Rusak</option>
                                    <option value="perlu_perbaikan" <?php echo e(request('condition') == 'perlu_perbaikan' ? 'selected' : ''); ?>>Perlu Perbaikan</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-secondary me-2">
                                    <i class="fas fa-search"></i> Cari
                                </button>
                                <a href="<?php echo e(route('staff.items.index')); ?>" class="btn btn-outline-secondary">
                                    <i class="fas fa-times"></i> Reset
                                </a>
                            </div>
                        </div>
                    </form>

                    <!-- Items Table -->
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Gambar</th>
                                    <th>Nama</th>
                                    <th>Kategori</th>
                                    <th>Supplier</th>
                                    <th>Stok</th>
                                    <th>Kondisi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td>
                                        <?php if($item->image): ?>
                                        <img src="<?php echo e(asset('storage/' . $item->image)); ?>" alt="<?php echo e($item->name); ?>" width="50" height="50" class="rounded">
                                        <?php else: ?>
                                        <span class="text-muted">No Image</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($item->name); ?></td>
                                    <td><?php echo e($item->category->name ?? 'N/A'); ?></td>
                                    <td><?php echo e($item->supplier->name ?? 'N/A'); ?></td>
                                    <td><?php echo e($item->stock_quantity); ?></td>
                                    <td>
                                        <span class="badge bg-<?php echo e($item->condition == 'baik' ? 'success' : ($item->condition == 'rusak' ? 'danger' : 'warning')); ?>">
                                            <?php echo e(ucfirst(str_replace('_', ' ', $item->condition))); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-<?php echo e($item->status == 'tersedia' ? 'success' : ($item->status == 'dipinjam' ? 'warning' : 'secondary')); ?>">
                                            <?php echo e(ucfirst($item->status)); ?>

                                        </span>
                                    </td>
                                    <td class="d-flex gap-1">
                                        <a href="<?php echo e(route('staff.items.show', $item)); ?>" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye me-1"></i> Detail
                                        </a>
                                        <a href="<?php echo e(route('staff.items.edit', $item)); ?>" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada data barang.</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <?php echo e($items->links()); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Documents\GitHub\Aplikasi-Manajemen-inventaris-barang\Aplikasi-Manajemen-inventaris-barang\resources\views/staff/items/index.blade.php ENDPATH**/ ?>