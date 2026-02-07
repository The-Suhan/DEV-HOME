<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User as UserModel;

class clientController extends Controller
{
    public function index()
    {
        $users = UserModel::all();
        return view('users.index', compact('users'));
    }

    public function show($id)
    {
        $user = auth()->user()->findOrFail($id);
        $repositories = $user->repositories()->latest()->get();
        $posts = \App\Models\Post::where('user_id', $user->id)->latest()->get();

        return view('users.show', compact('user', 'repositories', 'posts'));
    }
}
