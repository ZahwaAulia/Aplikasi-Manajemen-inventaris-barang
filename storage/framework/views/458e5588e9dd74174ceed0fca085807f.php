<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <h1>Staff Dashboard Test</h1>
    <p>Total Items: <?php echo e($totalItems ?? 'Not set'); ?></p>
    <p>Total Suppliers: <?php echo e($totalSuppliers ?? 'Not set'); ?></p>
    <p>Available Items: <?php echo e($availableItems ?? 'Not set'); ?></p>
    <p>Recent Items Count: <?php echo e($recentItems ? $recentItems->count() : 'Not set'); ?></p>
    <p>Recent Suppliers Count: <?php echo e($recentSuppliers ? $recentSuppliers->count() : 'Not set'); ?></p>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Documents\GitHub\Aplikasi-Manajemen-inventaris-barang\Aplikasi-Manajemen-inventaris-barang\resources\views\staff\dashboard_test.blade.php ENDPATH**/ ?>