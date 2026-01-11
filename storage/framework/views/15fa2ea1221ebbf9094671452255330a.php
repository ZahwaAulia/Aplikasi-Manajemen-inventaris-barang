<?php $__env->startSection('content'); ?>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Daftar Supplier</h4>
                            </div>
                            <div class="col-md-6 text-end">
                                <a href="<?php echo e(route('supplier.suppliers.create')); ?>" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Ajukan Supplier Baru
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Search Form -->
                        <form method="GET" action="<?php echo e(route('supplier.suppliers.index')); ?>" class="mb-4">
                            <div class="row">
                                <div class="col-md-8">
                                    <input type="text" name="search" class="form-control"
                                        placeholder="Cari nama, kontak, email..." value="<?php echo e(request('search')); ?>">
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-secondary me-2">
                                        <i class="fas fa-search"></i> Cari
                                    </button>
                                    <a href="<?php echo e(route('supplier.suppliers.index')); ?>" class="btn btn-outline-secondary">
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
                                        <th>Alamat</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $supplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td><?php echo e($sup->name); ?></td>
                                            <td><?php echo e($sup->contact_email ?? '-'); ?></td>
                                            <td><?php echo e($sup->contact_phone ?? '-'); ?></td>
                                            <td><?php echo e($sup->address ?? '-'); ?></td>
                                            <td>
                                                <?php if($sup->status === 'approved'): ?>
                                                    <span class="badge bg-success">Disetujui</span>
                                                <?php elseif($sup->status === 'pending'): ?>
                                                    <span class="badge bg-warning">Menunggu Persetujuan</span>
                                                <?php else: ?>
                                                    <span class="badge bg-secondary"><?php echo e($sup->status); ?></span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak ada data supplier yang disetujui.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <?php echo e($supplier->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\laragon-6.0-minimal\www\Aplikasi-Manajemen-inventaris-barang\Aplikasi-Manajemen-inventaris-barang\resources\views/supplier/supplier/index.blade.php ENDPATH**/ ?>