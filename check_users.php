<?php

require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

use App\Models\User;

$users = User::all();

echo "Users in database:\n";
foreach ($users as $user) {
    echo "ID: " . $user->id . ", Name: " . $user->name . ", Email: " . $user->email . ", Role: " . $user->role . ", Status: " . $user->status . "\n";
}
