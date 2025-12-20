<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

try {
    $totalSuppliers = \App\Models\Supplier::count();
    echo "Total suppliers: " . $totalSuppliers . "\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
