<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
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

Route::delete('/likes/{userId}/{tweetId}', [LikeController::class, 'delete']);
Route::post('/postLike', [LikeController::class, 'store']);
Route::get('likesById/{id}', [LikeController::class, 'getByIdLike']);
Route::get('/getLikes', [LikeController::class, 'getLikes']);
Route::get('/liked/{userId}/{tweetId}', [LikeController::class, 'getLiked']);

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
