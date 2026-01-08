<?php

require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

use Illuminate\Support\Facades\Auth;
use App\Models\User;

// Test supplier login
$user = User::where('email', 'supplier@example.com')->first();

if (!$user) {
    echo "Supplier user not found\n";
    exit;
}

echo "User found: " . $user->name . "\n";
echo "User role: " . $user->role . "\n";
echo "User status: " . $user->status . "\n";

$result = Auth::attempt(['email' => 'supplier@example.com', 'password' => 'password']);

echo "Login result: " . ($result ? 'success' : 'failed') . "\n";

if ($result) {
    echo "Authenticated user: " . Auth::user()->name . "\n";
    echo "Authenticated user role: " . Auth::user()->role . "\n";
} else {
    echo "Login failed\n";
}
