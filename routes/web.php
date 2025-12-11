<?php

use App\Http\Controllers\DasboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/dashboard', [DasboardController::class, 'index'])->name('admin.dashboard');

