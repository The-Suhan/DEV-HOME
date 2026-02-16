<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class ProfileController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        $repositories = $user->repositories()->latest()->get();
        $posts = \App\Models\Post::where('user_id', $user->id)->latest()->get();

        return view('profile.index', compact('user', 'repositories', 'posts'));
    }

    public function followers(\App\Models\User $user)
    {
        $list = $user->followers()->with('follower')->get();
        $type = 'Followers';
        return view('profile.follow_list', compact('user', 'list', 'type'));
    }

    public function following(\App\Models\User $user)
    {
        $list = $user->followings()->with('following')->get();
        $type = 'Following';
        return view('profile.follow_list', compact('user', 'list', 'type'));
    }

    public function destroyFollow(\App\Models\Subscription $subscription)
    {
        $subscription->delete();
        return back()->with('success', 'Removed!');
    }
    public function follow(\App\Models\User $user)
    {
        auth()->user()->followings()->create(['following_id' => $user->id]);
        return back();
    }

    public function unfollow(\App\Models\User $user)
    {
        auth()->user()->followings()->where('following_id', $user->id)->delete();
        return back();
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
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'bio' => 'nullable|string|max:500',
            'github_url' => 'nullable|url',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user->username = $request->username;
        $user->bio = $request->bio;
        $user->github_url = $request->github_url;

        if ($request->hasFile('profile_image')) {
            $imageName = time() . '.' . $request->profile_image->extension();
            $request->profile_image->move(public_path('images/profiles'), $imageName);
            $user->profile_image = 'images/profiles/' . $imageName;
        }

        $user->save();

        return redirect()->route('profile.index')->with('success', 'Profile updated!');
    }



}
