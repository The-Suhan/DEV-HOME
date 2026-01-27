<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'user_id', 
        'repository_id', 
        'parent_id', 
        'comment_text'
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
    public function repository()
    {
        return $this->belongsTo(Repository::class);
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

  
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    
    public function repliedTo()
    {
        return $this->parent()->with('user');
    }
}