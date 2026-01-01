<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

try {
    DB::statement('DROP TABLE IF EXISTS sessions');
    echo "Sessions table dropped successfully.\n";
} catch (Exception $e) {
    echo "Error dropping sessions table: " . $e->getMessage() . "\n";
}
