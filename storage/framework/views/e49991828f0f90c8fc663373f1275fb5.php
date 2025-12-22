<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Inventory App</title>

    
    <link href="<?php echo e(asset('assetadmin/css/argon-dashboard.css')); ?>" rel="stylesheet" />
    <style>
        :root {
            --bs-primary: #667eea;
            --bs-secondary: #f093fb;
            --bs-success: #4ecdc4;
            --bs-info: #45b7d1;
            --bs-warning: #f9ca24;
            --bs-danger: #f0932b;
            --bs-light: #f8f9fa;
            --bs-dark: #2d3748;
        }

        .bg-gradient-primary {
            background: linear-gradient(87deg, #667eea 0, #764ba2 100%) !important;
        }

        .bg-gradient-success {
            background: linear-gradient(87deg, #4ecdc4 0, #44a08d 100%) !important;
        }

        .bg-gradient-info {
            background: linear-gradient(87deg, #45b7d1 0, #96c93d 100%) !important;
        }

        .bg-gradient-warning {
            background: linear-gradient(87deg, #f9ca24 0, #f093fb 100%) !important;
        }

        .bg-gradient-danger {
            background: linear-gradient(87deg, #f0932b 0, #f5576c 100%) !important;
        }

        .navbar-vertical .navbar-nav>.nav-item>.nav-link.active {
            background: linear-gradient(87deg, #667eea 0, #764ba2 100%) !important;
        }

        .card {
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        .btn-primary {
            background: linear-gradient(87deg, #667eea 0, #764ba2 100%) !important;
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(87deg, #5a67d8 0, #6b46c1 100%) !important;
        }

        .sidenav {
            background: linear-gradient(180deg, #667eea 0%, #764ba2 50%, #f093fb 100%) !important;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        }

        .sidenav .navbar-brand {
            color: white !important;
        }

        .sidenav .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
        }

        .sidenav .navbar-nav .nav-link:hover {
            color: white !important;
            background: rgba(255, 255, 255, 0.1) !important;
        }

        .sidenav .navbar-nav .nav-link.active {
            color: white !important;
            background: rgba(255, 255, 255, 0.2) !important;
        }

        .sidenav hr.horizontal {
            background: rgba(255, 255, 255, 0.2) !important;
        }

        .sidenav .navbar-nav .nav-link.active {
            border-radius: 0.5rem;
            margin: 0.25rem 0.5rem;
        }

        .main-content {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%) !important;
        }

        .navbar-main {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px) !important;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05) !important;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            content: "›";
            color: #6b7280;
        }

        .form-control:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 0.2rem rgba(79, 70, 229, 0.25);
        }

        .table {
            border-radius: 0.5rem;
            overflow: hidden;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .table thead th {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%) !important;
            color: white;
            border: none;
        }

        .badge {
            border-radius: 0.375rem;
            font-weight: 500;
        }

        .alert {
            border-radius: 0.5rem;
            border: none;
        }

        .alert-success {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%) !important;
            color: #065f46;
        }

        .alert-danger {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%) !important;
            color: #991b1b;
        }

        .pagination .page-link {
            color: #4f46e5;
            border-color: #e5e7eb;
            border-radius: 0.375rem !important;
            margin: 0 0.125rem;
            transition: all 0.2s ease;
        }

        .pagination .page-link:hover {
            color: #3730a3;
            background: #f3f4f6;
            border-color: #d1d5db;
        }

        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%) !important;
            border-color: #4f46e5;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            border-radius: 0.5rem;
        }

        .dropdown-item:hover {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%) !important;
        }

        .avatar {
            border-radius: 0.5rem;
            border: 2px solid white;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .bg-gray-100 {
            background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%) !important;
        }

        .text-primary {
            color: #4f46e5 !important;
        }

        .text-secondary {
            color: #6b7280 !important;
        }

        .text-success {
            color: #10b981 !important;
        }

        .text-info {
            color: #06b6d4 !important;
        }

        .text-warning {
            color: #f59e0b !important;
        }

        .text-danger {
            color: #ef4444 !important;
        }

        .shadow {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
        }

        .shadow-lg {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        }

        .border-radius-xl {
            border-radius: 0.75rem !important;
        }

        .border-radius-lg {
            border-radius: 0.5rem !important;
        }

        .border-radius-md {
            border-radius: 0.375rem !important;
        }

        .border-radius-sm {
            border-radius: 0.25rem !important;
        }

        .border-radius-xs {
            border-radius: 0.125rem !important;
        }

        .opacity-5 {
            opacity: 0.5 !important;
        }

        .opacity-6 {
            opacity: 0.6 !important;
    </style>
</head>

<body class="g-sidenav-show bg-gray-100">

    
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3"
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="<?php echo e(route('admin.dashboard')); ?>" target="_blank">
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg"
                    class="navbar-brand-img">
                    <rect x="5" y="8" width="30" height="24" rx="3" fill="#ffffff" stroke="#ffffff"
                        stroke-width="2" />
                    <rect x="8" y="12" width="8" height="6" fill="#4f46e5" />
                    <rect x="18" y="12" width="8" height="6" fill="#4f46e5" />
                    <rect x="8" y="20" width="8" height="6" fill="#4f46e5" />
                    <rect x="18" y="20" width="8" height="6" fill="#4f46e5" />
                    <rect x="28" y="12" width="4" height="14" fill="#7c3aed" />
                    <circle cx="30" cy="15" r="1.5" fill="#ffffff" />
                    <circle cx="30" cy="20" r="1.5" fill="#ffffff" />
                    <circle cx="30" cy="25" r="1.5" fill="#ffffff" />
                </svg>
                <span class="ms-1 font-weight-bold">Manajemen Inventaris</span>

            </a>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </ul>
        </div>
    </aside>

    
    <main class="main-content d-flex flex-column min-vh-100 border-radius-lg">

        
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a>
                        </li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">Dashboard</h6>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                        <div class="input-group">
                            <span class="input-group-text text-body"><i class="fas fa-search"
                                    aria-hidden="true"></i></span>
                            <input type="text" class="form-control" placeholder="Type here...">
                        </div>
                    </div>
                    <ul class="navbar-nav justify-content-end">
                        <li class="nav-item d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body font-weight-bold px-0">
                                <i class="fa fa-user me-sm-1"></i>
                                <span class="d-sm-inline d-none">Sign In</span>
                            </a>
                        </li>
                        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item px-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0">
                                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                            </a>
                        </li>
                        <li class="nav-item dropdown pe-2 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-bell cursor-pointer"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4"
                                aria-labelledby="dropdownMenuButton">
                                <li class="mb-2">
                                    <a class="dropdown-item border-radius-md" href="javascript:;">
                                        <div class="d-flex py-1">
                                            <div class="my-auto">
                                                <img src="<?php echo e(asset('assetadmin/img/team-2.jpg')); ?>"
                                                    class="avatar avatar-sm me-3">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-sm font-weight-normal mb-1">
                                                    <span class="font-weight-bold">New message</span> from Laur
                                                </h6>
                                                <p class="text-xs text-secondary mb-0">
                                                    <i class="fa fa-clock me-1"></i>
                                                    13 minutes ago
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="mb-2">
                                    <a class="dropdown-item border-radius-md" href="javascript:;">
                                        <div class="d-flex py-1">
                                            <div class="my-auto">
                                                <img src="<?php echo e(asset('assetadmin/img/small-logos/logo-spotify.svg')); ?>"
                                                    class="avatar avatar-sm bg-gradient-dark me-3">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-sm font-weight-normal mb-1">
                                                    <span class="font-weight-bold">New album</span> by Travis Scott
                                                </h6>
                                                <p class="text-xs text-secondary mb-0">
                                                    <i class="fa fa-clock me-1"></i>
                                                    1 day
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item border-radius-md" href="javascript:;">
                                        <div class="d-flex py-1">
                                            <div class="my-auto">
                                                <i class="ni ni-controller text-dark"></i>
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-sm font-weight-normal mb-1">
                                                    Payment successfully completed
                                                </h6>
                                                <p class="text-xs text-secondary mb-0">
                                                    <i class="fa fa-clock me-1"></i>
                                                    2 days
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        
        <div class="container-fluid py-4 flex-grow-1">
            <?php echo $__env->yieldContent('content'); ?>
        </div>

        <footer class="text-center py-3 mt-auto"
            style="
        font-size: 13px;
        color: #fff;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 60%, #f093fb 100%);
        border-radius: 14px;
        margin: 0 1.5rem 1rem;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.35);
    ">
            © <?php echo e(date('Y')); ?> Inventory System • Developed by
            <strong>Zahwa & Raja</strong>
        </footer>


    </main>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php /**PATH C:\laragon\laragon-6.0-minimal\www\Aplikasi-Manajemen-inventaris-barang\resources\views/layouts/app.blade.php ENDPATH**/ ?>