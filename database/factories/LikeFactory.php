<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Like;
use App\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(Like::class, function (Faker $faker) {
    return [
      'post_id' => Post::all()->random(),
      'user_id' => User::all()->random(),
    ];
});
