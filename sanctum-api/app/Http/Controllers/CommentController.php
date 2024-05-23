<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    public function index()
    {
        return Comment::all();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'body' => 'required|string',
            'post_id' => 'required|exists:posts,id',
        ]);

        $comment = Comment::create([
            'body' => $validatedData['body'],
            'post_id' => $validatedData['post_id'],
            'user_id' => $request->user()->id,
        ]);

        return response()->json($comment, 201);
    }

    public function show(Comment $comment)
    {
        return $comment;
    }

    public function update(Request $request, Post $post, Comment $comment)
    {
        $request->validate([
            'body' => 'required|string',
        ]);

        $comment->body = $request->body;
        $comment->save();

        return response()->json($comment, 200);
    }

    public function destroy(Post $post, Comment $comment)
    {
        // $this->authorize('delete', $comment);
        Log::info('Deleting comment', ['comment' => $comment]);
        $comment->delete();

        return response()->json(null, 204);
    }

}
