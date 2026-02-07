<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|max:500'
        ]);

        \App\Models\Comment::create([
            'user_id' => auth()->id(),
            'content' => $request->content,
        
            'post_id' => $request->has('is_post') ? $id : null,
            'repository_id' => $request->has('is_post') ? null : $id,
        ]);

        return back();
    }
}

