<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

// Item Management Routes
Route::resource('items', ItemController::class)->names([
    'index' => 'admin.items.index',
    'create' => 'admin.items.create',
    'store' => 'admin.items.store',
    'show' => 'admin.items.show',
    'edit' => 'admin.items.edit',
    'update' => 'admin.items.update',
    'destroy' => 'admin.items.destroy',
]);

