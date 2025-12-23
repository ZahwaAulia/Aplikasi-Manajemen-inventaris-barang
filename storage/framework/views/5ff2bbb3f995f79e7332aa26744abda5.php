<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Kelola Supplier</h4>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="<?php echo e(route('admin.suppliers.create')); ?>" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah Supplier
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Search Form -->
                    <form method="GET" action="<?php echo e(route('admin.suppliers.index')); ?>" class="mb-4">
                        <div class="row">
                            <div class="col-md-8">
                                <input type="text" name="search" class="form-control" placeholder="Cari nama, kontak, email..." value="<?php echo e(request('search')); ?>">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-secondary me-2">
                                    <i class="fas fa-search"></i> Cari
                                </button>
                                <a href="<?php echo e(route('admin.suppliers.index')); ?>" class="btn btn-outline-secondary">
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
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($supplier->name); ?></td>
                                        <td><?php echo e($supplier->contact_email ?? '-'); ?></td>
                                        <td><?php echo e($supplier->contact_phone ?? '-'); ?></td>
                                        <td><?php echo e($supplier->address ?? '-'); ?></td>
                                        <td>
                                            <?php if($supplier->status === 'approved'): ?>
                                                <span class="badge bg-success">Disetujui</span>
                                            <?php elseif($supplier->status === 'pending'): ?>
                                                <span class="badge bg-warning">Menunggu</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary"><?php echo e($supplier->status); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo e(route('admin.suppliers.show', $supplier)); ?>" class="btn btn-sm btn-info" title="Lihat Detail">
                                                <i class="fas fa-eye"></i> Lihat
                                            </a>
                                            <a href="<?php echo e(route('admin.suppliers.edit', $supplier)); ?>" class="btn btn-sm btn-warning" title="Edit Supplier">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <?php if($supplier->status === 'pending'): ?>
                                                <form action="<?php echo e(route('admin.suppliers.approve', $supplier)); ?>" method="POST" class="d-inline">
                                                    <?php echo csrf_field(); ?>
                                                    <button type="submit" class="btn btn-sm btn-success" title="Setujui Supplier">
                                                        <i class="fas fa-check"></i> Setujui
                                                    </button>
                                                </form>
                                                <form action="<?php echo e(route('admin.suppliers.reject', $supplier)); ?>" method="POST" class="d-inline">
                                                    <?php echo csrf_field(); ?>
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Tolak Supplier" onclick="return confirm('Apakah Anda yakin ingin menolak supplier ini?')">
                                                        <i class="fas fa-times"></i> Tolak
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                            <form action="<?php echo e(route('admin.suppliers.destroy', $supplier)); ?>" method="POST" class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus supplier ini?')" title="Hapus Supplier">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak ada data supplier.</td>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Documents\GitHub\Aplikasi-Manajemen-inventaris-barang\Aplikasi-Manajemen-inventaris-barang\resources\views\admin\suppliers\index.blade.php ENDPATH**/ ?>