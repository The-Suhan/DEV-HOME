<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class ProfileController extends Controller
{
    
    public function index()
    {
        $user = Auth::user()->load(['repositories', 'followers', 'followings', 'totalLikes']);
        return view('profile.index', compact('user'));
    }


    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    
    public function destroy()
    {
        $user = Auth::user();
        Auth::logout();
        $user->delete();
        return redirect('/register')->with('success', 'Your account has been successfully deleted');
    }

    public function update(Request $request)
{
    $user = Auth::user();
    
    $request->validate([
        'username' => 'required|string|max:255|unique:users,username,'.$user->id,
        'bio' => 'nullable|string|max:500',
        'github_url' => 'nullable|url',
        'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $user->username = $request->username;
    $user->bio = $request->bio;
    $user->github_url = $request->github_url;

    if ($request->hasFile('profile_image')) {
        $imageName = time().'.'.$request->profile_image->extension();
        $request->profile_image->move(public_path('images/profiles'), $imageName);
        $user->profile_image = 'images/profiles/'.$imageName;
    }

    $user->save();

    return redirect()->route('profile.index')->with('success', 'Profil başarıyla güncellendi!');
}
}
