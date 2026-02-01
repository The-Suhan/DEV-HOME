<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function repository()
    {
        return $this->belongsTo(Repository::class);
    }
    protected $fillable = [
        'user_id',
        'repository_id',
        'content',
    ];
}
