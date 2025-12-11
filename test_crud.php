<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== COMPREHENSIVE CRUD TESTING ===\n\n";

// Test Category CRUD
echo "Testing Category CRUD:\n";
echo "Count before: " . App\Models\Category::count() . "\n";

// Create
$category = App\Models\Category::create(['name' => 'Test Category', 'description' => 'Test Description']);
echo "Created category ID: " . $category->id . "\n";

// Read
$foundCategory = App\Models\Category::find($category->id);
echo "Found category: " . ($foundCategory ? $foundCategory->name : 'Not found') . "\n";

// Update
$category->update(['name' => 'Updated Category']);
echo "Updated category: " . $category->fresh()->name . "\n";

// Delete
$category->delete();
echo "Count after delete: " . App\Models\Category::count() . "\n\n";

// Test Supplier CRUD
echo "Testing Supplier CRUD:\n";
echo "Count before: " . App\Models\Supplier::count() . "\n";

    // Create
    $supplier = App\Models\Supplier::create(['name' => 'Test Supplier', 'contact_email' => 'test@example.com', 'address' => 'Test Address']);
echo "Created supplier ID: " . $supplier->id . "\n";

// Read
$foundSupplier = App\Models\Supplier::find($supplier->id);
echo "Found supplier: " . ($foundSupplier ? $foundSupplier->name : 'Not found') . "\n";

// Update
$supplier->update(['name' => 'Updated Supplier']);
echo "Updated supplier: " . $supplier->fresh()->name . "\n";

// Delete
$supplier->delete();
echo "Count after delete: " . App\Models\Supplier::count() . "\n\n";

// Test Item CRUD
echo "Testing Item CRUD:\n";
echo "Count before: " . App\Models\Item::count() . "\n";

// Get existing category and supplier IDs for foreign keys
$existingCategory = App\Models\Category::first();
$existingSupplier = App\Models\Supplier::first();

if ($existingCategory && $existingSupplier) {
    // Create
    $item = App\Models\Item::create([
        'name' => 'Test Item',
        'description' => 'Test Description',
        'category_id' => $existingCategory->id,
        'supplier_id' => $existingSupplier->id,
        'stock_quantity' => 10,
        'unit_price' => 100000,
        'condition' => 'baik',
        'status' => 'tersedia'
    ]);
    echo "Created item ID: " . $item->id . "\n";

    // Read
    $foundItem = App\Models\Item::find($item->id);
    echo "Found item: " . ($foundItem ? $foundItem->name : 'Not found') . "\n";

    // Update
    $item->update(['name' => 'Updated Item']);
    echo "Updated item: " . $item->fresh()->name . "\n";

    // Delete
    $item->delete();
    echo "Count after delete: " . App\Models\Item::count() . "\n\n";
} else {
    echo "Cannot test Item CRUD - missing category or supplier\n\n";
}

// Test Relationships
echo "Testing Relationships:\n";
$itemWithRelations = App\Models\Item::with(['category', 'supplier'])->first();
if ($itemWithRelations) {
    echo "Item: " . $itemWithRelations->name . "\n";
    echo "Category: " . ($itemWithRelations->category ? $itemWithRelations->category->name : 'None') . "\n";
    echo "Supplier: " . ($itemWithRelations->supplier ? $itemWithRelations->supplier->name : 'None') . "\n";
} else {
    echo "No items with relationships found\n";
}

echo "\n=== CRUD TESTING COMPLETED ===\n";
