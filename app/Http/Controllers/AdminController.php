<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    

    public function index()
    {
        $isAdmin = \DB::table('admins')->where('user_id', auth()->id())->exists();

        if (!$isAdmin) {
            abort(403, 'Access denied !');
        }

        $users = User::where('id', '!=', auth()->id())->get();
        return view('admin.panel', compact('users'));
    }

    public function destroy(User $user)
    {
        if (!auth()->user()->is_admin) {
            abort(403);
        }

        $user->delete();
        return back()->with('success', 'User deleted.');
    }
}