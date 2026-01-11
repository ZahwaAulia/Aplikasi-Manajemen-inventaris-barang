<?php

require_once 'vendor/autoload.php';

use App\Http\Controllers\DashboardController;

$controller = new DashboardController();

if (method_exists($controller, 'supplier')) {
    echo "Method 'supplier' exists in DashboardController\n";
} else {
    echo "Method 'supplier' does not exist in DashboardController\n";
}

$methods = get_class_methods($controller);
echo "Available methods: " . implode(', ', $methods) . "\n";
