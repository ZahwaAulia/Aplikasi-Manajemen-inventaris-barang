<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\Supplier;

class DashboardController extends Controller
{
    // ================= ADMIN DASHBOARD =================
    public function index()
    {
        $totalItems      = Item::count();
        $totalCategories = Category::count();
        $totalSuppliers  = Supplier::count();

        $availableItems = Item::where('status', 'tersedia')->count();
        $borrowedItems  = Item::where('status', 'dipinjam')->count();
        $damagedItems = Item::where('status', 'dikeluarkan')->count();

        // Data for charts
        $itemStatusData = [
            'tersedia' => $availableItems,
            'dipinjam' => $borrowedItems,
            'dikeluarkan' => $damagedItems,
        ];

        // Recent items
        $recentItems = Item::with(['category', 'supplier'])->latest()->take(5)->get();

        // Categories with item counts
        $categoriesWithCounts = Category::withCount('items')->get();

        // Monthly item additions (simplified)
        $monthlyItems = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthlyItems[] = Item::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
        }

        return view('admin.dashboard', compact(
            'totalItems',
            'totalCategories',
            'totalSuppliers',
            'availableItems',
            'borrowedItems',
            'damagedItems',
            'itemStatusData',
            'recentItems',
            'categoriesWithCounts',
            'monthlyItems'
        ));
    }

    // ================= STAFF DASHBOARD =================
    public function staff()
    {
        $totalItems = Item::count();

        $availableItems = Item::where('status', 'tersedia')->count();
        $borrowedItems  = Item::where('status', 'dipinjam')->count();
        $damagedItems = Item::where('status', 'dikeluarkan')->count();


        return view('staff.dashboard', compact(
            'totalItems',
            'availableItems',
            'borrowedItems',
            'damagedItems'
        ));
    }

    // ================= GUEST DASHBOARD =================
    public function guest()
    {
        $categories = Category::withCount('items')->get();

        $totalAvailableItems = Item::where('status', 'tersedia')->count();

        $availableItems = Item::where('status', 'tersedia')
            ->with(['category', 'supplier'])
            ->paginate(12);

        return view('guest.dashboard', compact(
            'categories',
            'totalAvailableItems',
            'availableItems'
        ));
    }

    // ================= SUPPLIER DASHBOARD =================
    public function supplier()
    {
        $supplierId = auth()->user()->id;

        $totalItems = Item::where('supplier_id', $supplierId)->count();

        $availableItems = Item::where('supplier_id', $supplierId)
            ->where('status', 'tersedia')->count();
        $borrowedItems = Item::where('supplier_id', $supplierId)
            ->where('status', 'dipinjam')->count();
        $damagedItems = Item::where('supplier_id', $supplierId)
            ->where('status', 'dikeluarkan')->count();

        // Recent items by this supplier
        $recentItems = Item::where('supplier_id', $supplierId)
            ->with(['category', 'supplier'])
            ->latest()
            ->take(5)
            ->get();

        // Categories with item counts for this supplier
        $categories = Category::withCount(['items' => function ($query) use ($supplierId) {
            $query->where('supplier_id', $supplierId);
        }])->get();

        return view('supplier.dashboard', compact(
            'totalItems',
            'availableItems',
            'borrowedItems',
            'damagedItems',
            'recentItems',
            'categories'
        ));
    }
}
