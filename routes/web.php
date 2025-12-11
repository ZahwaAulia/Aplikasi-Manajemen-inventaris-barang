<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes (Require Authentication)
Route::middleware(['auth'])->group(function () {

    // General Dashboard Route - Redirects based on role
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->isStaff()) {
            return redirect()->route('staff.dashboard');
        } else {
            return redirect()->route('guest.dashboard');
        }
    })->name('dashboard');

    // Admin Routes
    Route::middleware(['role:admin'])
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {

            Route::get('/dashboard', [DashboardController::class, 'index'])
                ->name('dashboard');

            // Item Management
            Route::resource('items', ItemController::class);

            // Category Management
            Route::resource('categories', CategoryController::class);

            // Supplier Management
            Route::resource('suppliers', SupplierController::class);
        });

    // Staff Routes
    Route::middleware(['role:staff'])
        ->prefix('staff')
        ->name('staff.')
        ->group(function () {

            Route::get('/dashboard', [DashboardController::class, 'staff'])
                ->name('dashboard');

            // Item Management (Limited)
            Route::get('items', [ItemController::class, 'index'])->name('items.index');
            Route::get('items/{item}', [ItemController::class, 'show'])->name('items.show');
            Route::get('items/{item}/edit', [ItemController::class, 'edit'])->name('items.edit');
            Route::put('items/{item}', [ItemController::class, 'update'])->name('items.update');

            // Category & Supplier (Read-only)
            Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
            Route::get('suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
        });

    // Guest Routes
    Route::middleware(['role:guest'])
        ->prefix('guest')
        ->name('guest.')
        ->group(function () {

            Route::get('/dashboard', [DashboardController::class, 'guest'])
                ->name('dashboard');

            // Public Item View
            Route::get('items', [ItemController::class, 'index'])->name('items.index');
            Route::get('items/{item}', [ItemController::class, 'show'])->name('items.show');

            // Public Category & Supplier View
            Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
            Route::get('suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
        });
});
