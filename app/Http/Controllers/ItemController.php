<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Item::with(['category', 'supplier']);

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%')
                  ->orWhere('location', 'like', '%' . $request->search . '%');
        }

        // Filter by category
        if ($request->has('category_id') && !empty($request->category_id)) {
            $query->where('category_id', $request->category_id);
        }

        // Filter by status
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        // Filter by condition
        if ($request->has('condition') && !empty($request->condition)) {
            $query->where('condition', $request->condition);
        }

        $items = $query->paginate(10)->withQueryString();
        $categories = Category::all();

        $view = auth()->user()->isStaff() ? 'staff.items.index' : 'admin.items.index';
        return view($view, compact('items', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        $view = auth()->user()->isStaff() ? 'staff.items.create' : 'admin.items.create';
        return view($view, compact('categories', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'stock_quantity' => 'required|integer|min:0',
            'unit_price' => 'nullable|numeric|min:0',
            'location' => 'nullable|string|max:255',
            'condition' => 'required|in:baik,rusak,perlu_perbaikan',
            'purchase_date' => 'nullable|date',
            'warranty_expiry' => 'nullable|date|after:purchase_date',
            'status' => 'required|in:tersedia,dipinjam,dikeluarkan',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('items', 'public');
        }

        Item::create($data);

        $redirectRoute = auth()->user()->isStaff() ? 'staff.items.index' : 'admin.items.index';
        return redirect()->route($redirectRoute)->with('success', 'Barang berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        $item->load(['category', 'supplier']);
        $view = auth()->user()->isStaff() ? 'staff.items.show' : 'admin.items.show';
        return view($view, compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        $view = auth()->user()->isStaff() ? 'staff.items.edit' : 'admin.items.edit';
        return view($view, compact('item', 'categories', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'stock_quantity' => 'required|integer|min:0',
            'unit_price' => 'nullable|numeric|min:0',
            'location' => 'nullable|string|max:255',
            'condition' => 'required|in:baik,rusak,perlu_perbaikan',
            'purchase_date' => 'nullable|date',
            'warranty_expiry' => 'nullable|date|after:purchase_date',
            'status' => 'required|in:tersedia,dipinjam,dikeluarkan',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($item->image && Storage::disk('public')->exists($item->image)) {
                Storage::disk('public')->delete($item->image);
            }
            $data['image'] = $request->file('image')->store('items', 'public');
        }

        $item->update($data);

        $redirectRoute = auth()->user()->isStaff() ? 'staff.items.index' : 'admin.items.index';
        return redirect()->route($redirectRoute)->with('success', 'Barang berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        // Delete image if exists
        if ($item->image && Storage::disk('public')->exists($item->image)) {
            Storage::disk('public')->delete($item->image);
        }

        $item->delete();

        $redirectRoute = auth()->user()->isStaff() ? 'staff.items.index' : 'admin.items.index';
        return redirect()->route($redirectRoute)->with('success', 'Barang berhasil dihapus.');
    }
}
