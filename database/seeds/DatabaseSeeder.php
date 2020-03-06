<?php

use App\Tag;
use App\Like;
use App\Post;
use App\User;
use App\Image;
use App\Video;
use App\Comment;
use App\Retweet;
use App\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      // $this->call(UsersTableSeeder::class);
      /* factory(User::class, 100)->create();
      factory(Category::class, 5)->create();
      factory(Tag::class, 20)->create();
      factory(Post::class, 50)->create();
      factory(Comment::class, 500)->create();
      factory(Image::class, 100)->create();
      factory(Video::class, 100)->create();
      factory(Like::class, 2000)->create(); */
      factory(Retweet::class, 2000)->create();
    }
}
