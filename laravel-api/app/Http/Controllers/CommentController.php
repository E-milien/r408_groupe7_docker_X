<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function getComment()
    {
        return Comment::all();
    }

    public function getById($id)
    {
        return Comment::findOrFail($id);
    }

    public function getByIdTweet($id)
    {
        return Comment::where('tweet_id', $id)->get();
    }

    public function updateComment(Request $request, $id)
    {
        $task = Comment::findOrFail($id);
        return $task->update($request->all());
    }

    public function store(Request $request)
    {
        $comment = new Comment();
        $comment->user_id = $request->user_id;
        $comment->tweet_id = $request->tweet_id;
        $comment->comment_text = $request->comment_text;
        $comment->created_at = $request->created_at;
        $comment->save();


        return response()->json(['message' => 'Tweet posté avec succès'], 201);
    }

    public function delete($id)
    {
        Comment::findOrFail($id)->delete();
    }
}
