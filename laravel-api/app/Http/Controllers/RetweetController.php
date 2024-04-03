<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Retweet;

class RetweetController extends Controller
{
    public function getRTs()
    {
        return Retweet::all();
    }

    public function getByIdRT($id)
    {
        return Retweet::where('tweet_id', $id)->get();
    }

    public function getByIdsRT($userId, $tweetId)
    {
        return Retweet::where('tweet_id', $tweetId)
            ->where('user_id', $userId)
            ->get();
    }

    public function store(Request $request)
    {
        $rt = new Retweet();
        $rt->user_id = $request->user_id;
        $rt->tweet_id = $request->tweet_id;
        $rt->save();
        return response()->json(['message' => 'Retweet posté avec succès'], 201);
    }

    public function delete($userId, $tweetId)
    {
        $rt = Retweet::where('user_id', $userId)->where('tweet_id', $tweetId)->delete();

        if ($rt) {
            return response()->json(['message' => 'Retweet supprimé avec succès'], 200);
        } else {
            return response()->json(['error' => 'Retweet non trouvé'], 404);
        }
    }
}
