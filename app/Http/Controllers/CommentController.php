<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use Illuminate\Http\Request;
use App\Http\Resources\CommentResource;

class CommentController extends Controller
{
  public function index(Post $post) {
    return CommentResource::collection($post->comments);
  }

  public function show(Post $post, Comment $comment) {
    return new CommentResource($comment);
  }

  public function store(Post $post, Request $request) {
    $comment = $post->comments()->create($request->all());
    return response([
      "data" => new CommentResource($comment)
    ]);
  }
}
