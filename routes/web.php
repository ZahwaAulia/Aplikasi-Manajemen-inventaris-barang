<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Guest Routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Protected Routes
Route::middleware(['auth'])->group(function () {

    // Admin Routes
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');

        // Item Management
        Route::resource('items', ItemController::class);

        // Category Management
        Route::resource('categories', CategoryController::class);

        // Supplier Management
        Route::resource('suppliers', SupplierController::class);
    });

    // Staff Routes
    Route::middleware(['role:staff'])->prefix('staff')->name('staff.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'staff'])->name('dashboard');

        // Limited Item Management (Read, Update)
        Route::get('items', [ItemController::class, 'index'])->name('items.index');
        Route::get('items/{item}', [ItemController::class, 'show'])->name('items.show');
        Route::get('items/{item}/edit', [ItemController::class, 'edit'])->name('items.edit');
        Route::put('items/{item}', [ItemController::class, 'update'])->name('items.update');

        // Category and Supplier Read Only
        Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
    });

    // Guest Routes (Authenticated Guest)
    Route::middleware(['role:guest'])->prefix('guest')->name('guest.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'guest'])->name('dashboard');

        // Read Only Access
        Route::get('items', [ItemController::class, 'index'])->name('items.index');
        Route::get('items/{item}', [ItemController::class, 'show'])->name('items.show');
        Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
    });
});

