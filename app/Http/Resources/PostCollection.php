<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
          "post_id" => $this->id,
          //"title" => $this->title,
          'content' => $this->content,
          //'post_type' => $this->post_type,
          'author' => new UserResource($this->author),
          //'category' => new CategoryResource($this->category),
          //'image' => $this->images,
          'retweets' => count($this->retweets),
          'likes' => count($this->likes),
          'retweeted' => $this->retweet,
          'liked' => $this->like,
        ];
    }
}
