<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use App\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
      'content' => $faker->sentence,
      'author_id' => User::all()->random(), //rand(1, 99), 
      'post_id' => Post::all()->random()
    ];
});
