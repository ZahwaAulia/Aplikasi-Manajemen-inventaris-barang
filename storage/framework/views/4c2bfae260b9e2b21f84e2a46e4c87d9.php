<?php $__env->startSection('title', 'User Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>User Management</h6>
                        <a href="<?php echo e(route('admin.users.create')); ?>" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Add Admin
                        </a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <?php if(session('success')): ?>
                        <div class="alert alert-success mx-4"><?php echo e(session('success')); ?></div>
                    <?php endif; ?>
                    <?php if(session('error')): ?>
                        <div class="alert alert-danger mx-4"><?php echo e(session('error')); ?></div>
                    <?php endif; ?>
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Role</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm"><?php echo e($user->name); ?></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0"><?php echo e($user->email); ?></p>
                                    </td>
                                    <td>
                                        <span class="badge badge-sm bg-gradient-<?php echo e($user->role === 'admin' ? 'primary' : ($user->role === 'staff' ? 'info' : 'success')); ?>">
                                            <?php echo e(ucfirst($user->role)); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-sm bg-gradient-<?php echo e($user->status === 'confirmed' ? 'success' : 'warning'); ?>">
                                            <?php echo e(ucfirst($user->status)); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <?php if($user->role === 'staff' && $user->status === 'pending'): ?>
                                            <form action="<?php echo e(route('admin.users.confirm', $user->id)); ?>" method="POST" class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('POST'); ?>
                                                <button type="submit" class="btn btn-success btn-sm">
                                                    <i class="fas fa-check"></i> Confirm
                                                </button>
                                            </form>
                                            <form action="<?php echo e(route('admin.users.reject', $user->id)); ?>" method="POST" class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('POST'); ?>
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menolak registrasi staff ini?')">
                                                    <i class="fas fa-times"></i> Reject
                                                </button>
                                            </form>
                                        <?php else: ?>
                                            <span class="text-muted">No action needed</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\laragon-6.0-minimal\www\Aplikasi-Manajemen-inventaris-barang\resources\views/admin/users/index.blade.php ENDPATH**/ ?>