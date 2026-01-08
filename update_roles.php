<?php

require_once 'vendor/autoload.php';

use Illuminate\Foundation\Application;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\DB;

$app = require_once 'bootstrap/app.php';

$app->make(Kernel::class)->bootstrap();

echo "Updating 'staff' roles to 'supplier'...\n";

$updated = DB::table('users')->where('role', 'staff')->update(['role' => 'supplier']);

echo "Updated $updated user(s) from 'staff' to 'supplier'.\n";

echo "Checking for any remaining 'staff' roles...\n";

$remaining = DB::table('users')->where('role', 'staff')->count();

if ($remaining > 0) {
    echo "Warning: $remaining 'staff' roles still exist!\n";
} else {
    echo "All 'staff' roles have been successfully updated to 'supplier'.\n";
}

echo "Done!\n";
