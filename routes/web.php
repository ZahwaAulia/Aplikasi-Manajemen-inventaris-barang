<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\GuestItemController;

// Route::get('/', function () {
//     return redirect()->route('login');

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // User Management
    Route::resource('users', UserController::class)->except(['show', 'edit', 'update', 'destroy']);
    Route::post('/users/{id}/confirm', [UserController::class, 'confirm'])->name('users.confirm');
    Route::post('/users/{id}/reject', [UserController::class, 'reject'])->name('users.reject');

    // Items
    Route::resource('items', ItemController::class);

    // Categories
    Route::resource('categories', CategoryController::class);

    // Suppliers
    Route::resource('suppliers', SupplierController::class);
    Route::post('/suppliers/{supplier}/approve', [SupplierController::class, 'approve'])->name('suppliers.approve');
    Route::post('/suppliers/{supplier}/reject', [SupplierController::class, 'reject'])->name('suppliers.reject');
});

// Staff Routes
Route::middleware(['auth', 'role:staff'])->prefix('staff')->name('staff.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'staff'])->name('dashboard');

    // Items (staff can create and edit)
    Route::resource('items', ItemController::class);

    // Categories (read-only)
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

    // Suppliers (staff can propose)
    Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
    Route::get('/suppliers/create', [SupplierController::class, 'create'])->name('suppliers.create');
    Route::post('/suppliers', [SupplierController::class, 'store'])->name('suppliers.store');
});

// Guest Routes
Route::middleware(['auth', 'role:guest'])->prefix('guest')->name('guest.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'guest'])->name('dashboard');

//     // Items (read-only for guests)
//     // Route::get('/items', [ItemController::class, 'index'])->name('items.index');
//     // Route::get('/items/{item}', [ItemController::class, 'show'])->name('items.show');

//     // Categories (read-only)
//     Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

 Route::get('/items', [GuestItemController::class, 'index'])
        ->name('items.index');

    Route::get('/items/{item}', [GuestItemController::class, 'show'])
        ->name('items.show');

    // Categories (read-only)
    Route::get('/categories', [CategoryController::class, 'index'])
        ->name('categories.index');
});
