<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Retweet extends Model
{

  public $fillable = [
    'post_id','user_id'
  ];
  
  public function post() {
    return $this->belongsTo(Post::class);
  }
}
