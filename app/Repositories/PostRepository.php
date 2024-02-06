<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface
{
    public function importPosts(array $posts)
    {
        foreach ($posts as $post) {
            $existingPost = Post::where('external_id', $post['id'])->first();

            if (!$existingPost) {
                Post::create([
                    'external_id' => $post['id'],
                    'title' => $post['title'],
                    'body' => $post['body'],
                    // Дополнительные поля...
                ]);
            }
        }
    }

    public function getLatestPostsWithComments(int $postsCount = 25, int $commentsCount = 3)
    {
        return Post::with(['comments' => function ($query) use ($commentsCount) {
            $query->latest()->take($commentsCount);
        }])->latest()->take($postsCount)->get();
    }
}
