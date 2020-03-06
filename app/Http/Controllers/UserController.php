<?php

namespace App\Http\Controllers;

use Auth;
use App\Like;
use App\Post;
use App\User;
use App\Retweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return UserResource::collection(User::paginate(15));
    }

    public function posts(User $user) {
      return PostResource::collection($user->posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function unLike(Post $post) {
      $check = Like::where('post_id','=', $post->id)->where('user_id','=', Auth::id())->first();
      //$check = Like::find($post->id);
      //return $check->id;
      if(!$check){
        return response([
          "message" => "post not liked, can't unlike"
        ]);
      }
      $check->delete();
      return response([
        "message" => "success",
      ]);
    }

    public function like(Post $post) {
      $check = Like::where('post_id','=', $post->id)->where('user_id','=', Auth::id())->first();
      //$check = Like::find($post->id);
      //return $check;
      if($check){
        return response([
          "message" => "this post has been liked"
        ]);
      }
      $like = new Like();
      $like->post_id = $post->id;
      $like->user_id = Auth::id();
      $like->save();
      return response([
        "message" => "success",
      ]);
    }

    public function unRetweet(Post $post) {
      $check = Retweet::where('post_id','=', $post->id)->where('user_id','=', Auth::id())->first();
      //$check = Like::find($post->id);
      //return $check->id;
      if(!$check){
        return response([
          "message" => "post not retweeted, can't retweet"
        ]);
      }
      $check->delete();
      return response([
        "message" => "success",
      ]);
    }

    public function retweet(Post $post) {
      $check = Retweet::where('post_id','=', $post->id)->where('user_id','=', Auth::id())->first();
      //$check = Like::find($post->id);
      //return $check;
      if($check){
        return response([
          "message" => "this post has been retweeted"
        ]);
      }
      $retweet = new Retweet();
      $retweet->post_id = $post->id;
      $retweet->user_id = Auth::id();
      $retweet->save();
      return response([
        "message" => "success",
      ]);
    }

    public function follow(User $user) {
      if($user->id == Auth::id()){
        return response([
          "message" => "can't follow self"
        ]);
      }
      $exist = DB::table('follow')->where('user_following', Auth::id())->where('user_followed', $user->id)->first();
      if($exist) return response([
        "message" => "you already follow this user"
      ]);

      $parent = User::find(Auth::id());
      $parent->following()->attach($user);
      return response([
        "message" => "success"
      ]); 
    }

    public function unfollow(User $user){
      if($user->id == Auth::id()){
        return response([
          "message" => "can't unfollow self"
        ]);
      }
      $exist = DB::table('follow')->where('user_following', Auth::id())->where('user_followed', $user->id)->first();
      if(!$exist) return response([
        "message" => "can't unfollow a user you don't follow"
      ]);

      $parent = User::find(Auth::id());
      $parent->following()->detach($user);
      return response([
        "message" => "success"
      ]);
    }
}
