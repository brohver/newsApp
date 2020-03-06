<?php

namespace App;

use Auth;
use App\Retweet;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  protected $fillable = [
    'title', 'content', 'post_type', 
    'author_id', 'category_id', 'meta_data'
  ];

  public function author()
  {
    return $this->belongsTo(User::class, 'author_id');
  }

  public function category()
  {
    return $this->belongsTo(Category::class, 'category_id');
  }

  public function images()
  {
    return $this->hasMany(Image::class, 'id');
  }

  public function videos()
  {
    return $this->hasMany(Video::class, 'id');
  }

  public function tags()
  {
    return $this->belongsToMany(Tag::class);
  }

  public function comments()
  {
    return $this->hasMany(Comment::class);
  }

  public function retweets()
  {
    return $this->hasMany(Retweet::class);
  }

  public function likes()
  {
    return $this->hasMany(Like::class);
  }

  public function getRetweetAttribute()
  {
    //return "hello";
    $retweeted = Retweet::where('user_id', Auth::id())->where('post_id', $this->id)->first();
    if($retweeted) return true;
    return false;
  }

  public function getLikeAttribute()
  {
    //return "hello";
    $liked = Like::where('user_id', Auth::id())->where('post_id', $this->id)->first();
    if($liked) return true;
    return false;
  }
}
