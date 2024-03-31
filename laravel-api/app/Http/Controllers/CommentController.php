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
        $request->validate([
            'comment_text' => 'required',
            'user_id' => 'required|exists:users,id',
            'tweet_id' => 'required|exists:tweets,id',
        ]);

        $comment = Comment::create($request->all());

        return response()->json($comment, 201);
    }

    public function delete($id)
    {
        Comment::findOrFail($id)->delete();
    }
}
