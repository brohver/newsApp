<?php

namespace App\Observers;

use App\Comment;
use Auth;

class CommentObserver
{
   public function creating(Comment $comment) {
    $comment->author_id = Auth::id();
  } 
}
