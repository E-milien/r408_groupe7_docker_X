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

    public function getLiked($userId, $tweetId)
    {
        return Like::where('tweet_id', $tweetId)
            ->where('user_id', $userId)
            ->get();
    }

    public function store(Request $request)
    {
        $like = new Like();
        $like->user_id = $request->user_id;
        $like->tweet_id = $request->tweet_id;
        $like->save();
        return response()->json(['message' => 'Like posté avec succès'], 201);
    }

    public function delete($userId, $tweetId)
    {
        $like = Like::where('user_id', $userId)->where('tweet_id', $tweetId)->firstOrDefault();

        if ($like) {
            $like->delete();
            return response()->json(['message' => 'Like supprimé avec succès']);
        } else {
            return response()->json(['error' => 'Like non trouvé'], 404);
        }
    }
}
