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

    public function create()
    {
        return view('posts.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'media' => 'required|file|max:20000', 
            'type' => 'required|in:image,video',
            'caption' => 'nullable|string|max:1000',
        ]);

        if ($request->hasFile('media')) {
            $file = $request->file('media');
            $fileName = time() . '.' . $file->getClientOriginalExtension();

            $folder = ($request->type === 'video') ? 'videos' : 'images';
            $file->move(public_path($folder), $fileName);
            $path = $folder . '/' . $fileName;

            \App\Models\Post::create([
                'user_id' => auth()->id(),
                'media_path' => $path,
                'caption' => $request->caption,
                'type' => $request->type
            ]);

            return redirect()->route('profile.index')->with('success', 'Post shared!');
        }
    }
}
