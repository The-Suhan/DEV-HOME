<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user',])->latest()->get();
        
        return view('posts.index', compact('posts'));
    }
    public function show(Post $post)
    {
        $post->load(['user',]);
        return view('posts.show', compact('post'));
    }
}
