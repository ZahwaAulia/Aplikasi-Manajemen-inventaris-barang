<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|in:admin,staff,guest'
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {

            $request->session()->regenerate();
            $user = Auth::user();

            // Update user role if different from selected
            if ($user->role !== $request->role) {
                $user->update(['role' => $request->role]);
            }

            // Check if staff is confirmed
            if ($request->role === 'staff' && !$user->isConfirmed()) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Your account is pending admin approval.'
                ]);
            }

            if ($request->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            if ($request->role === 'staff') {
                return redirect()->route('staff.dashboard');
            }

            return redirect()->route('guest.dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.'
        ]);
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:staff,guest'
        ]);

        $status = $request->role === 'staff' ? 'pending' : 'confirmed';

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => $status,
        ]);

        $message = $request->role === 'staff'
            ? 'Registration successful! Your account is pending admin approval. Please wait for confirmation.'
            : 'Registration successful! Please login.';

        return redirect()->route('login')->with('status', $message);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
