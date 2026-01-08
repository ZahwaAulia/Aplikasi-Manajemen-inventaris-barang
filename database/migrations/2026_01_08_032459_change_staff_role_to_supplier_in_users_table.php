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
        // Change the enum values first
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'supplier', 'guest'])->default('guest')->change();
        });

        // Then update existing 'staff' roles to 'supplier'
        DB::table('users')->where('role', 'staff')->update(['role' => 'supplier']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // First, add 'staff' back to the enum
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'staff', 'supplier', 'guest'])->default('guest')->change();
        });

        // Update existing 'supplier' roles back to 'staff'
        DB::table('users')->where('role', 'supplier')->update(['role' => 'staff']);

        // Finally, remove 'supplier' from the enum
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'staff', 'guest'])->default('guest')->change();
        });
    }
};
