<?php

namespace App\Http\Controllers;

use App\Models\Repository;
use Illuminate\Http\Request;

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

        return view('dashboard.show', compact('repo'));
    }
}