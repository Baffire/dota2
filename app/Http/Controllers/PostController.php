<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public static function show(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $comments = $post->commentsOnlyParents;

        return view('post.show', [
            'post' => $post,
            'comments' => $comments,
        ]);
    }

    public static function comment(Request $request, $postId)
    {
        $post = Post::findOrFail($postId);

        if ($request->input('parent_id')) {
            $parentComment = Comment::findOrFail($request->input('parent_id'));
            $parentsChain = 0;
            while ($parentComment->parent_id) {
                $parentComment = Comment::findOrFail($parentComment->parent_id);
                $parentsChain++;
            }
            if ($parentsChain >= 4) {
                return response()->json([
                    'status' => false,
                    'error' => 'Уровень вложенности превышает 5'
                ]);
            }
        }

        $comment = Comment::create([
            'user_nickname' => $request->input('user_nickname'),
            'body' => $request->input('body'),
            'parent_id' => $request->input('parent_id'),
            'post_id' => $postId,
        ]);

        return response()->json([
            'status' => true,
            'comments' => view('comments', [
                'comments' => $post->commentsOnlyParents
            ])->render(),
        ]);
    }

    public static function like(Request $request, $commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $comment->like += 1;
        $comment->save();
        return response()->json([
            'status' => true,
            'rating' => $comment->rating,
        ]);
    }

    public static function dislike(Request $request, $commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $comment->dislike += 1;
        $comment->save();
        return response()->json([
            'status' => true,
            'rating' => $comment->rating,
        ]);
    }

    public static function get_comments(Request $request, $postId)
    {
        $post = Post::findOrFail($postId);
        $sort = $request->input('sort');
        $comments = $post->commentsOnlyParents;
        return response()->json([
            'comments' => view('comments', [
                'comments' => $comments, 'sort' => $sort
            ])->render()
        ]);
    }
}
