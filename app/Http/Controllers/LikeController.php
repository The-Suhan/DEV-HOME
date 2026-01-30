<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggleLike(Request $request)
    {
        $repoId = $request->repository_id;
        $userId = Auth::id();

        $like = Like::where('user_id', $userId)->where('repository_id', $repoId)->first();

        if ($like) {
            $like->delete();
            return response()->json(['status' => 'unliked', 'count' => Like::where('repository_id', $repoId)->count()]);
        }

        Like::create(['user_id' => $userId, 'repository_id' => $repoId]);
        return response()->json(['status' => 'liked', 'count' => Like::where('repository_id', $repoId)->count()]);
    }
}