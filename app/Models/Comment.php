<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    
    protected $fillable = ['id', 'body', 'postId', 'user'];
    /**
     * Получить пост, к которому относится этот комментарий.
     */
    public function post()
    {
        return $this->belongsTo(Post::class, 'postId');
    }
}
