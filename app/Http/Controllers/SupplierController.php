<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Supplier::query();

        // Supplier can only see approved suppliers
        if (auth()->user()->role === 'supplier') {
            $query->where('status', 'approved');
        }

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('contact_email', 'like', '%' . $request->search . '%');
        }

        $suppliers = $query->paginate(10);

        $view = auth()->user()->role === 'supplier' ? 'supplier.supplier.index' : 'admin.suppliers.index';
        return view($view, compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $view = auth()->user()->role === 'supplier' ? 'supplier.supplier.create' : 'admin.suppliers.create';
        return view($view);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['status'] = auth()->user()->role === 'supplier' ? 'pending' : 'approved';

        Supplier::create($data);

        $route = auth()->user()->role === 'supplier' ? 'supplier.suppliers.index' : 'admin.suppliers.index';
        return redirect()->route($route)->with('success', 'Supplier berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        return view('admin.suppliers.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        return view('admin.supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        // Supplier cannot update suppliers
        if (auth()->user()->role === 'supplier') {
            return redirect()->route('supplier.suppliers.index')->with('error', 'Anda tidak memiliki izin untuk mengupdate supplier.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        $supplier->update($request->all());

        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        // Supplier cannot delete suppliers
        if (auth()->user()->role === 'supplier') {
            return redirect()->route('supplier.suppliers.index')->with('error', 'Anda tidak memiliki izin untuk menghapus supplier.');
        }

        $supplier->delete();

        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier berhasil dihapus.');
    }

    /**
     * Approve a pending supplier.
     */
    public function approve(Supplier $supplier)
    {
        // Only admin can approve suppliers
        if (auth()->user()->role !== 'admin') {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menyetujui supplier.');
        }

        if ($supplier->status !== 'pending') {
            return redirect()->back()->with('error', 'Supplier ini sudah disetujui atau tidak valid.');
        }

        $supplier->update(['status' => 'approved']);

        return redirect()->back()->with('success', 'Supplier berhasil disetujui.');
    }

    /**
     * Reject a pending supplier.
     */
    public function reject(Supplier $supplier)
    {
        // Only admin can reject suppliers
        if (auth()->user()->role !== 'admin') {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menolak supplier.');
        }

        if ($supplier->status !== 'pending') {
            return redirect()->back()->with('error', 'Supplier ini sudah disetujui atau tidak valid.');
        }

        $supplier->update(['status' => 'rejected']);

        return redirect()->back()->with('success', 'Supplier berhasil ditolak.');
    }
}
