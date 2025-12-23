

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Detail Supplier</h4>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="<?php echo e(route('admin.suppliers.index')); ?>" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <a href="<?php echo e(route('admin.suppliers.edit', $supplier)); ?>" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nama Supplier</label>
                                <p class="form-control-plaintext"><?php echo e($supplier->name); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Email</label>
                                <p class="form-control-plaintext"><?php echo e($supplier->contact_email ?? '-'); ?></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Telepon</label>
                                <p class="form-control-plaintext"><?php echo e($supplier->contact_phone ?? '-'); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Alamat</label>
                                <p class="form-control-plaintext"><?php echo e($supplier->address ?? '-'); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Dibuat Pada</label>
                                <p class="form-control-plaintext"><?php echo e($supplier->created_at->format('d/m/Y H:i')); ?></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Diupdate Pada</label>
                                <p class="form-control-plaintext"><?php echo e($supplier->updated_at->format('d/m/Y H:i')); ?></p>
                            </div>
                        </div>
                    </div>

                    <?php if($supplier->items && $supplier->items->count() > 0): ?>
                    <hr>
                    <h5>Barang dari Supplier Ini</h5>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Stok</th>
                                    <th>Kondisi</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $supplier->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($item->name); ?></td>
                                        <td><?php echo e($item->category->name ?? 'N/A'); ?></td>
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
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Documents\GitHub\Aplikasi-Manajemen-inventaris-barang\Aplikasi-Manajemen-inventaris-barang\resources\views\admin\suppliers\show.blade.php ENDPATH**/ ?>