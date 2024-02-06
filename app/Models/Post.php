<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['id', 'title', 'body', 'userId', 'tags', 'reactions'];
    /**
     * Получить комментарии этого поста.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }
}
