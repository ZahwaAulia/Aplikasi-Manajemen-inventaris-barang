<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// Test login
$user = User::where('email', 'admin@example.com')->first();
if ($user) {
    echo "User found: " . $user->email . "\n";
    echo "Password hash: " . $user->password . "\n";
    echo "Role: " . $user->role . "\n";
    echo "Status: " . $user->status . "\n";

    // Test password
    if (Hash::check('password', $user->password)) {
        echo "Password is correct\n";
    } else {
        echo "Password is incorrect\n";
    }

    // Test auth attempt
    $credentials = ['email' => 'admin@example.com', 'password' => 'password'];
    if (Auth::attempt($credentials)) {
        echo "Login successful\n";
        Auth::logout();
    } else {
        echo "Login failed\n";
    }
} else {
    echo "User not found\n";
}
