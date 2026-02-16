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

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }
    public function description()
    {
        return $this->belongsTo(Report::class, 'description');
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
