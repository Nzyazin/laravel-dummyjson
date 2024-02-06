<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['id', 'body', 'post_id', 'user_id'];
    /**
     * Получить пост, к которому относится этот комментарий.
     */
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}
