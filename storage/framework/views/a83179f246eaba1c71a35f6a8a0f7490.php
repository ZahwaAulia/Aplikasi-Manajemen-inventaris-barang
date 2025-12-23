<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <h6 class="mb-0">Navigasi Cepat</h6>
                </div>
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="<?php echo e(route('staff.items.index')); ?>" class="btn btn-primary btn-lg w-100 mb-3">
                                <i class="ni ni-box-2"></i> Kelola Barang
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="<?php echo e(route('staff.suppliers.index')); ?>" class="btn btn-success btn-lg w-100 mb-3">
                                <i class="ni ni-delivery-fast"></i> Kelola Supplier
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Documents\GitHub\Aplikasi-Manajemen-inventaris-barang\Aplikasi-Manajemen-inventaris-barang\resources\views/staff/dashboard.blade.php ENDPATH**/ ?>