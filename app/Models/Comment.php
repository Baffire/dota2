<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function post()
    {
        return $this->belongsTo(\App\Models\Post::class);
    }

    // public function children()
    // {
    //     return Comment::where('parent_id', $this->id);
    // }

    public function getRatingAttribute()
    {
        return $this->like - $this->dislike;
    }

    public static function sortComments($comments, $sort = 'popular')
    {
        if ($sort === 'popular') {
            $comments = $comments->sortByDesc('rating');
        } elseif ($sort === 'new') {
            $comments = $comments->sortByDesc('created_at');
        } elseif ($sort === 'old') {
            $comments = $comments->sortBy('created_at');
        }
        foreach ($comments as $comment) {
            $comment->children = Comment::sortComments($comment->children, $sort);
        }
        return $comments;
    }

    public static function get_comment_chain($comment)
    {
        $parentsChain = 0;
        while ($comment->parent) {
            $comment = $comment->parent;
            $parentsChain++;
        }
        return $parentsChain;
    }

    public static function makeCommentsTree($comments, $parent = NULL)
    {
        $currentComments = $comments->filter(function ($item) use ($parent) {
            return is_null($parent) ? (!$item->parent_id) : ($item->parent_id == $parent->id);
        });
        foreach ($currentComments as $currentComment) {
            $currentComment->parent = $parent;
            $currentComment->children = Comment::makeCommentsTree($comments, $currentComment);
        }
        return $currentComments;
    }
}
