<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
      'title' => $faker->sentence,
      'content' => $faker->paragraph,
      'post_type' => $faker->randomElement(['text', 'video']),
      'author_id' => User::all()->random(),
      'category_id' => Category::all()->random(),
    ];
});
