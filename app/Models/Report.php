<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'reporter_id',
        'reportable_id',
        'reportable_type',
        'reason',
        'description',
    ];

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    public function reportable()
    {
        return $this->morphTo();
    }
    public function getTargetUrlAttribute()
    {
        if (!$this->reportable)
            return '#';

        return match ($this->reportable_type) {
            'App\Models\User' => route('users.show', $this->reportable_id),
            'App\Models\Post' => route('posts.show', $this->reportable_id),
            'App\Models\Repository' => route('dashboard.show', $this->reportable_id), 
            default => '#',
        };
    }
}
