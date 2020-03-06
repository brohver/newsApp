<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Post;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\LikeResource;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PostCollection;
use App\Http\Resources\RetweetResource;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return PostCollection::collection(Post::orderBy('id', 'DESC')->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
        'title' => 'required',
        'category_id' => ['required','numeric', 
        function ($attribute, $value, $fail) {
          $category = Category::find($value);
          if (!$category) {
            $fail($attribute.' of '.$value.' is invalid.');
          }
        }],
        'content' => 'required',
        'post_type' => 'required',
        'images' => 'nullable|file:image',
        'videos' => 'nullable|file:image',
        'tags' => ['nullable', 
        function($att, $val, $fail) {
          foreach ($val as $tag) {
            $check = Tag::find($tag);
            if (!$check) $fail($att.' of id '.$tag.' is invalid.');
          }
        }]
      ]);

      //return $request->all();

      $request['author_id'] = Auth::id();

      $post = new Post($request->all());

      $post->save();
      
      if($request->has('tags')) {
        foreach ($request['tags'] as $tag_id) {
          DB::table('post_tag')->insert([
            'post_id' => $post->id,
            'tag_id' => $tag_id
          ]);
        }
      }

      




      return response([
        'message' => 'success',
        'data' => new PostResource($post)
      ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
      return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showLikes(Post $post) {
      return response([
        "total" => count($post->likes),
        "data" => LikeResource::collection($post->likes)
      ]);
      //return $post->likes;
    }

    public function showRetweets(Post $post) {
      return response([
        "total" => count($post->retweets),
        "data" => RetweetResource::collection($post->retweets)
      ]);
    }
}
