<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
            'status' => 'confirmed',
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Admin user created successfully.');
    }

   public function confirm(Request $request, $id)
{
    $user = User::find($id);

    if (!$user) {
        return redirect()->route('admin.users.index')->with('error', 'User not found.');
    }

    if ($user->role === 'staff' && $user->status === 'pending') {
        $user->update(['status' => 'confirmed']);
        return redirect()->route('admin.users.index')->with('success', 'Staff account confirmed successfully.');
    }

    return redirect()->route('admin.users.index')
        ->with('error', 'Unable to confirm this user. Role: ' . ($user->role ?? 'null') . ', Status: ' . ($user->status ?? 'null'));
}


public function reject(Request $request, $id)
{
    $user = User::find($id);

    if (!$user) {
        return redirect()->route('admin.users.index')->with('error', 'User not found.');
    }

    if ($user->role === 'staff' && $user->status === 'pending') {
        $user->update(['status' => 'rejected']);
        return redirect()->route('admin.users.index')
            ->with('success', 'Staff account rejected.');
    }

    return redirect()->route('admin.users.index')->with('error', 'Unable to reject this user.');
}

}
