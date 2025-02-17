<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
            'annonce_id' => 'required|exists:annonces,id'
        ]);

        $comment = new Comment();
        $comment->content = $validated['content'];
        $comment->annonce_id = $validated['annonce_id'];
        $comment->user_id = auth()->id();
        $comment->save();

        return redirect()->back()->with('success', 'Comment added successfully!');
    }

    public function destroy(Comment $comment)
    {
        if (auth()->id() !== $comment->user_id) {
            abort(403);
        }

        $comment->delete();
        return redirect()->back()->with('success', 'Comment deleted successfully!');
    }
}