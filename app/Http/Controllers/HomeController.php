<?php

namespace App\Http\Controllers;

use App\Models\Repository;
use Illuminate\Http\Request;
use App\Models\User as UserModel;

class HomeController extends Controller
{
    public function index()
    {
        $repositories = Repository::with(['user', 'likes'])->get();

        return view('dashboard.dashboard', compact('repositories'));
    }

    public function show($id)
    {
        $repo = Repository::with(['user', 'likes'])->findOrFail($id);


        $user = UserModel::with(['repositories', 'followers', 'followings', 'totalLikes'])->findOrFail($id);

        return view('dashboard.show', compact('repo', 'user'));
    }
}