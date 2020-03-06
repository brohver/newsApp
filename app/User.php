<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements MustVerifyEmail, JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 
        'password', 'api_token', 'user_type', 
        'liked_posts', 'disliked_posts', 'favourite_posts', 
        'favourite_categories', 'preferences', 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
      return $this->hasMany(Post::class, 'author_id');
    }

    public function comments()
    {
      return $this->hasMany(Comment::class, 'author_id');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function following() {
      return $this->belongsToMany(User::class, 'follow', 'user_following', 'user_followed')->withTimestamps();
    }

    public function followers() {
      return $this->belongsToMany(User::class, 'follow', 'user_followed', 'user_following')->withTimestamps();
    }
}
