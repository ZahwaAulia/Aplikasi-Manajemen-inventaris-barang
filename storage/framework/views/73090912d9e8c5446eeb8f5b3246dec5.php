<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Kelola Kategori</h4>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="<?php echo e(route('admin.categories.create')); ?>" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah Kategori
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Search Form -->
                    <form method="GET" action="<?php echo e(route('admin.categories.index')); ?>" class="mb-4">
                        <div class="row">
                            <div class="col-md-8">
                                <input type="text" name="search" class="form-control" placeholder="Cari nama atau deskripsi kategori..." value="<?php echo e(request('search')); ?>">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-secondary me-2">
                                    <i class="fas fa-search"></i> Cari
                                </button>
                                <a href="<?php echo e(route('admin.categories.index')); ?>" class="btn btn-outline-secondary">
                                    <i class="fas fa-times"></i> Reset
                                </a>
                            </div>
                        </div>
                    </form>

                    <!-- Categories Table -->
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Deskripsi</th>
                                    <th>Jumlah Barang</th>
                                    <th>Supplier</th>
                                    <th>Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($category->name); ?></td>
                                        <td><?php echo e($category->description ?? '-'); ?></td>
                                        <td><?php echo e($category->items_count ?? $category->items()->count()); ?></td>
                                        <td>
                                            <?php
                                                $suppliers = $category->items->pluck('supplier')->filter()->unique('id');
                                            ?>
                                            <?php $__empty_2 = true; $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                                                <span class="badge bg-primary me-1"><?php echo e($supplier->name); ?></span>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($category->created_at->format('d/m/Y')); ?></td>
                                        <td>
                                            <a href="<?php echo e(route('admin.categories.show', $category)); ?>" class="btn btn-sm btn-info" title="Lihat Detail">
                                                <i class="fas fa-eye"></i> Lihat
                                            </a>
                                            <a href="<?php echo e(route('admin.categories.edit', $category)); ?>" class="btn btn-sm btn-warning" title="Edit Kategori">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="<?php echo e(route('admin.categories.destroy', $category)); ?>" method="POST" class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')" title="Hapus Kategori">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada data kategori.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <?php echo e($categories->links()); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\laragon-6.0-minimal\www\Aplikasi-Manajemen-inventaris-barang\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>