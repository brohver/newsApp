<?php

namespace App\Http\Resources;

use App\User;
use Illuminate\Http\Resources\Json\JsonResource;

class RetweetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $user = User::find($this->user_id);
        return [
          'retweetId' => $this->id,
          'user_id' => $user->id,
          'first_name' => $user->first_name,
          'last_name' => $user->last_name,
          'email' => $user->email,
          'avatar' => $user->avatar,
        ];
    }
}
