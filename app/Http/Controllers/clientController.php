<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User as UserModel; 

class clientController extends Controller 
{    
    public function index()    
    {        
        $users = UserModel::all();
        return view('users.index', compact('users'));    
    }     

    public function show($id)    
    {        
        $user = UserModel::with(['repositories', 'followers', 'followings', 'totalLikes'])->findOrFail($id);
        return view('users.show', compact('user'));
    }
}
