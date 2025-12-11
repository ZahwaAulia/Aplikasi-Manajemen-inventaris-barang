<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Item::create(['name' => 'Laptop Asus', 'description' => 'Laptop untuk kerja', 'stock_quantity' => 15, 'price' => 8500000, 'category_id' => 1, 'supplier_id' => 1]);
        Item::create(['name' => 'Kaos Polos', 'description' => 'Kaos katun', 'stock_quantity' => 50, 'price' => 50000, 'category_id' => 2, 'supplier_id' => 2]);
        Item::create(['name' => 'Nasi Goreng', 'description' => 'Makanan siap saji', 'stock_quantity' => 8, 'price' => 25000, 'category_id' => 3, 'supplier_id' => 3]);
        Item::create(['name' => 'Meja Kayu', 'description' => 'Meja makan', 'stock_quantity' => 5, 'price' => 1500000, 'category_id' => 4, 'supplier_id' => 4]);
        Item::create(['name' => 'Ban Mobil', 'description' => 'Ban untuk mobil', 'stock_quantity' => 20, 'price' => 800000, 'category_id' => 5, 'supplier_id' => 5]);
        Item::create(['name' => 'Mouse Wireless', 'description' => 'Mouse nirkabel', 'stock_quantity' => 3, 'price' => 150000, 'category_id' => 1, 'supplier_id' => 1]);
        Item::create(['name' => 'Celana Jeans', 'description' => 'Celana panjang', 'stock_quantity' => 25, 'price' => 200000, 'category_id' => 2, 'supplier_id' => 2]);
        Item::create(['name' => 'Kursi Kantor', 'description' => 'Kursi ergonomis', 'stock_quantity' => 10, 'price' => 750000, 'category_id' => 4, 'supplier_id' => 4]);
    }
}
