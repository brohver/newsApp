<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Resources\TagResource;
use App\Http\Resources\PostResource;

class TagController extends Controller
{
  public function index() {
    return TagResource::collection(Tag::all());
  }

  public function posts(Tag $tag) {
    return PostResource::collection($tag->posts);
  }

  public function show(Tag $tag) {
    return new TagResource($tag);
  }

  public function store(Request $request) {
    $request->validate([
      'title' => 'required|unique:tags',
    ]);

    $tag = new Tag();
    $tag->title = strtolower(trim($request['title']));
    $tag->save();
    return response([
      'message' => 'success',
      'data' => new TagResource($tag),
    ], 200);
  }
}
