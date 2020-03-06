<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\User;
use App\Retweet;
use Faker\Generator as Faker;

$factory->define(Retweet::class, function (Faker $faker) {
    return [
      'post_id' => Post::all()->random(),
      'user_id' => User::all()->random(),
    ];
});
