<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Repository extends Model
{
    use HasFactory ;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    
    public function comments()
    {
        return $this->belongsTo(Comment::class);
    }
    public function likes()
    {
        return $this->belongsTo(Like::class);
    }
    
}
