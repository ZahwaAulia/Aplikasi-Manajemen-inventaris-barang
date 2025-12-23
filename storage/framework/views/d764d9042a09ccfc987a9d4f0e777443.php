<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">

    
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="mb-0 fw-bold">Dashboard</h4>
            <p class="text-sm text-secondary mb-0">Ringkasan data inventaris</p>
        </div>
    </div>

    
    <div class="row g-4">
        <div class="col-xl-3 col-sm-6">
            <div class="card h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-sm mb-1 text-uppercase fw-bold">Total Barang</p>
                        <h4 class="mb-0 fw-bolder"><?php echo e($totalItems ?? 0); ?></h4>
                    </div>
                    <div class="icon icon-shape bg-gradient-primary text-white rounded-circle">
                        <i class="ni ni-box-2"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="card h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-sm mb-1 text-uppercase fw-bold">Kategori</p>
                        <h4 class="mb-0 fw-bolder"><?php echo e($totalCategories ?? 0); ?></h4>
                    </div>
                    <div class="icon icon-shape bg-gradient-success text-white rounded-circle">
                        <i class="ni ni-tag"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="card h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-sm mb-1 text-uppercase fw-bold">Supplier</p>
                        <h4 class="mb-0 fw-bolder"><?php echo e($totalSuppliers ?? 0); ?></h4>
                    </div>
                    <div class="icon icon-shape bg-gradient-info text-white rounded-circle">
                        <i class="ni ni-delivery-fast"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="card h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-sm mb-1 text-uppercase fw-bold">Tersedia</p>
                        <h4 class="mb-0 fw-bolder"><?php echo e($availableItems ?? 0); ?></h4>
                    </div>
                    <div class="icon icon-shape bg-gradient-warning text-white rounded-circle">
                        <i class="ni ni-check-bold"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="row g-4 mt-2">

        
      <div class="col-lg-6">
    <div class="card h-100">
        <div class="card-header pb-0">
            <h6 class="mb-0 fw-bold">Statistik Barang</h6>
            <p class="text-sm text-secondary mb-0">Ringkasan kondisi barang</p>
        </div>

        <div class="card-body">

            
            <div class="row text-center mb-3">
                <div class="col-6">
                    <div class="p-3 border-radius-lg bg-gray-100">
                        <div class="icon icon-shape bg-gradient-success text-white rounded-circle mb-2 mx-auto">
                            <i class="ni ni-check-bold"></i>
                        </div>
                        <h4 class="font-weight-bolder text-success mb-0">
                            <?php echo e($availableItems ?? 0); ?>

                        </h4>
                        <p class="text-sm mb-0">Tersedia</p>
                    </div>
                </div>

                <div class="col-6">
                    <div class="p-3 border-radius-lg bg-gray-100">
                        <div class="icon icon-shape bg-gradient-warning text-white rounded-circle mb-2 mx-auto">
                            <i class="ni ni-time-alarm"></i>
                        </div>
                        <h4 class="font-weight-bolder text-warning mb-0">
                            <?php echo e($borrowedItems ?? 0); ?>

                        </h4>
                        <p class="text-sm mb-0">Dipinjam</p>
                    </div>
                </div>
            </div>

            
            <div class="row text-center">
                <div class="col-12">
                    <div class="p-3 border-radius-lg bg-gray-100">
                        <div class="icon icon-shape bg-gradient-danger text-white rounded-circle mb-2 mx-auto">
                            <i class="ni ni-fat-remove"></i>
                        </div>
                        <h4 class="font-weight-bolder text-danger mb-0">
                            <?php echo e($damagedItems ?? 0); ?>

                        </h4>
                        <p class="text-sm mb-0">Rusak</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>



        
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header pb-0">
                    <h6 class="mb-0 fw-bold">Navigasi Cepat</h6>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">

                        <?php
                            $menus = [
                                ['Barang', 'ni-box-2', route('admin.items.index'), 'Kelola data barang'],
                                ['Kategori', 'ni-tag', route('admin.categories.index'), 'Kelompokkan barang'],
                                ['Supplier', 'ni-delivery-fast', route('admin.suppliers.index'), 'Data supplier'],
                                ['User', 'ni-single-02', route('admin.users.index'), 'Manajemen pengguna'],
                            ];
                        ?>

                        <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div class="d-flex align-items-center">
                                <div class="icon icon-shape icon-sm bg-gradient-dark text-white rounded-circle me-3">
                                    <i class="ni <?php echo e($menu[1]); ?>"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 text-sm fw-bold"><?php echo e($menu[0]); ?></h6>
                                    <span class="text-xs text-secondary"><?php echo e($menu[3]); ?></span>
                                </div>
                            </div>
                            <a href="<?php echo e($menu[2]); ?>" class="btn btn-sm btn-link text-dark">
                                <i class="ni ni-bold-right"></i>
                            </a>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Documents\GitHub\Aplikasi-Manajemen-inventaris-barang\Aplikasi-Manajemen-inventaris-barang\resources\views\admin\dashboard.blade.php ENDPATH**/ ?>