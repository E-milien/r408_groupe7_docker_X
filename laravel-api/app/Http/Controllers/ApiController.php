<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;

class ApiController extends Controller
{
    public function index(){
        return 'hello world';
    }

    public function tweet(Request $request) {
        $tweets = [
            [
                "user_id" => 1,
                "tweet_text" => "Contenu du tweet 1"
            ],
            [
                "user_id" => 2,
                "tweet_text" => "Contenu du tweet 2"
            ],
            [
                "user_id" => 3,
                "tweet_text" => "Contenu du tweet 3"
            ]
        ];
    
        return $tweets;
    }
}
