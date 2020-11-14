<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function commentsOnlyParents()
    {
        return $this->hasMany(Comment::class)
            ->whereNull('parent_id');
    }

    public function getCommentsTree()
    {
        return Comment::makeCommentsTree($this->comments);
    }
}
