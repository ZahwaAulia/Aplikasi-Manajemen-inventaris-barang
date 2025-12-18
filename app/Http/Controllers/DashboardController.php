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


        return view('admin.dashboard', compact(
            'totalItems',
            'totalCategories',
            'totalSuppliers',
            'availableItems',
            'borrowedItems',
            'damagedItems'
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

        $availableItems = Item::where('status', 'tersedia')
            ->with(['category', 'supplier'])
            ->paginate(12);

        return view('guest.dashboard', compact(
            'categories',
            'availableItems'
        ));
    }
}
dvfbvgfbgf
