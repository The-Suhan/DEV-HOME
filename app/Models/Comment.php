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
        'post_id',
        'content',
    ];

    public function getName()
    {
        $locale = app()->getLocale();

        if ($locale == 'tm') {
            return $this->name_tm ?: $this->name;
        } else if ($locale == 'ru') {
            return $this->name_ru ?: $this->name;
        }
        return $this->name;
    }

}
