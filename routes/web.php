  <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\AuthController;
    use App\Http\Controllers\DashboardController;
    use App\Http\Controllers\UserController;
    use App\Http\Controllers\ItemController;
    use App\Http\Controllers\CategoryController;
    use App\Http\Controllers\SupplierController;
    use App\Http\Controllers\GuestItemController;
    use App\Http\Controllers\ProfileController;  

    // Route::get('/', function () {
    //     return redirect()->route('login');

    Route::get('/', function () {
        $stats = [
            'total_items' => \App\Models\Item::count(),
            'total_categories' => \App\Models\Category::count(),
            'total_suppliers' => \App\Models\Supplier::count(),
            'recent_items' => \App\Models\Item::with('category')->latest()->take(3)->get()
        ];
        return view('welcome', compact('stats'));
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

    // Supplier Routes
    Route::middleware(['auth', 'role:supplier'])->prefix('supplier')->name('supplier.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'supplier'])->name('dashboard');

        // Items (supplier can create and edit)
        Route::resource('items', ItemController::class);

        // Categories (read-only)
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

        // Suppliers (supplier can propose and manage their own)
        Route::resource('suppliers', SupplierController::class)->except(['destroy']);
    });

    // Public Guest Routes (for unauthenticated users to view limited items)
    Route::prefix('guest')->name('guest.')->group(function () {
        Route::get('/items', [GuestItemController::class, 'index'])
            ->name('items.index');

        Route::get('/items/{item}', [GuestItemController::class, 'show'])
            ->name('items.show');
    });

    // Authenticated Guest Routes
    Route::middleware(['auth', 'role:guest'])->prefix('guest')->name('guest.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'guest'])->name('dashboard');

        // Categories (read-only)
        Route::get('/categories', [CategoryController::class, 'index'])
            ->name('categories.index');
    });

    // Profile Routes (for all authenticated users)
    Route::middleware(['auth'])->group(function () {
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    });
