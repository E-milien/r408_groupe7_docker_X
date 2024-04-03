<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Follower;

class FollowerController extends Controller
{
    public function getFollowers()
    {
        return Follower::all();
    }

    public function getById($id)
    {
        return Follower::where('followed_id', $id)->get();
    }

    public function getByIds($follower, $followed)
    {
        return Follower::where('follower_id', $follower)
            ->where('followed_id', $followed)
            ->get();
    }

    public function store(Request $request)
    {
        $rt = new Follower();
        $rt->follower_id = $request->follower_id;
        $rt->followed_id = $request->followed_id;
        $rt->save();
        return response()->json(['message' => 'Suivis exécuté avec succès'], 201);
    }

    public function delete($follower, $followed)
    {
        $rt = Follower::where('follower_id', $follower)->where('followed_id', $followed)->delete();

        if ($rt) {
            return response()->json(['message' => 'Follow supprimé avec succès'], 200);
        } else {
            return response()->json(['error' => 'Follow non trouvé'], 404);
        }
    }
}
