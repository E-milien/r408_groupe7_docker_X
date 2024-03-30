<?php

use App\Http\Controllers\TweetController;
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

Route::get("/index", [TweetController::class, 'index']);

Route::get("/tweet", [TweetController::class, 'getTweet']);
Route::Post("/createtweet", [TweetController::class,'createTweet']);
