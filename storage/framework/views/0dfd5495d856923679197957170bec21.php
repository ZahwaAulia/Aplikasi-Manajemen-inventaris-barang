<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Kelola Supplier</h4>
                    <a href="<?php echo e(route('staff.suppliers.create')); ?>" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Tambah Supplier
                    </a>
                </div>
                <div class="card-body">
                    <!-- Search Form -->
                    <form method="GET" action="<?php echo e(route('staff.suppliers.index')); ?>" class="mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="search" class="form-control" placeholder="Cari nama, contact person, email..." value="<?php echo e(request('search')); ?>">
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-secondary me-2">
                                    <i class="fas fa-search"></i> Cari
                                </button>
                                <a href="<?php echo e(route('staff.suppliers.index')); ?>" class="btn btn-outline-secondary">
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
                                <?php $__empty_1 = true; $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($supplier->name); ?></td>
                                        <td><?php echo e($supplier->contact_email ?? 'N/A'); ?></td>
                                        <td><?php echo e($supplier->contact_phone ?? 'N/A'); ?></td>
                                        <td>
                                            <a href="<?php echo e(route('staff.suppliers.show', $supplier)); ?>" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada data supplier.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <?php echo e($suppliers->links()); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Documents\GitHub\Aplikasi-Manajemen-inventaris-barang\Aplikasi-Manajemen-inventaris-barang\resources\views/staff/suppliers/index.blade.php ENDPATH**/ ?>