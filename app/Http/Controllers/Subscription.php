<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function toggle(Request $request)
    {
        $targetUserId = $request->user_id;
        $myId = Auth::id();

        if ($targetUserId == $myId) {
            return response()->json(['error' => 'Kendini takip edemezsin kanka!'], 400);
        }

        $sub = Subscription::where('follower_id', $myId)->where('following_id', $targetUserId)->first();

        if ($sub) {
            $sub->delete();
            return response()->json(['status' => 'unsubscribed']);
        }

        Subscription::create([
            'follower_id' => $myId,
            'following_id' => $targetUserId
        ]);

        return response()->json(['status' => 'subscribed']);
    }
}
