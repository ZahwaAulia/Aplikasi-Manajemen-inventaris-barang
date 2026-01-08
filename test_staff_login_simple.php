<?php

require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->handle(
    $request = Illuminate\Http\Request::create('/test-login', 'POST', [
        'email' => 'staff@example.com',
        'password' => 'password'
    ])
);

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// Test direct user lookup
$user = User::where('email', 'staff@example.com')->first();

if (!$user) {
    echo "Staff user not found\n";
    exit;
}

echo "User found: " . $user->name . "\n";
echo "User role: " . $user->role . "\n";
echo "User status: " . $user->status . "\n";
echo "Password hash: " . $user->password . "\n";
echo "Password check: " . (Hash::check('password', $user->password) ? 'valid' : 'invalid') . "\n";

// Test authentication
$result = Auth::attempt(['email' => 'staff@example.com', 'password' => 'password']);

echo "Login result: " . ($result ? 'success' : 'failed') . "\n";

if ($result) {
    echo "Authenticated user: " . Auth::user()->name . "\n";
    echo "Authenticated user role: " . Auth::user()->role . "\n";
} else {
    echo "Login failed\n";
}
