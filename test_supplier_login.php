<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\Auth;
use App\Models\User;

// Test supplier login
$user = User::where('role', 'supplier')->first();

if ($user) {
    Auth::login($user);
    echo "Logged in as: " . $user->name . " (" . $user->role . ")\n";

    // Test the route using HTTP client
    try {
        $kernel = app(\Illuminate\Contracts\Http\Kernel::class);
        $request = \Illuminate\Http\Request::create('/supplier/dashboard', 'GET');
        $response = $kernel->handle($request);

        echo "Response status: " . $response->getStatusCode() . "\n";

        if ($response->getStatusCode() == 200) {
            echo "✅ Supplier dashboard accessible!\n";
        } else {
            echo "❌ Error accessing supplier dashboard\n";
            echo "Response content: " . substr($response->getContent(), 0, 500) . "\n";
        }
    } catch (Exception $e) {
        echo "❌ Exception: " . $e->getMessage() . "\n";
    }
} else {
    echo "❌ No supplier user found\n";
}
