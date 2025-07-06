<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    /**
     * Store a newly created comment.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'post_id' => 'required|exists:posts,id',
            'parent_comment_id' => 'nullable|exists:comments,id'
        ]);

        // Check if adding this comment would exceed the maximum depth
        if (Comment::wouldExceedMaxDepth($request->parent_comment_id)) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot add reply: Maximum depth limit reached.'
            ], 422);
        }

        $comment = Comment::create([
            'content' => $request->content,
            'post_id' => $request->post_id,
            'parent_comment_id' => $request->parent_comment_id ?? null,
        ]);

        // Load the relationships for the response
        $comment->load('replies');

        return response()->json([
            'success' => true,
            'message' => 'Comment added successfully!',
            'comment' => $comment
        ]);
    }

    /**
     * Get comments for a specific post.
     */
    public function getComments(Post $post): JsonResponse
    {
        $comments = $post->comments()->with('allReplies')->get();

        return response()->json([
            'success' => true,
            'comments' => $comments
        ]);
    }

    /**
     * Delete a comment.
     */
    public function destroy(Comment $comment): JsonResponse
    {
        $comment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Comment deleted successfully!'
        ]);
    }
}
