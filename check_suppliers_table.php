<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

try {
    $suppliers = DB::select('DESCRIBE suppliers');
    echo "Suppliers table structure:\n";
    foreach ($suppliers as $column) {
        echo "- {$column->Field}: {$column->Type}\n";
    }

    // Check if status column exists
    $statusColumn = collect($suppliers)->firstWhere('Field', 'status');
    if ($statusColumn) {
        echo "\nStatus column exists: {$statusColumn->Type}\n";
    } else {
        echo "\nStatus column does NOT exist!\n";
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
