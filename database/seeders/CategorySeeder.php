<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name' => 'Elektronik', 'description' => 'Barang elektronik']);
        Category::create(['name' => 'Pakaian', 'description' => 'Pakaian dan aksesoris']);
        Category::create(['name' => 'Makanan', 'description' => 'Barang makanan dan minuman']);
        Category::create(['name' => 'Furnitur', 'description' => 'Barang rumah tangga']);
        Category::create(['name' => 'Otomotif', 'description' => 'Suku cadang dan aksesoris kendaraan']);
    }
}
