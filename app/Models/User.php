<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'profile_image',
        'bio',
        'github_url',
    ];

    public function getTotalLikesAttribute()
    {

        $repoIds = $this->repositories()->pluck('id');

        $postIds = $this->posts()->pluck('id');


        $repoLikesCount = \App\Models\Like::whereIn('repository_id', $repoIds)->count();
        $postLikesCount = \App\Models\Like::whereIn('post_id', $postIds)->count();

        return $repoLikesCount + $postLikesCount;
    }


    public function followings()
    {
        return $this->hasMany(Subscription::class, 'follower_id');
    }

    public function followers()
    {
        return $this->hasMany(Subscription::class, 'following_id');
    }


    public function isFollowing($userId)
    {
        return $this->followings()->where('following_id', $userId)->exists();
    }


    public function repositories()
    {
        return $this->hasMany(Repository::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }










    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_admin' => 'boolean',
    ];
}
