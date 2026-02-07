<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Repository;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.panel');
    }

    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function repositories()
    {
        $repos = Repository::with('user')->get();
        return view('admin.repositories', compact('repos'));
    }

    public function destroyUser(User $user)
    {
        $user->delete();
        return back()->with('success', 'user deleted !');
    }

    public function destroyRepo(Repository $repo)
    {
        $repo->delete();
        return back()->with('success', 'Repository deleted');
    }
    public function posts()
    {
        $posts = \App\Models\Post::with('user')->latest()->get();
        return view('admin.posts', compact('posts'));
    }

    public function destroyPost(\App\Models\Post $post)
    {
        $post->delete();
        return back()->with('success', 'Post deleted succesfully!');
    }
}