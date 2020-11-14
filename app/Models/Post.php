<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function comments()
    {
        return $this->hasMany(\App\Models\Comment::class);
    }

    public function commentsOnlyParents()
    {
        return $this->hasMany(\App\Models\Comment::class)
            ->whereNull('parent_id');
    }
}
