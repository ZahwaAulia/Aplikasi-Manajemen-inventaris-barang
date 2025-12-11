<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');



Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

// Proses login
Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::middleware(['auth'])->group(function () {


    Route::middleware(['role:admin'])
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {

            Route::get('/dashboard', [DashboardController::class, 'admin'])
                ->name('dashboard');

            Route::resource('items', ItemController::class);
            Route::resource('categories', CategoryController::class);
            Route::resource('suppliers', SupplierController::class);
        });


    Route::middleware(['role:staff'])
        ->prefix('staff')
        ->name('staff.')
        ->group(function () {

            Route::get('/dashboard', [DashboardController::class, 'staff'])
                ->name('dashboard');

            // Item khusus staff (read/update)
            Route::get('items', [ItemController::class, 'index'])->name('items.index');
            Route::get('items/{item}', [ItemController::class, 'show'])->name('items.show');
            Route::get('items/{item}/edit', [ItemController::class, 'edit'])->name('items.edit');
            Route::put('items/{item}', [ItemController::class, 'update'])->name('items.update');

            // Category & Supplier read-only
            Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
            Route::get('suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
        });



    Route::middleware(['role:guest'])
        ->prefix('guest')
        ->name('guest.')
        ->group(function () {

            Route::get('/dashboard', [DashboardController::class, 'guest'])
                ->name('dashboard');

            // Read only
            Route::get('items', [ItemController::class, 'index'])->name('items.index');
            Route::get('items/{item}', [ItemController::class, 'show'])->name('items.show');
            Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
            Route::get('suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
        });
});
