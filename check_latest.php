<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Item;
use App\Models\Supplier;

echo "Items count: " . Item::count() . PHP_EOL;
echo "Suppliers count: " . Supplier::count() . PHP_EOL;

echo "Latest 5 items:" . PHP_EOL;
$latestItems = Item::latest()->take(5)->get();
foreach ($latestItems as $item) {
    echo $item->name . ' - ' . $item->created_at . PHP_EOL;
}

echo "Latest 5 suppliers:" . PHP_EOL;
$latestSuppliers = Supplier::latest()->take(5)->get();
foreach ($latestSuppliers as $supplier) {
    echo $supplier->name . ' - ' . $supplier->created_at . PHP_EOL;
}
