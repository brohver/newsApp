<?php

namespace App\Http\Resources;

use App\Video;
use App\Http\Resources\TagResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
          'post_id' => $this->id,
          'post_title' => $this->title,
          'post_content' => $this->content,
          'post_type' => $this->post_type,
          'author_id' => $this->author_id,
          'category_id' => $this->category_id,
          'updated_at' => $this->updated_at->diffForHumans(),
          'category' => new CategoryResource($this->category),
          'author' => new UserResource($this->author),
          'images' => ImageResource::collection($this->images),
          'videos' => VideoResource::collection($this->videos),
          'tags' => TagResource::collection($this->tags),
          'comments' => CommentResource::collection($this->comments),
          'likes' => count($this->likes),
          'retweets' => count($this->retweets),
          'retweeted' => $this->retweet,
          'liked' => $this->like,
          //'liked_by' =>  LikeResource::collection($this->likes)
          /* 'liked_by' => function() {
            foreach($this->likes as $like) {
              $user = User::find($like->user_id);
              return new UserResource($user);
            }
          } */
        ];
    }
}
