<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max
        ]);

        $user = Auth::user();

        if ($request->hasFile('profile_photo')) {

            // hapus foto lama
            if ($user->profile_photo && file_exists(public_path($user->profile_photo))) {
                unlink(public_path($user->profile_photo));
            }

            // simpan foto ke public/profile-photos
            $filename = time() . '_' . $request->profile_photo->getClientOriginalName();
            $request->profile_photo->move(public_path('profile-photos'), $filename);

            $user->profile_photo = 'profile-photos/' . $filename;
            $user->save();
        }

        return redirect()->back()->with('success', 'Profile photo updated successfully!');
    }
}
