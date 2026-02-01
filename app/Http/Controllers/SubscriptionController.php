<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function toggle(Request $request)
    {
        $me = auth()->user();
        $targetUserId = $request->user_id; 

        $subscription = Subscription::where('follower_id', $me->id)
            ->where('following_id', $targetUserId)
            ->first();

        if ($subscription) {
            $subscription->delete();
            $status = 'unfollowed';
        } else {
            Subscription::create([
                'follower_id' => $me->id,
                'following_id' => $targetUserId
            ]);
            $status = 'followed';
        }

       
        $followerCount = Subscription::where('following_id', $targetUserId)->count();

        return response()->json([
            'status' => $status,
            'followers_count' => $followerCount
        ]);
    }
}