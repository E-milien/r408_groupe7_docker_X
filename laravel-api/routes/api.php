<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RetweetController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get("/tweet", [TweetController::class, 'getTweet']);
Route::Post("/createtweet", [TweetController::class, 'createTweet']);
Route::post('/registerNew', [AuthController::class, 'authenticate']);
Route::post('/login', [AuthController::class, 'login']);

Route::delete('/likes/{userId}/{tweetId}', [LikeController::class, 'delete']);
Route::post('/postLike', [LikeController::class, 'store']);
Route::get('likesById/{id}', [LikeController::class, 'getByIdLike']);
Route::get('/getLikes', [LikeController::class, 'getLikes']);
Route::get('/liked/{userId}/{tweetId}', [LikeController::class, 'getLiked']);

Route::delete('/retweets/{userId}/{tweetId}', [RetweetController::class, 'delete']);
Route::post('/postRetweet', [RetweetController::class, 'store']);
Route::get('retweetsById/{id}', [RetweetController::class, 'getByIdRT']);
Route::get('/getRetweets', [RetweetController::class, 'getRTs']);
Route::get('/retweeted/{userId}/{tweetId}', [RetweetController::class, 'getByIdsRT']);

Route::delete('/followers/{follower}/{followed}', [FollowerController::class, 'delete']);
Route::post('/postFollow', [FollowerController::class, 'store']);
Route::get('followsById/{id}', [FollowerController::class, 'getById']);
Route::get('/getFollows', [FollowerController::class, 'getFollowers']);
Route::get('/followed/{follower}/{followed}', [FollowerController::class, 'getByIds']);

Route::get('/comments', [CommentController::class, 'getComment']);
Route::get('/comments/getById/{id}', [CommentController::class, 'getById']);
Route::get('/comments/getByIdTweet/{id}', [CommentController::class, 'getByIdTweet']);
Route::put('/comments/{id}', [CommentController::class, 'updateComment']);
Route::post('/postComment', [CommentController::class, 'store']);
Route::delete('/comments/{id}', [CommentController::class, 'delete']);

//Route::delete('/user/{id}', [UserController::class, 'destroy']);
//Route::put('/users/{id}', [UserController::class, 'updateUser']);
Route::get("/users/getById/{id}", [UserController::class, 'getById']);
Route::get("/users", [UserController::class, 'getUser']);

Route::get("/tweet/getByIdTweet/{id}", [TweetController::class, 'getByIdUser']);
