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


        $user = UserModel::with(['repositories', 'followers', 'followings',])->findOrFail($id);

        return view('dashboard.show', compact('repo', 'user'));
    }

    public function createRepo()
    {
        return view('dashboard.create_repo');
    }

    public function storeRepo(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'repo_path' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $repo = new \App\Models\Repository();
        $repo->user_id = auth()->id();
        $repo->title = $request->title;
        $repo->description = $request->description;
        $repo->repo_path = $request->repo_path;

        if ($request->hasFile('thumbnail')) {
            $imageName = time() . '.' . $request->thumbnail->extension();
            $request->thumbnail->move(public_path('repos'), $imageName);
            $repo->thumbnail = 'repos/' . $imageName;
        }

        $repo->save();

        return redirect()->route('profile.index')->with('success', 'Repo created successfully!');
    }

}