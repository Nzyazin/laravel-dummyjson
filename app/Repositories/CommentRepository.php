<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Models\Post;
use App\Repositories\Interfaces\CommentRepositoryInterface;

class CommentRepository implements CommentRepositoryInterface
{
    public function importComments($postId, array $comments)
    {
        $post = Post::find($postId);

        foreach ($comments as $comment) {
            $post->comments()->create([
                'external_id' => $comment['id'],
                'body' => $comment['body'],
                // Дополнительные поля...
            ]);
        }
    }
}
