<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header">
            <h4>
                <?php if(auth()->guard()->check()): ?>
                    Daftar Barang
                <?php else: ?>
                    Pratinjau Barang
                <?php endif; ?>
            </h4>
        </div>

        <div class="card-body">

            <!-- SEARCH & FILTER -->
            <form method="GET" action="<?php echo e(route('guest.items.index')); ?>" class="mb-4">
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" name="search" class="form-control"
                            placeholder="Cari nama / deskripsi"
                            value="<?php echo e(request('search')); ?>">
                    </div>

                    <div class="col-md-2">
                        <select name="category_id" class="form-control">
                            <option value="">Semua Kategori</option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->id); ?>"
                                    <?php echo e(request('category_id') == $category->id ? 'selected' : ''); ?>>
                                    <?php echo e($category->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <select name="status" class="form-control">
                            <option value="">Semua Status</option>
                            <option value="tersedia">Tersedia</option>
                            <option value="dipinjam">Dipinjam</option>
                            <option value="dikeluarkan">Dikeluarkan</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <select name="condition" class="form-control">
                            <option value="">Semua Kondisi</option>
                            <option value="baik">Baik</option>
                            <option value="rusak">Rusak</option>
                            <option value="perlu_perbaikan">Perlu Perbaikan</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <button class="btn btn-secondary">Cari</button>
                        <a href="<?php echo e(route('guest.items.index')); ?>" class="btn btn-outline-secondary">Reset</a>
                    </div>
                </div>
            </form>

            <!-- TABLE -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Supplier</th>
                        <th>Stok</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($item->name); ?></td>
                            <td><?php echo e($item->category->name ?? '-'); ?></td>
                            <td><?php echo e($item->supplier->name ?? '-'); ?></td>
                            <td><?php echo e($item->stock_quantity); ?></td>
                            <td><?php echo e(ucfirst($item->status)); ?></td>
                            <td>
                                <a href="<?php echo e(route('guest.items.show', $item)); ?>" class="btn btn-sm btn-info">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <!-- PAGINATION (LOGIN SAJA) -->
            <?php if(auth()->guard()->check()): ?>
                <?php echo e($items->links()); ?>

            <?php endif; ?>

            <!-- PESAN GUEST -->
            <?php if(auth()->guard()->guest()): ?>
                <div class="alert alert-info text-center mt-4">
                    Kamu hanya melihat sebagian barang.<br>
                    <strong>Login untuk melihat semua barang.</strong><br>
                    <a href="<?php echo e(route('login')); ?>" class="btn btn-primary mt-2">
                        Login Sekarang
                    </a>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\laragon-6.0-minimal\www\Aplikasi-Manajemen-inventaris-barang\resources\views/guest/items/index.blade.php ENDPATH**/ ?>