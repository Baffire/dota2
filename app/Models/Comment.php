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

    public function children()
    {
        return Comment::where('parent_id', $this->id);
    }

    public function getRatingAttribute()
    {
        return $this->like - $this->dislike;
    }

    public static function sort_comments($comments, $sort)
    {
        if ($sort === 'popular') {
            $comments = $comments->sortByDesc('rating');
        } elseif ($sort === 'new') {
            $comments = $comments->sortByDesc('created_at');
        } elseif ($sort === 'old') {
            $comments = $comments->sortBy('created_at');
        }
        return $comments;
    }

    public static function get_comment_chain($comment)
    {
        $parentsChain = 0;
        while ($comment->parent_id) {
            $comment = Comment::findOrFail($comment->parent_id);
            $parentsChain++;
        }
        return $parentsChain;
    }
}
