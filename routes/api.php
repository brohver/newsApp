<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
 */
Route::middleware(['auth:api'])->group(function (){
  Route::apiResource('categories', 'CategoryController');
  Route::apiResource('tags', 'TagController');
  Route::apiResource('/posts/{post}/comments', 'CommentController');
  Route::apiResource('/posts', 'PostController');
  Route::get('authors', 'UserController@index');
  Route::get('authors/{user}/posts', 'UserController@posts');
  Route::get('tags/{tag}/posts', 'TagController@posts');
  Route::post('posts/{post}/like', 'UserController@like');
  Route::delete('posts/{post}/like', 'UserController@unLike');
  Route::get('posts/{post}/likes', 'PostController@showLikes');
  Route::post('posts/{post}/retweet', 'UserController@retweet');
  Route::delete('posts/{post}/retweet', 'UserController@unRetweet');
  Route::get('posts/{post}/retweets', 'PostController@showRetweets');
  Route::get('users/{user}/follows', 'UserController@following');
  Route::post('follow/{user}', 'UserController@follow');
  Route::delete('follow/{user}', 'UserController@unfollow');
  //Route::apiResource('/users', 'UserController');
});

Route::group([

  'middleware' => 'api',
  'prefix' => 'auth'

], function ($router) {

  Route::post('login', 'Auth\AuthController@login');
  Route::post('logout', 'Auth\AuthController@logout');
  Route::post('refresh', 'Auth\AuthController@refresh');
  
  Route::post('me', 'Auth\AuthController@me');

});

Route::post('register', 'Auth\AuthController@register');
