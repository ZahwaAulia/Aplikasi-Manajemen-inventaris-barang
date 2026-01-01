<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Update all existing suppliers to approved status
        \App\Models\Supplier::query()->update(['status' => 'approved']);

        // Create or update suppliers
        \App\Models\Supplier::updateOrCreate(['name' => 'PT. Elektronik Indonesia'], ['contact_email' => 'contact@elektronik.co.id', 'contact_phone' => '08123456789', 'address' => 'Jakarta', 'status' => 'approved']);
        \App\Models\Supplier::updateOrCreate(['name' => 'CV. Pakaian Nusantara'], ['contact_email' => 'contact@pakaian.co.id', 'contact_phone' => '08198765432', 'address' => 'Bandung', 'status' => 'approved']);
        \App\Models\Supplier::updateOrCreate(['name' => 'UD. Makanan Sehat'], ['contact_email' => 'contact@makanan.co.id', 'contact_phone' => '08111222333', 'address' => 'Surabaya', 'status' => 'approved']);
         \App\Models\Supplier::updateOrCreate(['name' => 'PT. Furnitur Modern'], ['contact_email' => 'contact@furnitur.co.id', 'contact_phone' => '08144555666', 'address' => 'Semarang', 'status' => 'approved']);
        \App\Models\Supplier::updateOrCreate(['name' => 'CV. Otomotif Maju'], ['contact_email' => 'contact@otomotif.co.id', 'contact_phone' => '08177888999', 'address' => 'Yogyakarta', 'status' => 'approved']);
    }
}
