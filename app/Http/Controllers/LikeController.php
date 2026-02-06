<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Repository;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggle(Repository $repository)
    {
        $user = auth()->user();
        $like = $repository->likes()->where('user_id', $user->id)->first();

        if ($like) {
            $like->delete();
            $status = 'unliked';
        } else {
            $repository->likes()->create(['user_id' => $user->id]);
            $status = 'liked';
        }

        return response()->json([
            'status' => $status,
            'count' => $repository->likes()->count()
        ]);
    }
    public function togglePostLike(\App\Models\Post $post)
    {
        $user = auth()->user();
        $like = $post->likes()->where('user_id', $user->id)->first();

        if ($like) {
            $like->delete(); 
            $status = 'unliked';
        } else {
            $post->likes()->create(['user_id' => $user->id]);
            $status = 'liked';
        }

        return response()->json([
            'status' => $status,
            'like_count' => $post->likes()->count()
        ]);
    }
}