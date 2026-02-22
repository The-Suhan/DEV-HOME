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
            'repo_file' => 'required|file|max:50000',
            'thumbnail' => 'required|image|max:5000',
        ]);

        if ($request->hasFile('repo_file') && $request->hasFile('thumbnail')) {
            $repoPath = $request->file('repo_file')->store('repos/repo_paths', 'public');
            $thumbPath = $request->file('thumbnail')->store('repos/repo_thumbnail', 'public');

            \App\Models\Repository::create([
                'user_id' => auth()->id(),
                'repo_path' => $repoPath,
                'thumbnail' => $thumbPath,
                'title' => $request->title,
                'description' => $request->description,
            ]);
        }

        return redirect()->route('profile.index')->with('success', 'Repo created successfully!');
    }

    public function locale($locale)
    {
        $locale = in_array($locale, ['tm', 'ru']) ? $locale : 'en';
        session()->put('locale', $locale);

        return redirect()->back();
    }

}