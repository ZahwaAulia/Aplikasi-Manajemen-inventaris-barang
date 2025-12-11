<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
