<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "Testing Item Model:\n";
$item = App\Models\Item::first();
if($item) {
    echo "First item: " . $item->name . "\n";
} else {
    echo "No items found\n";
}
echo "Count: " . App\Models\Item::count() . "\n\n";

echo "Testing Category Model:\n";
$category = App\Models\Category::first();
if($category) {
    echo "First category: " . $category->name . "\n";
} else {
    echo "No categories found\n";
}
echo "Count: " . App\Models\Category::count() . "\n\n";

echo "Testing Supplier Model:\n";
$supplier = App\Models\Supplier::first();
if($supplier) {
    echo "First supplier: " . $supplier->name . "\n";
} else {
    echo "No suppliers found\n";
}
echo "Count: " . App\Models\Supplier::count() . "\n\n";

echo "Testing Relationships:\n";
$itemWithRelations = App\Models\Item::with(['category', 'supplier'])->first();
if($itemWithRelations) {
    echo "Item: " . $itemWithRelations->name . "\n";
    echo "Category: " . ($itemWithRelations->category ? $itemWithRelations->category->name : 'None') . "\n";
    echo "Supplier: " . ($itemWithRelations->supplier ? $itemWithRelations->supplier->name : 'None') . "\n";
} else {
    echo "No items with relationships found\n";
}
