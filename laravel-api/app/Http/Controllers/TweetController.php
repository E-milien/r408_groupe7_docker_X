<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;

class TweetController extends Controller
{

    public function getTweet()
    {
        return Tweet::all();
    }

    public function getById(Request $request, $id)
    {
        return Tweet::findOrFail($id);
    }


    public function createTweet(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'tweet_text' => 'required|string|max:280',
        ]);

        $tweet = new Tweet();
        $tweet->user_id = $request->user_id;
        $tweet->tweet_text = $request->tweet_text;
        $tweet->save();

        return response()->json(['message' => 'Tweet posté avec succès'], 201);
    }

    public function updateTweet(Request $request, $id)
    {
        $task = Tweet::findOrFail($id);
        return $task->update($request->all());
    }

    public function delete($id)
    {
        Tweet::findOrFail($id)->delete();
    }
}
