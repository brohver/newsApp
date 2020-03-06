<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Tag;
use App\Post;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
  /* $faker = new Faker();
  for($i = 0; $i < 1500; $i++ ){
    DB::table('post_tag')->insert(
      [
        'post_id' => Post::all()->random()->id,
        'tag_id' => Tag::all()->random()->id
      ]
    );
  } */

  /* $faker = new Faker();
  for($i = 0; $i < 1500; $i++ ){
    DB::table('follow')->insert(
      [
        'user_following' => User::all()->random()->id,
        'user_followed' => User::all()->random()->id
      ]
    );
  } */
  
});
