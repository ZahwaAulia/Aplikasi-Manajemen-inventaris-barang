<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First update the enum to include 'supplier'
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'staff', 'supplier', 'guest') NOT NULL DEFAULT 'guest'");

        // Then update existing 'staff' roles to 'supplier'
        DB::table('users')->where('role', 'staff')->update(['role' => 'supplier']);

        // Finally, update the enum to remove 'staff'
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'supplier', 'guest') NOT NULL DEFAULT 'guest'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'supplier', 'guest') NOT NULL DEFAULT 'guest'");
    }
};
