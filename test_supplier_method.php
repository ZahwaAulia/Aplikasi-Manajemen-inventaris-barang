<?php

require_once 'vendor/autoload.php';

use App\Http\Controllers\DashboardController;

// Check if the method exists
$reflection = new ReflectionMethod(DashboardController::class, 'supplier');

echo "Method exists: " . ($reflection->isPublic() ? 'YES (public)' : 'NO') . "\n";
echo "Class: " . $reflection->getDeclaringClass()->getName() . "\n";

echo "\nAll public methods in DashboardController:\n";
$methods = (new ReflectionClass(DashboardController::class))->getMethods(ReflectionMethod::IS_PUBLIC);
foreach ($methods as $method) {
    echo "  - " . $method->getName() . "\n";
}
