<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $repoId)
    {
        $request->validate(['content' => 'required|max:500']);

        Comment::create([
            'user_id' => auth()->id(),
            'repository_id' => $repoId,
            'content' => $request->content
        ]);

        return back()->with('success', 'Comment submitted');
    }
}
