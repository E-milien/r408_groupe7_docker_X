<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;

class LikeController extends Controller
{
    public function getLikes()
    {
        return Like::all();
    }

    public function getByIdLike($id)
    {
        return Like::where('tweet_id', $id)->get();
    }

    public function getLiked($user_id, $tweet_id)
    {
        return Like::where('tweet_id', $tweet_id)
            ->where('user_id', $user_id)
            ->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'tweet_id' => 'required|exists:tweets,id',
        ]);

        $like = Like::create([
            'user_id' => $request->user_id,
            'tweet_id' => $request->tweet_id,
        ]);

        return response()->json($like, 201);
    }

    public function delete($userId, $tweetId)
    {
        $like = Like::where('user_id', $userId)->where('tweet_id', $tweetId)->first();

        if ($like) {
            $like->delete();
            return response()->json(['message' => 'Like supprimé avec succès']);
        } else {
            return response()->json(['error' => 'Like non trouvé'], 404);
        }
    }
}
