<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserCollection extends JsonResource
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
      'user_id' => $this->id,
      'first_name' => $this->first_name,
      'last_name' => $this->last_name,
      'email' => $this->email,
      'user_type' => $this->user_type,
      'liked_posts' => $this->liked_posts,
      'disliked_posts' => $this->disliked_posts,
      'favourite_posts' => $this->favourite_posts,
      'favourite_categories' => $this->favourite_categories,
      'avatar' => $this->avatar,
    ];
  }
}
