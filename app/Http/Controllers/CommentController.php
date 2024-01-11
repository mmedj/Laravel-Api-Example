<?php

namespace App\Http\Controllers;

// app/Http/Controllers/CommentController.php

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{


    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'body' => 'required|string',
        ]);

        // Create a new comment and associate it with the selected post
        $comment = new Comment([
            'body' => $request->input('body'),
            // Add other fields as needed
        ]);

        // Associate the comment with the selected post
        $comment->post_id = $request->input('post_id');
        $comment->save();

        return response()->json($comment, 201);
    }

    public function index($postId)
    {
        $comments = Comment::where('post_id', $postId)->get();
        return response()->json($comments);
    }

    public function show($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        return response()->json($comment);
    }

    public function update(Request $request, $commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $comment->update($request->all());
        return response()->json($comment, 200);
    }
    public function edit($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        return response()->json($comment);
    }
    public function destroy($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $comment->delete();
        return response()->json(null, 204);
    }
}
