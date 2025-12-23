<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Detail Barang</h4>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="<?php echo e(route('admin.items.index')); ?>" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <a href="<?php echo e(route('admin.items.edit', $item)); ?>" class="btn btn-warning ms-2">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <?php if($item->image): ?>
                                <img src="<?php echo e(asset('storage/' . $item->image)); ?>" alt="<?php echo e($item->name); ?>" class="img-fluid rounded">
                            <?php else: ?>
                                <div class="bg-light text-center p-5 rounded">
                                    <i class="fas fa-image fa-3x text-muted"></i>
                                    <p class="text-muted mt-2">Tidak ada gambar</p>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-8">
                            <h3><?php echo e($item->name); ?></h3>
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <p><strong>Kategori:</strong> <?php echo e($item->category->name ?? 'N/A'); ?></p>
                                    <p><strong>Supplier:</strong> <?php echo e($item->supplier->name ?? 'N/A'); ?></p>
                                    <p><strong>Jumlah Stok:</strong> <?php echo e($item->stock_quantity); ?></p>
                                    <p><strong>Harga Satuan:</strong> Rp <?php echo e(number_format($item->unit_price, 0, ',', '.')); ?></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Lokasi:</strong> <?php echo e($item->location ?? 'N/A'); ?></p>
                                    <p><strong>Kondisi:</strong>
                                        <span class="badge bg-<?php echo e($item->condition == 'baik' ? 'success' : ($item->condition == 'rusak' ? 'danger' : 'warning')); ?>">
                                            <?php echo e(ucfirst(str_replace('_', ' ', $item->condition))); ?>

                                        </span>
                                    </p>
                                    <p><strong>Status:</strong>
                                        <span class="badge bg-<?php echo e($item->status == 'tersedia' ? 'success' : ($item->status == 'dipinjam' ? 'warning' : 'secondary')); ?>">
                                            <?php echo e(ucfirst($item->status)); ?>

                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <p><strong>Tanggal Pembelian:</strong> <?php echo e($item->purchase_date ? \Carbon\Carbon::parse($item->purchase_date)->format('d/m/Y') : 'N/A'); ?></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Tanggal Kadaluarsa Garansi:</strong> <?php echo e($item->warranty_expiry ? \Carbon\Carbon::parse($item->warranty_expiry)->format('d/m/Y') : 'N/A'); ?></p>
                                </div>
                            </div>
                            <div class="mt-3">
                                <strong>Deskripsi:</strong>
                                <p><?php echo e($item->description ?? 'Tidak ada deskripsi'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Documents\GitHub\Aplikasi-Manajemen-inventaris-barang\Aplikasi-Manajemen-inventaris-barang\resources\views\guest\items\show.blade.php ENDPATH**/ ?>