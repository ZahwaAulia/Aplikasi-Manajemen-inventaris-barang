<?php

require_once 'vendor/autoload.php';

use Illuminate\Foundation\Application;
use Illuminate\Contracts\Console\Kernel;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

echo "Testing Admin Login...\n\n";

// Check if admin user exists
$admin = User::where('email', 'admin@example.com')->first();

if (!$admin) {
    echo "❌ Admin user not found. Creating admin user...\n";

    User::create([
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'password' => Hash::make('password'),
        'role' => 'admin',
        'status' => 'confirmed',
    ]);

    echo "✅ Admin user created successfully!\n";
} else {
    echo "✅ Admin user exists:\n";
    echo "   - Name: " . $admin->name . "\n";
    echo "   - Email: " . $admin->email . "\n";
    echo "   - Role: " . $admin->role . "\n";
    echo "   - Status: " . $admin->status . "\n";
}

// Test password verification
$admin = User::where('email', 'admin@example.com')->first();
if (Hash::check('password', $admin->password)) {
    echo "✅ Password verification: CORRECT\n";
} else {
    echo "❌ Password verification: FAILED\n";
}

echo "\n📋 Login Instructions:\n";
echo "1. Go to: http://localhost/Aplikasi-Manajemen-inventaris-barang/login\n";
echo "2. Enter email: admin@example.com\n";
echo "3. Enter password: password\n";
echo "4. Select role: Admin\n";
echo "5. Click Login button\n";

echo "\n🔑 Available Test Accounts:\n";
echo "- Admin: admin@example.com / password\n";
echo "- Supplier: supplier@example.com / password\n";
echo "- Guest: guest@example.com / password\n";

echo "\n⚠️  Important: Make sure to select the correct role (Admin/Staff/Guest) in the login form!\n";
