<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;

class GuestItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Item::with(['category', 'supplier']);

        // 🔍 SEARCH
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // 📦 FILTER KATEGORI
        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        // 📊 FILTER STATUS
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // 🛠️ FILTER KONDISI
        if ($request->condition) {
            $query->where('condition', $request->condition);
        }

        $items = $query->paginate(10)->withQueryString();
        $categories = Category::all();

        return view('guest.items.index', compact('items', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = Item::with(['category', 'supplier'])->findOrFail($id);

        return view('guest.items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
